document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#sign-in-form");

  form.addEventListener("submit", async e => {
    e.preventDefault();

    let formData = new FormData(form);

    try {
      const response = await fetch("controller/process_sign_in.php", {
        method: "POST",
        body: formData,
      });

      if (!response.ok) {
        throw new Error(`HTTP error: ${response.status}`);
      }

      const result = await response.json();

      if (result.success) {
        alert("¡Tu usuario se ha creado correctamente!");
        location.href = 'index.php?id=4';
      } else {
        alert("Error en la creación de tu usuario.");
      }
    } catch (error) {
      console.error("Error en la solicitud:", error);
      alert("Ocurrió un error al enviar el formulario.");
    }
  });
});