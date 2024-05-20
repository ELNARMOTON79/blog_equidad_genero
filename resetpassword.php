<?php
include("base/contacto.php");

if (isset($_GET['code'])) {
    $codigo = htmlspecialchars($_GET['code']);
    $contacto = new Contacto();
    $usuario = $contacto->verificarCodigo($codigo);

    if (!$usuario) {
        header("Location: home.php");
        exit;
    }
} else {
    echo "No se proporcionó ningún código.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
</head>
<body class="bg-tertiary flex items-center justify-center min-h-screen">
    <div class="relative bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-primary">Reset Password</h2>
        <form method="post">
            <div class="mb-5">
                <label for="password" class="block text-lg font-semibold text-secondary">New Password</label>
                <input type="password" name="password" id="password" class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="New Password" required>
            </div>
            <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
            <button type="submit" name="reset" class="w-full py-3 px-4 bg-primary text-white font-bold rounded-md shadow-md hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-75">Reset Password</button>
            <?php
                if (isset($_POST['reset'])) {
                    include("procesar_resetpassword.php");
                }
            ?>
        </form>
    </div>
</body>
</html>
