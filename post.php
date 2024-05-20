
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <?php include ("navbar.php"); ?>
    <div class="pt-20"></div>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-center mb-6">All Posts</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php
                include ("base/contacto.php");
                $contacto = new Contacto();
                $result = $contacto->buscarPost();
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='bg-white rounded-lg shadow-lg overflow-hidden'>";
                    echo "<img src='image/".$row['image']."' alt='Descripción de la imagen' class='w-full h-48 object-cover'>";
                    echo "<div class='p-4'>";
                    echo "<h2 class='text-xl font-bold'>".$row['title']."</h2>";
                    echo "<p class='text-gray-700 mb-4'>".$row['category']."</p>";
                    echo "<p class='text-gray-700 mb-4'>".$row['name']."</p>";
                    echo "<p class='text-sm text-gray-500'>".$row['date']."</p>";
                    echo "<a href='publicaciones.php?id=".$row['id']."'><button class='mt-2 bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-700 focus:outline-none'>Leer Más</button></a>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</body>
<?php include ("footer.php"); ?>
</html>
