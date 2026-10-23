# ProtonGAME · Catálogo de videojuegos

##  Propiedad

Nombre y apellidos: Jose Carlos Martin

## Descripción

Aplicación web que permite visualizar, ordenar, filtrar, buscar y analizar
un catálogo de videojuegos mediante JavaScript.
## Temática

Videojuegos.

El catálogo incluye 12 videojuegos de 6 categorías:

- Simulación.
- Metroidvania.
- Plataformas.
- Roguelike.
- Supervivencia.
- Lucha.

Cada videojuego tiene seis propiedades:

- id.
- nombre.
- categoria.
- precio.
- puntuacion.
- icono.

Los precios y las puntuaciones son datos educativos de ejemplo,
no precios comerciales ni valoraciones oficiales actuales.

## Estructura

```text
PixelVault/
├── index.html
├── README.md
├── styles/
│   └── styles.css
└── js/
    ├── app.js
    ├── datos.js
    └── funciones.js
```

## Instalación

1. Descargar y descomprimir el proyecto.
2. Abrir la carpeta en Visual Studio Code.
3. Instalar la extensión Live Server si no está instalada.
4. Abrir index.html mediante Open with Live Server.
5. Utilizar la aplicación desde el navegador.

El proyecto utiliza módulos ES6 y debe ejecutarse mediante un servidor HTTP,
no abriendo index.html directamente con file://.

No necesita npm, frameworks ni dependencias externas.

## Archivos

### datos.js

Exporta el array de videojuegos.

### funciones.js

Contiene las quince funciones obligatorias, documentadas con JSDoc.

Las funciones no modifican el array recibido ni escriben en el DOM.

Las ordenaciones utilizan spread para crear una copia antes de aplicar sort.

### app.js

Importa los datos y todas las funciones.

Dentro de DOMContentLoaded crea las secciones, muestra los resultados
y registra los eventos del selector y los formularios.

### styles.css

Define el diseño responsive, las tarjetas, los gradientes,
las transiciones y los estados de foco.

## Funciones

| Función | Método utilizado |
| --- | --- |
| mostrarCatalogoHTML | map |
| ordenarPorPuntuacion | sort y spread |
| ordenarPorPrecio | sort y spread |
| existeCategoria | some |
| todosCumplenPrecioMinimo | every |
| filtrarPorCategoria | filter |
| filtrarPorPuntuacionMinima | filter |
| buscarPorId | find |
| buscarPorNombre | find |
| obtenerIndicePorId | findIndex |
| calcularPrecioPromedio | forEach |
| calcularPuntuacionPromedio | forEach |
| obtenerPropiedades | Object.keys |
| objetoAEntradas | Object.entries |
| crearObjetoDesdeEntradas | Object.fromEntries |

## Secciones

1. Encabezado.
2. Catálogo completo.
3. Estadísticas generales.
4. Top 5 mejor valorados.
5. Verificaciones.
6. Filtro por categoría.
7. Elementos premium.
8. Sistema de búsqueda.
9. Análisis de propiedades.
10. Top 5 más económicos.
11. Footer.

