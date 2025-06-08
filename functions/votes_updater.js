document.addEventListener("DOMContentLoaded", () => {

  const id = document.querySelector("#id");

  RefreshInit(
    UpdateVotes,
    "fotos",
    document.querySelector("input#id").value
  );

  document.querySelector("#vote-button").addEventListener("click", async () =>{
    const votante = await CheckVotante();

    if(votante.votos > 0) {
      if(confirm("ATENCIÓN\nCada usuario puede votar un máximo de 3 fotos (establecido por las bases del concurso). Una vez vote una foto NO PODRÁ RETIRAR SU VOTO.\n¿Desea votar esta foto?")) {
        DecreaseVote();
        IncreaseImgVote(id.value);
        alert("Se ha votado la foto con éxito")
      }
    } else {
      alert("Atención usuario: Número máximo de votos alcanazado")
    }
  })
});