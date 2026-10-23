
// Normaliza un valor para realizar búsquedas de texto.

function normalizar(texto) {
    return String(texto ?? "").trim().toLocaleLowerCase("es");
}


function escaparHTML(valor) {
    const caracteres = {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#39;"
    };

    return String(valor).replace(
        /[&<>"']/g,
        caracter => caracteres[caracter]
    );
}


// Genera las tarjetas del catálogo utilizando map.

export function mostrarCatalogoHTML(array) {
    if (array.length === 0) {
        return '<p class="vacio">No se encontraron videojuegos.</p>';
    }

    return array.map(juego => `
    <article class="tarjeta">
      <div class="icono" aria-hidden="true">
        ${escaparHTML(juego.icono ?? "🎮")}
      </div>

      <span class="categoria">
        ${escaparHTML(juego.categoria)}
      </span>

      <h3>${escaparHTML(juego.nombre)}</h3>

      <p class="identificador">
        ID: ${escaparHTML(juego.id)}
      </p>

      <div class="datos">
        <span>${juego.precio.toFixed(2)} €</span>
        <span>⭐ ${juego.puntuacion.toFixed(1)} / 10</span>
      </div>
    </article>
  `).join("");
}


//Ordena los videojuegos de mayor a menor puntuación.
export function ordenarPorPuntuacion(array) {
    return [...array].sort(
        (a, b) => b.puntuacion - a.puntuacion
    );
}

//Ordena los videojuegos de menor a mayor precio.
export function ordenarPorPrecio(array) {
    return [...array].sort(
        (a, b) => a.precio - b.precio
    );
}


//Comprueba si existe una categoría utilizando some.

export function existeCategoria(array, categoria) {
    return array.some(
        juego => normalizar(juego.categoria) === normalizar(categoria)
    );
}

//Comprueba si todos los precios superan estrictamente el mínimo.

export function todosCumplenPrecioMinimo(array, precio) {
    return array.every(juego => juego.precio > precio);
}


//Filtra los videojuegos de una categoría.

export function filtrarPorCategoria(array, categoria) {
    return array.filter(
        juego => normalizar(juego.categoria) === normalizar(categoria)
    );
}

//Filtra los videojuegos que alcanzan una puntuación mínima.

export function filtrarPorPuntuacionMinima(array, puntuacion) {
    return array.filter(
        juego => juego.puntuacion >= puntuacion
    );
}

//Busca un videojuego por su identificador.

export function buscarPorId(array, id) {
    return array.find(
        juego => normalizar(juego.id) === normalizar(id)
    );
}

//Busca la primera coincidencia parcial por nombre.

export function buscarPorNombre(array, nombre) {
    const consulta = normalizar(nombre);

    if (consulta === "") {
        return undefined;
    }

    return array.find(
        juego => normalizar(juego.nombre).includes(consulta)
    );
}

//Obtiene el índice de un videojuego en el catálogo.

export function obtenerIndicePorId(array, id) {
    return array.findIndex(
        juego => normalizar(juego.id) === normalizar(id)
    );
}

//Calcula el precio promedio utilizando forEach.

export function calcularPrecioPromedio(array) {
    if (array.length === 0) {
        return 0;
    }

    let total = 0;

    array.forEach(juego => {
        total += juego.precio;
    });

    return total / array.length;
}

//Calcula la puntuación promedio utilizando forEach.

export function calcularPuntuacionPromedio(array) {
    if (array.length === 0) {
        return 0;
    }

    let total = 0;

    array.forEach(juego => {
        total += juego.puntuacion;
    });

    return total / array.length;
}

//Obtiene las propiedades propias enumerables con clave de texto.

export function obtenerPropiedades(objeto) {
    return Object.keys(objeto);
}

//Convierte un objeto en pares de clave y valor.

export function objetoAEntradas(objeto) {
    return Object.entries(objeto);
}

//Crea un objeto nuevo a partir de pares de clave y valor.

export function crearObjetoDesdeEntradas(entradas) {
    return Object.fromEntries(entradas);
}