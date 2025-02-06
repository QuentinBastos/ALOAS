document.querySelectorAll('.team-logo').forEach(img => {
    img.addEventListener('click', function () {
        document.querySelectorAll('.team-logo').forEach(el => el.classList.remove('selected'));
        this.classList.add('selected');
        document.querySelector('.selected-team-name').value = this.dataset.name;
    });
});