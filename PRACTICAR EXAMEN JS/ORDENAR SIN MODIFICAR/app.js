const notas = [8, 3, 9, 5];

const ordenadas = [...notas].sort((a, b) => a - b);

console.log(ordenadas);
console.log(notas);

//utilizamos sort y aplicamos como queremos que ordene
// recuerda a-b es de menor a mayor. Al reves b-a seria de mayor a menor.