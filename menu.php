<?php
$categorias = [
    'Cafés Calientes' => [
        [
            'nombre' => 'Americano',
            'desc'   => 'Café negro suave y equilibrado',
            'precio' => 2.50,
            'img'    => 'americano.png',
            'opciones' => [
                'Tamaño' => ['Pequeño', 'Mediano (+$0.50)', 'Grande (+$1.00)'],
                'Azúcar' => ['Sin azúcar', '1 cdta', '2 cdta', 'Extra dulce (+$0.30)']
            ]
        ],
        [
            'nombre' => 'Cappuccino',
            'desc'   => 'Espresso, leche vaporizada y espuma cremosa',
            'precio' => 3.90,
            'img'    => 'cappuccino.png',
            'opciones' => [
                'Leche'  => ['Entera', 'Deslactosada', 'Almendra (+$0.90)', 'Avena (+$0.90)'],
                'Canela' => ['Sin canela', 'Con canela', 'Extra canela (+$0.20)']
            ]
        ],
        [
            'nombre' => 'Latte',
            'desc'   => 'Café con mucha leche suave y aterciopelada',
            'precio' => 3.80,
            'img'    => 'latte.png',
            'opciones' => [
                'Tamaño' => ['Pequeño', 'Mediano', 'Grande'],
                'Sabor'  => ['Natural', 'Vainilla (+$0.70)', 'Caramelo (+$0.70)', 'Avellana (+$0.70)']
            ]
        ],
        [
            'nombre' => 'Mocha',
            'desc'   => 'Latte con chocolate y crema batida',
            'precio' => 4.00,
            'img'    => 'mocha.png',
            'opciones' => ['Crema' => ['Sin crema', 'Con crema batida']]
        ]
    ],
    'Bebidas Frías' => [
        [
            'nombre' => 'Cold Brew',
            'desc'   => 'Café infusionado en frío 12 horas',
            'precio' => 4.00,
            'img'    => 'cold-brew.png',
            'opciones' => [
                'Tamaño' => ['Mediano', 'Grande (+$0.50)'],
                'Leche'  => ['Sin leche', 'Con leche fría', 'Con leche vegetal (+$0.90)']
            ]
        ],
        [
            'nombre' => 'Frappé de Caramelo',
            'desc'   => 'Café, hielo, caramelo y crema',
            'precio' => 4.20,
            'img'    => 'frappe-caramelo.png',
            'opciones' => [
                'Tamaño' => ['Mediano', 'Grande (+$0.60)']
            ]
        ]
    ],
    'Postres' => [
        [
            'nombre' => 'Brownie con nuez',
            'desc'   => 'Húmedo, intenso chocolate y nueces crocantes',
            'precio' => 2.90,
            'img'    => 'brownie.png',
            'opciones' => ['Extra' => ['Solo', 'Con helado (+$1.50)']]
        ],
        [
            'nombre' => 'Cheesecake de fresa',
            'desc'   => 'Base crujiente y cremoso relleno',
            'precio' => 3.50,
            'img'    => 'cheesecake.png'
        ],
        [
            'nombre' => 'Galleta de chispas',
            'desc'   => 'Clásica galleta gigante recién horneada',
            'precio' => 1.80,
            'img'    => 'galleta.png'
        ]
    ],
    'Snacks' => [
        [
            'nombre' => 'Tostadas con aguacate',
            'desc'   => 'Pan artesanal, aguacate fresco y toque de limón',
            'precio' => 3.20,
            'img'    => 'tostada-aguacate.png'
        ],
        [
            'nombre' => 'Croissant clásico',
            'desc'   => 'Hoja crujiente y mantecoso interior',
            'precio' => 2.10,
            'img'    => 'croissant.png'
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - El Aroma</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <div class="header-content">
            <h1>El Aroma</h1>
            <p>Nuestro Menú</p>
        </div>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="menu.php">Menú</a>
            <a href="pedido.php" class="carrito-btn">
                🛒 Pedido (<span id="contador-carrito">0</span>)
            </a>
        </nav>
    </header>

    <main class="container">
        <?php foreach ($categorias as $nombreCat => $productos): ?>
            <section class="categoria">
                <h2><?= htmlspecialchars($nombreCat) ?></h2>
                
                <div class="grid-productos">
                    <?php foreach ($productos as $p): ?>
                        <div class="card">
                            <div class="card-img">
                                <img src="images/<?= htmlspecialchars($p['img']) ?>" 
                                     alt="<?= htmlspecialchars($p['nombre']) ?>" 
                                     loading="lazy">
                            </div>
                            <div class="card-body">
                                <h3><?= htmlspecialchars($p['nombre']) ?></h3>
                                <p class="desc"><?= htmlspecialchars($p['desc']) ?></p>
                                <p class="precio" data-precio-base="<?= $p['precio'] ?>">$<?= number_format($p['precio'], 2) ?></p>

                                <?php if (!empty($p['opciones'])): ?>
                                    <div class="opciones">
                                        <?php foreach ($p['opciones'] as $tipo => $vals): ?>
                                            <div class="campo">
                                                <label><?= $tipo ?>:</label>
                                                <select class="opcion-select">
                                                    <?php foreach ($vals as $v): ?>
                                                        <option><?= htmlspecialchars($v) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <button class="btn agregar" 
                                        data-nombre="<?= htmlspecialchars($p['nombre']) ?>"
                                        data-precio="<?= $p['precio'] ?>"
                                        data-img="<?= htmlspecialchars($p['img']) ?>">
                                    Agregar al pedido
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </main>

    <footer>
        <p>© <?= date("Y") ?> El Aroma • Hecho con ☕ y pasión • SV</p>
    </footer>

    <script>
        // Sistema de carrito
        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        
        // Actualizar contador al cargar la página
        actualizarContador();

        // Función para extraer el costo adicional de una opción
        function extraerCostoAdicional(opcion) {
            const match = opcion.match(/\+\$(\d+\.?\d*)/);
            return match ? parseFloat(match[1]) : 0;
        }

        // Agregar event listeners a todos los botones
        document.querySelectorAll('.btn.agregar').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.card-body');
                const nombre = this.dataset.nombre;
                const precioBase = parseFloat(this.dataset.precio);
                const img = this.dataset.img;
                
                // Recoger opciones seleccionadas
                const selects = card.querySelectorAll('.opcion-select');
                let opciones = {};
                let costoAdicional = 0;
                
                selects.forEach(select => {
                    const label = select.previousElementSibling.textContent.replace(':', '');
                    const valorSeleccionado = select.value;
                    opciones[label] = valorSeleccionado;
                    costoAdicional += extraerCostoAdicional(valorSeleccionado);
                });
                
                const precioFinal = precioBase + costoAdicional;
                
                // Crear objeto producto
                const producto = {
                    id: Date.now(),
                    nombre: nombre,
                    precio: precioFinal,
                    precioBase: precioBase,
                    img: img,
                    opciones: opciones
                };
                
                // Agregar al carrito
                carrito.push(producto);
                localStorage.setItem('carrito', JSON.stringify(carrito));
                
                // Actualizar contador
                actualizarContador();
                
                // Feedback visual
                this.textContent = '¡Agregado! ✓';
                this.style.background = '#2e7d32';
                
                setTimeout(() => {
                    this.textContent = 'Agregar al pedido';
                    this.style.background = '';
                }, 1500);
            });
        });

        function actualizarContador() {
            document.getElementById('contador-carrito').textContent = carrito.length;
        }
    </script>

</body>
</html>