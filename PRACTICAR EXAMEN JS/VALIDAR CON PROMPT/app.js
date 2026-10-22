const entradaPrecio = prompt("Introduce el precio unitario:");
const entradaUnidades = prompt("Introduce las unidades:");

// 1. Comprobar cancelación o campo vacío
if (entradaPrecio === null || entradaUnidades === null) {
    console.log("Operación cancelada.");
    document.querySelector("#resultado").textContent = "Operación cancelada.";
} else if (entradaPrecio.trim() === "" || entradaUnidades.trim() === "") {
    console.log("Debes rellenar ambos campos.");
    document.querySelector("#resultado").textContent = "Debes rellenar ambos campos.";
} else {
    // 2. Convertir texto a número
    const precio = Number(entradaPrecio);
    const unidades = Number(entradaUnidades);

    // 3. Validar que sean enteros no negativos
    if (Number.isInteger(precio) && precio >= 0 &&
        Number.isInteger(unidades) && unidades >= 0) {

        const total = precio * unidades;

        console.log(`Total: ${total} EUR`);
        document.querySelector("#resultado").textContent =
            `Total: ${total} EUR`;

    } else {
        console.log("Datos no válidos: introduce números enteros positivos.");
        document.querySelector("#resultado").textContent =
            "Datos no válidos: introduce números enteros positivos.";
    }
}