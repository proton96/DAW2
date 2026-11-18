# Plan de estudio · Temas 4 y 5 (DWEC)

**Examen: 26 de noviembre.** Días de trabajo: del **miércoles 18** al **miércoles 25** (8 días, el 26 no se incluye).
**Tiempo total previsto:** ~18 h (1,5–2 h entre semana, 3–3,5 h el fin de semana).

Documentos de referencia (no está permitido estudiar sin ellos abiertos al lado):

- `TEMA 4/TEMARIO/DWEC_Tema4_Eventos_y_DOM.pdf` — 29 pág.
- `TEMA 5/DWEC_Tema5A_Formularios_y_validacion.pdf` — 32 pág.
- `TEMA 5/DWEC_Tema5B_Expresiones_regulares.pdf` — 28 pág.

---

## 1. Reglas del plan

1. **Nada se copia sin explicarlo.** Si no puedes decir en voz alta qué hace cada línea, no cuenta como estudiado.
2. **Se estudia escribiendo código**, no leyendo. Cada bloque de teoría termina con código propio escrito desde cero.
3. **Repaso espaciado obligatorio**: los primeros 15 minutos de cada sesión son tarjetas del día anterior, sin mirar apuntes.
4. **Un entregable por día.** Si el día termina sin el entregable, ese día no está hecho.
5. **Errores al registro.** Cuando algo falle, se anota: entrada → esperado → real → línea/regla → cambio. Eso es exactamente lo que pide el tema 5.
6. Si un día se cae, **se recupera el entregable, no la lectura**. Nunca se salta el repaso del día siguiente.

## 2. Estructura diaria (bloques de 45 min máximo)

| Bloque | Duración | Qué se hace |
|---|---|---|
| A · Repaso | 15 min | Tarjetas de los días anteriores. En voz alta o por escrito, sin apuntes. |
| B · Teoría activa | 40–50 min | Leer páginas concretas del PDF + escribir apunte **de memoria** después de cerrar el PDF. |
| C · Código | 50–90 min | Construir el entregable del día sin copiar del PDF; después comparar y corregir. |
| D · Cierre | 10–15 min | Crear 5–8 tarjetas nuevas + rellenar la checklist de dominio. |

Regla de las tarjetas: pregunta en el anverso, respuesta en el reverso, **y siempre un ejemplo de código mínimo** en el reverso. Se descarta una tarjeta solo si la aciertas dos sesiones seguidas.

## 3. Estructura de carpetas a crear hoy

```
ENTORNO CLIENTE/ESTUDIO_T4_T5/
├── apuntes-t4.md          # teoría propia del tema 4
├── apuntes-t5.md          # teoría propia del tema 5
├── flashcards.md          # todas las tarjetas, numeradas
├── errores.md             # registro de fallos y correcciones
├── 01-lista-tareas/       # práctica guiada del tema 4 (HTML+CSS+JS separados)
├── 02-ejercicios-t4/      # mensaje alterno, contador, tarjetas, vaciar lista
├── 03-inscripcion/        # proyecto del tema 5A + reto del 5B
├── 04-regex/              # ejercicios.js + pruebas.js
└── 05-chuleta/            # resumen de 1 hoja para el día 26
```

Cada carpeta se abre con Live Server, nunca con `file://` suelto si hay módulos o `defer` dudoso.

---

## 4. Calendario día a día

### Día 1 · Miércoles 18 (1 h 45) — Cimientos del DOM

**Objetivo:** seleccionar y modificar el DOM sin mirar apuntes.

| Bloque | Tarea |
|---|---|
| A (15 min) | Crear la estructura de carpetas y los 5 archivos `.md`. Abrir VS Code + Live Server. |
| B (45 min) | Tema 4, pág. 3–10: árbol de nodos, `querySelector`/`getElementById`/`querySelectorAll`, `textContent` vs `innerHTML`, `classList`, propiedades vs atributos, `dataset`, `createElement`/`append`/`remove`. |
| C (35 min) | Sin copiar: página con un `<ul>` vacío donde creas 3 `li` desde un array, alternas una clase con `classList.toggle`, borras el último con `remove()` y muestras `lista.children.length` en un `<p>`. |
| D (10 min) | 6 tarjetas: `querySelector` vs `getElementById`; NodeList estática; `textContent` vs `innerHTML`; `classList` (4 métodos); `append` vs `prepend`; `children` vs `childNodes`. |

**Autotest de salida (responder sin PDF):**
- ¿Por qué `document.querySelector(".tarjeta")` puede devolver `null`?
- ¿Qué pasa si asignas `textContent = "<strong>Hola</strong>"`?
- ¿Por qué `boton.disabled = "false"` no habilita el botón?

---

### Día 2 · Jueves 19 (2 h) — Eventos, propagación y delegación

**Objetivo:** explicar el recorrido de un evento y delegar en un contenedor.

| Bloque | Tarea |
|---|---|
| A (15 min) | Tarjetas del día 1. |
| B (45 min) | Tema 4, pág. 11–19: `addEventListener`, catálogo de eventos, `event.target` vs `currentTarget`, captura/destino/burbujeo, `preventDefault` vs `stopPropagation`, delegación con `closest`, `once` y `removeEventListener`, accesibilidad, orden de depuración. |
| C (45 min) | (1) Montar el ejemplo panel+botón con `{capture:true}` y comprobar en consola el orden **captura → botón → burbujeo**. (2) Reescribir la delegación del `ul` con `closest("button[data-accion]")`. (3) Provocar un fallo a propósito (listener pasado con paréntesis) y observarlo. |
| D (15 min) | Comparar de memoria: `preventDefault` / `stopPropagation` / `return false` / `once`. 6 tarjetas nuevas. |

**Autotest de salida:**
- Clic sobre un `<span>` dentro de un `<button>`: ¿qué valen `target` y `currentTarget`?
- ¿Por qué una función flecha no puede usar `this` para el elemento?
- ¿Por qué `preventDefault()` no detiene el burbujeo?
- ¿Qué diferencia hay entre dos funciones flecha con el mismo cuerpo al llamar a `removeEventListener`?

---

### Día 3 · Viernes 20 (2 h) — Práctica guiada del Tema 4

**Objetivo:** construir la lista interactiva completa de memoria.

| Bloque | Tarea |
|---|---|
| A (15 min) | Tarjetas del día 2 + reescribir a mano el esquema de propagación. |
| B (45 min) | Construir `01-lista-tareas/` (HTML, CSS, JS separados) **sin mirar el PDF**: añadir numeradas, completar con `toggle`, borrar, resumen `Total · Completadas`, delegación en el `ul`, foco a *Añadir* al borrar. |
| C (30 min) | Abrir el PDF (pág. 20–26) y comparar línea a línea. Anotar en `errores.md` las diferencias reales (no las cosméticas). |
| D (30 min) | Recorrer la checklist de comprobación de la pág. 26 (los 7 pasos) + teclado (Tab, Enter, Espacio) + ventana estrecha. 6 tarjetas nuevas. |

**Entregable:** lista funcional, resumen siempre correcto, tareas nuevas responden a los eventos.

---

### Día 4 · Sábado 21 (3 h) — Cierre del Tema 4 y arranque del Tema 5A

**Objetivo:** dar por cerrado el tema 4 y entender cómo se lee un control de formulario.

| Bloque | Tarea |
|---|---|
| A (25 min) | Tarjetas tema 4 completas. Reescribir el listener delegado de memoria. |
| B (55 min) | `02-ejercicios-t4/`: ejercicio 1 (mensaje alterno sin `alert`), 2 (contador con `-` deshabilitado en 0), 3 (tres tarjetas desde array con delegación) y 4 (Vaciar lista + pendientes). |
| C (60 min) | Tema 5A pág. 4–11: `label`/`id`/`name`, `action`/`method`, `fieldset`, qué control usar; **tabla de lectura de valores**; validación HTML (`required`, `type`, `minlength`, `min`/`max`, `step`, `pattern`); eventos `submit`/`input`/`change`; `checkValidity`/`reportValidity`/`setCustomValidity` y `validity`. |
| D (40 min) | Laboratorio: formulario con texto, número, select, radio, checkbox y file. Leer cada valor por su propiedad correcta y probar en consola `campo.validity` de un campo vacío, de uno con `typeMismatch` y de uno con `setCustomValidity("x")`. |
| E (15 min) | 8 tarjetas del 5A. |

**Autotest de salida:**
- ¿Cómo se lee si una casilla está marcada? ¿Y el radio elegido?
- ¿Qué devuelve `valueAsNumber` de un número vacío?
- ¿Qué hace exactamente `novalidate`? ¿Desactiva `checkValidity()`?
- Si la validación HTML falla, ¿se dispara `submit`?

---

### Día 5 · Domingo 22 (3 h 30) — Proyecto completo de formulario (5A)

**Objetivo:** formulario de inscripción funcionando y probado con la matriz del PDF.

| Bloque | Tarea |
|---|---|
| A (20 min) | Tarjetas tema 4 + 5A. |
| B (2 h) | `03-inscripcion/`: construir el proyecto entero desde cero. Nombre 2–60 tras `trim`, correo con `type="email"`, plazas entero 1–5 con `valueAsNumber`, taller con opción vacía, imagen opcional JPEG/PNG ≤ 2 MB, casilla de condiciones. `validar(campo)` que limpia `setCustomValidity("")`, calcula mensaje propio y cae a `valueMissing`/`typeMismatch`/`!valid`; `submit` que valida **todos**, enfoca el primero inválido y simula con `FormData`. Revalidación al `input`/`change` solo tras el primer intento. |
| C (45 min) | Matriz de pruebas de la pág. 25–26: los 12 casos, con columna *observado*. Hay que provocar los fallos, no suponerlos. |
| D (15 min) | Documentar en `errores.md` al menos 3 discrepancias con el formato: entrada / esperado / real / regla / cambio. |

**Entregable:** los 12 casos de la matriz con resultado observado, y el formulario sin ningún fallo de la lista.

---

### Día 6 · Lunes 23 (2 h) — Expresiones regulares I

**Objetivo:** leer y construir un patrón, y saber cuándo NO usarlo.

| Bloque | Tarea |
|---|---|
| A (15 min) | Tarjetas 5A. |
| B (45 min) | Tema 5B pág. 4–11: buscar vs validar (anclas), clases y escapes, cuantificadores, grupos y `(?:...)`, alternancia, banderas (`i`, `g`, `m`, `s`, `u`), literal vs `new RegExp`. |
| C (45 min) | `04-regex/ejercicios.js`: actividades 1–4 (cifra, `AULA-\d{2}`, alias, extensión) + `pruebas.js` con `console.assert` y tabla de casos (válido, límites, inválido, vacío, rodeado de texto). |
| D (15 min) | Explicar por escrito por qué `const r = /^\d+$/g; r.test("123")` da `true` y luego `false`. 8 tarjetas. |

**Autotest de salida:**
- ¿Por qué `/gafas?/.test("gafassss")` es `true` y `/^gafas?$/` es `false`?
- ¿Qué exige exactamente `^rojo|azul$`? ¿Cómo se arregla?
- ¿Cuándo se usa `g` y cuándo está prohibido usarla?

---

### Día 7 · Martes 24 (2 h) — Regex II + integración en el formulario

**Objetivo:** meter patrones dentro del formulario del domingo.

| Bloque | Tarea |
|---|---|
| A (15 min) | Tarjetas regex + reescribir el patrón del móvil de memoria. |
| B (40 min) | Tema 5B pág. 12–22: `test`/`match`/`replace`/`split`, normalizar con intención, patrones del tema, `pattern` en HTML (sin barras, coincidencia completa, vacío no falla), formato vs significado (DNI), matrices de prueba. |
| C (45 min) | Actividades 5–8 (teléfono opcional, extraer cantidades con `?? []`, normalizar espacios `/ +/g`, modalidad `(?:presencial|online)` con `i`) + el DNI con letra de control. |
| D (20 min) | Reto de integración: añadir **alias** (con `pattern`) y **teléfono opcional** (con `validar()` en JS) al formulario, con ≥6 casos de prueba documentados. |

**Entregable:** formulario con 8 campos validados, alias por `pattern` y teléfono por JS, y su tabla de pruebas.

---

### Día 8 · Miércoles 25 (3 h) — Repaso global y simulacro

**Objetivo:** llegar al 26 sin conceptos frágiles.

| Bloque | Tarea |
|---|---|
| A (30 min) | Todas las tarjetas, marcando en rojo las que fallen. |
| B (75 min) | Simulacro en papel (sección 7 de este documento): 12 preguntas cortas + 3 ejercicios de código escritos a mano, sin autocompletado ni consola. |
| C (45 min) | Corregir con los PDFs. Cada fallo se convierte en una tarjeta nueva y en una línea de la chuleta. |
| D (30 min) | Reducir todo a `05-chuleta/chuleta.md` (1 hoja): sintaxis, propiedades, trampas, patrones. |

**Criterio de cierre:** ninguna tarjeta en rojo dos veces seguidas y los 3 ejercicios del simulacro resueltos sin consultar.

---

## 5. Checklist de dominio ("lo sé si…")

### Tema 4
- [ ] Dibujo el árbol de nodos de un HTML dado y nombro padre, hijo, hermano y descendiente.
- [ ] Explico por qué cambiar el DOM no modifica el archivo HTML.
- [ ] Elijo entre `querySelector`, `querySelectorAll` y `getElementById` sin dudar.
- [ ] Explico por qué `querySelectorAll` no incorpora elementos nuevos.
- [ ] Cambio solo texto, solo clase o solo atributo según el caso, sin tocar los demás.
- [ ] Creo un elemento completo (`createElement` + `textContent` + `dataset` + `append`) de memoria.
- [ ] Explico `target` vs `currentTarget` con un clic sobre un hijo.
- [ ] Ordeno captura, destino y burbujeo.
- [ ] Distingo `preventDefault`, `stopPropagation` y `return false`.
- [ ] Escribo un listener delegado con `closest` + `contains` de memoria.
- [ ] Explico `{ once: true }` y por qué falla `removeEventListener` con flechas nuevas.
- [ ] Añado `aria-pressed`/`aria-expanded` y mantengo el foco visible.

### Tema 5A
- [ ] Relaciono `label for` ↔ `id` ↔ `name` y digo qué rompe cada uno.
- [ ] Leo cada control con su propiedad correcta (`.value`, `valueAsNumber`, `.checked`, `:checked`, `files[0]`).
- [ ] Explico por qué `Number("")` es `0` y cómo evitarlo.
- [ ] Asigno cada regla a HTML (`required`, `type`, `min/max`, `step`, `pattern`) o a JS, y justifico.
- [ ] Uso `validity` con sus 7 indicadores y `.valid`.
- [ ] Distingo `checkValidity`, `reportValidity` y `setCustomValidity`.
- [ ] Sé qué eventos (`submit`, `input`, `change`) cubren qué.
- [ ] Explico por qué `novalidate` no desactiva la API y por qué `return false` no cancela.
- [ ] Escribo `validar(campo)` completa con `aria-invalid` y `#error-<id>`.
- [ ] Valido todos los campos aunque el primero falle y enfoco el primero inválido.
- [ ] Explico qué entra y qué no entra en `FormData` y cuándo usar `getAll`.
- [ ] Sé por qué 2 MB = 2 000 000 bytes.

### Tema 5B
- [ ] Distingo buscar (`/x/`) de validar (`/^x$/`).
- [ ] Explico qué modifica un cuantificador y qué pasa con `{n,m}` y el vacío.
- [ ] Diferencio `(abc)` de `(?:abc)` y sé cuándo agrupar alternativas.
- [ ] Uso `i`, `g`, `m`, `s`, `u` y sé cuándo cada una rompe una validación.
- [ ] Escribo de memoria: alias, C.P., importe, móvil, `AULA-\d{2}`, extensión.
- [ ] Explico el problema de `lastIndex` con `g` + `test`.
- [ ] Sé qué hace `pattern` en HTML y qué NO hace (vacío, barras, anclas).
- [ ] Combino patrón + regla de cálculo (DNI) y explico qué queda fuera de la regex.
---

## 6. Cómo estudiar cada bloque (para que no se te quede en la cabeza solo al leer)

- **Recuperación activa:** después de leer una página del PDF, ciérralo y escribe en `apuntes-t4.md` / `apuntes-t5.md` todo lo que recuerdes, incluido código. Solo entonces vuelve a abrir para completar huecos. Los huecos son tu lista de estudio real.
- **Explicación en voz alta:** cada concepto, explicado como si se lo contaras a un compañero que no ha leído el tema. Si te trabas, no lo dominas.
- **Código a mano primero, luego en VS Code:** los ejercicios de examen se escriben sin autocompletar. Haz al menos uno al día en papel.
- **Variar el ejemplo:** no repetir el mismo código del PDF. Si el PDF valida un alias, tú validas un código de reserva. Cambiar el caso detecta si entendiste la regla o memorizaste el ejemplo.
- **Repetición espaciada:** cada tarjeta se repasa al día siguiente, a los 3 días y a los 7. Por eso el repaso está al principio de cada sesión.
- **Errores como material:** `errores.md` es lo último que leas el día 25. Tus fallos son el mejor predictor de las preguntas que vas a fallar.

---

## 7. Simulacro del día 25 (Block B) — sin apuntes, sin consola

### Parte 1 · Preguntas cortas (1 punto cada una)

1. Explica por qué `document.querySelectorAll(".producto")` no incluye un `<li class="producto">` añadido después de la llamada.
2. Diferencia `event.target` y `event.currentTarget` y da un ejemplo en el que no coincidan.
3. ¿Qué diferencia hay entre `preventDefault()` y `stopPropagation()`? ¿Cuál de los dos detiene el burbujeo?
4. En un listener registrado con `addEventListener`, ¿por qué `return false` no cancela el envío del formulario?
5. `const x = document.querySelector("#nada"); console.log(x);` → ¿qué se imprime y por qué?
6. ¿Qué entra y qué no entra en `new FormData(form)`? Nombra dos casos excluidos.
7. ¿Qué hace exactamente `novalidate`? ¿Desactiva `checkValidity()`?
8. Si el navegador detecta un campo inválido, ¿se ejecuta el listener `submit`? Justifica.
9. Diferencia `checkValidity()`, `reportValidity()` y `setCustomValidity("x")`.
10. ¿Por qué `Number("")` es `0` y qué usarías en su lugar para leer un `input type="number"`?
11. ¿Por qué `/^gafas?$/.test("gafassss")` es `false` y `/gafas?/.test("gafassss")` es `true`?
12. Explica por qué `^rojo|azul$` no es lo mismo que `^(?:rojo|azul)$`. ¿Qué acepta cada uno?

### Parte 2 · Código a mano (3 ejercicios)

**Ejercicio A — Delegación y estado (Tema 4)**

HTML dado:

```html
<ul id="lista">
  <li><span>Pan</span><button type="button" data-accion="hecho">Hecho</button></li>
  <li><span>Leche</span><button type="button" data-accion="hecho">Hecho</button></li>
</ul>
```

Escribe el JS que, con **delegación**, al pulsar un botón `hecho` marque ese `li` con la clase `completado`. Debe funcionar con `li` añadidos posteriormente. Indica qué elemento lleva el listener y por qué.

**Ejercicio B — Validación de un campo (Tema 5A + 5B)**

Escribe la función `validar(campo)` para un `<input id="alias" name="alias" required pattern="[a-z0-9_]{3,12}">` que:
- limpie el error anterior,
- escriba el mensaje adecuado en `#error-alias` distinguiendo *falta rellenar* de *formato incorrecto*,
- marque `aria-invalid`,
- devuelva un booleano.

**Ejercicio C — Patrones (Tema 5B)**

Escribe, sin consultar, los patrones para: código de aula `AULA-` + dos cifras; extensión `.jpg` o `.png`; móvil `+34 6xx xxx xxx` o `+34 7xx xxx xxx`; y una función que devuelva `true` si el texto es `presencial` u `online`, sin distinguir mayúsculas.
---

## 8. Soluciones del simulacro (no abrir hasta haberlo hecho entero)

### Preguntas cortas

1. `querySelectorAll` devuelve una **NodeList estática**: una foto de la colección en el momento de la llamada. Si añades elementos después, hay que volver a consultar.
2. `target` es el elemento donde **se originó** el evento; `currentTarget` es el elemento **cuyo listener se está ejecutando**. Clic sobre un `<span>` dentro de `<button id="b">`: `target` es el `SPAN`, `currentTarget` el `BUTTON`.
3. `preventDefault()` cancela la acción predeterminada del navegador (navegar, enviar) y **no** detiene el burbujeo. `stopPropagation()` detiene el recorrido del evento y **no** cancela la acción predeterminada. El que detiene el burbujeo es `stopPropagation()`.
4. Porque `return false` solo tiene efecto en manejadores registrados como atributo HTML (`onclick="return false"`) o con `on<evento>`. Con `addEventListener` el valor devuelto se ignora: hay que llamar a `evento.preventDefault()`.
5. `null`. `querySelector` devuelve la primera coincidencia o `null` si el selector no encuentra nada (`#nada` no existe). Cualquier propiedad sobre ese valor lanzaría `TypeError`.
6. Entran los controles con `name` que participan en el envío. **No** entran los `disabled`, las casillas y radios **no marcados**, los `button` sin `name`, los elementos fuera del `form` y los `<input type="file">` sin archivo seleccionado (aparecen como `File` vacío).
7. `novalidate` impide que el navegador **bloquee el envío** y muestre sus mensajes automáticos. **No** desactiva la API de validación: `checkValidity()`, `reportValidity()` y `validity` siguen funcionando.
8. **No**. Si la validación nativa falla, el navegador no dispara `submit` (por eso se dice que no conviene dejar reglas personalizadas desactualizadas esperando corregirlas dentro de `submit`). Con `novalidate` el evento sí llega.
9. `checkValidity()` devuelve si se cumplen las restricciones sin abrir la interfaz de mensajes. `reportValidity()` comprueba **y** pide al navegador que muestre los errores. `setCustomValidity("texto")` marca el control como inválido con ese mensaje; `setCustomValidity("")` elimina el error personalizado.
10. `Number("")` es `0` porque una cadena vacía se convierte en cero: no significa que se haya escrito cero. Para un `input type="number"` se usa `campo.valueAsNumber`, que da `NaN` cuando no hay número válido, y se comprueba con `Number.isInteger()` y el rango.
11. Sin anclas, `/gafas?/` encuentra la subcadena `gafas` dentro de `gafassss` → `true`. Con `^...$` el patrón debe cubrir **toda** la cadena y sobran caracteres → `false`. El `?` afecta solo a la `s` anterior.
12. `^rojo|azul$` significa «empieza por `rojo`» **o** «termina en `azul`», así que acepta `rojizo` o `miazul`. `^(?:rojo|azul)$` agrupa las alternativas bajo las mismas anclas: solo acepta exactamente `rojo` o `azul`.

### Ejercicio A

```js
const lista = document.querySelector("#lista");

lista.addEventListener("click", (event) => {
  if (!(event.target instanceof Element)) return;
  const boton = event.target.closest("button[data-accion='hecho']");
  if (!boton || !lista.contains(boton)) return;
  boton.closest("li").classList.add("completado");
});
```

El listener va en el contenedor `ul`: los clics de los botones suben por burbujeo hasta él, así que los `li` creados después funcionan sin registrar nada nuevo. `closest` localiza el botón aunque se pulse el texto o un icono interior, y `lista.contains(boton)` evita responder a elementos ajenos.
Si se pidiera alternar en lugar de marcar: `classList.toggle("completado")`.

### Ejercicio B

```js
const campo = document.querySelector("#alias");

function validar(campo) {
  campo.setCustomValidity("");           // Borra el error anterior.
  let mensaje = "";

  if (campo.validity.valueMissing) {
    mensaje = "Escribe un alias.";
  } else if (campo.validity.patternMismatch) {
    mensaje = "Usa de 3 a 12 caracteres: minúsculas, cifras o _.";
  } else if (!campo.validity.valid) {
    mensaje = "Revisa el valor de este campo.";
  }

  campo.setCustomValidity(mensaje);
  campo.setAttribute("aria-invalid", String(mensaje !== ""));
  document.getElementById(`error-${campo.id}`).textContent = mensaje;
  return mensaje === "";
}

validar(campo);                          // Estado inicial.
campo.addEventListener("input", () => validar(campo));
```

Puntos que puntúan: limpiar **primero** con `""`, distinguir `valueMissing` de `patternMismatch`, escribir con `textContent`, marcar `aria-invalid` y devolver booleano.
Variante equivalente en JS puro (sin `pattern`): `if (!/^[a-z0-9_]{3,12}$/.test(campo.value))`.

### Ejercicio C

```js
const aulaValida      = (t) => /^AULA-[0-9]{2}$/.test(t);
const extensionValida = (t) => /^\.(?:jpg|png)$/.test(t);
const movilValido     = (t) => /^\+34 [67][0-9]{2} [0-9]{3} [0-9]{3}$/.test(t);
const modalidadValida = (t) => /^(?:presencial|online)$/i.test(t);
```

Errores que restan puntos aquí: `/^\.jpg|png$/` (anclas mal agrupadas: aceptaría `.jpgpega`), `/^+.34/` (`+` sin escapar es un cuantificador), `/^AULA-\d{2}$/` es correcto pero `\d` en `pattern` HTML debe ir como `[0-9]` si el navegador usa modo `v` y te exige escapes compatibles; y olvidar `i` en la modalidad.

---

## 9. Las 15 trampas que más caen

| # | Trampa | Respuesta correcta |
|---|---|---|
| 1 | `querySelectorAll` se actualiza sola | Es **estática**: hay que volver a consultar. |
| 2 | `innerHTML` para datos de usuario | Usar `textContent`; `innerHTML` interpreta marcado peligroso. |
| 3 | `boton.disabled = "false"` habilita | No: en atributos booleanos cuenta la **presencia**. Usar `false` booleano o `removeAttribute`. |
| 4 | `addEventListener("click", fn())` | Con paréntesis la ejecutas al registrar. Se pasa la referencia: `fn`. |
| 5 | `this` dentro de una función flecha | Es el `this` del ámbito externo. Usar `event.currentTarget`. |
| 6 | `preventDefault()` detiene el burbujeo | No, solo la acción predeterminada. |
| 7 | `return false` cancela con `addEventListener` | No: hay que usar `evento.preventDefault()`. |
| 8 | Dos funciones flecha iguales se pueden retirar | Son objetos distintos aunque el código coincida. `removeEventListener` exige la misma referencia. |
| 9 | `Number("")` es `NaN` | Es `0`. Para number usar `valueAsNumber`. |
| 10 | `value` de un checkbox indica si está marcado | No: se usa `.checked`. |
| 11 | `required` detecta solo espacios | No: una cadena de espacios cuenta como contenido; añadir regla con `trim()`. |
| 12 | `novalidate` desactiva la validación | No: solo impide el bloqueo y los mensajes automáticos; la API sigue activa. |
| 13 | `checkValidity()` muestra los errores | No: `reportValidity()` los muestra. |
| 14 | `/^\d+$/g` sirve para validar repetidamente | No: `g` mueve `lastIndex` y `test()` alterna `true/false`. Sin `g` para validar. |
| 15 | `^rojo\|azul$` acepta solo rojo o azul | No: acepta «empieza por rojo» o «termina en azul». Agrupar: `^(?:rojo\|azul)$`. |

Extra: `reset()` restablece valores pero **no** limpia tus mensajes ni los `setCustomValidity`; `Object.fromEntries(FormData)` pierde claves repetidas (usa `getAll`); 2 MB = **2 000 000** bytes, no 2 097 152.

---

## 10. Plan de emergencia (si se cae un día)

Orden de prioridad para recortar sin perder lo esencial:

1. **Imprescindible:** Tema 4 eventos + delegación (días 2 y 3) y Tema 5A proyecto con matriz de pruebas (día 5). Son el 70 % de la nota práctica.
2. **Muy alto:** Tema 5B patrones (día 6) y las trampas de la tabla anterior.
3. **Recortable:** los ejercicios extra del tema 4 (día 4, bloque B) y el DNI.
4. **Nunca recortable:** el simulacro del día 8 y la chuleta.

Si solo quedaran 3 días: día 1 = T4 completo con la lista interactiva; día 2 = T5A completo con su matriz; día 3 = T5B + simulacro.

## 11. La mañana del 26

- Solo `05-chuleta/chuleta.md` y la tabla de trampas. Nada nuevo.
- 10 minutos de repaso de: orden captura/burbujeo, `preventDefault` vs `stopPropagation`, tabla de lectura de controles, los 6 patrones y `lastIndex`.
- En el examen: si piden «explica», nombrar el mecanismo y poner un ejemplo de una línea. Si piden código, separar HTML/CSS/JS y no usar `innerHTML` con datos del usuario. Si piden patrones, **anclar siempre** y decir qué no cubre el patrón.
