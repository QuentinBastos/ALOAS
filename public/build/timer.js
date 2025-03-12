(self["webpackChunk"] = self["webpackChunk"] || []).push([["timer"],{

/***/ "./assets/js/timer.js":
/*!****************************!*\
  !*** ./assets/js/timer.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.array.concat.js */ "./node_modules/core-js/modules/es.array.concat.js");
__webpack_require__(/*! core-js/modules/es.date.to-string.js */ "./node_modules/core-js/modules/es.date.to-string.js");
__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
__webpack_require__(/*! core-js/modules/es.regexp.to-string.js */ "./node_modules/core-js/modules/es.regexp.to-string.js");
__webpack_require__(/*! core-js/modules/es.string.pad-start.js */ "./node_modules/core-js/modules/es.string.pad-start.js");
__webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
__webpack_require__(/*! core-js/modules/web.timers.js */ "./node_modules/core-js/modules/web.timers.js");
document.addEventListener("DOMContentLoaded", function () {
  var timer;
  var isRunning = false;
  var seconds = 0;
  function updateDisplay() {
    var mins = Math.floor(seconds / 60).toString().padStart(2, "0");
    var secs = (seconds % 60).toString().padStart(2, "0");
    document.getElementById("timerDisplay").innerText = "".concat(mins, ":").concat(secs);
  }
  function startStopTimer() {
    var btn = document.getElementById("startStopBtn");
    if (isRunning) {
      clearInterval(timer);
      btn.innerText = "Démarrer";
      btn.classList.replace("bg-red-500", "bg-blue-500");
    } else {
      timer = setInterval(function () {
        seconds++;
        updateDisplay();
      }, 1000);
      btn.innerText = "Arrêter";
      btn.classList.replace("bg-blue-500", "bg-red-500");
    }
    isRunning = !isRunning;
  }
  function resetTimer() {
    clearInterval(timer);
    seconds = 0;
    isRunning = false;
    updateDisplay();
    var btn = document.getElementById("startStopBtn");
    btn.innerText = "Démarrer";
    btn.classList.replace("bg-red-500", "bg-blue-500");
  }
  document.getElementById("startStopBtn").addEventListener("click", startStopTimer);
  document.getElementById("resetBtn").addEventListener("click", resetTimer);
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_internals_array-species-create_js-node_modules_core-js_modules_e-f827ea","vendors-node_modules_core-js_modules_es_array_concat_js-node_modules_core-js_modules_es_date_-3d35c8"], () => (__webpack_exec__("./assets/js/timer.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoidGltZXIuanMiLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7Ozs7OztBQUFBQSxRQUFRLENBQUNDLGdCQUFnQixDQUFDLGtCQUFrQixFQUFFLFlBQVk7RUFDdEQsSUFBSUMsS0FBSztFQUNULElBQUlDLFNBQVMsR0FBRyxLQUFLO0VBQ3JCLElBQUlDLE9BQU8sR0FBRyxDQUFDO0VBRWYsU0FBU0MsYUFBYUEsQ0FBQSxFQUFHO0lBQ3JCLElBQUlDLElBQUksR0FBR0MsSUFBSSxDQUFDQyxLQUFLLENBQUNKLE9BQU8sR0FBRyxFQUFFLENBQUMsQ0FBQ0ssUUFBUSxDQUFDLENBQUMsQ0FBQ0MsUUFBUSxDQUFDLENBQUMsRUFBRSxHQUFHLENBQUM7SUFDL0QsSUFBSUMsSUFBSSxHQUFHLENBQUNQLE9BQU8sR0FBRyxFQUFFLEVBQUVLLFFBQVEsQ0FBQyxDQUFDLENBQUNDLFFBQVEsQ0FBQyxDQUFDLEVBQUUsR0FBRyxDQUFDO0lBQ3JEVixRQUFRLENBQUNZLGNBQWMsQ0FBQyxjQUFjLENBQUMsQ0FBQ0MsU0FBUyxNQUFBQyxNQUFBLENBQU1SLElBQUksT0FBQVEsTUFBQSxDQUFJSCxJQUFJLENBQUU7RUFDekU7RUFFQSxTQUFTSSxjQUFjQSxDQUFBLEVBQUc7SUFDdEIsSUFBTUMsR0FBRyxHQUFHaEIsUUFBUSxDQUFDWSxjQUFjLENBQUMsY0FBYyxDQUFDO0lBRW5ELElBQUlULFNBQVMsRUFBRTtNQUNYYyxhQUFhLENBQUNmLEtBQUssQ0FBQztNQUNwQmMsR0FBRyxDQUFDSCxTQUFTLEdBQUcsVUFBVTtNQUMxQkcsR0FBRyxDQUFDRSxTQUFTLENBQUNDLE9BQU8sQ0FBQyxZQUFZLEVBQUUsYUFBYSxDQUFDO0lBQ3RELENBQUMsTUFBTTtNQUNIakIsS0FBSyxHQUFHa0IsV0FBVyxDQUFDLFlBQU07UUFDdEJoQixPQUFPLEVBQUU7UUFDVEMsYUFBYSxDQUFDLENBQUM7TUFDbkIsQ0FBQyxFQUFFLElBQUksQ0FBQztNQUNSVyxHQUFHLENBQUNILFNBQVMsR0FBRyxTQUFTO01BQ3pCRyxHQUFHLENBQUNFLFNBQVMsQ0FBQ0MsT0FBTyxDQUFDLGFBQWEsRUFBRSxZQUFZLENBQUM7SUFDdEQ7SUFDQWhCLFNBQVMsR0FBRyxDQUFDQSxTQUFTO0VBQzFCO0VBRUEsU0FBU2tCLFVBQVVBLENBQUEsRUFBRztJQUNsQkosYUFBYSxDQUFDZixLQUFLLENBQUM7SUFDcEJFLE9BQU8sR0FBRyxDQUFDO0lBQ1hELFNBQVMsR0FBRyxLQUFLO0lBQ2pCRSxhQUFhLENBQUMsQ0FBQztJQUNmLElBQU1XLEdBQUcsR0FBR2hCLFFBQVEsQ0FBQ1ksY0FBYyxDQUFDLGNBQWMsQ0FBQztJQUNuREksR0FBRyxDQUFDSCxTQUFTLEdBQUcsVUFBVTtJQUMxQkcsR0FBRyxDQUFDRSxTQUFTLENBQUNDLE9BQU8sQ0FBQyxZQUFZLEVBQUUsYUFBYSxDQUFDO0VBQ3REO0VBRUFuQixRQUFRLENBQUNZLGNBQWMsQ0FBQyxjQUFjLENBQUMsQ0FBQ1gsZ0JBQWdCLENBQUMsT0FBTyxFQUFFYyxjQUFjLENBQUM7RUFDakZmLFFBQVEsQ0FBQ1ksY0FBYyxDQUFDLFVBQVUsQ0FBQyxDQUFDWCxnQkFBZ0IsQ0FBQyxPQUFPLEVBQUVvQixVQUFVLENBQUM7QUFDN0UsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL3RpbWVyLmpzIl0sInNvdXJjZXNDb250ZW50IjpbImRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJET01Db250ZW50TG9hZGVkXCIsIGZ1bmN0aW9uICgpIHtcclxuICAgIGxldCB0aW1lcjtcclxuICAgIGxldCBpc1J1bm5pbmcgPSBmYWxzZTtcclxuICAgIGxldCBzZWNvbmRzID0gMDtcclxuXHJcbiAgICBmdW5jdGlvbiB1cGRhdGVEaXNwbGF5KCkge1xyXG4gICAgICAgIGxldCBtaW5zID0gTWF0aC5mbG9vcihzZWNvbmRzIC8gNjApLnRvU3RyaW5nKCkucGFkU3RhcnQoMiwgXCIwXCIpO1xyXG4gICAgICAgIGxldCBzZWNzID0gKHNlY29uZHMgJSA2MCkudG9TdHJpbmcoKS5wYWRTdGFydCgyLCBcIjBcIik7XHJcbiAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJ0aW1lckRpc3BsYXlcIikuaW5uZXJUZXh0ID0gYCR7bWluc306JHtzZWNzfWA7XHJcbiAgICB9XHJcblxyXG4gICAgZnVuY3Rpb24gc3RhcnRTdG9wVGltZXIoKSB7XHJcbiAgICAgICAgY29uc3QgYnRuID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJzdGFydFN0b3BCdG5cIik7XHJcblxyXG4gICAgICAgIGlmIChpc1J1bm5pbmcpIHtcclxuICAgICAgICAgICAgY2xlYXJJbnRlcnZhbCh0aW1lcik7XHJcbiAgICAgICAgICAgIGJ0bi5pbm5lclRleHQgPSBcIkTDqW1hcnJlclwiO1xyXG4gICAgICAgICAgICBidG4uY2xhc3NMaXN0LnJlcGxhY2UoXCJiZy1yZWQtNTAwXCIsIFwiYmctYmx1ZS01MDBcIik7XHJcbiAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgdGltZXIgPSBzZXRJbnRlcnZhbCgoKSA9PiB7XHJcbiAgICAgICAgICAgICAgICBzZWNvbmRzKys7XHJcbiAgICAgICAgICAgICAgICB1cGRhdGVEaXNwbGF5KCk7XHJcbiAgICAgICAgICAgIH0sIDEwMDApO1xyXG4gICAgICAgICAgICBidG4uaW5uZXJUZXh0ID0gXCJBcnLDqnRlclwiO1xyXG4gICAgICAgICAgICBidG4uY2xhc3NMaXN0LnJlcGxhY2UoXCJiZy1ibHVlLTUwMFwiLCBcImJnLXJlZC01MDBcIik7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGlzUnVubmluZyA9ICFpc1J1bm5pbmc7XHJcbiAgICB9XHJcblxyXG4gICAgZnVuY3Rpb24gcmVzZXRUaW1lcigpIHtcclxuICAgICAgICBjbGVhckludGVydmFsKHRpbWVyKTtcclxuICAgICAgICBzZWNvbmRzID0gMDtcclxuICAgICAgICBpc1J1bm5pbmcgPSBmYWxzZTtcclxuICAgICAgICB1cGRhdGVEaXNwbGF5KCk7XHJcbiAgICAgICAgY29uc3QgYnRuID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJzdGFydFN0b3BCdG5cIik7XHJcbiAgICAgICAgYnRuLmlubmVyVGV4dCA9IFwiRMOpbWFycmVyXCI7XHJcbiAgICAgICAgYnRuLmNsYXNzTGlzdC5yZXBsYWNlKFwiYmctcmVkLTUwMFwiLCBcImJnLWJsdWUtNTAwXCIpO1xyXG4gICAgfVxyXG5cclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwic3RhcnRTdG9wQnRuXCIpLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCBzdGFydFN0b3BUaW1lcik7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInJlc2V0QnRuXCIpLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCByZXNldFRpbWVyKTtcclxufSk7Il0sIm5hbWVzIjpbImRvY3VtZW50IiwiYWRkRXZlbnRMaXN0ZW5lciIsInRpbWVyIiwiaXNSdW5uaW5nIiwic2Vjb25kcyIsInVwZGF0ZURpc3BsYXkiLCJtaW5zIiwiTWF0aCIsImZsb29yIiwidG9TdHJpbmciLCJwYWRTdGFydCIsInNlY3MiLCJnZXRFbGVtZW50QnlJZCIsImlubmVyVGV4dCIsImNvbmNhdCIsInN0YXJ0U3RvcFRpbWVyIiwiYnRuIiwiY2xlYXJJbnRlcnZhbCIsImNsYXNzTGlzdCIsInJlcGxhY2UiLCJzZXRJbnRlcnZhbCIsInJlc2V0VGltZXIiXSwic291cmNlUm9vdCI6IiJ9