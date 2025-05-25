
/**
 * Lista clases css para cambiar paletas fácilmente
 * @date 'Wed, Oct 2, 2024 7:49 PM'
 * @author 'Aliuz'
 */
const COLORS = {
    brown: ".color-lp-brown",
    grey: ".color-lp-grey",
    dark: ".color-dp",
    toString: () => {
        // Devuelve una cadena con todas las clases para seleccionar
        let colorsList = ""
        Object.values(COLORS).forEach((element) => {
            if (typeof(element) === 'string') colorsList += element + ", "
        });
        colorsList = colorsList.slice(0, -2);
        return colorsList;
    }
}

// TODO
function SwitchColorStyle(newColor="dp") {
    let coloredTags = document.querySelectorAll(COLORS.toString());
    return coloredTags;
}

/**
 * Fixes a two style combination issue
 * @author 'Aliuz'
 * @date 'Mon, Sep 30, 2024 9:05 PM'
 * 
 * [Documentation](./README.md)
 */
function CenterSpacedWords() {
    let wordlist = document.querySelectorAll("[data-centered-spaced]");

    wordlist.forEach(element => {
        element.innerHTML= (
            element.innerHTML.slice(0, -1)
            + "<span style=\"letter-spacing:0\">"
            + element.innerHTML.slice(-1)
            + "</span>"
        )
    });

    return wordlist;
} CenterSpacedWords()

function GetToday() {
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    let yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    return today;
}

/* START EVENT LISTENERS */
document.querySelector(".burguer-icon").addEventListener("click", () => {
    let side_menu = document.querySelector(".side-menu");

    side_menu.classList.toggle("collapse");
    document.querySelector(".burguer-icon").classList.toggle("active");

    if(side_menu.classList.contains("collapse")) {
        // Wait for the animation
        setTimeout(() => {
            document.querySelector(".sign-button-box").classList.toggle("d-none");
            // document.querySelector(".side-menu-head").classList.toggle("d-none");
            document.querySelector(".side-menu-body").classList.toggle("d-none");
        }, 150);
    } else {
        side_menu.querySelector(".sign-button-box").classList.toggle("d-none");
        // side_menu.querySelector(".side-menu-head").classList.toggle("d-none");
        side_menu.querySelector(".side-menu-body").classList.toggle("d-none");
    }
})

if (document.querySelector('input[type="date"].today-date') != null) {
    let dateInputs = document.querySelectorAll('input[type="date"].today-date');
    dateInputs.forEach(e => {
        e.min = GetToday();
    });
}
/* END EVENT LISTENERS */