
const numeros = [-4, -2 , -8, -1, -3, -6];
let producto =1;
let mayor = numeros[0];
let suma = 0;
let media = 0;


for (let i = 0; i < numeros.length; i++) {
  producto = producto * numeros[i];
  suma = suma + numeros[i];
  if (numeros[i]> mayor) {
      mayor = numeros[i];
  }
  
}
media = suma / numeros.length;

console.log("Con:", numeros, "\nProducto:", producto, "\nMayor:", mayor, "\nMedia:", media);