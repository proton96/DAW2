//Metemos la ficha del empleado
const nombre = "Ana López";
const profesion = "administrativa";
const antiguedad = 3;
const sueldoBase = 1200;

// Mostrar datos pero en  plantilla (formateamos con $ /n para asi que salga mejor)
console.log(
    `Nombre: ${nombre}\n` +
    `Profesión: ${profesion}\n` +
    `Años de antigüedad: ${antiguedad}\n` +
    `Sueldo base: ${sueldoBase.toFixed(2)} €`
);

// Calcular el plus mensual de 10% del sueldo base por cada año
const porcentajePlusPorAnio = 10; // 10% por año
const plusMensual = sueldoBase * (porcentajePlusPorAnio / 100) * antiguedad;

//Calculamos el total mensual
const totalMensual = sueldoBase + plusMensual;

// Mostrar sueldo base, plus y total con dos decimales
console.log(
    `Sueldo base: ${sueldoBase.toFixed(2)} €\n` +
    `Plus mensual: ${plusMensual.toFixed(2)} €\n` +
    `Total mensual: ${totalMensual.toFixed(2)} €`
);