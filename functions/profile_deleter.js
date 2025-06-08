document.querySelector(".delete-button").addEventListener("click", e => {
    e.preventDefault();
    if (confirm("¡CUIDADO!\n¿De verdad quiere ELIMINAR su cuenta?")) {
        location.href='controller/delete_user.php';
    }
});