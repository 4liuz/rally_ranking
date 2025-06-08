document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#rally-form");
  const inputInicioSubidas = document.querySelector("#fecha_inicio_subidas");
  const inputFinSubidas = document.querySelector("#fecha_fin_subidas");
  const inputInicioVotaciones = document.querySelector("#fecha_inicio_votaciones");
  const inputFinVotaciones = document.querySelector("#fecha_fin_votaciones");

  inputInicioSubidas.addEventListener("change", () => {
    inputFinSubidas.min = inputInicioSubidas.value;
    if (inputFinSubidas.value < inputInicioSubidas.value) {
      inputFinSubidas.value = inputInicioSubidas.value
    }
  })
  
  inputInicioVotaciones.addEventListener("change", () => {
    inputFinVotaciones.min = inputInicioVotaciones.value;
    if (inputFinVotaciones.value < inputInicioVotaciones.value) {
      inputFinVotaciones.value = inputInicioVotaciones.value
    }

  })

  form.addEventListener("submit", async e => {
    e.preventDefault();
    UpdateRally();
  });
});
