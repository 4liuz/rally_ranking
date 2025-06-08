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


/* START FUNCTIONS */

/**
 * Returns string format today's date 'yyyy-mm-dd'
 * @author 'Aliuz'
 *
 * @returns {String} 
 */
function GetToday() {
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0');
    let yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    return today;
}


/**
 * Changes a client side form values with updated ones from DDBB
 * @author 'Aliuz'
 *
 * @async
 * @param {{ data?: {}; usuario?: String; nombre?: String; apellidos?: String; email?: String; password?: String; id?: Int; }} object User data
 * @param {{}} [object.data={}] used only for [refresh.js](refresh.js). If data is given, no more parameters are needed
 * @returns {void} 
 */
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

async function UnsuscribeUserManager(id, baja) {
    baja = parseInt(baja);
    if(confirm(baja ? "¿Desea dar de alta al participante?" : "¿Está seguro de que desea dar de baja al participante?")){
        try {
            await fetch('controller/change_unsuscribed.php', {
                method: "POST",
                body: JSON.stringify({
                    id: id,
                    baja: baja
                })
            });
        
            alert("¡Participante dado de " + (baja ? "alta" : "baja") + "!");

            // Manage Profiles
            location.href='index.php?id=12';
        } catch (error) {
            console.error('Error al cargar datos:', error);
        }
    }
}

async function UnsuscribeUserProfile(id, baja) {
    baja = parseInt(baja);
    if(confirm(baja ? "¿Desea dar de alta al participante?" : "¿Está seguro de que desea dar de baja al participante?")){
        try {
            await fetch('controller/change_unsuscribed.php', {
                method: "POST",
                body: JSON.stringify({
                    id: id,
                    baja: baja
                })
            });
        
            alert("¡Participante dado de " + (baja ? "alta" : "baja") + "!");

            const unsuscribeButton = document.querySelector(".unsuscribe-button");
            unsuscribeButton.innerHTML = baja ? "Baja" : "Alta";
            const bajaInput = document.querySelector("#baja");
            bajaInput.value =  baja ? "0" : "1";
        } catch (error) {
            console.error('Error al cargar datos:', error);
        }
    }
}

async function UpdateRally() {
    try {
        const formData = new FormData(document.querySelector("#rally-form"))
        await fetch('controller/process_rally.php', {
            method: "POST",
            body: formData
        });
    
        alert("¡La configuración de Rally Ranking se ha actualizado!");

    } catch (error) {
        console.error('Error al cargar datos:', error);
    }
}

async function DeleteImg(id) {
    if (confirm("¡CUIDADO!\n¿De verdad quiere ELIMINAR esta foto?")) {
        try {
            await fetch('controller/delete_img.php', {
                method: "POST",
                body: JSON.stringify({
                    id: id
                })
            });
        
            alert("¡La foto se ha borrado con éxito");
            location.href='index.php?id=7'; // my_gallery.php
    
        } catch (error) {
            console.error('Error al cargar datos:', error);
        }
    }
}

async function ApproveImg(id, admin) {
        try {
            await fetch("controller/process_approval.php", {
                method: "POST",
                body: JSON.stringify({
                    id: id,
                    admin: admin,
                    estado: 1
                }),
            });
        } catch (error) {
            console.log(error);
        }

}

async function RejectImg(id, admin) {
        try {
            await fetch("controller/process_approval.php", {
                method: "POST",
                body: JSON.stringify({
                    id: id,
                    admin: admin,
                    estado: 0
                }),
            });
        } catch (error) {
            console.log(error);
        }

}

function UpdateVotes(data) {
    document.querySelector("#votes").innerHTML = data.data.votos + '&nbsp;<i style="font-size:24px" class="fa">&#xf087;</i>';
}

async function CheckVotante() {
    try {
        const response = await fetch("controller/check_votante.php", {
            method: "POST"
        });
        const votante = await response.json();
        return votante;
    } catch (error) {
        console.log(error);
    }
}

async function IncreaseImgVote(id) {
    try {
        await fetch("controller/increase_img_vote.php", {
            method: "POST",
            body: JSON.stringify({
                id: id
            })
        });
    } catch (error) {
        console.log(error);
    }
}

async function DecreaseVote() {
    try {
        await fetch("controller/decrease_vote.php", {
            method: "POST"
        });
    } catch (error) {
        console.log(error);
    }
}
/* END EVENT LISTENERS */