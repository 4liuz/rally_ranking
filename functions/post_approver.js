document.addEventListener("DOMContentLoaded", () => {
    document.querySelector(".approve-button").addEventListener("click", () => {
        if(confirm("¿Desea aceptar esta foto dentro del concurso?")) {
            ApproveImg(document.querySelector("#id").value, document.querySelector("#admin").value);
            alert("¡La solicitud ha sido aprobada!");
            location.href = 'index.php?id=11'; // manage_requests.php
        }
    });

    document.querySelector(".reject-button").addEventListener("click", () => {
        if(confirm("¿Desea RECHAZAR esta solicitud para que la foto NO participe en el concurso?")) {
            RejectImg(document.querySelector("#id").value, document.querySelector("#admin").value);
            alert("Se ha rechazado la solicitud")
            location.href = 'index.php?id=11'; // manage_requests.php
        }
    });
})