/* START VARIABLES */
const regexMap = {
    usuario: /^[a-zA-Z0-9. ]+$/,
    nombre: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑçÇàèìòùÀÈÌÒÙ\s]+$/,
    apellidos: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑçÇàèìòùÀÈÌÒÙ\s]+$/,
    password: /^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{6,}$/,
    email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
};
/* END VARIABLES */

/* START EVENT LISTENERS */
document.addEventListener("DOMContentLoaded", () => {
    /* START TODAY MIN SETTER */
    if (document.querySelector('input[type="date"].today-date') != null) {
        let dateInputs = document.querySelectorAll('input[type="date"].today-date');
        dateInputs.forEach(e => {
            e.min = GetToday();
        });
    }
    /* END TODAY MIN SETTER */
    /* START MENU HANDLER */
    const burguer = document.querySelector(".burguer-icon");
    
    burguer.addEventListener("click", () => {
        const side_menu = document.querySelector(".side-menu");
        
        side_menu.classList.toggle("collapse");
        burguer.classList.toggle("active");
        
        if(side_menu.classList.contains("collapse")) {
            // Wait for the animation
            setTimeout(() => {
                document.querySelector(".sign-button-box").classList.toggle("d-none");
                if (head = document.querySelector(".side-menu-head")) {
                    head.classList.toggle("d-none");
                }
                document.querySelector(".side-menu-body").classList.toggle("d-none");
            }, 150);
        } else {
            side_menu.querySelector(".sign-button-box").classList.toggle("d-none");
            if (head = document.querySelector(".side-menu-head")) {
                head.classList.toggle("d-none");
            }
            side_menu.querySelector(".side-menu-body").classList.toggle("d-none");
        }
    })
    /* END MENU HANDLER */
})
/* END EVENT LISTENERS */



function GetToday() {
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    let yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    return today;
}

async function UpdateProfile
({
    data = {}, // Sólo para refresh.js
    usuario = data.usuario,
    nombre = data.nombre,
    apellidos = data.apellidos,
    email = data.email,
    password = data.password,
    id = data.id
}) {
    let rol =  await CheckRol();

    document.querySelector("#usuario").value = data.usuario ?? usuario;
    document.querySelector("#nombre").value = data.nombre ?? nombre;
    document.querySelector("#apellidos").value = data.apellidos ?? apellidos;
    document.querySelector("#email").value = data.email ?? email;
    document.querySelector("#password").value = data.password ?? password;
    document.querySelector("#id").value = data.id ?? id;
    
    if (rol == "Participante") {
        document.querySelector(".side-menu-head .user-name").innerHTML = usuario;
    }
}

async function CheckRol() {
    try {
        const response = await fetch("controller/check_rol.php");
        
        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }
        
        const result = await response.json();
        
        return result.rol;
        
    } catch (error) {
        console.error("Error en la solicitud:", error);
        alert("Ocurrió un error al enviar el formulario.");
    }
}

function AttachFormListeners(form) {
    const inputs = form.querySelectorAll("input, textarea, select");

    inputs.forEach(input => {

        input.addEventListener("blur", function Handler() {
            ValidateField(input);

            input.addEventListener("input", () => {
                ValidateField(input)
            })

            input.removeEventListener("blur", Handler);
        })
    });
}

function ValidateField(input){
    const name = input.name;
    const regexp = regexMap[name];

    if (!regexp) return;

    const errorBox = document.querySelector(`#error-${name}`)
    const isValid = regexp.test(input.value);

    if (isValid) {
        errorBox.classList.add("d-none");
        return true;
    } else {
        errorBox.classList.remove("d-none");
        return false;
    }
}

function ProcessForm(form) {
    const inputs = form.querySelectorAll("input, textarea, select");

    let allValid = true;

    inputs.forEach(input => {
        const name = input.name;
        const regex = regexMap[name];

        if (!regex) return;

        if (!ValidateField(input)) allValid = false;
    });

    return allValid;
}

/* END EVENT LISTENERS */