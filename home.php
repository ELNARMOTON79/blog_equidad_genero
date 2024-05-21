<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equidad Creativa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .carousel-inner {
            position: relative;
            overflow: hidden;
            height: 500px; /* Ajusta la altura según tus necesidades */
        }
        .carousel-item {
            position: absolute;
            inset: 0;
            transition: opacity 1s ease;
            opacity: 0;
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100%;
        }
        .carousel-item.active {
            position: relative;
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-200">
    <?php include("navbar.php"); ?>
    <div class="pt-20"></div>
    
    <!-- Carrusel de imágenes -->
    <div class="relative carousel-inner">
        <div class="carousel-item active" style="background-image: url('image/6.jpg')">
            <div class="bg-gray-900 bg-opacity-50 h-full flex items-center justify-center">
                <h1 class="text-white text-4xl font-bold">Creative Equity</h1>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url('image/7.jpg')">
            <div class="bg-gray-900 bg-opacity-50 h-full flex items-center justify-center">
                <h1 class="text-white text-4xl font-bold">Creative Equity</h1>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url('image/8.jpg')">
            <div class="bg-gray-900 bg-opacity-50 h-full flex items-center justify-center">
                <h1 class="text-white text-4xl font-bold">Creative Equity</h1>
            </div>
        </div>
    </div>
    <br>
    
    <h2 class="text-2xl font-bold text-center mb-4">Recent Post</h2>
    <div class="container mx-auto px-4 py-6 flex flex-col md:flex-row">
        <?php
        include("base/contacto.php");
        $contacto = new Contacto();
        $result = $contacto->buscarUltimoPost();
        if ($row = $result->fetch_assoc()) { // Si hay un resultado, mostrarlo
            echo "<div class='flex-1'>";
            echo "<div class='bg-white rounded-lg shadow-lg overflow-hidden'>";
            echo "<img src='image/" . $row['image'] . "' alt='Descripción de la imagen' class='w-full h-96 object-cover'>";
            echo "<div class='p-4'>";
            echo "<h2 class='text-3xl font-bold'>" . $row['title'] . "</h2>";
            echo "<p class='text-gray-700 mb-4'>" . $row['category'] . "</p>";
            echo "<p class='text-gray-700 mb-4'>" . $row['name'] . "</p>";
            echo "<p class='text-gray-700'>" . $row['content'] . "</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p>No hay publicaciones recientes.</p>"; // Mensaje si no hay resultados
        }
        ?>
        <aside class="md:ml-4 md:w-96">
            <div class="grid grid-cols-1 gap-4">
                <?php
                $result = $contacto->buscarPostReciente();
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='bg-white rounded-lg shadow-lg overflow-hidden'>";
                    echo "<img src='image/" . $row['image'] . "' alt='Descripción de la imagen' class='w-full h-48 object-cover'>";
                    echo "<div class='p-4'>";
                    echo "<h2 class='text-xl font-bold'>" . $row['title'] . "</h2>";
                    echo "<p class='text-gray-700 mb-4'>" . $row['name'] . "</p>";
                    echo "<a href='publicaciones.php?id=" . $row['id'] . "'><button class='mt-2 bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-700 focus:outline-none'>Leer Más</button></a>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </aside>
    </div>
    <script>
        const items = document.querySelectorAll('.carousel-item');
        let currentItem = 0;
        const totalItems = items.length;
        
        function showNextItem() {
            items[currentItem].classList.remove('active');
            currentItem = (currentItem + 1) % totalItems;
            items[currentItem].classList.add('active');
        }
        
        function showPrevItem() {
            items[currentItem].classList.remove('active');
            currentItem = (currentItem - 1 + totalItems) % totalItems;
            items[currentItem].classList.add('active');
        }
        setInterval(showNextItem, 5000); // Cambia de imagen cada 5 segundos
    </script>
</body>
<?php include("footer.php"); ?>
</html>
