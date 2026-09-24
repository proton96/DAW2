
// Creamos el objeto persona con sus propiedades
const persona = {
  nombre: "Laura",
  edad: 24,
  profesion: "desarrolladora",

  // Método que utiliza,.
  describir() {
    return `${this.nombre} tiene ${this.edad} años y trabaja como ${this.profesion}.`;
  }
};

// Mostrar cada propiedad por separado en consola
console.log("Propiedades por separado:");
console.log("Nombre:", persona.nombre);
console.log("Edad:", persona.edad);
console.log("Profesión:", persona.profesion);
console.log("-------------------------------------------------");

//Llamar al método describir y mostrar lo que devuelve
console.log("Primera descripción:");
console.log(persona.describir());

// Cambiamos la edad a 25 y volvemos a llamarlo
persona.edad = 25;
console.log("\nTras el cambio de edad:");
console.log(persona.describir());
