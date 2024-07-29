document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('header nav ul li a');
    menuItems.forEach(function(item) {
        item.addEventListener('click', function() {
            menuItems.forEach(function(i) {
                i.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.getElementById('nav-menu');

    menuToggle.addEventListener('click', function() {
        navMenu.classList.toggle('show');
    });

    const form = document.getElementById('contact-form');
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const nombre = document.getElementById('nombre').value;
            const correo = document.getElementById('correo').value;
            const asunto = document.getElementById('asunto').value;
            const comentario = document.getElementById('comentario').value;
            let hasError = false;

            if (!nombre) {
                showAlert('Por favor, ingresa tu nombre.');
                hasError = true;
            }
            if (!correo) {
                showAlert('Por favor, ingresa tu correo electrónico.');
                hasError = true;
            }
            if (!asunto) {
                showAlert('Por favor, ingresa el asunto.');
                hasError = true;
            }
            if (!comentario) {
                showAlert('Por favor, ingresa tu comentario.');
                hasError = true;
            }

            if (!hasError) {
                form.submit();
            }
        });
    }

    function showAlert(message) {
        const alertPlaceholder = document.getElementById('alert-placeholder');
        alertPlaceholder.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
    }
});
