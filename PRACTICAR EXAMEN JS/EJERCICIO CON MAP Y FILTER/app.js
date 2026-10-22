const notas = [4, 7, 9, 3, 5, 2];

const aprobadasDuplicadas = notas
    .filter(nota => nota >= 5)
    .map(nota => nota * 2);

console.log(aprobadasDuplicadas);



    //Siempre usamos funcion flecha aqui para utilizar esas funciones.
    