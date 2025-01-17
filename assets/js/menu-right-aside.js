ocument.addEventListener('DOMContentLoaded', () => {
    console.log('menu-right-aside.js');
    const helpAside = document.getElementById('helpAside');
    const buttonInsideAside = document.getElementById('buttonAside');
    const sidebar = document.getElementById('rightAside');

    if (helpAside && sidebar && buttonInsideAside) {
        helpAside.addEventListener('click', () => {
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
            } else {
                sidebar.classList.add('hidden');
            }
        });
        buttonInsideAside.addEventListener('click', () => {
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
            } else {
                sidebar.classList.add('hidden');
            }
        });
    }
});