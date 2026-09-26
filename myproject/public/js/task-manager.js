function confirmDelete() {
    return confirm(
        "Are you sure you want to delete this task?"
    );
}


document.addEventListener("DOMContentLoaded", function () {

    const successMessage =
        document.querySelector(".success-message");

    if (successMessage) {

        setTimeout(function () {

            successMessage.style.opacity = "0";

            setTimeout(function () {
                successMessage.remove();
            }, 400);

        }, 3000);
    }


    const dueDate =
        document.querySelector("#due_date");

    if (dueDate) {

        const today =
            new Date().toISOString().split("T")[0];

        dueDate.setAttribute("min", today);
    }

});