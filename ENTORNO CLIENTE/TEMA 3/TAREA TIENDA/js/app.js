
// Con esto convertimos los discos en tarjetas.


const contenedor = document.getElementById("discos");

const imagenPorDefecto = "img/default.jpg";

tienda.forEach(disco => {
    const card = document.createElement("div");
    card.className = "card";

    const imagen = document.createElement("img");
    imagen.src = disco.caratula;
    imagen.alt = disco.titulo;

    imagen.onerror = function () {
        imagen.src = imagenPorDefecto;
        imagen.classList.add("error");
    };

    const info = document.createElement("div");
    info.className = "card-info";

    const titulo = document.createElement("h2");
    titulo.textContent = disco.titulo;

    const artista = document.createElement("p");
    artista.textContent = disco.artista;

    const pais = document.createElement("span");
    pais.className = "badge";
    pais.textContent = disco.pais;

    const anio = document.createElement("p");
    anio.textContent = "Año: " + disco.publicacion;

    const copias = document.createElement("p");
    copias.textContent = "Copias vendidas: " + disco.copias + " mil";

    const precio = document.createElement("p");
    precio.className = "precio";
    precio.textContent = "€" + disco.precio.toFixed(2);

    info.append(titulo, artista, pais, anio, copias, precio);
    card.append(imagen, info);
    contenedor.append(card);
});