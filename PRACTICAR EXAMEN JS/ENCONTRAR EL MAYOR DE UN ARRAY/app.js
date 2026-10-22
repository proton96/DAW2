function encontrarMayor(numeros) {
    let mayor = numeros[0];

    for (const numero of numeros) {
        if (numero > mayor) {
            mayor = numero;
        }
    }

    return mayor;
}

const notas = [4, 7, 9, 3];

console.log(encontrarMayor(notas));


// Lo mismo, casi todo se realiza por for of , pero aqui estaria
// bien utilizar Math.max. Cuando usamos ... es para expandir el array.

const notas2 = [4, 7, 9, 3];

const mayor = Math.max(...notas2);

console.log(mayor); // 9