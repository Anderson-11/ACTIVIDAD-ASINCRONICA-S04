<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAFETERÍA El Aroma - Equipo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <div class="header-content">
            <h1>El Aroma</h1>
            <p>Donde cada sorbo cuenta una historia</p>
        </div>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="menu.php">Menú</a>
        </nav>
    </header>

    <main class="container">
        <section class="equipo">
            <h2>Nuestro Equipo</h2>
            
            <div class="miembros">
                <div class="miembro">
                    <h3>Rocio Marbelly Moreno Erazo</h3>
                    <p>Carnet: ME0763032023<br>Frontend & Diseño</p>
                </div>
                <div class="miembro">
                    <h3>Bryan Alexis Rauda Gómez</h3>
                    <p>Carnet: RG0358032023<br>PHP & Lógica</p>
                </div>
                <div class="miembro">
                    <h3>Anderson Juvini Cisneros Quijada</h3>
                    <p>Carnet: CQ0472032023<br>CSS & Responsive</p>
                </div>
                <div class="miembro">
                    <h3>Rafael Edmundo Salguero Dubon</h3>
                    <p>Carnet: SD0058032023<br>Contenido & Pruebas</p>
                </div>
            </div>

            <div class="info-proyecto">
                <p><strong>Asignatura:</strong> Desarrollo Web y Aplicaciones Para Móviles - 16S</p>
                <p><strong>Docente:</strong> Mtro. Jonathan Francisco Carballo Castro.</p>
                <p><strong>Fecha:</strong> 11 de Febrero 2026</p>
            </div>

            <a href="menu.php" class="btn principal">Explorar el Menú →</a>
        </section>
    </main>

    <footer>
        <p>© <?= date("Y") ?> El Aroma • Actividad Grupal •</p>
    </footer>

</body>
</html>