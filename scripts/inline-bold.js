(function () {
    'use strict';

    function apply(root) {
        if (!root || !root.isConnected) return;
        var walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT);
        var nodes = [];
        while (walker.nextNode()) nodes.push(walker.currentNode);
        nodes.forEach(function (node) {
            if (!node.nodeValue.includes('**')) return;
            if (node.parentElement.closest('script, style, textarea, code, pre, svg, select, option, [contenteditable]')) return;
            var pattern = /\*\*([\s\S]+?)\*\*/g;
            var value = node.nodeValue;
            var match;
            var last = 0;
            var fragment = document.createDocumentFragment();
            while ((match = pattern.exec(value)) !== null) {
                fragment.append(document.createTextNode(value.slice(last, match.index)));
                var strong = document.createElement('strong');
                strong.className = 'siteInlineBold';
                strong.textContent = match[1];
                fragment.append(strong);
                last = pattern.lastIndex;
            }
            if (!last) return;
            fragment.append(document.createTextNode(value.slice(last)));
            node.replaceWith(fragment);
        });
    }

    function start() {
        apply(document.body);
        var observer = new MutationObserver(function (changes) {
            changes.forEach(function (change) {
                if (change.type === 'characterData') {
                    apply(change.target.parentElement);
                    return;
                }
                change.addedNodes.forEach(function (node) {
                    if (node.nodeType === Node.ELEMENT_NODE) apply(node);
                    else if (node.nodeType === Node.TEXT_NODE) apply(node.parentElement);
                });
            });
        });
        observer.observe(document.body, { childList: true, characterData: true, subtree: true });
    }

    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', start);
    else start();
})();
