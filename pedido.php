<?php
session_start();

// Generar número de pedido único si no existe
if (!isset($_SESSION['numero_pedido'])) {
    $_SESSION['numero_pedido'] = 'EA-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
}

$numeroPedido = $_SESSION['numero_pedido'];

// Manejar confirmación del pedido
$pedidoConfirmado = false;
if (isset($_POST['confirmar_pedido'])) {
    $pedidoConfirmado = true;
    // Aquí puedes guardar el pedido en una base de datos si lo deseas
    // Por ahora solo lo confirmamos
}

// Si se cancela el pedido
if (isset($_POST['cancelar_pedido'])) {
    unset($_SESSION['numero_pedido']);
    header('Location: menu.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Pedido - El Aroma</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pedido.css">
</head>
<body>

    <header>
        <div class="header-content">
            <h1>El Aroma</h1>
            <p>Tu Pedido</p>
        </div>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="menu.php">Menú</a>
            <a href="pedido.php" class="carrito-btn activo">
                🛒 Pedido
            </a>
        </nav>
    </header>

    <main class="container">
        <?php if ($pedidoConfirmado): ?>
            <!-- Vista de pedido confirmado -->
            <section class="pedido-confirmado">
                <div class="icono-confirmado">✓</div>
                <h2>¡Pedido Confirmado!</h2>
                <div class="numero-pedido-grande">
                    <p>Número de Pedido</p>
                    <h3><?= htmlspecialchars($numeroPedido) ?></h3>
                </div>
                <div class="instrucciones">
                    <p><strong>Instrucciones:</strong></p>
                    <ol>
                        <li>Dirígete a la caja con este número de pedido</li>
                        <li>Realiza el pago de tu orden</li>
                        <li>Espera a que preparemos tus productos</li>
                        <li>¡Disfruta tu pedido!</li>
                    </ol>
                </div>
                <div class="total-confirmado">
                    <p>Total a pagar: <span id="total-final-confirmado">$0.00</span></p>
                </div>
                <div class="acciones-confirmado">
                    <a href="menu.php" class="btn principal">Hacer otro pedido</a>
                    <button onclick="window.print()" class="btn secundario">Imprimir comprobante</button>
                </div>
            </section>
        <?php else: ?>
            <!-- Vista del carrito normal -->
            <section class="pedido-section">
                <div class="pedido-header">
                    <h2>Mi Pedido</h2>
                    <div class="numero-pedido">
                        <span>Número de pedido:</span>
                        <strong><?= htmlspecialchars($numeroPedido) ?></strong>
                    </div>
                </div>

                <div id="carrito-vacio" class="carrito-vacio" style="display: none;">
                    <p>🛒</p>
                    <h3>Tu carrito está vacío</h3>
                    <p>Agrega productos desde nuestro menú</p>
                    <a href="menu.php" class="btn principal">Ver Menú</a>
                </div>

                <div id="carrito-contenido">
                    <div class="items-pedido" id="items-pedido">
                        <!-- Los items se cargarán dinámicamente con JavaScript -->
                    </div>

                    <div class="resumen-pedido">
                        <div class="linea-resumen">
                            <span>Subtotal:</span>
                            <span id="subtotal">$0.00</span>
                        </div>
                        <div class="linea-resumen total">
                            <span>Total a pagar:</span>
                            <span id="total">$0.00</span>
                        </div>
                        <div class="nota-pago">
                            <p>💳 El pago se realiza en caja</p>
                        </div>
                    </div>

                    <form method="POST" class="acciones-pedido">
                        <button type="submit" name="confirmar_pedido" class="btn principal btn-confirmar">
                            Confirmar Pedido
                        </button>
                        <button type="button" class="btn secundario" onclick="limpiarCarrito()">
                            Vaciar carrito
                        </button>
                        <a href="menu.php" class="btn terciario">Seguir comprando</a>
                    </form>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>© <?= date("Y") ?> El Aroma • Hecho con ☕ y pasión • SV</p>
    </footer>

    <script>
        // Cargar carrito desde localStorage
        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        // Mostrar pedido confirmado con el total correcto
        <?php if ($pedidoConfirmado): ?>
            const totalConfirmado = calcularTotal();
            document.getElementById('total-final-confirmado').textContent = '$' + totalConfirmado.toFixed(2);
            // Limpiar carrito después de confirmar
            localStorage.removeItem('carrito');
        <?php endif; ?>

        function calcularTotal() {
            return carrito.reduce((sum, item) => sum + item.precio, 0);
        }

        function renderizarCarrito() {
            const itemsContainer = document.getElementById('items-pedido');
            const carritoVacio = document.getElementById('carrito-vacio');
            const carritoContenido = document.getElementById('carrito-contenido');

            if (carrito.length === 0) {
                carritoVacio.style.display = 'block';
                carritoContenido.style.display = 'none';
                return;
            }

            carritoVacio.style.display = 'none';
            carritoContenido.style.display = 'block';

            itemsContainer.innerHTML = '';

            carrito.forEach((item, index) => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'item-pedido';
                
                let opcionesHTML = '';
                if (item.opciones && Object.keys(item.opciones).length > 0) {
                    opcionesHTML = '<div class="opciones-item">';
                    for (let [key, value] of Object.entries(item.opciones)) {
                        opcionesHTML += `<span class="opcion-tag">${key}: ${value}</span>`;
                    }
                    opcionesHTML += '</div>';
                }

                itemDiv.innerHTML = `
                    <div class="item-info">
                        <img src="images/${item.img}" alt="${item.nombre}" class="item-img">
                        <div class="item-detalles">
                            <h4>${item.nombre}</h4>
                            ${opcionesHTML}
                        </div>
                    </div>
                    <div class="item-acciones">
                        <span class="item-precio">$${item.precio.toFixed(2)}</span>
                        <button class="btn-eliminar" onclick="eliminarItem(${index})">🗑️</button>
                    </div>
                `;
                
                itemsContainer.appendChild(itemDiv);
            });

            actualizarTotales();
        }

        function actualizarTotales() {
            const total = calcularTotal();
            document.getElementById('subtotal').textContent = '$' + total.toFixed(2);
            document.getElementById('total').textContent = '$' + total.toFixed(2);
        }

        function eliminarItem(index) {
            if (confirm('¿Eliminar este producto del pedido?')) {
                carrito.splice(index, 1);
                localStorage.setItem('carrito', JSON.stringify(carrito));
                renderizarCarrito();
            }
        }

        function limpiarCarrito() {
            if (confirm('¿Estás seguro de vaciar todo el carrito?')) {
                carrito = [];
                localStorage.setItem('carrito', JSON.stringify(carrito));
                renderizarCarrito();
            }
        }

        // Renderizar al cargar la página
        <?php if (!$pedidoConfirmado): ?>
            renderizarCarrito();
        <?php endif; ?>
    </script>

</body>
</html>