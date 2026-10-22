function contarAprobadosYSuspensos(notas) {
    let aprobados = 0;
    let suspensos = 0;

    for (const nota of notas) {
        if (nota >= 5) {
            aprobados++;
        } else {
            suspensos++;
        }
    }

    return { aprobados, suspensos };
}

const notas1 = [4, 7, 9, 3, 5, 2];

const resultado = contarAprobadosYSuspensos(notas1);

console.log(`Aprobados: ${resultado.aprobados}`);
console.log(`Suspensos: ${resultado.suspensos}`);


// Lo mismo que el anterior, se hace con for of pero aqui lo ideal es 
// utilizar filter.

const notas = [4, 7, 9, 3, 5, 2];

const aprobados = notas.filter(nota => nota >= 5).length;
const suspensos = notas.filter(nota => nota < 5).length;

console.log(`Aprobados: ${aprobados}`);
console.log(`Suspensos: ${suspensos}`);