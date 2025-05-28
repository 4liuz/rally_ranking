document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("profileForm");

  form.addEventListener("submit", async e => {
    e.preventDefault();

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
        UpdateProfile(result.data.usuario, result.data.nombre, result.data.apellidos, result.data.email, result.data.password, result.data.id_participante)

        alert("¡Perfil actualizado!");
      } else {
        alert("Error al actualizar el perfil.");
      }
    } catch (error) {
      console.error("Error en la solicitud:", error);
      alert("Ocurrió un error al enviar el formulario.");
    }
  });
});