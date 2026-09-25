//Añado el array.
const numeros = [-4, -2 , -8, -1, -3, -6];
// Creo las variables donde se acumularan los resultados
let producto =1;
let mayor = numeros[0];
let suma = 0;
let media = 0;

//En este bucle for recorremos elemento a elemento y en el if si el numero actual es mayor que el encontrado se actualiza.
for (let i = 0; i < numeros.length; i++) {
  producto = producto * numeros[i];
  suma = suma + numeros[i];
  if (numeros[i]> mayor) {
      mayor = numeros[i];
  }
  
}

// Hacemos la media
media = suma / numeros.length;
// Mostramos por consola
console.log("Con:", numeros, "\nProducto:", producto, "\nMayor:", mayor, "\nMedia:", media);