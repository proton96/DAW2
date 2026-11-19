<?php
// aqui guardo todas las preguntas del test sobre cafe
// cada una tiene su enunciado, las posibles respuestas y la posicion de la que es correcta
// da igual cuantas preguntas o respuestas pongamos porque el codigo las cuenta solo

$preguntas = [
    [
        'enunciado' => '¿Qué especie de café supone aproximadamente el 60 % de la producción mundial?',
        'opciones' => ['Arábica', 'Robusta', 'Libérica', 'Excelsa'],
        'correcta' => 0
    ],
    [
        'enunciado' => '¿En qué país se sitúan los orígenes de la planta del café?',
        'opciones' => ['Brasil', 'Colombia', 'Etiopía', 'Indonesia'],
        'correcta' => 2
    ],
    [
        'enunciado' => '¿Qué método de procesado seca el grano al sol dentro de su cereza?',
        'opciones' => ['Lavado', 'Natural', 'Honey', 'Húmedo'],
        'correcta' => 1
    ],
    [
        'enunciado' => '¿Qué molienda es la adecuada para preparar un espresso?',
        'opciones' => ['Gruesa', 'Media', 'Fina', 'En grano entero'],
        'correcta' => 2
    ],
    [
        'enunciado' => '¿Cuál es el rango de temperatura recomendado del agua para preparar café?',
        'opciones' => ['65 - 70 °C', '75 - 80 °C', '90 - 96 °C', '100 °C en ebullición'],
        'correcta' => 2
    ],
    [
        'enunciado' => '¿Cuál es el mayor país productor de café del mundo?',
        'opciones' => ['Brasil', 'Vietnam', 'Colombia', 'Etiopía'],
        'correcta' => 0
    ],
    [
        'enunciado' => '¿Qué variedad se caracteriza por un sabor más amargo y mayor contenido de cafeína?',
        'opciones' => ['Arábica', 'Robusta', 'Geisha', 'Bourbon'],
        'correcta' => 1
    ],
    [
        'enunciado' => '¿Cómo se llama la cata profesional de café con protocolo estandarizado?',
        'opciones' => ['Cupping', 'Brewing', 'Latte art', 'Tamping'],
        'correcta' => 0
    ],
    [
        'enunciado' => '¿Qué indica la etiqueta "single origin" en un paquete de café?',
        'opciones' =>
            [
                'Que es un café descafeinado',
                'Que proviene de un único origen o finca',
                'Que está tostado en origen',
                'Que se ha cultivado en invernadero'
            ],
        'correcta' => 1
    ],
    [
        'enunciado' => '¿Qué bebida se prepara añadiendo agua caliente a un espresso?',
        'opciones' => ['Ristretto', 'Macchiato', 'Americano', 'Cortado'],
        'correcta' => 2
    ],
    [
        'enunciado' => '¿Qué es la "crema" de un espresso?',
        'opciones' =>
            [
                'La espuma dorada que se forma en la superficie',
                'La leche vaporizada que se añade al final',
                'El azúcar disuelto en la taza',
                'El residuo sólido que queda en el portafiltro'
            ],
        'correcta' => 0
    ],
    [
        'enunciado' => '¿Qué molienda se recomienda para una prensa francesa?',
        'opciones' => ['Muy fina, como harina', 'Fina', 'Media', 'Gruesa'],
        'correcta' => 3
    ]
];
