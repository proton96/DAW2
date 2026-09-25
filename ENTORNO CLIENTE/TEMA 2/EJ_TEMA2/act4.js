//Hacemos un array con los nombres en minúsculas
const empleados1 = ["ana", "luis", "marta", "pedro", "lucia", "carlos", "elena"];

//Pedimos el nombre con promot 
const entrada = prompt("Introduce un nombre:");

// Hacemos un if y si cancela mostramos que la consulta es cancelada
if (entrada === null) {
    console.log("Consulta cancelada");
} else {
    const nombreLimpio = entrada.trim();

    // Hacemos otro if y si mete espacios nada mas o vacio le decimos que el nombre esta vacio
    if (nombreLimpio === "") {
        console.log("Nombre vacío");
    } else {
        //si si , comparamos sin distinguir minusculas o mayusculas
        const nombreNormalizado = nombreLimpio.toLowerCase();
        const existe = empleados.includes(nombreNormalizado);

        //Si existe le metemos un saludo y si no le decimos que no esta en la lista
        if (existe) {
            console.log(`¡Hola, ${nombreLimpio}! Bienvenido/a.`);
        } else {
            console.log(`${nombreLimpio} no está en la lista de empleados.`);
        }
    }
}