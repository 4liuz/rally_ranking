async function ProcessImg(event, user) {
  event.preventDefault();

  try {

    let res = await fetch('controller/check_user_id.php', {

      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        usuario: user
      })

    });

    const userId = await res.json();

    const canUpload = await CheckUploadConfig(1, userId);
  
    if (canUpload.canPost) {
  
      alert(`Requisitos para subir imágenes:\n
      1. Dimensiones entre 1:1 y 2:1 (cuadrado o panorámico)
      2. Perímetro menor a 4000 píxeles ((2 x altura) + (2 x anchura))
      3. Formato .jpg o .png`);
    
      const input = document.querySelector('#img-input');
    
      input.value = '';
    
      input.onchange = function () {
        const file = input.files[0];
        if (!file) return;
    
        const allowedTypes = ['image/jpeg', 'image/png'];
        const reader = new FileReader();
    
        // Verificamos el tipo de archivo
        if (!allowedTypes.includes(file.type)) {
          return ShowError(`Formato no permitido.` + file.type ? `\nDetectado: ${file.type})` : '');
        }
    
        reader.onload = function (e) {
          const img = new Image();
          img.onload = function () {
            const width = img.width;
            const height = img.height;
            const ratio = width / height;
            const perimeter = 2 * (width + height);
    
            let errores = [];
    
            if (ratio < 1 || ratio > 2) {
              errores.push('Las dimensiones deben estar entre 1:1 y 2:1\n( 1:1 = mismo ancho que alto y 2:1 = doble de ancho que de alto )\n');
            }
    
            if (perimeter >= 4000) {
              errores.push('El perímetro debe ser menor a 4000 píxeles\n(2 x ancho) + (2 x alto) <= 4000px\n');
            }
    
            if (errores.length > 0) {
              return ShowError(errores.join('\n'));
            }
    
            let texto;
            let unprocessed = true;
    
            while(unprocessed) {
              texto = prompt("Elija un título descriptivo para su foto. Máximo 100 caracteres, todo contenido que exceda este límite será eliminado")
    
              if (texto === null || texto.trim() === '') {
                if(confirm("¿Deseas cancelar la subida?")){
                  alert("Operación cancelada, tu foto no se ha subido");
                  return;
                }
              } else {
                unprocessed = false;
              }
            }
    
            texto = texto.trim().substring(0, 100);
    
            CreateImgForm(usuario)
    
            SaveImage(file); // TODO
    
            alert('¡Tu foto se ha subido con éxito!\nAún está a la espera de que la admita el administrador, puedes ver su estado en "Mis Fotos"');
          };
          img.src = e.target.result;
        };
    
        reader.readAsDataURL(file);
      };
    
      input.click(); // Lanza el selector del sistema operativo
    } else {
      alert(canUpload.message);
    }
  } catch (error) {
    console.log(error);
  }
  
}

async function CheckUploadConfig(rallyId, userId) {
    try {
      let res = await fetch('controller/check_rally.php', {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          id: rallyId
        })
      });

      const rallyData = await res.json();

      res = await fetch('controller/check_count_img.php', {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          id: userId // Participant id
        })
      });

      const userImgs = await res.json();

      let rallyCheck = { canPost: true, message: "" };

      if (parseInt(rallyData.limite_fotos_participante) > parseInt(userImgs.count)) {
        const today = GetToday();
        
        if (today >= rallyData.fecha_inicio_subidas && today <= rallyData.fecha_fin_subidas) {
          rallyCheck.canPost = true;
          rallyCheck.message = "Puede subir foto";

        } else {
          rallyCheck.canPost = false;
          rallyCheck.message = "El periodo de subida de fotos aún no ha comenzado o ha finalizado. Consulta las bases del concurso.";
        }
      } else {
        rallyCheck.canPost = false;
        rallyCheck.message = "Ya has subido el máximo de fotos establecido en las bases del concurso.";
      }

      return rallyCheck;

    } catch (error) {
      console.error('Error al verificar datos del rally:', error);
    }

}

function ShowError(mensaje) {
  // TODO
  alert(`La imagen no cumple con los requisitos de subida. ${mensaje}`);
}

function SaveImage(file) {
  // TODO
  console.log('GuardarFoto llamada con: ', file);
}

function CreateImgForm(usuario) {
  // TODO
  console.log('GuardarFoto llamada con: ', usuario);
}