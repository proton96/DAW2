function sumarArray(numeros) {
    let suma = 0;

    for (const numero of numeros) {
        suma += numero;
    }

    return suma;
}

const notas = [4, 7, 9, 3];

console.log(sumarArray(notas));



// Lo hemos hecho con un bucle for of pero lo suyo es con reduce.