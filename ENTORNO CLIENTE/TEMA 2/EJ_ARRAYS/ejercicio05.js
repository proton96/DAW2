
const tienda = {
  productos: [
    { nombre: "Cuaderno", precio: 4 },
    { nombre: "Bolígrafo", precio: 2 },
    { nombre: "Mochila", precio: 25 }
  ],

  //Método que recorre los productos y suma sus precios
  calcularTotal() {
    let total = 0;
    for (let i = 0; i < this.productos.length; i++) {
      total += this.productos[i].precio;
    }
    return total;
  }
};

// Función auxiliar para formatear a dos decimales con coma o punto
function formatearPrecio(cantidad) {
  return cantidad.toFixed(2).replace(".", ",");
}

// Mostrar resultado inicial 
console.log(`Total: ${formatearPrecio(tienda.calcularTotal())} €`);

// Comprobar con el array vacío 
const copiaProductosOriginales = [...tienda.productos]; // Guardamos copia
tienda.productos = [];
console.log(`Con productos vacío: ${formatearPrecio(tienda.calcularTotal())} €`);

// Restauramos y añadimos un Estuche de 6 € 
tienda.productos = copiaProductosOriginales;
tienda.productos.push({ nombre: "Estuche", precio: 6 });
console.log(`Tras añadir Estuche (6 €): ${formatearPrecio(tienda.calcularTotal())} €`);
