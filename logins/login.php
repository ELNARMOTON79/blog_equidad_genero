<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h2 class="text-3xl font-extrabold mb-6 text-center text-primary">Login</h2>
        <form action="#" method="post">
            <div class="mb-5">
                <label for="email" class="block text-lg font-semibold text-secondary">User</label>
                <input type="text" name="user" id="email" class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="User" required>
            </div>
            <div class="mb-5">
                <label for="password" class="block text-lg font-semibold text-secondary">Password</label>
                <input type="password" name="password" id="password" class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="********" required>
            </div>
            <div class="mb-5">
                <label class="inline-flex items-center">
                    <input type="radio" name="terms" class="form-checkbox text-primary">
                    <span class="ml-2 text-sm text-secondary">I agree to the <a href="../source/terms.pdf" class="text-primary hover:underline">terms and conditions</a></span>
                </label>
            </div>
            <div class="mb-5">
                <a href="forgotpassword.php" class="block text center text-primary hover:underline">Forgot Password?</a>
            </div>
            <button type="submit" name="log_in" class="w-full py-3 px-4 bg-primary text-white font-bold rounded-md shadow-md hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-75">Login</button>
        </form>
        <?php
        include ("../base/contacto.php");

        if (isset($_POST["log_in"])) {
            $user = $_POST["user"];
            $password = $_POST["password"];
            $terms = isset($_POST["terms"]) ? $_POST["terms"] : null;

            if (!$terms) {
                echo "<div class='error-message mt-4 p-3 bg-red-100 text-red-700 border border-red-400 rounded-md'>You must accept the terms and conditions</div>";
            } else {
                $contacto = new Contacto();
                $result = $contacto->login2($user);

                if ($result === null) {
                    echo "<div class='error-message mt-4 p-3 bg-red-100 text-red-700 border border-red-400 rounded-md'>Incorrect username or password</div>";
                } else {
                    $passwordHash = $result['password'];
                    if (password_verify($password, $passwordHash)) {
                        $_SESSION['user'] = $user;  // Guardar el nombre de usuario en la sesión
                        $_SESSION['type_user'] = $result['type_user']; // Guardar el tipo de usuario en la sesión
                        header("Location: ../home.php");
                        exit();  // Asegurar que el script se detenga después de la redirección
                    } else {
                        echo "<div class='error-message mt-4 p-3 bg-red-100 text-red-700 border border-red-400 rounded-md'>Incorrect username or password</div>";
                    }
                }
            }
        }
        ?>
    </div>
</body>
</html>
