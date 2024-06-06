<?php
session_start();
include ("../base/contacto.php");
include ("codegen.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-primary {
            background-color: #8E7AB5;
        }
        .bg-secondary {
            background-color: #B784B7;
        }
        .bg-tertiary {
            background-color: #FAE7F3;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                let errorMessages = document.querySelectorAll(".error-message");
                errorMessages.forEach(function(message) {
                    message.style.display = 'none';
                });
            }, 5000);
        });
    </script>
</head>
<body class="bg-tertiary flex items-center justify-center min-h-screen">
    <div class="relative bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        <a href="../home.php" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
        <h2 class="text-3xl font-extrabold mb-6 text-center text-primary">Forgot Password</h2>
        <form action="#" method="post">
            <div class="mb-5">
                <label for="email" class="block text-lg font-semibold text-secondary">E-mail</label>
                <input type="text" name="email" id="email" class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="E-mail" required>
            </div>
            <button type="submit" name="forgot" class="w-full py-3 px-4 bg-primary text-white font-bold rounded-md shadow-md hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-75">Send</button>
        </form>
        <?php
            if (isset($_POST['forgot'])) {
                $email = $_POST['email'];
            
                // Validar formato de correo electrónico
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<div class='error-message mt-4 p-3 bg-red-100 text-red-700 border border-red-400 rounded-md'>Invalid email format</div>";
                } else {
                    $contacto = new Contacto();
                    $usuario = $contacto->forgotPassword($email);
            
                    if ($usuario === null) {
                        echo "<div class='error-message mt-4 p-3 bg-red-100 text-red-700 border border-red-400 rounded-md'>The email address does not exist</div>";
                    } else {
                        $codigo = generarCodigoAleatorio();
                        if ($contacto->insertarCodigo($codigo, $usuario['id'])) {
                            echo "<div class='success-message mt-4 p-3 bg-green-100 text-green-700 border border-green-400 rounded-md'>Recovery link sent to your email</div>";
                            $nombreDeUsuario = $usuario['name'];
                            include ("sendmail.php");
                        } else {
                            echo "<div class='error-message mt-4 p-3 bg-red-100 text-red-700 border border-red-400 rounded-md'>Error inserting the code</div>";
                        }
                    }
                }
            }
        ?>
    </div>
</body>
</html>
