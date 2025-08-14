document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('theme-toggle');
    const body = document.body;

    // Set dark theme as default if no theme is stored in localStorage
    if (localStorage.getItem('theme') !== 'light') {
        body.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        toggleButton.textContent = '☀️'; // Sun icon for dark mode
    } else {
        toggleButton.textContent = '🌓'; // Default icon for light mode
    }

    toggleButton.addEventListener('click', () => {
        body.classList.toggle('dark');
        if (body.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
            toggleButton.textContent = '☀️';
        } else {
            localStorage.setItem('theme', 'light');
            toggleButton.textContent = '🌓';
        }
    });
});