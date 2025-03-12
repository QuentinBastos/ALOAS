(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _js_menu_burger_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./js/menu-burger.js */ "./assets/js/menu-burger.js");
/* harmony import */ var _js_menu_burger_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_js_menu_burger_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _js_menu_right_aside_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./js/menu-right-aside.js */ "./assets/js/menu-right-aside.js");
/* harmony import */ var _js_menu_right_aside_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_js_menu_right_aside_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _js_step_form_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./js/step-form.js */ "./assets/js/step-form.js");
/* harmony import */ var _js_step_form_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_js_step_form_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _js_form_team_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./js/form-team.js */ "./assets/js/form-team.js");
/* harmony import */ var _js_form_team_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_js_form_team_js__WEBPACK_IMPORTED_MODULE_3__);





/***/ }),

/***/ "./assets/js/form-team.js":
/*!********************************!*\
  !*** ./assets/js/form-team.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
__webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
__webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
__webpack_require__(/*! core-js/modules/es.string.split.js */ "./node_modules/core-js/modules/es.string.split.js");
__webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
document.addEventListener('DOMContentLoaded', function () {
  var teamList = document.getElementById('team-list');
  var addTeamButton = document.getElementById('add-team');
  var prototype = teamList.dataset.prototype;
  var teamIndex = teamList.children.length;
  var maxTeams = 8;
  var popup = document.getElementById('image-popup');
  var closePopup = document.querySelector('.close-popup');
  var selectedPlaceholder = null;
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
      var _teamIndex = selectedPlaceholder.getAttribute('data-team-index');
      var input = document.querySelector(".selected-team-name[data-team-index=\"".concat(_teamIndex, "\"]"));
      var previewImage = selectedPlaceholder.querySelector('.team-preview');
      if (input && previewImage) {
        input.value = event.target.dataset.name;
        var imagePath = event.target.src.split(window.location.origin)[1];
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
    var removeButton = document.createElement('button');
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
    var newForm = prototype.replace(/__name__/g, teamIndex);
    var newFormContainer = document.createElement('div');
    newFormContainer.classList.add('team-item');
    newFormContainer.setAttribute('data-team-index', teamIndex);
    newFormContainer.innerHTML = newForm;

    // Ajouter un nouvel input avec le bon data-team-index
    var newInput = newFormContainer.querySelector('.selected-team-name');
    if (newInput) {
      newInput.setAttribute('data-team-index', teamIndex);
    }

    // Ajout du carré blanc cliquable avec une image par défaut
    var textTeam = document.createElement('p');
    textTeam.textContent = teamIndex + ". Equipe";
    var imagePlaceholder = document.createElement('div');
    imagePlaceholder.classList.add('image-placeholder');
    imagePlaceholder.setAttribute('data-team-index', teamIndex);
    var previewImage = document.createElement('img');
    previewImage.src = "/build/images/default.png";
    previewImage.alt = "";
    previewImage.classList.add('team-preview');
    imagePlaceholder.appendChild(previewImage);
    imagePlaceholder.addEventListener('click', function () {
      openPopup(this);
    });
    newFormContainer.prepend(imagePlaceholder);
    newFormContainer.prepend(textTeam);
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
  document.querySelectorAll('.team-item').forEach(function (item) {
    var input = item.querySelector('.selected-team-name');
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

/***/ }),

/***/ "./assets/js/menu-burger.js":
/*!**********************************!*\
  !*** ./assets/js/menu-burger.js ***!
  \**********************************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', function () {
  var menuBurger = document.getElementById('menu-burger');
  var sidebar = document.getElementById('sidebar');
  var mainContent = document.querySelector('.main-content');
  if (menuBurger && sidebar && mainContent) {
    menuBurger.addEventListener('click', function () {
      sidebar.classList.toggle('hidden');
      mainContent.classList.toggle('full-width');
    });
  }
});

/***/ }),

/***/ "./assets/js/menu-right-aside.js":
/*!***************************************!*\
  !*** ./assets/js/menu-right-aside.js ***!
  \***************************************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', function () {
  var helpAside = document.getElementById('rightAside');
  var buttonInsideAside = document.getElementById('buttonAside');
  var buttonClose = document.getElementById('buttonClose');
  if (helpAside && buttonInsideAside) {
    buttonClose.addEventListener('click', function () {
      if (helpAside.classList.contains('hidden')) {
        helpAside.classList.remove('hidden');
      } else {
        helpAside.classList.add('hidden');
      }
    });
    buttonInsideAside.addEventListener('click', function () {
      if (helpAside.classList.contains('hidden')) {
        helpAside.classList.remove('hidden');
      } else {
        helpAside.classList.add('hidden');
      }
    });
  }
});

/***/ }),

/***/ "./assets/js/step-form.js":
/*!********************************!*\
  !*** ./assets/js/step-form.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
__webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
document.addEventListener("DOMContentLoaded", function () {
  var steps = document.querySelectorAll(".form-step");
  var stepIcons = document.querySelectorAll(".step-icon");
  var stepTexts = document.querySelectorAll(".step-text");
  if (steps && stepIcons && stepTexts) {
    var currentStep = 0;
    var showStep = function showStep(stepIndex) {
      steps.forEach(function (step, index) {
        step.style.display = index === stepIndex ? 'flex' : 'none';
      });
      stepIcons.forEach(function (icon, index) {
        if (index <= stepIndex) {
          icon.classList.add('active');
        } else {
          icon.classList.remove('active');
        }
      });
      stepTexts.forEach(function (text, index) {
        text.style.display = index === stepIndex ? 'block' : 'none';
      });
    };
    document.getElementById("next-step-1").addEventListener("click", function () {
      currentStep = 1;
      showStep(currentStep);
    });
    document.getElementById("prev-step-2").addEventListener("click", function () {
      currentStep = 0;
      showStep(currentStep);
    });
    document.getElementById("next-step-2").addEventListener("click", function () {
      currentStep = 2;
      showStep(currentStep);
    });
    document.getElementById("prev-step-3").addEventListener("click", function () {
      currentStep = 1;
      showStep(currentStep);
    });
    showStep(currentStep);
  }
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_internals_array-species-create_js-node_modules_core-js_modules_e-f827ea","vendors-node_modules_core-js_modules_es_array_for-each_js-node_modules_core-js_modules_es_fun-9754aa"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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USxDQUFDRCxXQUFXLENBQUM7SUFDekIsQ0FBQyxDQUFDO0lBRUZ4RSxRQUFRLENBQUNHLGNBQWMsQ0FBQyxhQUFhLENBQUMsQ0FBQ0YsZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFlBQU07TUFDbkV1RSxXQUFXLEdBQUcsQ0FBQztNQUNmQyxRQUFRLENBQUNELFdBQVcsQ0FBQztJQUN6QixDQUFDLENBQUM7SUFFRnhFLFFBQVEsQ0FBQ0csY0FBYyxDQUFDLGFBQWEsQ0FBQyxDQUFDRixnQkFBZ0IsQ0FBQyxPQUFPLEVBQUUsWUFBTTtNQUNuRXVFLFdBQVcsR0FBRyxDQUFDO01BQ2ZDLFFBQVEsQ0FBQ0QsV0FBVyxDQUFDO0lBQ3pCLENBQUMsQ0FBQztJQUVGQyxRQUFRLENBQUNELFdBQVcsQ0FBQztFQUN6QjtBQUNKLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2Zvcm0tdGVhbS5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvbWVudS1idXJnZXIuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL21lbnUtcmlnaHQtYXNpZGUuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL3N0ZXAtZm9ybS5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgJy4vanMvbWVudS1idXJnZXIuanMnO1xyXG5pbXBvcnQgJy4vanMvbWVudS1yaWdodC1hc2lkZS5qcyc7XHJcbmltcG9ydCAnLi9qcy9zdGVwLWZvcm0uanMnO1xyXG5pbXBvcnQgJy4vanMvZm9ybS10ZWFtLmpzJzsiLCJkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCdET01Db250ZW50TG9hZGVkJywgZnVuY3Rpb24gKCkge1xyXG4gICAgY29uc3QgdGVhbUxpc3QgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgndGVhbS1saXN0Jyk7XHJcbiAgICBjb25zdCBhZGRUZWFtQnV0dG9uID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2FkZC10ZWFtJyk7XHJcbiAgICBjb25zdCBwcm90b3R5cGUgPSB0ZWFtTGlzdC5kYXRhc2V0LnByb3RvdHlwZTtcclxuICAgIGxldCB0ZWFtSW5kZXggPSB0ZWFtTGlzdC5jaGlsZHJlbi5sZW5ndGg7XHJcbiAgICBjb25zdCBtYXhUZWFtcyA9IDg7XHJcblxyXG4gICAgY29uc3QgcG9wdXAgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnaW1hZ2UtcG9wdXAnKTtcclxuICAgIGNvbnN0IGNsb3NlUG9wdXAgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuY2xvc2UtcG9wdXAnKTtcclxuICAgIGxldCBzZWxlY3RlZFBsYWNlaG9sZGVyID0gbnVsbDtcclxuXHJcbiAgICBmdW5jdGlvbiBvcGVuUG9wdXAocGxhY2Vob2xkZXIpIHtcclxuICAgICAgICBzZWxlY3RlZFBsYWNlaG9sZGVyID0gcGxhY2Vob2xkZXI7XHJcbiAgICAgICAgcG9wdXAuc3R5bGUuZGlzcGxheSA9ICdmbGV4JztcclxuICAgIH1cclxuXHJcbiAgICBmdW5jdGlvbiBjbG9zZUltYWdlUG9wdXAoKSB7XHJcbiAgICAgICAgcG9wdXAuc3R5bGUuZGlzcGxheSA9ICdub25lJztcclxuICAgICAgICBzZWxlY3RlZFBsYWNlaG9sZGVyID0gbnVsbDtcclxuICAgIH1cclxuXHJcbiAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcucG9wdXAtaW1hZ2VzJykuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoZXZlbnQpIHtcclxuICAgICAgICBpZiAoZXZlbnQudGFyZ2V0LmNsYXNzTGlzdC5jb250YWlucygncG9wdXAtdGVhbS1sb2dvJykgJiYgc2VsZWN0ZWRQbGFjZWhvbGRlcikge1xyXG4gICAgICAgICAgICBjb25zdCB0ZWFtSW5kZXggPSBzZWxlY3RlZFBsYWNlaG9sZGVyLmdldEF0dHJpYnV0ZSgnZGF0YS10ZWFtLWluZGV4Jyk7XHJcbiAgICAgICAgICAgIGNvbnN0IGlucHV0ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihgLnNlbGVjdGVkLXRlYW0tbmFtZVtkYXRhLXRlYW0taW5kZXg9XCIke3RlYW1JbmRleH1cIl1gKTtcclxuICAgICAgICAgICAgY29uc3QgcHJldmlld0ltYWdlID0gc2VsZWN0ZWRQbGFjZWhvbGRlci5xdWVyeVNlbGVjdG9yKCcudGVhbS1wcmV2aWV3Jyk7XHJcblxyXG4gICAgICAgICAgICBpZiAoaW5wdXQgJiYgcHJldmlld0ltYWdlKSB7XHJcbiAgICAgICAgICAgICAgICBpbnB1dC52YWx1ZSA9IGV2ZW50LnRhcmdldC5kYXRhc2V0Lm5hbWU7XHJcbiAgICAgICAgICAgICAgICBjb25zdCBpbWFnZVBhdGggPSBldmVudC50YXJnZXQuc3JjLnNwbGl0KHdpbmRvdy5sb2NhdGlvbi5vcmlnaW4pWzFdO1xyXG4gICAgICAgICAgICAgICAgcHJldmlld0ltYWdlLnNyYyA9IGltYWdlUGF0aDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBjbG9zZUltYWdlUG9wdXAoKTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuXHJcbiAgICBjbG9zZVBvcHVwLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgY2xvc2VJbWFnZVBvcHVwKTtcclxuXHJcbiAgICBmdW5jdGlvbiBhZGRSZW1vdmVCdXR0b24odGVhbUNvbnRhaW5lcikge1xyXG4gICAgICAgIGlmICh0ZWFtQ29udGFpbmVyLmdldEF0dHJpYnV0ZSgnZGF0YS10ZWFtLWluZGV4JykgPT09IFwiMFwiKSB7XHJcbiAgICAgICAgICAgIHJldHVybjtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGNvbnN0IHJlbW92ZUJ1dHRvbiA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2J1dHRvbicpO1xyXG4gICAgICAgIHJlbW92ZUJ1dHRvbi50eXBlID0gJ2J1dHRvbic7XHJcbiAgICAgICAgcmVtb3ZlQnV0dG9uLmNsYXNzTmFtZSA9ICdyZW1vdmUtdGVhbSBidG4gYnRuLWRhbmdlcic7XHJcbiAgICAgICAgcmVtb3ZlQnV0dG9uLmlubmVyVGV4dCA9ICdYJztcclxuICAgICAgICByZW1vdmVCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIHRlYW1Db250YWluZXIucmVtb3ZlKCk7XHJcbiAgICAgICAgICAgIHRlYW1JbmRleC0tO1xyXG4gICAgICAgICAgICBhZGRUZWFtQnV0dG9uLmRpc2FibGVkID0gZmFsc2U7XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIHRlYW1Db250YWluZXIuYXBwZW5kQ2hpbGQocmVtb3ZlQnV0dG9uKTtcclxuICAgIH1cclxuXHJcbiAgICBhZGRUZWFtQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIGlmICh0ZWFtSW5kZXggPj0gbWF4VGVhbXMpIHtcclxuICAgICAgICAgICAgYWxlcnQoJ1ZvdXMgbmUgcG91dmV6IHBhcyBham91dGVyIHBsdXMgZGUgOCDDqXF1aXBlcy4nKTtcclxuICAgICAgICAgICAgcmV0dXJuO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgY29uc3QgbmV3Rm9ybSA9IHByb3RvdHlwZS5yZXBsYWNlKC9fX25hbWVfXy9nLCB0ZWFtSW5kZXgpO1xyXG4gICAgICAgIGNvbnN0IG5ld0Zvcm1Db250YWluZXIgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdkaXYnKTtcclxuICAgICAgICBuZXdGb3JtQ29udGFpbmVyLmNsYXNzTGlzdC5hZGQoJ3RlYW0taXRlbScpO1xyXG4gICAgICAgIG5ld0Zvcm1Db250YWluZXIuc2V0QXR0cmlidXRlKCdkYXRhLXRlYW0taW5kZXgnLCB0ZWFtSW5kZXgpO1xyXG4gICAgICAgIG5ld0Zvcm1Db250YWluZXIuaW5uZXJIVE1MID0gbmV3Rm9ybTtcclxuXHJcbiAgICAgICAgLy8gQWpvdXRlciB1biBub3V2ZWwgaW5wdXQgYXZlYyBsZSBib24gZGF0YS10ZWFtLWluZGV4XHJcbiAgICAgICAgY29uc3QgbmV3SW5wdXQgPSBuZXdGb3JtQ29udGFpbmVyLnF1ZXJ5U2VsZWN0b3IoJy5zZWxlY3RlZC10ZWFtLW5hbWUnKTtcclxuICAgICAgICBpZiAobmV3SW5wdXQpIHtcclxuICAgICAgICAgICAgbmV3SW5wdXQuc2V0QXR0cmlidXRlKCdkYXRhLXRlYW0taW5kZXgnLCB0ZWFtSW5kZXgpO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLy8gQWpvdXQgZHUgY2FycsOpIGJsYW5jIGNsaXF1YWJsZSBhdmVjIHVuZSBpbWFnZSBwYXIgZMOpZmF1dFxyXG4gICAgICAgIGNvbnN0IHRleHRUZWFtID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgncCcpXHJcbiAgICAgICAgdGV4dFRlYW0udGV4dENvbnRlbnQ9IHRlYW1JbmRleCArIFwiLiBFcXVpcGVcIjtcclxuXHJcbiAgICAgICAgY29uc3QgaW1hZ2VQbGFjZWhvbGRlciA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2RpdicpO1xyXG4gICAgICAgIGltYWdlUGxhY2Vob2xkZXIuY2xhc3NMaXN0LmFkZCgnaW1hZ2UtcGxhY2Vob2xkZXInKTtcclxuICAgICAgICBpbWFnZVBsYWNlaG9sZGVyLnNldEF0dHJpYnV0ZSgnZGF0YS10ZWFtLWluZGV4JywgdGVhbUluZGV4KTtcclxuXHJcbiAgICAgICAgY29uc3QgcHJldmlld0ltYWdlID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnaW1nJyk7XHJcbiAgICAgICAgcHJldmlld0ltYWdlLnNyYyA9IFwiL2J1aWxkL2ltYWdlcy9kZWZhdWx0LnBuZ1wiO1xyXG4gICAgICAgIHByZXZpZXdJbWFnZS5hbHQgPSBcIlwiO1xyXG4gICAgICAgIHByZXZpZXdJbWFnZS5jbGFzc0xpc3QuYWRkKCd0ZWFtLXByZXZpZXcnKTtcclxuXHJcbiAgICAgICAgaW1hZ2VQbGFjZWhvbGRlci5hcHBlbmRDaGlsZChwcmV2aWV3SW1hZ2UpO1xyXG4gICAgICAgIGltYWdlUGxhY2Vob2xkZXIuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIG9wZW5Qb3B1cCh0aGlzKTtcclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgbmV3Rm9ybUNvbnRhaW5lci5wcmVwZW5kKGltYWdlUGxhY2Vob2xkZXIpO1xyXG4gICAgICAgIG5ld0Zvcm1Db250YWluZXIucHJlcGVuZCh0ZXh0VGVhbSlcclxuXHJcbiAgICAgICAgYWRkUmVtb3ZlQnV0dG9uKG5ld0Zvcm1Db250YWluZXIpO1xyXG5cclxuICAgICAgICB0ZWFtTGlzdC5hcHBlbmRDaGlsZChuZXdGb3JtQ29udGFpbmVyKTtcclxuICAgICAgICB0ZWFtSW5kZXgrKztcclxuXHJcbiAgICAgICAgaWYgKHRlYW1JbmRleCA+PSBtYXhUZWFtcykge1xyXG4gICAgICAgICAgICBhZGRUZWFtQnV0dG9uLmRpc2FibGVkID0gdHJ1ZTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuXHJcbiAgICBkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uIChldmVudCkge1xyXG4gICAgICAgIGlmIChldmVudC50YXJnZXQuY2xhc3NMaXN0LmNvbnRhaW5zKCdpbWFnZS1wbGFjZWhvbGRlcicpKSB7XHJcbiAgICAgICAgICAgIG9wZW5Qb3B1cChldmVudC50YXJnZXQpO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG5cclxuICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy50ZWFtLWl0ZW0nKS5mb3JFYWNoKGl0ZW0gPT4ge1xyXG4gICAgICAgIGNvbnN0IGlucHV0ID0gaXRlbS5xdWVyeVNlbGVjdG9yKCcuc2VsZWN0ZWQtdGVhbS1uYW1lJyk7XHJcbiAgICAgICAgaWYgKGlucHV0KSB7XHJcbiAgICAgICAgICAgIGlucHV0LnNldEF0dHJpYnV0ZSgnZGF0YS10ZWFtLWluZGV4JywgaXRlbS5nZXRBdHRyaWJ1dGUoJ2RhdGEtdGVhbS1pbmRleCcpKTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGl0ZW0ucXVlcnlTZWxlY3RvcignLmltYWdlLXBsYWNlaG9sZGVyJykuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIG9wZW5Qb3B1cCh0aGlzKTtcclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgaWYgKGl0ZW0uZ2V0QXR0cmlidXRlKCdkYXRhLXRlYW0taW5kZXgnKSAhPT0gXCIwXCIpIHtcclxuICAgICAgICAgICAgYWRkUmVtb3ZlQnV0dG9uKGl0ZW0pO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG59KTtcclxuIiwiZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignRE9NQ29udGVudExvYWRlZCcsICgpID0+IHtcclxuICAgIGNvbnN0IG1lbnVCdXJnZXIgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbWVudS1idXJnZXInKTtcclxuICAgIGNvbnN0IHNpZGViYXIgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnc2lkZWJhcicpO1xyXG4gICAgY29uc3QgbWFpbkNvbnRlbnQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcubWFpbi1jb250ZW50Jyk7XHJcblxyXG4gICAgaWYgKG1lbnVCdXJnZXIgJiYgc2lkZWJhciAmJiBtYWluQ29udGVudCkge1xyXG4gICAgICAgIG1lbnVCdXJnZXIuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB7XHJcbiAgICAgICAgICAgIHNpZGViYXIuY2xhc3NMaXN0LnRvZ2dsZSgnaGlkZGVuJyk7XHJcbiAgICAgICAgICAgIG1haW5Db250ZW50LmNsYXNzTGlzdC50b2dnbGUoJ2Z1bGwtd2lkdGgnKTtcclxuICAgICAgICB9KTtcclxuICAgIH1cclxufSk7XHJcbiIsImRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ0RPTUNvbnRlbnRMb2FkZWQnLCAoKSA9PiB7XHJcbiAgICBjb25zdCBoZWxwQXNpZGUgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncmlnaHRBc2lkZScpO1xyXG4gICAgY29uc3QgYnV0dG9uSW5zaWRlQXNpZGUgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYnV0dG9uQXNpZGUnKTtcclxuICAgIGNvbnN0IGJ1dHRvbkNsb3NlID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2J1dHRvbkNsb3NlJyk7XHJcblxyXG4gICAgaWYgKGhlbHBBc2lkZSAmJiBidXR0b25JbnNpZGVBc2lkZSkge1xyXG4gICAgICAgIGJ1dHRvbkNsb3NlLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4ge1xyXG4gICAgICAgICAgICBpZiAoaGVscEFzaWRlLmNsYXNzTGlzdC5jb250YWlucygnaGlkZGVuJykpIHtcclxuICAgICAgICAgICAgICAgIGhlbHBBc2lkZS5jbGFzc0xpc3QucmVtb3ZlKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgIGhlbHBBc2lkZS5jbGFzc0xpc3QuYWRkKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgICAgIGJ1dHRvbkluc2lkZUFzaWRlLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4ge1xyXG4gICAgICAgICAgICBpZiAoaGVscEFzaWRlLmNsYXNzTGlzdC5jb250YWlucygnaGlkZGVuJykpIHtcclxuICAgICAgICAgICAgICAgIGhlbHBBc2lkZS5jbGFzc0xpc3QucmVtb3ZlKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgIGhlbHBBc2lkZS5jbGFzc0xpc3QuYWRkKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG59KTsiLCJkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKFwiRE9NQ29udGVudExvYWRlZFwiLCBmdW5jdGlvbigpIHtcclxuICAgIGNvbnN0IHN0ZXBzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChcIi5mb3JtLXN0ZXBcIik7XHJcbiAgICBjb25zdCBzdGVwSWNvbnMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKFwiLnN0ZXAtaWNvblwiKTtcclxuICAgIGNvbnN0IHN0ZXBUZXh0cyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoXCIuc3RlcC10ZXh0XCIpO1xyXG5cclxuICAgIGlmIChzdGVwcyAmJiBzdGVwSWNvbnMgJiYgc3RlcFRleHRzKSB7XHJcbiAgICAgICAgbGV0IGN1cnJlbnRTdGVwID0gMDtcclxuXHJcbiAgICAgICAgY29uc3Qgc2hvd1N0ZXAgPSAoc3RlcEluZGV4KSA9PiB7XHJcblxyXG4gICAgICAgICAgICBzdGVwcy5mb3JFYWNoKChzdGVwLCBpbmRleCkgPT4ge1xyXG4gICAgICAgICAgICAgICAgc3RlcC5zdHlsZS5kaXNwbGF5ID0gaW5kZXggPT09IHN0ZXBJbmRleCA/ICdmbGV4JyA6ICdub25lJztcclxuICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICAgICBzdGVwSWNvbnMuZm9yRWFjaCgoaWNvbiwgaW5kZXgpID0+IHtcclxuICAgICAgICAgICAgICAgIGlmIChpbmRleCA8PSBzdGVwSW5kZXgpIHtcclxuICAgICAgICAgICAgICAgICAgICBpY29uLmNsYXNzTGlzdC5hZGQoJ2FjdGl2ZScpO1xyXG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgICAgICBpY29uLmNsYXNzTGlzdC5yZW1vdmUoJ2FjdGl2ZScpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgIHN0ZXBUZXh0cy5mb3JFYWNoKCh0ZXh0LCBpbmRleCkgPT4ge1xyXG4gICAgICAgICAgICAgICAgdGV4dC5zdHlsZS5kaXNwbGF5ID0gaW5kZXggPT09IHN0ZXBJbmRleCA/ICdibG9jaycgOiAnbm9uZSc7XHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH07XHJcblxyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibmV4dC1zdGVwLTFcIikuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsICgpID0+IHtcclxuICAgICAgICAgICAgY3VycmVudFN0ZXAgPSAxO1xyXG4gICAgICAgICAgICBzaG93U3RlcChjdXJyZW50U3RlcCk7XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwicHJldi1zdGVwLTJcIikuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsICgpID0+IHtcclxuICAgICAgICAgICAgY3VycmVudFN0ZXAgPSAwO1xyXG4gICAgICAgICAgICBzaG93U3RlcChjdXJyZW50U3RlcCk7XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibmV4dC1zdGVwLTJcIikuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsICgpID0+IHtcclxuICAgICAgICAgICAgY3VycmVudFN0ZXAgPSAyO1xyXG4gICAgICAgICAgICBzaG93U3RlcChjdXJyZW50U3RlcCk7XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwicHJldi1zdGVwLTNcIikuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsICgpID0+IHtcclxuICAgICAgICAgICAgY3VycmVudFN0ZXAgPSAxO1xyXG4gICAgICAgICAgICBzaG93U3RlcChjdXJyZW50U3RlcCk7XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIHNob3dTdGVwKGN1cnJlbnRTdGVwKTtcclxuICAgIH1cclxufSk7XHJcbiJdLCJuYW1lcyI6WyJkb2N1bWVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCJ0ZWFtTGlzdCIsImdldEVsZW1lbnRCeUlkIiwiYWRkVGVhbUJ1dHRvbiIsInByb3RvdHlwZSIsImRhdGFzZXQiLCJ0ZWFtSW5kZXgiLCJjaGlsZHJlbiIsImxlbmd0aCIsIm1heFRlYW1zIiwicG9wdXAiLCJjbG9zZVBvcHVwIiwicXVlcnlTZWxlY3RvciIsInNlbGVjdGVkUGxhY2Vob2xkZXIiLCJvcGVuUG9wdXAiLCJwbGFjZWhvbGRlciIsInN0eWxlIiwiZGlzcGxheSIsImNsb3NlSW1hZ2VQb3B1cCIsImV2ZW50IiwidGFyZ2V0IiwiY2xhc3NMaXN0IiwiY29udGFpbnMiLCJnZXRBdHRyaWJ1dGUiLCJpbnB1dCIsImNvbmNhdCIsInByZXZpZXdJbWFnZSIsInZhbHVlIiwibmFtZSIsImltYWdlUGF0aCIsInNyYyIsInNwbGl0Iiwid2luZG93IiwibG9jYXRpb24iLCJvcmlnaW4iLCJhZGRSZW1vdmVCdXR0b24iLCJ0ZWFtQ29udGFpbmVyIiwicmVtb3ZlQnV0dG9uIiwiY3JlYXRlRWxlbWVudCIsInR5cGUiLCJjbGFzc05hbWUiLCJpbm5lclRleHQiLCJyZW1vdmUiLCJkaXNhYmxlZCIsImFwcGVuZENoaWxkIiwiYWxlcnQiLCJuZXdGb3JtIiwicmVwbGFjZSIsIm5ld0Zvcm1Db250YWluZXIiLCJhZGQiLCJzZXRBdHRyaWJ1dGUiLCJpbm5lckhUTUwiLCJuZXdJbnB1dCIsInRleHRUZWFtIiwidGV4dENvbnRlbnQiLCJpbWFnZVBsYWNlaG9sZGVyIiwiYWx0IiwicHJlcGVuZCIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJmb3JFYWNoIiwiaXRlbSIsIm1lbnVCdXJnZXIiLCJzaWRlYmFyIiwibWFpbkNvbnRlbnQiLCJ0b2dnbGUiLCJoZWxwQXNpZGUiLCJidXR0b25JbnNpZGVBc2lkZSIsImJ1dHRvbkNsb3NlIiwic3RlcHMiLCJzdGVwSWNvbnMiLCJzdGVwVGV4dHMiLCJjdXJyZW50U3RlcCIsInNob3dTdGVwIiwic3RlcEluZGV4Iiwic3RlcCIsImluZGV4IiwiaWNvbiIsInRleHQiXSwic291cmNlUm9vdCI6IiJ9