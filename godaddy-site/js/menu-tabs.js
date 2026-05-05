(function () {
    var tabs = Array.prototype.slice.call(document.querySelectorAll('.category-tab'));
    var panels = document.querySelectorAll('.menu-panel');

    function activate(targetId, options) {
        options = options || {};
        var found = false;
        tabs.forEach(function (t) {
            var active = t.getAttribute('data-tab') === targetId;
            if (active) found = true;
            t.classList.toggle('active', active);
            t.setAttribute('aria-selected', active ? 'true' : 'false');
            t.tabIndex = active ? 0 : -1;
        });
        if (!found) return false;
        panels.forEach(function (p) {
            p.classList.toggle('active', p.getAttribute('data-panel') === targetId);
        });
        if (options.updateHash) {
            history.replaceState(null, '', '#' + targetId);
        }
        if (options.focus) {
            var match = tabs.filter(function (t) { return t.getAttribute('data-tab') === targetId; })[0];
            if (match) match.focus();
        }
        return true;
    }

    tabs.forEach(function (tab, idx) {
        tab.addEventListener('click', function () {
            activate(tab.getAttribute('data-tab'), { updateHash: true });
        });
        tab.addEventListener('keydown', function (e) {
            var next = null;
            if (e.key === 'ArrowRight') next = tabs[(idx + 1) % tabs.length];
            else if (e.key === 'ArrowLeft') next = tabs[(idx - 1 + tabs.length) % tabs.length];
            else if (e.key === 'Home') next = tabs[0];
            else if (e.key === 'End') next = tabs[tabs.length - 1];
            if (next) {
                e.preventDefault();
                activate(next.getAttribute('data-tab'), { updateHash: true, focus: true });
            }
        });
    });

    var initial = (location.hash || '').replace('#', '');
    if (!initial || !activate(initial)) {
        activate(tabs[0].getAttribute('data-tab'));
    }

    window.addEventListener('hashchange', function () {
        var id = (location.hash || '').replace('#', '');
        if (id) activate(id);
    });
})();
