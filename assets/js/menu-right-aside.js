document.addEventListener('DOMContentLoaded', () => {
    const helpAside = document.getElementById('rightAside');
    const buttonInsideAside = document.getElementById('buttonAside');
    const buttonClose = document.getElementById('buttonClose');

    if (helpAside && buttonInsideAside) {
        buttonClose.addEventListener('click', () => {
            if (helpAside.classList.contains('hidden')) {
                helpAside.classList.remove('hidden');
            } else {
                helpAside.classList.add('hidden');
            }
        });
        buttonInsideAside.addEventListener('click', () => {
            if (helpAside.classList.contains('hidden')) {
                helpAside.classList.remove('hidden');
            } else {
                helpAside.classList.add('hidden');
            }
        });
    }
});