// Toggle theme sáng/tối
document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('theme-toggle');
    const body = document.body;

    // Kiểm tra theme hiện tại từ localStorage
    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark');
        toggleButton.textContent = '☀️'; // Biểu tượng mặt trời cho dark mode
    } else {
        toggleButton.textContent = '🌓'; // Biểu tượng mặc định
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