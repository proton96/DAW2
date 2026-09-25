//Metemos los jamones y empleados que son.
const jamonesTotales = 23;
const empleados = 10;

//Calculamos los que recibe cada persona.
const jamonesPorEmpleado = Math.floor(jamonesTotales / empleados);

//Calculamos los que quedan sin repartir
const jamonesSobrantes = jamonesTotales % empleados;

//Mostramos ambos resultados por consola
console.log("Jamones por empleado:", jamonesPorEmpleado);
console.log("Jamones sobrantes:", jamonesSobrantes);

/*He utilizado la funcion Math.floor porque la division nos da numeros decimales
y los jamones no se pueden partir deben ser numeros enteros. */

