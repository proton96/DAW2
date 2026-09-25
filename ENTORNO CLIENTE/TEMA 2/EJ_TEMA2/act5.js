// Lo primero es meter un array vacio para los productos
const productos = [];

// Hacemos un while para pedir productos hasta que el usuario cancele
while (true) {
    const entrada = prompt("Introduce un producto (o Cancelar para terminar):");

    // Este if es para cancelar la recogida
    if (entrada === null) {
        break;
    }

    // Eliminamos los espacios en los extemos
    const nombreLimpio = entrada.trim();

    //Con este if si la entrada que metes es vacia volvemos a pedir el producto
    if (nombreLimpio === "") {
        alert("Nombre vacío. Introduce un nombre válido.");
        continue; // vuelve al inicio del bucle
    }

    // Asi añadimos un nombre al array ( que es nuestra lista )
    productos.push(nombreLimpio);
}

//Mostramos por consola la lista y el numero de productos y productos
if (productos.length === 0) {
    console.log("Lista vacía");
} else {
    console.log("Productos:", productos);
    console.log("Número de productos:", productos.length);
}