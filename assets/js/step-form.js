document.addEventListener("DOMContentLoaded", function() {
    const steps = document.querySelectorAll(".form-step");
    const stepIcons = document.querySelectorAll(".step-icon");
    const stepTexts = document.querySelectorAll(".step-text"); // Sélection des textes liés aux étapes
    let currentStep = 0;

    const showStep = (stepIndex) => {

        steps.forEach((step, index) => {
            step.style.display = index === stepIndex ? 'flex' : 'none';
        });

        stepIcons.forEach((icon, index) => {
            if (index <= stepIndex) {
                icon.classList.add('active');
            } else {
                icon.classList.remove('active');
            }
        });

        stepTexts.forEach((text, index) => {
            text.style.display = index === stepIndex ? 'block' : 'none';
        });
    };
    const nextStep1 = document.getElementById("next-step-1");
    const prevStep2 = document.getElementById("prev-step-2");
    const nextStep2 = document.getElementById("next-step-2");
    const prevStep3 = document.getElementById("prev-step-3");

    if (nextStep1) {
        nextStep1.addEventListener("click", () => {
            currentStep = 1;
            showStep(currentStep);
        });
    }

    if (prevStep2) {
        prevStep2.addEventListener("click", () => {
            currentStep = 0;
            showStep(currentStep);
        });
    }

    if (nextStep2) {
        nextStep2.addEventListener("click", () => {
            currentStep = 2;
            showStep(currentStep);
        });
    }

    if (prevStep3) {
        prevStep3.addEventListener("click", () => {
            currentStep = 1;
            showStep(currentStep);
        });
    }

    showStep(currentStep);
});
