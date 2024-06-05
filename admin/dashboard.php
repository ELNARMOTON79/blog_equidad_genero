<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../logins/login.php");
    exit();
}

include("../base/contacto.php");

$showForm = isset($_GET['action']) && $_GET['action'] == 'createUser';
$showForm2 = isset($_GET['action']) && $_GET['action'] == 'removeUser';
$showForm3 = isset($_GET['action']) && $_GET['action'] == 'createpost';
$showForm4 = isset($_GET['action']) && $_GET['action'] == 'editPost';
$showForm5 = isset($_GET['action']) && $_GET['action'] == 'category';
$showForm6 = isset($_GET['action']) && $_GET['action'] == 'modcategory';
$showForm7 = isset($_GET['action']) && $_GET['action'] == 'settings';
$showForm8 = isset($_GET['action']) && $_GET['action'] == 'dashboard';
$showForm9 = isset($_GET['action']) && $_GET['action'] == 'userList';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        .text-primary {
            color: #8E7AB5;
        }
        .text-secondary {
            color: #B784B7;
        }
        .hidden {
            display: none;
        }
    </style>
    <script>
        function toggleMenu(id) {
            var menu = document.getElementById(id);
            menu.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-tertiary min-h-screen flex flex-col">
    <header class="bg-primary text-white p-4 flex justify-between items-center fixed w-full z-10">
        <div>
        <?php
        echo '<h1 class="text-3xl font-bold">Welcome, <span class="text-black">'.$_SESSION['user'].'</span></h1>';
        ?>
        </div>
    </header>
    <div class="flex flex-1 pt-20">
        <!-- Sidebar -->
        <aside class="bg-white w-64 p-6 shadow-lg">
            <ul>
                <li class="mb-4">
                    <a href="?action=dashboard" class="text-primary hover:text-secondary block p-3 rounded-md flex justify-between items-center">
                        <span><i class="fas fa-tachometer-alt mr-2"></i> Dashboard</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <a href="#" onclick="toggleMenu('menuUsuarios')" class="text-primary hover:text-secondary block p-3 rounded-md flex justify-between items-center">
                        <span><i class="fas fa-users mr-2"></i> Users</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul id="menuUsuarios" class="hidden pl-4">
                        <li class="mb-2">
                            <a href="?action=userList" class="text-primary hover:text-secondary block p-2 rounded-md">
                                <i class="fas fa-users mr-2"></i> User list
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="?action=createUser" class="text-primary hover:text-secondary block p-2 rounded-md">
                                <i class="fas fa-user-plus mr-2"></i> Create User
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="?action=removeUser" class="text-primary hover:text-secondary block p-2 rounded-md">
                                <i class="fas fa-user-minus mr-2"></i> Delete User
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="mb-4">
                    <a href="#" onclick="toggleMenu('menuPosts')" class="text-primary hover:text-secondary block p-3 rounded-md flex justify-between items-center">
                        <span><i class="fas fa-thumbtack mr-2"></i> Post</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul id="menuPosts" class="hidden pl-4">
                        <li class="mb-2">
                            <a href="?action=createpost" class="text-primary hover:text-secondary block p-2 rounded-md">
                                <i class="fas fa-pencil-alt mr-2"></i> Create Post
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="?action=editPost" class="text-primary hover:text-secondary block p-2 rounded-md">
                                <i class="fas fa-edit mr-2"></i> Posts
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="mb-4">
                    <a href="#" onclick="toggleMenu('menuCategorias')" class="text-primary hover:text-secondary block p-3 rounded-md flex justify-between items-center">
                        <span><i class="fas fa-tags mr-2"></i> Category</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul id="menuCategorias" class="hidden pl-4">
                        <li class="mb-2">
                            <a href="?action=category" class="text-primary hover:text-secondary block p-2 rounded-md">
                                <i class="fas fa-tag mr-2"></i> Create Category
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="?action=modcategory" class="text-primary hover:text-secondary block p-2 rounded-md">
                                <i class="fas fa-tag mr-2"></i> Categories
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="mb-4">
                    <a href="?action=settings" class="text-primary hover:text-secondary block p-3 rounded-md flex justify-between items-center">
                        <span><i class="fas fa-cogs mr-2"></i> Settings</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="../home.php" class="text-primary hover:text-secondary block p-3 rounded-md flex justify-between items-center">
                        <span><i class="fas fa-sign-out-alt mr-2"></i> Exit</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- Contenido Principal -->
        <main class="flex-1 p-6">
        <?php if ((!$showForm && !$showForm2 && !$showForm3 && !$showForm4 && !$showForm5 && !$showForm6 && !$showForm7 && !$showForm9) || $showForm8): ?>
                <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto mt-10">
                    <h2 class="text-2xl font-bold mb-6 text-primary">Welcome To The Dashboard</h2>
                    <p class="text-gray-700">Select an option from the side menu to begin.</p>
                    <div class="mt-6">
                        <?php
                            $contacto = new Contacto();
                            $totalPosts = $contacto->contarPosts();
                            $totalCategories = $contacto->categorias();
                            $totalUsers = $contacto->contarUsuarios();
                        ?>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <h3 class="text-xl font-bold text-gray-800">Total Posts</h3>
                                <p class="text-2xl text-primary font-semibold"><?php echo $totalPosts; ?></p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <h3 class="text-xl font-bold text-gray-800">Total Categories</h3>
                                <p class="text-2xl text-primary font-semibold"><?php echo $totalCategories; ?></p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <h3 class="text-xl font-bold text-gray-800">Total Users</h3>
                                <p class="text-2xl text-primary font-semibold"><?php echo $totalUsers; ?></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            <?php endif; ?>

            <?php if ($showForm): ?>
                <div id="addUserContent" class="bg-white p-8 rounded-lg shadow-lg max-w-md mx-auto">
                    <h2 class="text-2xl font-bold mb-6 text-primary">Create User</h2>
                    <form method="POST">
                        <div class="mb-4">
                            <label id="usuario" class="block text-primary font-bold mb-2">Name</label>
                            <input type="text" name="names" class="bg-tertiary border border-primary rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label id="mail" class="block text-primary font-bold mb-2">Email</label>
                            <input type="email" name="email" class="bg-tertiary border border-primary rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label id="contra" class="block text-primary font-bold mb-2">Password</label>
                            <input type="password" name="password" class="bg-tertiary border border-primary rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label id="tipo" class="block text-primary font-bold mb-2">User Type</label>
                            <select name="user" class="bg-tertiary border border-primary rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="0">Administrator</option>
                                <option value="1">User</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" name="register" class="bg-primary text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                        </div>
                    </form>
                </div>

                <?php
                if (isset($_POST["register"])) {
                    $nombre = isset($_POST["names"]) ? $_POST["names"] : '';
                    $password = isset($_POST["password"]) ? $_POST["password"] : '';
                    $user = isset($_POST["user"]) ? $_POST["user"] : '';
                    $email = isset($_POST["email"]) ? $_POST["email"] : '';

                    $contacto = new Contacto();
                    $result = $contacto->crearUsuario($nombre, $password, $user, $email);
                    echo "<div id='success-message' class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4' role='alert'>User successfully created</div>";
                }
                ?>
                <script>
                    // Desaparece el mensaje después de 5 segundos
                    setTimeout(function() {
                        var successMessage = document.getElementById('success-message');
                        if (successMessage) {
                            successMessage.style.display = 'none';
                        }
                    }, 5000);
                </script>
            <?php endif; ?>

            <?php if ($showForm2): ?>
                <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto mt-10">
                    <h2 class="text-2xl font-bold mb-6 text-primary">User List</h2>
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-primary text-left text-primary font-bold">Name</th>
                                <th class="py-2 px-4 border-b border-primary text-left text-primary font-bold">User Type</th>
                                <th class="py-2 px-4 border-b border-primary text-left text-primary font-bold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $contacto = new Contacto();
                                $result = $contacto->mostrarUsuarios();
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr id='usuario-".$row['id']."'>";
                                    echo "<td class='py-2 px-4 border-b border-primary text-primary'>".$row['name']."</td>";
                                    echo "<td class='py-2 px-4 border-b border-primary text-primary'>".($row['type_user'] == 0 ? 'Administrador' : 'Usuario')."</td>";
                                    echo "<td class='py-2 px-4 border-b border-primary text-primary'>
                                            <form method='POST' target='deleteFrame' onsubmit='return confirmDelete(".$row['id'].")'>
                                                <input type='hidden' name='id_usuario' value='".$row['id']."'>
                                                <button type='submit' name='delete_user' class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'>Delete</button>
                                            </form>
                                        </td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <iframe name="deleteFrame" style="display:none;"></iframe>
                <?php
                if (isset($_POST["delete_user"])) {
                    $id_usuario = $_POST["id_usuario"];
                    $contacto = new Contacto();
                    $result = $contacto->eliminarUsuario($id_usuario);                   
                    echo "<script>document.getElementById('usuario-$id_usuario').remove();</script>";
                    echo "<div id='success-message' class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4' role='alert'>Usuario eliminado correctamente</div>";                   
                }
                ?>
                <script>
                    // Desaparece el mensaje después de 5 segundos
                    setTimeout(function() {
                        var successMessage = document.getElementById('success-message');
                        if (successMessage) {
                            successMessage.style.display = 'none';
                        }
                    }, 5000);
                </script>
                <script>
                    function confirmDelete(id) {
                        if (confirm('Are you sure you want to delete this user?')) {
                            // Si el usuario confirma, eliminamos la fila de la tabla
                            document.getElementById('usuario-' + id).style.display = 'none';
                            return true;
                        }
                        return false;
                    }
                </script>
            <?php endif; ?>

            <?php if ($showForm3): ?>
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto mt-10">
                <script src="https://cdn.tiny.cloud/1/x4b91kvixh7fmccnyfjphsxtknbb4avtj26jad4uje896w2w/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
                <script>
                    tinymce.init({
                        selector: 'textarea',
                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
                        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                        tinycomments_mode: 'embedded',
                        tinycomments_author: 'Author name',
                        mergetags_list: [
                            { value: 'First.Name', title: 'First Name' },
                            { value: 'Email', title: 'Email' },
                        ],
                        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
                    });
                </script>
                <h2 class="text-2xl font-bold mb-6 text-primary">Create New Post</h2>
                <form method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="mb-4">
                        <label for="titulo" class="block text-primary font-bold mb-2">Tittle</label>
                        <input type="text" id="titulo" name="titulo" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="contenido" class="block text-primary font-bold mb-2">Content</label>
                        <textarea id="contenido" name="contenido" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline h-40"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="categoria" class="block text-primary font-bold mb-2">Category</label>
                        <select id="categoria" name="categoria" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="">Select a category</option>
                            <?php
                                $contacto = new Contacto();
                                $result = $contacto->buscarCategorias();
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='".$row['category']."'>".$row['category']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="imagen" class="block text-primary font-bold mb-2">Image</label>
                        <input type="file" id="imagen" name="imagen" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" name="crear_post" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Create Post
                        </button>
                    </div>
                </form>
            </div>

            <script>
                function validateForm() {
                    // Sincroniza el contenido del editor TinyMCE con el textarea
                    tinymce.get('contenido').save();
                    console.log('Contenido sincronizado:', tinymce.get('contenido').getContent());

                    // Valida que el contenido no esté vacío
                    var contenidoTextarea = document.getElementById('contenido');
                    if (!contenidoTextarea.value.trim()) {
                        alert('El campo de contenido no puede estar vacío.');
                        return false; // Evita que el formulario se envíe
                    }

                    return true; // Permite que el formulario se envíe
                }
            </script>

            <?php
                if(isset($_POST["crear_post"])) {
                    $titulo = $_POST['titulo'];
                    $contenido = $_POST['contenido'];
                    $categoria = $_POST['categoria'];
                    $imagen = $_FILES['imagen']['name'];
                    $usuario = $_SESSION['user'];

                    $ruta = "../image/".$imagen;
                    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

                    $contacto = new Contacto();
                    $contacto->crearPost($usuario, $titulo, $contenido, $categoria, $imagen);
                    echo "<div id='succeess-message' class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4' role='alert'>Post created successfully</div>";
                }
            ?>
            <script>
                    // Desaparece el mensaje después de 5 segundos
                    setTimeout(function() {
                        var successMessage = document.getElementById('success-message');
                        if (successMessage) {
                            successMessage.style.display = 'none';
                        }
                    }, 5000);
                </script>

        <?php endif; ?>


            <?php if ($showForm4): ?>
                <?php
                    $contacto = new Contacto();
                    $editPostId = isset($_POST['id']) && isset($_POST['action2']) && $_POST['action2'] == 'editpost' ? $_POST['id'] : null;
                    $postToEdit = null;

                    if ($editPostId) {
                        $result = $contacto->buscarPostPorId($editPostId);
                        if ($result) {
                            $postToEdit = $result->fetch_assoc();
                            $titulo = $postToEdit['title'];
                            $contenido = $postToEdit['content'];
                            $categoria = $postToEdit['category'];
                        }
                    }

                    if (isset($_POST['actualizar_post'])) {
                        $id = $_POST['id'];
                        $titulo = $_POST['titulo'];
                        $contenido = $_POST['contenido'];
                        $categoria = $_POST['categoria'];
                        $imagen = $_FILES['imagen']['name'];

                        if ($imagen) {
                            $ruta = "../image/" . $imagen;
                            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
                        } else {
                            $ruta = $postToEdit ? $postToEdit['image'] : ''; // Assuming you store image path in your database.
                        }

                        $contacto->editarPost($id, $titulo, $contenido, $categoria, $ruta);
                        echo "<div id='success-message' class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4' role='alert'>Post successfully updated</div>";
                    }

                    if (isset($_POST['cancelar_edicion'])) {
                        $editPostId = null; // Reset the edit post ID to show the table again
                    }
                    
                ?>
                <script>
                    // Desaparece el mensaje después de 5 segundos
                    setTimeout(function() {
                        var successMessage = document.getElementById('success-message');
                        if (successMessage) {
                            successMessage.style.display = 'none';
                        }
                    }, 5000);
                </script>
                <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto mt-10">
                    <?php if ($editPostId && $postToEdit): ?>
                        <h2 class="text-2xl font-bold mb-6 text-primary">Edit Post</h2>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $editPostId; ?>">
                            <div class="flex justify-end mb-4">
                                <button type="submit" name="cancelar_edicion" class="text-red-500 hover:text-red-700 font-bold text-lg">X</button>
                            </div>
                            <div class="mb-4">
                                <label for="titulo" class="block text-primary font-bold mb-2">Title</label>
                                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                            <div class="mb-4">
                                <label for="contenido" class="block text-primary font-bold mb-2">Content</label>
                                <textarea id="contenido" name="contenido" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline h-40" required><?php echo htmlspecialchars($contenido); ?></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="categoria" class="block text-primary font-bold mb-2">Category</label>
                                <select id="categoria" name="categoria" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                                    <?php
                                    $result = $contacto->buscarCategorias();
                                    while ($row = $result->fetch_assoc()) {
                                        $selected = $categoria == $row['category'] ? 'selected' : '';
                                        echo "<option value='" . $row['category'] . "' $selected>" . $row['category'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-6">
                                <label for="imagen" class="block text-primary font-bold mb-2">Image</label>
                                <input type="file" id="imagen" name="imagen" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" name="actualizar_post" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Update Post
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <h2 class="text-2xl font-bold mb-6 text-primary">Posts</h2>
                        <div class="flex justify-between items-center mb-4">
                            <form method="GET" action="" class="flex items-center">
                                <input type="hidden" name="action" value="editPost">
                                <label for="entries" class="text-sm text-gray-700 mr-2">Show</label>
                                <select name="per_page" id="entries" class="border border-gray-300 rounded px-2 py-1" onchange="this.form.submit()">
                                    <option value="5" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 5) ? 'selected' : ''; ?>>5</option>
                                    <option value="10" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 10) ? 'selected' : ''; ?>>10</option>
                                    <option value="15" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 15) ? 'selected' : ''; ?>>15</option>
                                    <option value="20" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 20) ? 'selected' : ''; ?>>20</option>
                                </select>
                                <span class="text-sm text-gray-700 ml-2">entries</span>
                            </form>
                            <form method="GET" action="" class="flex items-center">
                                <input type="hidden" name="action" value="editPost">
                                <label for="search" class="text-sm text-gray-700 mr-2">Search:</label>
                                <input id="search" name="search" type="text" class="border border-gray-300 rounded px-2 py-1" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                <button type="submit" class="ml-2 bg-blue-500 text-white px-3 py-1 rounded">Search</button>
                            </form>
                        </div>
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Título</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Categoría</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $contacto = new Contacto();

                                    // Paginación
                                    $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 5;
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $offset = ($page - 1) * $per_page;

                                    // Búsqueda
                                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                                    $result = $contacto->buscarPostPaginado($offset, $per_page, $search);
                                    $total_posts = $contacto->contarPosts($search);

                                    while ($row = $result->fetch_assoc()) {
                                        echo "
                                        <tr id='row".$row['id']."'>
                                            <td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>".$row['title']."</td>
                                            <td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>".$row['category']."</td>
                                            <td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>".$row['date']."</td>
                                            <td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>
                                                <form method='POST' action='' style='display:inline;'>
                                                    <input type='hidden' name='action2' value='editpost'>
                                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                    <button type='submit' class='text-blue-500 hover:text-blue-700'><i class='fas fa-edit'></i></button>
                                                </form>
                                                <form method='POST' action='' onsubmit='return confirmDelete(" . $row['id'] . ")' style='display:inline;'>
                                                    <input type='hidden' name='action' value='deletePost'>
                                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                    <button type='submit' class='text-red-500 hover:text-red-700'><i class='fas fa-trash'></i></button>
                                                </form>
                                            </td>
                                        </tr>";
                                    }

                                    if (isset($_POST['action']) && $_POST['action'] == 'deletePost') {
                                        $id = $_POST['id'];
                                        $contacto->eliminarPost($id);
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        
                        <div class="flex justify-between mt-4">
                            <?php
                                $total_pages = ceil($total_posts / $per_page);
                                if ($page > 1) {
                                    echo '<form method="GET" action="">
                                            <input type="hidden" name="action" value="editPost">
                                            <input type="hidden" name="page" value="'.($page-1).'">
                                            <input type="hidden" name="per_page" value="'.$per_page.'">
                                            <input type="hidden" name="search" value="'.htmlspecialchars($search).'">
                                            <button type="submit" class="text-primary hover:text-primary-dark">← Back</button>
                                        </form>';
                                } else {
                                    echo '<span class="text-gray-400">← Back</span>';
                                }

                                if ($page < $total_pages) {
                                    echo '<form method="GET" action="">
                                            <input type="hidden" name="action" value="editPost">
                                            <input type="hidden" name="page" value="'.($page+1).'">
                                            <input type="hidden" name="per_page" value="'.$per_page.'">
                                            <input type="hidden" name="search" value="'.htmlspecialchars($search).'">
                                            <button type="submit" class="text-primary hover:text-primary-dark">Next →</button>
                                        </form>';
                                } else {
                                    echo '<span class="text-gray-400">Next →</span>';
                                }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>

                <script>
                    function confirmDelete(id) {
                        return confirm('Are you sure you want to delete this post?');
                    }
                </script>
            <?php endif; ?>

            <?php if ($showForm5): ?>
                <div id="addUserContent" class="bg-white p-8 rounded-lg shadow-lg max-w-md mx-auto">
                    <h2 class="text-2xl font-bold mb-6 text-primary">Add Category</h2>
                    <form method="POST">
                        <div class="mb-4">
                            <label id="usuario" class="block text-primary font-bold mb-2">Category</label>
                            <input type="text" name="names" class="bg-tertiary border border-primary rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" name="addcategory" class="bg-primary text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                        </div>
                    </form>
                </div>
                <?php
                    if (isset($_POST["addcategory"])) {
                        $category = isset($_POST["names"]) ? $_POST["names"] : '';

                        $contacto = new Contacto();
                        $result = $contacto->crearCategoria($category);
                        echo "<div id='success-message' class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4' role='alert'>Category created successfully</div>";
                    }
                ?>
                <script>
                    // Desaparece el mensaje después de 5 segundos
                    setTimeout(function() {
                        var successMessage = document.getElementById('success-message');
                        if (successMessage) {
                            successMessage.style.display = 'none';
                        }
                    }, 5000);
                </script>
            <?php endif; ?>

            <?php if ($showForm6): ?>
                <?php
                    $contacto = new Contacto();
                    $editCategoryId = isset($_POST['id']) && isset($_POST['action2']) && $_POST['action2'] == 'editcategory' ? $_POST['id'] : null;
                    $categoryToEdit = null;

                    if ($editCategoryId) {
                        $result = $contacto->buscarCategoriaPorId($editCategoryId);
                        if ($result) {
                            $categoryToEdit = $result->fetch_assoc();
                            $categoria = $categoryToEdit['category'];
                        }
                    }

                    if (isset($_POST['actualizar_categoria'])) {
                        $id = $_POST['id'];
                        $categoria = $_POST['categoria'];

                        $contacto->actualizarCategoria($id, $categoria);
                        echo "<div id='success-message' class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4' role='alert'>Category successfully updated</div>";
                    }

                    if (isset($_POST['cancelar_edicion'])) {
                        $editCategoryId = null; // Reset the edit category ID to show the table again
                    }
                    
                ?>
                <script>
                    // Desaparece el mensaje después de 5 segundos
                    setTimeout(function() {
                        var successMessage = document.getElementById('success-message');
                        if (successMessage) {
                            successMessage.style.display = 'none';
                        }
                    }, 5000);
                </script>

                <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto mt-10">
                    <?php if ($editCategoryId && $categoryToEdit): ?>
                        <h2 class="text-2xl font-bold mb-6 text-primary">Edit Category</h2>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $editCategoryId; ?>">
                            <div class="flex justify-end mb-4">
                                <button type="submit" name="cancelar_edicion" class="text-red-500 hover:text-red-700 font-bold text-lg">X</button>
                            </div>
                            <div class="mb-4">
                                <label for="categoria" class="block text-primary font-bold mb-2">Category</label>
                                <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($categoria); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" name="actualizar_categoria" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Update Category
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <h2 class="text-2xl font-bold mb-6 text-primary">Categories</h2>
                        <div class="flex justify-between items-center mb-4">
                            <form method="GET" action="" class="flex items-center">
                                <input type="hidden" name="action" value="modcategory">
                                <label for="entries" class="text-sm text-gray-700 mr-2">Show</label>
                                <select name="per_page" id="entries" class="border border-gray-300 rounded px-2 py-1" onchange="this.form.submit()">
                                    <option value="5" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 5) ? 'selected' : ''; ?>>5</option>
                                    <option value="10" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 10) ? 'selected' : ''; ?>>10</option>
                                    <option value="15" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 15) ? 'selected' : ''; ?>>15</option>
                                    <option value="20" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 20) ? 'selected' : ''; ?>>20</option>
                                </select>
                                <span class="text-sm text-gray-700 ml-2">Entrance</span>
                            </form>
                            <form method="GET" action="" class="flex items-center">
                                <input type="hidden" name="action" value="modcategory">
                                <label for="search" class="text-sm text-gray-700 mr-2">Search:</label>
                                <input id="search" name="search" type="text" class="border border-gray-300 rounded px-2 py-1" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                <button type="submit" class="ml-2 bg-blue-500 text-white px-3 py-1 rounded">Search</button>
                            </form>
                        </div>
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $contacto = new Contacto();

                                    // Paginación
                                    $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 5;
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $offset = ($page - 1) * $per_page;

                                    // Búsqueda
                                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                                    $result = $contacto->buscarCategoriaPaginado($offset, $per_page, $search);
                                    $total_categories = $contacto->contarCategorias($search);

                                    while ($row = $result->fetch_assoc()) {
                                        echo "
                                        <tr id='row".$row['id']."'>
                                            <td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>".$row['category']."</td>
                                            <td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>
                                                <form method='POST' action='' style='display:inline;'>
                                                    <input type='hidden' name='action2' value='editcategory'>
                                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                    <button type='submit' class='text-blue-500 hover:text-blue-700'><i class='fas fa-edit'></i></button>
                                                </form>
                                                <form method='POST' action='' onsubmit='return confirmDelete(" . $row['id'] . ")' style='display:inline;'>
                                                    <input type='hidden' name='action' value='deleteCategory'>
                                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                    <button type='submit' class='text-red-500 hover:text-red-700'><i class='fas fa-trash'></i></button>
                                                </form>
                                            </td>
                                        </tr>";
                                    }

                                    if (isset($_POST['action']) && $_POST['action'] == 'deleteCategory') {
                                        $id = $_POST['id'];
                                        $contacto->eliminarCategoria($id);
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        
                        <div class="flex justify-between mt-4">
                            <?php
                                $total_pages = ceil($total_categories / $per_page);
                                if ($page > 1) {
                                    echo '<form method="GET" action="">
                                            <input type="hidden" name="action" value="modcategory">
                                            <input type="hidden" name="page" value="'.($page-1).'">
                                            <input type="hidden" name="per_page" value="'.$per_page.'">
                                            <input type="hidden" name="search" value="'.htmlspecialchars($search).'">
                                            <button type="submit" class="text-primary hover:text-primary-dark">← Back</button>
                                        </form>';
                                } else {
                                    echo '<span class="text-gray-400">← Back</span>';
                                }

                                if ($page < $total_pages) {
                                    echo '<form method="GET" action="">
                                            <input type="hidden" name="action" value="modcategory">
                                            <input type="hidden" name="page" value="'.($page+1).'">
                                            <input type="hidden" name="per_page" value="'.$per_page.'">
                                            <input type="hidden" name="search" value="'.htmlspecialchars($search).'">
                                            <button type="submit" class="text-primary hover:text-primary-dark">Next →</button>
                                        </form>';
                                } else {
                                    echo '<span class="text-gray-400">Next →</span>';
                                }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>

                <script>
                    function confirmDelete(id) {
                        return confirm('Are you sure you want to delete this category?');
                    }
                </script>
            <?php endif; ?>
            <?php if ($showForm7): ?>
                <div id="modifyuser" class="bg-white p-8 rounded-lg shadow-lg max-w-md mx-auto">
                    <h2 class="text-2xl font-bold mb-6 text-primary">Settings</h2>
                    <?php
                        $contacto = new Contacto();

                        // Obtener los datos del usuario actual
                        $usuario_actual = $_SESSION['user'];

                        // Si se ha enviado el formulario de actualización, actualizamos los datos
                        if (isset($_POST["update"])) {
                            $id = $_POST["id"];
                            $nombre = isset($_POST["names"]) ? $_POST["names"] : '';
                            $password = isset($_POST["password"]) ? $_POST["password"] : '';
                            $email = isset($_POST["correo"]) ? $_POST["correo"] : '';

                            $result = $contacto->actualizarUsuario($id, $nombre, $password, $email);
                            echo "<div id='success-message' class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4' role='alert'>User updated correctly</div>";

                            // Actualizar la sesión con el nuevo nombre de usuario
                            $_SESSION['user'] = $nombre;

                            // Obtener nuevamente los datos del usuario después de la actualización
                            $datos_usuario = $contacto->obtenerDatosUsuario($nombre);
                        } else {
                            // Obtener los datos del usuario actual
                            $datos_usuario = $contacto->obtenerDatosUsuario($usuario_actual);
                        }

                        // Verificar que $datos_usuario no sea null
                        if ($datos_usuario) {
                            // Cargar los datos en el formulario
                            $id = $datos_usuario['id'];
                            $nombre = $datos_usuario['name'];
                            $password = $datos_usuario['password'];
                            $email = $datos_usuario['correo'];

                            echo "<form method='POST'>
                                <input type='hidden' name='id' value='$id'>
                                <div class='mb-4'>
                                    <label id='usuario' class='block text-primary font-bold mb-2'>Name</label>
                                    <input type='text' name='names' class='bg-tertiary border border-primary rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline' value='$nombre' required>
                                </div>
                                <div class='mb-4'>
                                    <label id='contra' class='block text-primary font-bold mb-2'>Password</label>
                                    <input type='password' name='password' class='bg-tertiary border border-primary rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline' value='$password' required>
                                </div>
                                <div class='mb-4'>
                                    <label id='email' class='block text-primary font-bold mb-2'>Email</label>
                                    <input type='text' name='correo' class='bg-tertiary border border-primary rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline' value='$email' required>
                                </div>
                                <div class='flex items-center justify-between'>
                                    <button type='submit' name='update' class='bg-primary text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline'>Update</button>
                                </div>
                            </form>";
                        } else {
                            echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4' role='alert'>User data not found</div>";
                        }
                    ?>
                </div>

                <script>
                    // Desaparece el mensaje después de 5 segundos
                    setTimeout(function() {
                        var successMessage = document.getElementById('success-message');
                        if (successMessage) {
                            successMessage.style.display = 'none';
                        }
                    }, 5000);
                </script>
            <?php endif; ?>
            <?php if ($showForm9): ?>
                <section>
                    <h2 class="text-2xl mb-4">Lista de Usuarios</h2>
                    <?php
                    // Configuración de la paginación
                    $conexion = new Conexion();
                    $conexion->sentencia = "SELECT COUNT(*) as total FROM users";
                    $result = $conexion->obtener_sentencia();
                    $totalUsuarios = mysqli_fetch_assoc($result)['total'];
                    $usuariosPorPagina = 5;
                    $totalPaginas = ceil($totalUsuarios / $usuariosPorPagina);

                    // Obtener la página actual de la URL, si no existe será la página 1
                    $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                    if ($paginaActual < 1) $paginaActual = 1;
                    if ($paginaActual > $totalPaginas) $paginaActual = $totalPaginas;

                    // Calcular el offset
                    $offset = ($paginaActual - 1) * $usuariosPorPagina;

                    // Obtener los usuarios para la página actual
                    $conexion->sentencia = "SELECT name, correo FROM users LIMIT $usuariosPorPagina OFFSET $offset";
                    $result = $conexion->obtener_sentencia();

                    if ($result && mysqli_num_rows($result) > 0): ?>
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 text-center border border-gray-200 font-bold">Nombre</th>
                                    <th class="py-2 text-center border border-gray-200 font-bold">Correo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class='py-2 text-center border border-gray-200'><?php echo $row['name']; ?></td>
                                        <td class='py-2 text-center border border-gray-200'><?php echo $row['correo']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <div class="mt-4">
                            <?php if ($paginaActual > 1): ?>
                                <a href="?action=userList&pagina=<?php echo $paginaActual - 1; ?>" class="px-4 py-2 bg-gray-300 text-black rounded">Anterior</a>
                            <?php endif; ?>
                            <?php if ($paginaActual < $totalPaginas): ?>
                                <a href="?action=userList&pagina=<?php echo $paginaActual + 1; ?>" class="px-4 py-2 bg-gray-300 text-black rounded">Siguiente</a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <p class="py-2">No se encontraron usuarios.</p>
                    <?php endif; ?>
                </section>
        <?php endif; ?>
        </main>
    </div>
    <footer class="bg-primary text-white p-4 mt-auto">
        <div class="container mx-auto text-center">
            &copy; 2024 Dashboard Administrador. All rights reserved.
        </div>
    </footer>
</body>
</html>
