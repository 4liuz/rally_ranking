let lastUpdate = '';

async function VerifyChanges(f, table) {
  try {
    const res = await fetch('check_' + table + '.php');
    const data = await res.json();

    if (data.lastUpdate && data.lastUpdate !== lastUpdate) {
      lastUpdate = data.lastUpdate;
      await LoadData(f); // Actualiza la interfaz
    }
  } catch (error) {
    console.error('Error al verificar cambios:', error);
  }
}

async function LoadData(f, table) {
  try {
    const res = await fetch('get_' + table + '.php');
    const data = await res.json();

    f(data);
  } catch (error) {
    console.error('Error al cargar datos:', error);
  }
}

function RefreshInit(f, table) {
  VerifyChanges(f, table);
  
  setInterval(() => VerifyChanges(f, table), 5000);
}