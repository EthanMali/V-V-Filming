document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('contact-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        alert('Thank you for contacting us! We will get back to you soon.');
        form.reset();
    });
});
