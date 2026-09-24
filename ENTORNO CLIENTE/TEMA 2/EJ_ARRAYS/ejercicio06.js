
//Función que recibe la edad del perro y devuelve su equivalente humano
function calcularEdadEquivalente(edadPerro) {
  return edadPerro * 7;
}

while (true) {
  //Pedir la edad mediante prompt
  const entrada = prompt("Introduce la edad del perro en años (mayor que 0 y menor que 30):");

  //Si el usuario cancela (prompt devuelve null)
  if (entrada === null) {
    alert("Operación cancelada. Fin del ejercicio.");
    break;
  }

  // Limpiamos posibles espacios en blanco en los extremos
  const entradaLimpia = entrada.trim();
  const edad = Number(entradaLimpia);

  //Validaciones:
  if (entradaLimpia === "" || isNaN(edad) || !isFinite(edad) || edad <= 0 || edad >= 30) {
    alert("Error: Debes introducir un número válido mayor que 0 y menor que 30 (ejemplos: 2 o 1.5).");
  } else {
    //Si el dato es válido, calculamos y mostramos con alert
    const edadHumana = calcularEdadEquivalente(edad);
    alert(`Un perro de ${edad} años equivale a ${edadHumana} años humanos.`);
    break;
  }
}
