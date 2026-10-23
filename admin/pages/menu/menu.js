(function () {
    'use strict';

    var modal = document.getElementById('menuCrop');
    if (!modal) return;

    var canvas = document.getElementById('menuCropCanvas');
    var ctx = canvas.getContext('2d');
    var zoom = document.getElementById('menuCropZoom');
    var zoomValue = document.getElementById('menuCropZoomValue');
    var title = document.getElementById('menuCropTitle');
    var hint = document.getElementById('menuCropHint');
    var help = modal.querySelector('.adminMenuCrop__help');
    var apply = document.getElementById('menuCropApply');
    var committed = new WeakMap();
    var active = null;
    var previousOverflow = '';

    function frame(width, height) {
        var ratio = width / height;
        var maxWidth = 620;
        var maxHeight = 440;
        var frameWidth = Math.min(maxWidth, maxHeight * ratio);
        var frameHeight = frameWidth / ratio;
        return { x: (canvas.width - frameWidth) / 2, y: (canvas.height - frameHeight) / 2, width: frameWidth, height: frameHeight };
    }

    function clampPosition() {
        if (!active) return;
        var scaledWidth = active.image.naturalWidth * active.scale;
        var scaledHeight = active.image.naturalHeight * active.scale;
        var maxX = Math.max(0, (scaledWidth - active.frame.width) / 2);
        var maxY = Math.max(0, (scaledHeight - active.frame.height) / 2);
        active.dx = Math.max(-maxX, Math.min(maxX, active.dx));
        active.dy = Math.max(-maxY, Math.min(maxY, active.dy));
    }

    function draw() {
        if (!active) return;
        var f = active.frame;
        var scaledWidth = active.image.naturalWidth * active.scale;
        var scaledHeight = active.image.naturalHeight * active.scale;
        active.imageX = f.x + f.width / 2 - scaledWidth / 2 + active.dx;
        active.imageY = f.y + f.height / 2 - scaledHeight / 2 + active.dy;

        ctx.fillStyle = '#0b1930';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(active.image, active.imageX, active.imageY, scaledWidth, scaledHeight);
        ctx.fillStyle = 'rgba(3, 11, 27, .72)';
        ctx.fillRect(0, 0, canvas.width, f.y);
        ctx.fillRect(0, f.y + f.height, canvas.width, canvas.height - f.y - f.height);
        ctx.fillRect(0, f.y, f.x, f.height);
        ctx.fillRect(f.x + f.width, f.y, canvas.width - f.x - f.width, f.height);
        ctx.strokeStyle = '#fff';
        ctx.lineWidth = 3;
        ctx.strokeRect(f.x, f.y, f.width, f.height);
        ctx.strokeStyle = 'rgba(255, 255, 255, .42)';
        ctx.lineWidth = 1;
        for (var n = 1; n < 3; n++) {
            var x = f.x + f.width * n / 3;
            var y = f.y + f.height * n / 3;
            ctx.beginPath(); ctx.moveTo(x, f.y); ctx.lineTo(x, f.y + f.height); ctx.stroke();
            ctx.beginPath(); ctx.moveTo(f.x, y); ctx.lineTo(f.x + f.width, y); ctx.stroke();
        }
    }

    function restoreInput(input) {
        var old = committed.get(input);
        if (old) {
            var transfer = new DataTransfer();
            transfer.items.add(old);
            input.files = transfer.files;
        } else {
            input.value = '';
        }
    }

    function close() {
        if (!active) return;
        var input = active.input;
        restoreInput(input);
        URL.revokeObjectURL(active.sourceUrl);
        active = null;
        modal.hidden = true;
        document.body.style.overflow = previousOverflow;
        input.focus();
    }

    function open(input, file) {
        if (!file.type.match(/^image\/(jpeg|png|webp)$/) || file.size > 20 * 1024 * 1024) {
            alert('Selecione uma imagem JPG, PNG ou WebP de até 20 MB para recortar.');
            restoreInput(input);
            return;
        }
        var sourceUrl = URL.createObjectURL(file);
        var image = new Image();
        image.onload = function () {
            if (!image.naturalWidth || !image.naturalHeight || image.naturalWidth * image.naturalHeight > 40000000) {
                URL.revokeObjectURL(sourceUrl);
                restoreInput(input);
                alert('A imagem é grande demais para o editor. Use até 40 megapixels.');
                return;
            }
            var width = Number(input.dataset.cropWidth);
            var height = Number(input.dataset.cropHeight);
            var cropFrame = frame(width, height);
            var baseScale = Math.max(cropFrame.width / image.naturalWidth, cropFrame.height / image.naturalHeight);
            active = { input: input, image: image, sourceUrl: sourceUrl, width: width, height: height, frame: cropFrame, baseScale: baseScale, scale: baseScale, dx: 0, dy: 0, dragging: false };
            zoom.value = '100';
            zoomValue.textContent = '100%';
            title.textContent = 'Recortar: ' + input.dataset.cropLabel;
            hint.textContent = 'Área final: ' + width + ' × ' + height + ' px';
            help.textContent = 'Arraste a imagem ou use as setas do teclado para posicionar o conteúdo dentro da máscara.';
            help.style.color = '';
            previousOverflow = document.body.style.overflow;
            document.body.style.overflow = 'hidden';
            modal.hidden = false;
            draw();
            canvas.focus();
        };
        image.onerror = function () {
            URL.revokeObjectURL(sourceUrl);
            restoreInput(input);
            alert('Não foi possível abrir esta imagem.');
        };
        image.src = sourceUrl;
    }

    document.querySelectorAll('.adminMenu__field--image input[type="file"]').forEach(function (input) {
        input.addEventListener('change', function () {
            if (input.files && input.files[0]) open(input, input.files[0]);
        });
    });

    zoom.addEventListener('input', function () {
        if (!active) return;
        active.scale = active.baseScale * Number(zoom.value) / 100;
        zoomValue.textContent = zoom.value + '%';
        clampPosition();
        draw();
    });

    canvas.addEventListener('pointerdown', function (event) {
        if (!active) return;
        canvas.setPointerCapture(event.pointerId);
        active.dragging = true;
        active.pointerX = event.clientX;
        active.pointerY = event.clientY;
    });
    canvas.addEventListener('pointermove', function (event) {
        if (!active || !active.dragging) return;
        var rect = canvas.getBoundingClientRect();
        active.dx += (event.clientX - active.pointerX) * canvas.width / rect.width;
        active.dy += (event.clientY - active.pointerY) * canvas.height / rect.height;
        active.pointerX = event.clientX;
        active.pointerY = event.clientY;
        clampPosition();
        draw();
    });
    canvas.addEventListener('pointerup', function () { if (active) active.dragging = false; });
    canvas.addEventListener('pointercancel', function () { if (active) active.dragging = false; });
    canvas.addEventListener('keydown', function (event) {
        if (!active) return;
        var step = event.shiftKey ? 20 : 5;
        if (event.key === 'ArrowLeft') active.dx -= step;
        else if (event.key === 'ArrowRight') active.dx += step;
        else if (event.key === 'ArrowUp') active.dy -= step;
        else if (event.key === 'ArrowDown') active.dy += step;
        else return;
        event.preventDefault();
        clampPosition();
        draw();
    });

    modal.querySelectorAll('[data-crop-cancel]').forEach(function (button) { button.addEventListener('click', close); });
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && active) close();
    });

    apply.addEventListener('click', async function () {
        if (!active) return;
        apply.disabled = true;
        try {
            var crop = active;
            var output = document.createElement('canvas');
            output.width = crop.width;
            output.height = crop.height;
            var outputCtx = output.getContext('2d');
            var sx = (crop.frame.x - crop.imageX) / crop.scale;
            var sy = (crop.frame.y - crop.imageY) / crop.scale;
            var sw = crop.frame.width / crop.scale;
            var sh = crop.frame.height / crop.scale;
            outputCtx.drawImage(crop.image, sx, sy, sw, sh, 0, 0, crop.width, crop.height);
            var blob = null;
            for (var quality of [0.92, 0.8, 0.65]) {
                blob = await new Promise(function (resolve) { output.toBlob(resolve, 'image/webp', quality); });
                if (blob && blob.type === 'image/webp' && blob.size <= 3 * 1024 * 1024) break;
            }
            if (!blob || blob.type !== 'image/webp' || blob.size > 3 * 1024 * 1024) throw new Error('Não foi possível gerar um arquivo WebP de até 3 MB.');
            var key = crop.input.name.match(/\[([^\]]+)\]/)[1];
            var newFile = new File([blob], key + '.webp', { type: 'image/webp' });
            committed.set(crop.input, newFile);
            var preview = crop.input.closest('.adminMenu__field').querySelector('img');
            if (preview.dataset.previewUrl) URL.revokeObjectURL(preview.dataset.previewUrl);
            preview.dataset.previewUrl = URL.createObjectURL(blob);
            preview.src = preview.dataset.previewUrl;
            close();
        } catch (error) {
            help.textContent = error.message || 'Não foi possível aplicar o recorte.';
            help.style.color = '#b42332';
        } finally {
            apply.disabled = false;
        }
    });
}());
