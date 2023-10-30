function createToast(message) {
    const toastContainer = document.getElementById("toast-container");

    const toast = document.createElement("div");
    toast.className = "toast";
    toast.textContent = message;

    const closeBtn = document.createElement("span");
    closeBtn.className = "close";
    closeBtn.textContent = "  x";
    closeBtn.addEventListener("click", function() {
        toast.remove();
    });

    toast.appendChild(closeBtn);
    toastContainer.appendChild(toast);

    // Trigger reflow to apply the transition
    setTimeout(function () {
        toast.classList.add("active");
    }, 10);

    // Remove the toast after a few seconds
    setTimeout(function () {
        toast.classList.remove("active");
        // Remove the toast after the transition duration
        setTimeout(function() {
            toast.remove();
        }, 400);
    }, 3000); // Adjust the duration as needed
}
