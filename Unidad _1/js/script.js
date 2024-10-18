// Esperamos a que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    // Obtenemos el formulario y los campos necesarios
    const form = document.getElementById("registration-form");
    const emailInput = document.getElementById("correo");
    const birthdateInput = document.getElementById("fecha-nacimiento");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm-password");

    // Función para validar si el usuario es mayor de 18 años
    function isOver18(dateString) {
        const today = new Date();
        const birthDate = new Date(dateString);
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age >= 18;
    }

    // Función para validar el formato del correo electrónico
    function isValidEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }

    // Función para validar que las contraseñas coinciden
    function doPasswordsMatch(password1, password2) {
        return password1 === password2;
    }

    // Función para mostrar un mensaje de error
    function showError(message) {
        alert(message); // Usamos una alerta, pero puedes personalizarlo para mostrar errores en la página
    }

    // Manejamos el evento de envío del formulario
    form.addEventListener("submit", function (event) {
        const email = emailInput.value.trim();
        const birthdate = birthdateInput.value;
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        // Validamos que el usuario es mayor de 18 años
        if (!isOver18(birthdate)) {
            showError("Debes tener al menos 18 años para registrarte.");
            event.preventDefault(); // Evita que el formulario se envíe
            return;
        }

        // Validamos el formato del correo
        if (!isValidEmail(email)) {
            showError("Por favor, ingresa un correo electrónico válido.");
            event.preventDefault(); // Evita que el formulario se envíe
            return;
        }

        // Validamos que las contraseñas coinciden
        if (!doPasswordsMatch(password, confirmPassword)) {
            showError("Las contraseñas no coinciden.");
            event.preventDefault(); // Evita que el formulario se envíe
            return;
        }
    });
});
