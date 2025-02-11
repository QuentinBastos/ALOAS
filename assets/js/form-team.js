document.addEventListener('DOMContentLoaded', function () {
    const teamList = document.getElementById('team-list');
    const addTeamButton = document.getElementById('add-team');
    const prototype = teamList.dataset.prototype;
    let teamIndex = teamList.children.length;
    const maxTeams = 8;

    const popup = document.getElementById('image-popup');
    const closePopup = document.querySelector('.close-popup');
    let selectedPlaceholder = null;

    function openPopup(placeholder) {
        selectedPlaceholder = placeholder;
        popup.style.display = 'flex';
    }

    function closeImagePopup() {
        popup.style.display = 'none';
        selectedPlaceholder = null;
    }

    document.querySelector('.popup-images').addEventListener('click', function (event) {
        if (event.target.classList.contains('popup-team-logo') && selectedPlaceholder) {
            const teamIndex = selectedPlaceholder.getAttribute('data-team-index');
            const input = document.querySelector(`.selected-team-name[data-team-index="${teamIndex}"]`);
            const previewImage = selectedPlaceholder.querySelector('.team-preview');

            if (input && previewImage) {
                input.value = event.target.dataset.name;
                const imagePath = event.target.src.split(window.location.origin)[1];
                previewImage.src = imagePath;
            }
            closeImagePopup();
        }
    });

    closePopup.addEventListener('click', closeImagePopup);

    function addRemoveButton(teamContainer) {
        if (teamContainer.getAttribute('data-team-index') === "0") {
            return;
        }

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'remove-team btn btn-danger';
        removeButton.innerText = 'X';
        removeButton.addEventListener('click', function () {
            teamContainer.remove();
            teamIndex--;
            addTeamButton.disabled = false;
        });

        teamContainer.appendChild(removeButton);
    }

    addTeamButton.addEventListener('click', function () {
        if (teamIndex >= maxTeams) {
            alert('Vous ne pouvez pas ajouter plus de 8 équipes.');
            return;
        }

        const newForm = prototype.replace(/__name__/g, teamIndex);
        const newFormContainer = document.createElement('div');
        newFormContainer.classList.add('team-item');
        newFormContainer.setAttribute('data-team-index', teamIndex);
        newFormContainer.innerHTML = newForm;

        // Ajouter un nouvel input avec le bon data-team-index
        const newInput = newFormContainer.querySelector('.selected-team-name');
        if (newInput) {
            newInput.setAttribute('data-team-index', teamIndex);
        }

        // Ajout du carré blanc cliquable avec une image par défaut
        const textTeam = document.createElement('p')
        textTeam.textContent= teamIndex + ". Equipe";

        const imagePlaceholder = document.createElement('div');
        imagePlaceholder.classList.add('image-placeholder');
        imagePlaceholder.setAttribute('data-team-index', teamIndex);

        const previewImage = document.createElement('img');
        previewImage.src = "/build/images/default.png";
        previewImage.alt = "";
        previewImage.classList.add('team-preview');

        imagePlaceholder.appendChild(previewImage);
        imagePlaceholder.addEventListener('click', function () {
            openPopup(this);
        });

        newFormContainer.prepend(imagePlaceholder);
        newFormContainer.prepend(textTeam)

        addRemoveButton(newFormContainer);

        teamList.appendChild(newFormContainer);
        teamIndex++;

        if (teamIndex >= maxTeams) {
            addTeamButton.disabled = true;
        }
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('image-placeholder')) {
            openPopup(event.target);
        }
    });

    document.querySelectorAll('.team-item').forEach(item => {
        const input = item.querySelector('.selected-team-name');
        if (input) {
            input.setAttribute('data-team-index', item.getAttribute('data-team-index'));
        }

        item.querySelector('.image-placeholder').addEventListener('click', function () {
            openPopup(this);
        });

        if (item.getAttribute('data-team-index') !== "0") {
            addRemoveButton(item);
        }
    });
});
