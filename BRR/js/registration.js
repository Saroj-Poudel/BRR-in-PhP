document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("registrationForm");

    form.addEventListener("submit", function(event) {
        event.preventDefault();
        // Here you can add validation logic or other functionality before submitting the form
        console.log("Form submitted!");
    });
});
