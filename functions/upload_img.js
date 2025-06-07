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

    // TODO: Rally selector if multiple rallys functionality is implemented
    const rally = 1;

    const canUpload = await CheckUploadConfig(rally, userId);
  
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
    
            let title;
            let unprocessed = true;
    
            while(unprocessed) {
              title = prompt("Elija un título descriptivo para su foto. Máximo 100 caracteres, todo contenido que exceda este límite será eliminado")
    
              if (title === null || title.trim() === '') {
                if(confirm("¿Deseas cancelar la subida?")){
                  alert("Operación cancelada, tu foto no se ha subido");
                  return;
                }
              } else {
                unprocessed = false;
              }
            }
    
            title = title.trim().substring(0, 100);
    
            SaveImage(CreateImgForm(file, user, rally, title));
    
            alert('¡Tu foto se ha subido con éxito!\nAún está a la espera de que la admita el administrador, puedes ver su estado en "Mis Fotos"');
          };
          img.src = e.target.result;
        };
    
        reader.readAsDataURL(file);
      };
    
      input.click();
    } else {
      alert(canUpload.message);
    }
  } catch (error) {
    console.log(error);
  }
  
}

async function CheckUploadConfig(rallyId, userId) {
      const rallyData = await GetRallyData(rallyId);

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
}

function ShowError(mensaje) {
  alert(`La imagen no cumple con los requisitos de subida. ${mensaje}`);
}

async function SaveImage(formData) {
  try {
    await fetch('controller/process_img.php', {
      method: "POST",
      body: formData
    });
  } catch (error) {
    console.log(error);
  }
}

function CreateImgForm(file, participante, rally, foto) {
  const formData = new FormData();
  formData.append("file", file);
  formData.append("participante", participante);
  formData.append("rally", rally);
  formData.append("foto", foto);
  return formData;
}

async function GetRallyData(rallyId){
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
    return await res.json();
  }catch (error) {
    console.log(error)
  }
}