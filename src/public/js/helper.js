class Helper {
    constructor() {
    }
    debounce(func, delay) {
        let timeoutId;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
                func.apply(context, args);
            }, delay);
        };
    }

    openModal(modalId, openButtonId, closeButtonId, submitButtonId, onSubmit) {
        const modal = document.getElementById(modalId);
        const openButton = document.getElementById(openButtonId);
        const closeButton = document.getElementById(closeButtonId);
        const submitButton = document.getElementById(submitButtonId);

        openButton.addEventListener("click", () => {
            modal.style.display = "block";
        });

        closeButton.addEventListener("click", () => {
            modal.style.display = "none";
        });

        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        if (onSubmit) {
            submitButton.addEventListener("click", async (e) => {
                e.preventDefault();
                onSubmit(modal);
            });
        }
    }

}