// Esperamos a que todo el HTML esté cargado antes de ejecutar la lógica
document.addEventListener('DOMContentLoaded', () => {
    
    const btnAbrir = document.getElementById('abrir-menu');
    const btnCerrar = document.getElementById('cerrar-menu');
    const menuModal = document.getElementById('menu-modal');
    const enlacesMenu = document.querySelectorAll('.menu-principal a');

    // Validación rápida de seguridad (evita errores en consola)
    if (btnAbrir && btnCerrar && menuModal) {
        
        // Función para abrir el menú
        btnAbrir.addEventListener('click', () => {
            menuModal.classList.add('activo');
        });

        // Función para cerrar el menú con la X
        btnCerrar.addEventListener('click', () => {
            menuModal.classList.remove('activo');
        });

        // Cierra el menú automáticamente cuando se hace clic en cualquier sección
        enlacesMenu.forEach(enlace => {
            enlace.addEventListener('click', () => {
                menuModal.classList.remove('activo');
            });
        });
        
    } else {
        console.error("Error: No se encontraron los botones del menú en el DOM.");
    }
});