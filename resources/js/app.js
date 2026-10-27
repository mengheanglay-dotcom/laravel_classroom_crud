const loadDirectoryResults = async (url, form, results) => {
    results.setAttribute('aria-busy', 'true');

    try {
        const response = await fetch(url, {
            headers: {
                Accept: 'text/html',
                'X-Requested-With': 'XMLHttpRequest',
            },
        });

        if (!response.ok) {
            throw new Error(`Directory request failed with status ${response.status}`);
        }

        const html = await response.text();
        const documentParser = new DOMParser();
        const page = documentParser.parseFromString(html, 'text/html');
        const nextResults = page.querySelector('[data-directory-results]');
        const nextForm = page.querySelector('[data-directory-filter]');

        if (!nextResults || !nextForm) {
            throw new Error('Directory response did not contain the expected results.');
        }

        results.replaceChildren(...nextResults.childNodes);
        form.replaceChildren(...nextForm.childNodes);
        window.history.pushState({}, '', url);
    } finally {
        results.removeAttribute('aria-busy');
    }
};

document.addEventListener('submit', (event) => {
    const form = event.target.closest('[data-directory-filter]');

    if (!form) {
        return;
    }

    event.preventDefault();
    const results = document.querySelector('[data-directory-results]');
    const url = new URL(form.action, window.location.origin);
    const formData = new FormData(form);

    url.search = new URLSearchParams(formData).toString();
    loadDirectoryResults(url, form, results).catch(() => {
        window.location.assign(url);
    });
});

document.addEventListener('change', (event) => {
    if (event.target.matches('[data-directory-filter] select')) {
        event.target.form.requestSubmit();
    }
});

document.addEventListener('click', (event) => {
    const reset = event.target.closest('[data-directory-reset]');

    if (reset) {
        event.preventDefault();
        const form = document.querySelector('[data-directory-filter]');
        const results = document.querySelector('[data-directory-results]');

        loadDirectoryResults(reset.href, form, results).catch(() => {
            window.location.assign(reset.href);
        });
        return;
    }

    const link = event.target.closest('[data-directory-results] a');

    if (!link || !link.href) {
        return;
    }

    event.preventDefault();
    const form = document.querySelector('[data-directory-filter]');
    const results = document.querySelector('[data-directory-results]');

    loadDirectoryResults(link.href, form, results).catch(() => {
        window.location.assign(link.href);
    });
});

window.addEventListener('popstate', () => {
    const form = document.querySelector('[data-directory-filter]');
    const results = document.querySelector('[data-directory-results]');

    if (form && results) {
        loadDirectoryResults(window.location.href, form, results).catch(() => {
            window.location.reload();
        });
    }
});
