document.addEventListener('DOMContentLoaded', () => {
    const menuBurger = document.getElementById('menu-burger');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');

    if (menuBurger && sidebar && mainContent) {
        menuBurger.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('full-width');
        });
    }
});
