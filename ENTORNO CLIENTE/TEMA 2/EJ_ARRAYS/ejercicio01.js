
// Array con los colores indicados
const colores = ["rojo", "azul", "verde", "amarillo"];

// Color a buscar
let busqueda1 = " AZUL ";

// Limpiamos los espacios con .trim()
const colorLimpio1 = busqueda1.trim().toLowerCase();

// Comprobamos si el color está en el array y mostramos por consola
if (colores.includes(colorLimpio1)) {
  console.log(`«${busqueda1}» → encontrado.`);
} else {
  console.log(`«${busqueda1}» → no encontrado.`);
}

// Probamos con otro color que no esté en el array
let busqueda2 = "violeta";
const colorLimpio2 = busqueda2.trim().toLowerCase();

if (colores.includes(colorLimpio2)) {
  console.log(`«${busqueda2}» → encontrado.`);
} else {
  console.log(`«${busqueda2}» → no encontrado.`);
}
