
const coche = {
  marca: "Toyota",
  modelo: "Yaris",
  anio: 2020,

  // Método que calcula la antigüedad.
  calcularAntiguedad() {
    const anioActual = new Date().getFullYear();

    // Validamos las condiciones.
    if (!Number.isInteger(this.anio) || this.anio < 1886 || this.anio > anioActual) {
      return null;
    }

    return anioActual - this.anio;
  }
};

// Función auxiliar para mostrar el resultado fuera del método.
function mostrarAntiguedad(cocheObj) {
  const antiguedad = cocheObj.calcularAntiguedad();

  if (antiguedad === null) {
    console.log(`Año (${cocheObj.anio}): Año no válido.`);
  } else {
    console.log(`El coche ${cocheObj.marca} ${cocheObj.modelo} (${cocheObj.anio}) tiene ${antiguedad} años.`);
  }
}

//Prueba con el coche de 2020
console.log("Prueba con año 2020:");
mostrarAntiguedad(coche);

//Prueba con el año actual
const anioActual = new Date().getFullYear();
coche.anio = anioActual;
console.log("\nPrueba con el año actual:");
mostrarAntiguedad(coche);

//Prueba con el año actual + 1 (año en el futuro, no válido)
coche.anio = anioActual + 1;
console.log("\nPrueba con año futuro (año actual + 1):");
mostrarAntiguedad(coche);
