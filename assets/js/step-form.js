document.addEventListener("DOMContentLoaded", function() {
    const steps = document.querySelectorAll(".form-step");
    const stepIcons = document.querySelectorAll(".step-icon");
    const stepTexts = document.querySelectorAll(".step-text");

    if (steps && stepIcons && stepTexts) {
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

        document.getElementById("next-step-1").addEventListener("click", () => {
            currentStep = 1;
            showStep(currentStep);
        });

        document.getElementById("prev-step-2").addEventListener("click", () => {
            currentStep = 0;
            showStep(currentStep);
        });

        document.getElementById("next-step-2").addEventListener("click", () => {
            currentStep = 2;
            showStep(currentStep);
        });

        document.getElementById("prev-step-3").addEventListener("click", () => {
            currentStep = 1;
            showStep(currentStep);
        });

        showStep(currentStep);
    }
});
