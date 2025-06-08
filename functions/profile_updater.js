document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#profile-form");

  AttachFormListeners(form);

  RefreshInit(
    UpdateProfile,
    "participantes",
    document.querySelector("input#id").value,
    document.querySelector("input#ultimo_usuario").value
  );

  form.addEventListener("submit", async e => {
    e.preventDefault();

    if(ProcessForm(form)){
      let formData = new FormData(form);
      
      try {
        const response = await fetch("controller/process_profile.php", {
          method: "POST",
          body: formData,
        });
  
        if (!response.ok) {
          throw new Error(`HTTP error: ${response.status}`);
        }
  
        const result = await response.json();
  
        if (result.success) {
          // Actualizar los campos del formulario con la info recibida
          UpdateProfile({
            usuario : result.data.usuario,
            nombre : result.data.nombre,
            apellidos : result.data.apellidos,
            email : result.data.email,
            password : result.data.password,
            id : result.data.id
          })
  
          alert("¡Perfil actualizado!");
        } else {
          alert("Error al actualizar el perfil. Los datos introducidos son incorrectos. Por favor revise el formato de cada campo.");
          ProcessForm(form);
        }
      } catch (error) {
        console.error("Error en la solicitud:", error);
        alert("Ocurrió un error al enviar el formulario.");
      }
    } else {
      alert("Por favor, revise los datos del formulario, algunos son incorrectos")
    }
  });
});