document.querySelector('.security-v2__menu')?.addEventListener('click', function () {
    const expanded = this.getAttribute('aria-expanded') === 'true';
    this.setAttribute('aria-expanded', String(!expanded));
    this.setAttribute('aria-label', expanded ? 'Abrir menu' : 'Fechar menu');
    document.getElementById('security-navigation').classList.toggle('is-open', !expanded);
});
document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        const toggle = document.querySelector('.security-v2__menu');
        if (toggle?.getAttribute('aria-expanded') === 'true') { toggle.click(); toggle.focus(); }
    }
});
