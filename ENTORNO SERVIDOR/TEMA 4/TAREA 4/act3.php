<?php
$mascotas = [
    [
        "nombre" => "Pepe",
        "peso" => 4.5,
        "color" => "Marrón",
        "edad" => 12
    ],
    [
        "nombre" => "Sparky",
        "peso" => 3,
        "color" => "Blanco",
        "edad" => 2
    ],
    [
        "nombre" => "Tobby",
        "peso" => 7.2,
        "color" => "Beige",
        "edad" => 8
    ],
    [
        "nombre" => "Bigotes",
        "peso" => 4,
        "color" => "Negro",
        "edad" => 9
    ],
    [
        "nombre" => "Ricky",
        "peso" => 0.1,
        "color" => "Verde",
        "edad" => 2
    ]
];

     // Peso de la mascota con código 3.
    $pesoCodigo3 = $mascotas[3]["peso"];

     // Buscar el color de Sparky.
    $colorSparky = null;

     // Inicializamos usando la primera mascota.
    $mascotaMayor = $mascotas[0];
    $mascotaMenorPeso = $mascotas[0];

foreach ($mascotas as $mascota) {
    if ($mascota["nombre"] === "Sparky") {
        $colorSparky = $mascota["color"];
    }

    if ($mascota["edad"] > $mascotaMayor["edad"]) {
        $mascotaMayor = $mascota;
    }

    if ($mascota["peso"] < $mascotaMenorPeso["peso"]) {
        $mascotaMenorPeso = $mascota;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de mascotas</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 600px;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th,
        td {
            padding: 6px 10px;
            text-align: left;
            border: 1px solid #eeeeee;
        }

        thead th {
            background-color: #f79646;
            color: white;
        }

        .codigo {
            background-color: #00b050;
            color: white;
            font-weight: bold;
        }

        tbody tr:nth-child(odd) td {
            background-color: #d9d9d9;
        }

        tbody tr:nth-child(even) td {
            background-color: white;
        }
    </style>
</head>

<body>
    <h2>i. Todas las mascotas</h2>

    <table>
        <thead>
            <tr>
                <th class="codigo">Fila</th>
                <th>Nombre</th>
                <th>Peso</th>
                <th>Color</th>
                <th>Edad</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($mascotas as $codigo => $mascota): ?>
                <tr>
                    <th class="codigo"><?= $codigo ?></th>
                    <td>
                        <?= htmlspecialchars($mascota["nombre"], ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td>
                        <?= str_replace('.', ',', (string) $mascota["peso"]) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($mascota["color"], ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td><?= $mascota["edad"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>ii. Peso de la mascota con código 3</h2>
    <p><?= str_replace('.', ',', (string) $pesoCodigo3) ?></p>

    <h2>iii. Color de Sparky</h2>
    <?php if ($colorSparky !== null): ?>
        <p><?= htmlspecialchars($colorSparky, ENT_QUOTES, 'UTF-8') ?></p>
    <?php else: ?>
        <p>No se ha encontrado ninguna mascota llamada Sparky.</p>
    <?php endif; ?>

    <h2>iv. Todos los datos de la mascota de mayor edad</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Peso</th>
                <th>Color</th>
                <th>Edad</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    <?= htmlspecialchars($mascotaMayor["nombre"], ENT_QUOTES, 'UTF-8') ?>
                </td>
                <td>
                    <?= str_replace('.', ',', (string) $mascotaMayor["peso"]) ?>
                </td>
                <td>
                    <?= htmlspecialchars($mascotaMayor["color"], ENT_QUOTES, 'UTF-8') ?>
                </td>
                <td><?= $mascotaMayor["edad"] ?></td>
            </tr>
        </tbody>
    </table>

    <h2>v. Nombre de la mascota que pesa menos</h2>
    <p>
        <?= htmlspecialchars($mascotaMenorPeso["nombre"], ENT_QUOTES, 'UTF-8') ?>
    </p>
</body>
</html>