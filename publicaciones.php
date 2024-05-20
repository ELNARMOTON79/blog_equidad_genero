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
    <?php
        include ("base/contacto.php");

        $contacto = new Contacto();
        $id = $_GET['id'];
        $result = $contacto->buscarPostPorId($id);
        //Mostrar post de acuerdo al id recibido
        while ($row = $result->fetch_assoc()) {
            echo "<div class='container mx-auto px-4 py-6'>";
            echo "<div class='bg-white rounded-lg shadow-lg overflow-hidden'>";
            echo "<div class='relative w-full' style='padding-bottom: 56.25%;'>"; // Mantener la proporción 16:9
            echo "<img src='image/".$row['image']."' alt='Descripción de la imagen' class='absolute inset-0 w-full h-full object-contain'>";
            echo "</div>";
            echo "<div class='p-4'>";
            echo "<h2 class='text-3xl font-bold'>".$row['title']."</h2>";
            echo "<p class='text-gray-700 mb-4'>".$row['category']."</p>";
            echo "<p class='text-gray-700 mb-4'>".$row['name']."</p>";
            echo "<p class='text-sm text-gray-500'>".$row['date']."</p>";
            echo "<p class='text-gray-700'>".$row['content']."</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    ?>
    <style>
        #disqus_thread {
            width: 80%; /* Ajusta el ancho según tu preferencia */
            display: flex;
            justify-content: center; /* Centra el contenido horizontalmente */
            align-items: center; /* Centra el contenido verticalmente */
            margin: 0 auto; /* Centra el contenido horizontalmente */
        }
    </style>

    <div id="disqus_thread"></div>
    <script>
        (function() { 
            var d = document, s = d.createElement('script');
            s.src = 'https://deep-ocean.disqus.com/embed.js'; // Reemplaza YOUR_SHORTNAME con tu shortname de Disqus
            s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Por favor habilita JavaScript para ver los <a href="https://disqus.com/?ref_noscript">comentarios powered by Disqus.</a></noscript>
</body>
<script id="dsq-count-scr" src="//equidad_creativa.disqus.com/count.js" async></script>
<?php include ("footer.php"); ?>
</html>
