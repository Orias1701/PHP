document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search');
    const cards = Array.from(document.querySelectorAll('.card[data-url]'));

    function filterCards() {
        const q = searchInput.value.trim().toLowerCase();
        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            card.style.display = text.includes(q) ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterCards);

    cards.forEach(card => {
        card.addEventListener('click', function() {
            const url = card.getAttribute('data-url');
            window.open(url, '_blank');
        });
        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                card.click();
            }
        });
    });
});