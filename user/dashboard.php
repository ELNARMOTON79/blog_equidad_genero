<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include("../base/contacto.php");

$showForm3 = isset($_GET['action']) && $_GET['action'] == 'createpost';
$showForm4 = isset($_GET['action']) && $_GET['action'] == 'editPost';
$showForm5 = isset($_GET['action']) && $_GET['action'] == 'category';
$showForm6 = isset($_GET['action']) && $_GET['action'] == 'modcategory';
$showForm7 = isset($_GET['action']) && $_GET['action'] == 'settings';

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
            <h1 class="text-3xl font-bold">Welcome User</h1>
        </div>
    </header>
    <div class="flex flex-1 pt-20">
        <!-- Sidebar -->
        <aside class="bg-white w-64 p-6 shadow-lg">
            <ul>
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
            <?php if (!$showForm3 && !$showForm4 && !$showForm5 && !$showForm6 && !$showForm7): ?>
                <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto mt-10">
                    <h2 class="text-2xl font-bold mb-6 text-primary">Welcome To The Dashboard</h2>
                    <p class="text-gray-700">Select an option from the side menu to begin.</p>
                </div>
            <?php endif; ?>

            <?php if ($showForm3): ?>
                <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto mt-10">
                    <h2 class="text-2xl font-bold mb-6 text-primary">Crear Nuevo Post</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="titulo" class="block text-primary font-bold mb-2">Título</label>
                            <input type="text" id="titulo" name="titulo" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="contenido" class="block text-primary font-bold mb-2">Contenido</label>
                            <textarea id="contenido" name="contenido" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline h-40" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="categoria" class="block text-primary font-bold mb-2">Categoría</label>
                            <select id="categoria" name="categoria" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Seleccione una categoría</option>
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
                            <label for="imagen" class="block text-primary font-bold mb-2">Imagen</label>
                            <input type="file" id="imagen" name="imagen" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" name="crear_post" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Crear Post
                            </button>
                        </div>
                    </form>
                </div>

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
                        $contacto->crearPost($titulo, $contenido, $categoria, $imagen, $usuario);
                        echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4' role='alert'>Post creado con éxito</div>";
                    }
                ?>
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
                        echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4' role='alert'>Post actualizado con éxito</div>";
                    }

                    if (isset($_POST['cancelar_edicion'])) {
                        $editPostId = null; // Reset the edit post ID to show the table again
                    }
                ?>

                <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto mt-10">
                    <?php if ($editPostId && $postToEdit): ?>
                        <h2 class="text-2xl font-bold mb-6 text-primary">Editar Post</h2>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $editPostId; ?>">
                            <div class="flex justify-end mb-4">
                                <button type="submit" name="cancelar_edicion" class="text-red-500 hover:text-red-700 font-bold text-lg">X</button>
                            </div>
                            <div class="mb-4">
                                <label for="titulo" class="block text-primary font-bold mb-2">Título</label>
                                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                            <div class="mb-4">
                                <label for="contenido" class="block text-primary font-bold mb-2">Contenido</label>
                                <textarea id="contenido" name="contenido" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline h-40" required><?php echo htmlspecialchars($contenido); ?></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="categoria" class="block text-primary font-bold mb-2">Categoría</label>
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
                                <label for="imagen" class="block text-primary font-bold mb-2">Imagen</label>
                                <input type="file" id="imagen" name="imagen" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" name="actualizar_post" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Actualizar Post
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <h2 class="text-2xl font-bold mb-6 text-primary">Posts</h2>
                        <div class="flex justify-between items-center mb-4">
                            <form method="GET" action="" class="flex items-center">
                                <input type="hidden" name="action" value="editPost">
                                <label for="entries" class="text-sm text-gray-700 mr-2">Mostrar</label>
                                <select name="per_page" id="entries" class="border border-gray-300 rounded px-2 py-1" onchange="this.form.submit()">
                                    <option value="5" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 5) ? 'selected' : ''; ?>>5</option>
                                    <option value="10" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 10) ? 'selected' : ''; ?>>10</option>
                                    <option value="15" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 15) ? 'selected' : ''; ?>>15</option>
                                    <option value="20" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 20) ? 'selected' : ''; ?>>20</option>
                                </select>
                                <span class="text-sm text-gray-700 ml-2">entradas</span>
                            </form>
                            <form method="GET" action="" class="flex items-center">
                                <input type="hidden" name="action" value="editPost">
                                <label for="search" class="text-sm text-gray-700 mr-2">Buscar:</label>
                                <input id="search" name="search" type="text" class="border border-gray-300 rounded px-2 py-1" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                <button type="submit" class="ml-2 bg-blue-500 text-white px-3 py-1 rounded">Buscar</button>
                            </form>
                        </div>
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Título</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Categoría</th>
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
                                            <td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>
                                                <form method='POST' action='' style='display:inline;'>
                                                    <input type='hidden' name='action2' value='editpost'>
                                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                    <button type='submit' class='text-blue-500 hover:text-blue-700'><i class='fas fa-edit'></i></button>
                                                </form>
                                            </td>
                                        </tr>";
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
                                            <button type="submit" class="text-primary hover:text-primary-dark">← Anterior</button>
                                        </form>';
                                } else {
                                    echo '<span class="text-gray-400">← Anterior</span>';
                                }

                                if ($page < $total_pages) {
                                    echo '<form method="GET" action="">
                                            <input type="hidden" name="action" value="editPost">
                                            <input type="hidden" name="page" value="'.($page+1).'">
                                            <input type="hidden" name="per_page" value="'.$per_page.'">
                                            <input type="hidden" name="search" value="'.htmlspecialchars($search).'">
                                            <button type="submit" class="text-primary hover:text-primary-dark">Siguiente →</button>
                                        </form>';
                                } else {
                                    echo '<span class="text-gray-400">Siguiente →</span>';
                                }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($showForm5): ?>
                <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto mt-10">
                    <h2 class="text-2xl font-bold mb-6 text-primary">Crear Categoría</h2>
                    <form method="POST">
                        <div class="mb-4">
                            <label for="categoria" class="block text-primary font-bold mb-2">Categoría</label>
                            <input type="text" id="categoria" name="categoria" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" name="crear_categoria" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Crear Categoría
                            </button>
                        </div>
                    </form>
                </div>
                <?php
                    if(isset($_POST["crear_categoria"])) {
                        $categoria = $_POST['categoria'];

                        $contacto = new Contacto();
                        $contacto->crearCategoria($categoria);
                        echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4' role='alert'>Categoría creada con éxito</div>";
                    }
                ?>
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
                        echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4' role='alert'>Categoría actualizada con éxito</div>";
                    }

                    if (isset($_POST['cancelar_edicion'])) {
                        $editCategoryId = null; // Reset the edit category ID to show the table again
                    }
                ?>

                <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto mt-10">
                    <?php if ($editCategoryId && $categoryToEdit): ?>
                        <h2 class="text-2xl font-bold mb-6 text-primary">Editar Categoría</h2>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $editCategoryId; ?>">
                            <div class="flex justify-end mb-4">
                                <button type="submit" name="cancelar_edicion" class="text-red-500 hover:text-red-700 font-bold text-lg">X</button>
                            </div>
                            <div class="mb-4">
                                <label for="categoria" class="block text-primary font-bold mb-2">Categoría</label>
                                <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($categoria); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" name="actualizar_categoria" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Actualizar Categoría
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <h2 class="text-2xl font-bold mb-6 text-primary">Categorías</h2>
                        <div class="flex justify-between items-center mb-4">
                            <form method="GET" action="" class="flex items-center">
                                <input type="hidden" name="action" value="modcategory">
                                <label for="entries" class="text-sm text-gray-700 mr-2">Mostrar</label>
                                <select name="per_page" id="entries" class="border border-gray-300 rounded px-2 py-1" onchange="this.form.submit()">
                                    <option value="5" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 5) ? 'selected' : ''; ?>>5</option>
                                    <option value="10" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 10) ? 'selected' : ''; ?>>10</option>
                                    <option value="15" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 15) ? 'selected' : ''; ?>>15</option>
                                    <option value="20" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 20) ? 'selected' : ''; ?>>20</option>
                                </select>
                                <span class="text-sm text-gray-700 ml-2">entradas</span>
                            </form>
                            <form method="GET" action="" class="flex items-center">
                                <input type="hidden" name="action" value="modcategory">
                                <label for="search" class="text-sm text-gray-700 mr-2">Buscar:</label>
                                <input id="search" name="search" type="text" class="border border-gray-300 rounded px-2 py-1" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                <button type="submit" class="ml-2 bg-blue-500 text-white px-3 py-1 rounded">Buscar</button>
                            </form>
                        </div>
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Categoría</th>
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
                                            </td>
                                        </tr>";
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
                                            <button type="submit" class="text-primary hover:text-primary-dark">← Anterior</button>
                                        </form>';
                                } else {
                                    echo '<span class="text-gray-400">← Anterior</span>';
                                }

                                if ($page < $total_pages) {
                                    echo '<form method="GET" action="">
                                            <input type="hidden" name="action" value="modcategory">
                                            <input type="hidden" name="page" value="'.($page+1).'">
                                            <input type="hidden" name="per_page" value="'.$per_page.'">
                                            <input type="hidden" name="search" value="'.htmlspecialchars($search).'">
                                            <button type="submit" class="text-primary hover:text-primary-dark">Siguiente →</button>
                                        </form>';
                                } else {
                                    echo '<span class="text-gray-400">Siguiente →</span>';
                                }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($showForm7): ?>
                <div id="modifyuser" class="bg-white p-8 rounded-lg shadow-lg max-w-md mx-auto">
                    <h2 class="text-2xl font-bold mb-6 text-primary">Settings</h2>
                    <?php
                        $contacto = new Contacto();

                        // Obtener los datos del usuario actual
                        $usuario_actual = $_SESSION['user'];
                        $datos_usuario = $contacto->obtenerDatosUsuario($usuario_actual);

                        // Si se ha enviado el formulario de actualización, actualizamos los datos
                        if (isset($_POST["update"])) {
                            $id = $_POST["id"];
                            $nombre = isset($_POST["names"]) ? $_POST["names"] : '';
                            $password = isset($_POST["password"]) ? $_POST["password"] : '';

                            $result = $contacto->actualizarUsuario($id, $nombre, $password);
                            echo "<div id='success-message' class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4' role='alert'>Usuario actualizado correctamente</div>";
                        }

                        // Cargar los datos en el formulario
                        $id = $datos_usuario['id'];
                        $nombre = $datos_usuario['name'];
                        $password = $datos_usuario['password'];

                        echo "<form method='POST'>
                            <input type='hidden' name='id' value='$id'>
                            <div class='mb-4'>
                                <label id='usuario' class='block text-primary font-bold mb-2'>Nombre</label>
                                <input type='text' name='names' class='bg-tertiary border border-primary rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline' value='$nombre' required>
                            </div>
                            <div class='mb-4'>
                                <label id='contra' class='block text-primary font-bold mb-2'>Contraseña</label>
                                <input type='password' name='password' class='bg-tertiary border border-primary rounded w-full py-2 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline' value='$password' required>
                            </div>
                            <div class='flex items-center justify-between'>
                                <button type='submit' name='update' class='bg-primary text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline'>Actualizar</button>
                            </div>
                        </form>";
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
        </main>
    </div>
    <footer class="bg-primary text-white p-4 mt-auto">
        <div class="container mx-auto text-center">
            &copy; 2024 Dashboard Administrador. All rights reserved.
        </div>
    </footer>
</body>
</html>
