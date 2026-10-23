import { videojuegos } from "./datos.js";

import {
    mostrarCatalogoHTML,
    ordenarPorPuntuacion,
    ordenarPorPrecio,
    existeCategoria,
    todosCumplenPrecioMinimo,
    filtrarPorCategoria,
    filtrarPorPuntuacionMinima,
    buscarPorId,
    buscarPorNombre,
    obtenerIndicePorId,
    calcularPrecioPromedio,
    calcularPuntuacionPromedio,
    obtenerPropiedades,
    objetoAEntradas,
    crearObjetoDesdeEntradas
} from "./funciones.js";

document.addEventListener("DOMContentLoaded", () => {
    const contenido = document.querySelector("#contenido");

    //Crea una sección y la incorpora al contenedor principal.

    function crearSeccion(id, titulo, descripcion = "") {
        const seccion = document.createElement("section");
        seccion.id = id;

        const encabezado = document.createElement("h2");
        encabezado.textContent = titulo;

        seccion.append(encabezado);

        if (descripcion !== "") {
            agregarTexto(seccion, descripcion);
        }

        contenido.append(seccion);

        return seccion;
    }

    //Añade un párrafo a un elemento.

    function agregarTexto(contenedor, texto, clase = "") {
        const parrafo = document.createElement("p");

        parrafo.textContent = texto;
        parrafo.className = clase;

        contenedor.append(parrafo);

        return parrafo;
    }

    //Crea una rejilla con tarjetas de videojuegos.

    function mostrarTarjetas(contenedor, datos) {
        const rejilla = document.createElement("div");

        rejilla.className = "rejilla";
        rejilla.innerHTML = mostrarCatalogoHTML(datos);

        contenedor.append(rejilla);

        return rejilla;
    }

    // 1. Catálogo completo.
    const catalogo = crearSeccion(
        "catalogo",
        "01 · Catálogo completo"
    );

    mostrarTarjetas(catalogo, videojuegos);

    // 2. Estadísticas generales.
    const estadisticas = crearSeccion(
        "estadisticas",
        "02 · Estadísticas generales"
    );

    const metricas = document.createElement("div");
    metricas.className = "metricas";

    const precioPromedio = calcularPrecioPromedio(videojuegos);
    const puntuacionPromedio = calcularPuntuacionPromedio(videojuegos);

    agregarTexto(
        metricas,
        `${videojuegos.length} videojuegos`,
        "metrica"
    );

    agregarTexto(
        metricas,
        `${precioPromedio.toFixed(2)} € de precio medio`,
        "metrica"
    );

    agregarTexto(
        metricas,
        `${puntuacionPromedio.toFixed(2)} / 10 de puntuación media`,
        "metrica"
    );

    estadisticas.append(metricas);

    // 3. Top 5 mejor valorados.
    const top = crearSeccion(
        "top",
        "03 · Top 5 mejor valorados"
    );

    const mejores = ordenarPorPuntuacion(videojuegos).slice(0, 5);
    const medallas = ["🥇", "🥈", "🥉", "4.º", "5.º"];

    mejores.forEach((juego, indice) => {
        agregarTexto(
            top,
            `${medallas[indice]} ${juego.nombre} · ${juego.puntuacion.toFixed(1)} / 10`,
            "ranking"
        );
    });

    mostrarTarjetas(top, mejores);

    // 4. Verificaciones.
    const verificaciones = crearSeccion(
        "verificaciones",
        "04 · Verificaciones"
    );

    ["Roguelike", "Deportes"].forEach(categoria => {
        const existe = existeCategoria(videojuegos, categoria);

        agregarTexto(
            verificaciones,
            `${existe ? "✅" : "❌"} ¿Existe la categoría ${categoria}? ${existe ? "Sí" : "No"
            }`
        );
    });

    [0, 15].forEach(precio => {
        const cumplen = todosCumplenPrecioMinimo(videojuegos, precio);

        agregarTexto(
            verificaciones,
            `${cumplen ? "✅" : "❌"} ¿Todos cuestan más de ${precio} €? ${cumplen ? "Sí" : "No"
            }`
        );
    });

    agregarTexto(
        verificaciones,
        "Se comprueba precio > mínimo. El catálogo incluye un videojuego gratuito."
    );

    // 5. Filtro por categoría.
    const filtro = crearSeccion(
        "categorias",
        "05 · Filtro por categoría"
    );

    const etiquetaCategoria = document.createElement("label");
    etiquetaCategoria.htmlFor = "categoria";
    etiquetaCategoria.textContent = "Selecciona una categoría:";

    const selector = document.createElement("select");
    selector.id = "categoria";

    const categorias = videojuegos
        .map(juego => juego.categoria)
        .filter((categoria, indice, array) => {
            return array.indexOf(categoria) === indice;
        });

    categorias.forEach(categoria => {
        const opcion = document.createElement("option");

        opcion.value = categoria;
        opcion.textContent = categoria;

        selector.append(opcion);
    });

    filtro.append(etiquetaCategoria, selector);

    const contador = agregarTexto(filtro, "");
    contador.setAttribute("aria-live", "polite");

    const listaFiltrada = mostrarTarjetas(filtro, []);

    function actualizarCategoria() {
        const seleccionados = filtrarPorCategoria(
            videojuegos,
            selector.value
        );

        contador.textContent =
            `${seleccionados.length} videojuegos de ${selector.value}`;

        listaFiltrada.innerHTML = mostrarCatalogoHTML(seleccionados);
    }

    selector.addEventListener("change", actualizarCategoria);
    actualizarCategoria();

    // 6. Elementos premium.
    const premium = crearSeccion(
        "premium",
        "06 · Elementos premium",
        "Videojuegos con puntuación igual o superior a 9.0."
    );

    premium.classList.add("destacada");

    const juegosPremium = filtrarPorPuntuacionMinima(
        videojuegos,
        9
    );

    mostrarTarjetas(premium, juegosPremium);

    // 7. Sistema de búsqueda.
    const busqueda = crearSeccion(
        "busqueda",
        "07 · Sistema de búsqueda",
        "Busca por ID exacto o por parte del nombre. Se muestra la primera coincidencia."
    );

    // Crea un formulario de búsqueda.

    function crearBuscador(tipo, ejemplo, buscar) {
        const formulario = document.createElement("form");

        const label = document.createElement("label");
        label.htmlFor = `buscar-${tipo}`;
        label.textContent = `Buscar por ${tipo}`;

        const input = document.createElement("input");
        input.id = `buscar-${tipo}`;
        input.type = "search";
        input.placeholder = ejemplo;
        input.required = true;

        const boton = document.createElement("button");
        boton.type = "submit";
        boton.textContent = "Buscar";

        formulario.append(label, input, boton);
        busqueda.append(formulario);

        const resultado = document.createElement("div");
        resultado.className = "resultado";
        resultado.setAttribute("aria-live", "polite");

        busqueda.append(resultado);

        formulario.addEventListener("submit", evento => {
            evento.preventDefault();
            resultado.replaceChildren();

            const consulta = input.value.trim();

            if (consulta === "") {
                agregarTexto(
                    resultado,
                    "Escribe un valor para realizar la búsqueda."
                );

                return;
            }

            const encontrado = buscar(videojuegos, consulta);

            if (encontrado === undefined) {
                agregarTexto(
                    resultado,
                    "No se encontró ningún videojuego."
                );

                return;
            }

            const indice = obtenerIndicePorId(
                videojuegos,
                encontrado.id
            );

            agregarTexto(
                resultado,
                `Posición en el catálogo: ${indice + 1} · Índice JavaScript: ${indice}`
            );

            mostrarTarjetas(resultado, [encontrado]);
        });
    }

    crearBuscador("ID", "Ejemplo: v01", buscarPorId);
    crearBuscador("nombre", "Ejemplo: stardew", buscarPorNombre);

    // 8. Análisis de propiedades.
    const analisis = crearSeccion(
        "analisis",
        "08 · Análisis de propiedades",
        "Propiedades, entradas y reconstrucción del primer videojuego."
    );

    const primero = videojuegos[0];

    if (primero !== undefined) {
        const propiedades = obtenerPropiedades(primero);
        const entradas = objetoAEntradas(primero);
        const reconstruido = crearObjetoDesdeEntradas(entradas);

        const resultados = [
            ["Object.keys()", propiedades],
            ["Object.entries()", entradas],
            ["Object.fromEntries()", reconstruido]
        ];

        resultados.forEach(([titulo, datos]) => {
            const encabezado = document.createElement("h3");
            encabezado.textContent = titulo;

            const bloque = document.createElement("pre");
            bloque.textContent = JSON.stringify(datos, null, 2);

            analisis.append(encabezado, bloque);
        });
    } else {
        agregarTexto(
            analisis,
            "El catálogo está vacío. No hay ningún objeto que analizar."
        );
    }

    // 9. Top 5 más económicos.
    const economicos = crearSeccion(
        "economicos",
        "09 · Top 5 más económicos"
    );

    const masEconomicos = ordenarPorPrecio(videojuegos).slice(0, 5);

    mostrarTarjetas(economicos, masEconomicos);

    // Footer.
    const pie = document.querySelector("#pie");
    const anio = new Date().getFullYear();

    pie.textContent =
        `PixelVault · TU NOMBRE · ${anio} · HTML5, CSS3 y JavaScript ES6`;
});