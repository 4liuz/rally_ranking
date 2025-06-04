let lastUpdate = '';

async function VerifyChanges(f, table, id, rol) {

  try {
    const res = await fetch('controller/check_refresh.php', {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        id: id,
        table: table
      })
    });
    const data = await res.json();

    if (data.ultima_actualizacion && data.ultima_actualizacion !== lastUpdate) {

      if (lastUpdate != '') {
        if (table == 'participantes'){

          const res = await fetch('controller/check_last_user.php', {
            method: "POST",
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify({
              id: id
            })
          });

          const ultimo_usuario = await res.json();

          if (ultimo_usuario != rol) {

            await LoadData(f, table, id);
          }

        } else {

          await LoadData(f, table, id); // Actualiza la interfaz
        }
      }

      lastUpdate = data.ultima_actualizacion;
    }
  } catch (error) {
    console.error('Error al verificar cambios:', error);
  }
}

async function LoadData(f, table, id) {
  try {
    const res = await fetch('controller/load_refresh.php', {
      method: "POST",
      body: JSON.stringify({
        id: id,
        table: table
      })
    });

    const data = await res.json();

    // Para informar en profile.php
    if (table == "participantes") {
      alert("Se ha actualizado la información del perfil")
    }

    f({data: data}); // Función de actualización de interfaz
  } catch (error) {
    console.error('Error al cargar datos:', error);
  }
}

function RefreshInit(f, table, id, rol) {
  VerifyChanges(f, table, id, rol);
  
  setInterval(() => VerifyChanges(f, table, id, rol), 5000);
}