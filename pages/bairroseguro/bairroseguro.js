(function () {
    document.querySelectorAll('.safe-neighborhood__faq button').forEach(function (button) {
        button.addEventListener('click', function () {
            var panel = document.getElementById(button.getAttribute('aria-controls'));
            var isOpen = button.getAttribute('aria-expanded') === 'true';

            button.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
            button.querySelector('b').textContent = isOpen ? '+' : '−';
            panel.hidden = isOpen;
        });
    });
}());