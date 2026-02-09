document.addEventListener('DOMContentLoaded', () => {
const btn = document.getElementById('like-btn');
const count = document.getElementById('like-count');
if (!btn || !count) return;
btn.addEventListener('click', function () {
    const itemId = btn.dataset.itemId;

    fetch(`/item/${itemId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
    })
    .then(res => res.json())
    .then(data => {
        btn.classList.toggle('liked', data.liked);
        count.innerHTML = data.likedCount;
    });
});
});
