//Primero creamos preciobase y porcentaje de impuesto aplicado.
const preciobase = 100;
const porcentajeImpuesto = 21;

//Ahora calculamos el importe del impuesto y el precio final.

const importeImpuesto = preciobase * (porcentajeImpuesto / 100);

const precioFinal = preciobase + importeImpuesto;

//Ahora vamos a mostrar por consola los 3 importes con dos decimales usando toFixed.

console.log("Precio base: " + preciobase.toFixed(2), +"€");
console.log("Importe del impuesto: ", importeImpuesto.toFixed(2), "€");
console.log("Precio final: ", precioFinal.toFixed(2), "€");



