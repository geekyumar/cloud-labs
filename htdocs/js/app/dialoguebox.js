function openInfoDialog() {
    document.getElementById('dialogOverlay').classList.add('active');
    document.querySelector('.dialog-box').classList.add('active');
}

function closeInfoDialog() {
    document.querySelector('.dialog-box').classList.add('fadeOut');
    setTimeout(() => {
        document.getElementById('dialogOverlay').classList.remove('active');
        document.querySelector('.dialog-box').classList.remove('active', 'fadeOut');
    }, 500);
}