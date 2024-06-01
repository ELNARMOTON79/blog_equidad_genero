<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include ("conexion.php");

    class Contacto extends Conexion {
        // buscar 5 po
        public function buscarPostReciente() {
            $this->sentencia = "SELECT * FROM posts ORDER BY date DESC LIMIT 3";
            $result = $this->obtener_sentencia();
            return $result;
        }
        
        public function buscarUltimoPost() {
            $this->sentencia = "SELECT * FROM posts ORDER BY time DESC LIMIT 1";
            $result = $this->obtener_sentencia();
            return $result;
        }
        
        // buscar todos los post
        public function buscarPost() {
            $this->sentencia = "SELECT * FROM posts";
            $result = $this->obtener_sentencia();
            return $result;
        }

        public function buscarPostPorId($id) {
            $this->sentencia = "SELECT * FROM posts WHERE id = $id";
            $result = $this->obtener_sentencia();
            return $result;
        }

        //buscar categoria por id
        public function buscarCategoriaPorId($id) {
            $this->sentencia = "SELECT * FROM category WHERE id = $id";
            $result = $this->obtener_sentencia();
            return $result;
        }

        public function buscarPostPaginado($offset, $per_page, $search = '') {
            $this->sentencia = "SELECT * FROM posts WHERE title LIKE '%$search%' OR content LIKE '%$search%' OR category LIKE '%$search%' LIMIT $offset, $per_page";
            $result = $this->obtener_sentencia();
            return $result;
        }

        //buscarcategoriaPostPaginado
        public function buscarCategoriaPaginado($offset, $per_page, $search = '') {
            $this->sentencia = "SELECT * FROM category WHERE category LIKE '%$search%' LIMIT $offset, $per_page";
            $result = $this->obtener_sentencia();
            return $result;
        }

        public function contarPosts()
        {
            $this->sentencia = "SELECT COUNT(*) as total FROM posts";
            $result = $this->obtener_sentencia();
            $total = $result->fetch_assoc();
            return $total['total'];
        }

        public function categorias()
        {
            $this->sentencia = "SELECT COUNT(*) as totalCategories FROM category";
            $result = $this->obtener_sentencia();
            if ($result) {
                $row = $result->fetch_assoc(); // Asumiendo que estás usando MySQLi
                return $row['totalCategories'];
            } else {
                return 0;
            }
        }

        public function contarCategorias($search = '')
        {
            $this->sentencia = "SELECT COUNT(*) as total FROM category WHERE category LIKE '%$search%'";
            $result = $this->obtener_sentencia();
            $total = $result->fetch_assoc();
            return $total['total'];
        }

        public function login($user, $password) {
            $this->sentencia = "SELECT type_user FROM users WHERE name = '$user' AND password = '$password';";
            $result = $this->obtener_sentencia();
        
            // Debugging output
            if ($result === false) {
                error_log("Error en la consulta SQL: " . $this->conexion->error);
            }
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row["type_user"];
            } else {
                return null;
            }
        }
        
        public function forgotPassword($email) {
            $this->sentencia = "SELECT id, name FROM users WHERE correo = '$email'";
            $result = $this->obtener_sentencia();
            return $result->fetch_assoc();
        }
        
        public function insertarCodigo($usuario, $codigo) {
            $this->sentencia = "INSERT INTO codes VALUES ('$usuario', $codigo)";
            return $this->obtener_sentencia();
        }

        public function verificarCodigo($codigo) {
            $this->sentencia = "SELECT id_user FROM codes WHERE code = '$codigo'";
            $result = $this->obtener_sentencia();
            if ($result === false) {
                // Si obtener_sentencia devuelve false, imprimir el error y la consulta
                die("Error en la consulta: " . $this->error . " - Consulta SQL: " . $this->sentencia);
            }
            return $result->fetch_assoc();
        }
        
        public function actualizarPassword($usuarioId, $nuevaPassword) {
            $this->sentencia = "UPDATE users SET password = '$nuevaPassword' WHERE id = '$usuarioId'";
            return $this->obtener_sentencia();
        }
        
        public function eliminarCodigo($codigo) {
            $this->sentencia = "DELETE FROM codes WHERE code = '$codigo'";
            return $this->obtener_sentencia();
        }

        // crear usuario
        public function crearUsuario($nombre, $password, $user, $email) {
            $this->sentencia = "INSERT INTO users (name, password, type_user, correo) VALUES ('$nombre', '$password', '$user', '$email')";
            return $this->ejecutar_sentencia();
        }

        // mostrar todos los usuarios
        public function mostrarUsuarios() {
            $this->sentencia = "SELECT * FROM users";
            $result = $this->obtener_sentencia();
            return $result;
        }

        public function contarUsuarios()
        {
            $this->sentencia = "SELECT COUNT(*) as total FROM users";
            $result = $this->obtener_sentencia();
            $total = $result->fetch_assoc();
            return $total['total'];
        }

        public function obtenerDatosUsuario($usuario_actual) {
            $this->sentencia = "SELECT id, name, password, correo FROM users WHERE name = '$usuario_actual'";
            $result = $this->obtener_sentencia();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        }

        // eliminar usuario
        public function eliminarUsuario($id) {
            $this->sentencia = "DELETE FROM users WHERE id = $id";
            $this->ejecutar_sentencia();
        }

        //buscar categorias sin repetir
        public function buscarCategorias() {
            $this->sentencia = "SELECT DISTINCT id, category FROM category";
            $result = $this->obtener_sentencia();
            return $result;
        }        

        //crear post
        public function crearPost($usuario, $titulo, $contenido, $categoria, $imagen) {
            $this->sentencia = "INSERT INTO posts (name , title, content, category, image) VALUES ('$usuario', '$titulo', '$contenido', '$categoria', '$imagen')";
            return $this->ejecutar_sentencia();
        }

        //eliminar post
        public function eliminarPost($id) {
            $this->sentencia = "DELETE FROM posts WHERE id = $id";
            $this->ejecutar_sentencia();
        }

        //editar post
        public function editarPost($id, $titulo, $contenido, $categoria, $imagen) {
            $this->sentencia = "UPDATE posts SET title = '$titulo', content = '$contenido', category = '$categoria', image = '$imagen' WHERE id = $id";
            return $this->ejecutar_sentencia();
        }

        //crear categoria
        public function crearCategoria($categoria) {
            $this->sentencia = "INSERT INTO category (category) VALUES ('$categoria')";
            return $this->ejecutar_sentencia();
        }

        //eliminar categoria
        public function eliminarCategoria($id) {
            $this->sentencia = "DELETE FROM category WHERE id = $id";
            $this->ejecutar_sentencia();
        }

        //editar categoria
        public function actualizarCategoria($id, $categoria) {
            $this->sentencia = "UPDATE category SET category = '$categoria' WHERE id = $id";
            $this->ejecutar_sentencia();
        }

        //actualizar usuario
        public function actualizarUsuario($id, $nombre, $password, $email) {
            $this->sentencia = "UPDATE users SET name = '$nombre', password = '$password', correo = '$email' WHERE id = $id";
            $this->ejecutar_sentencia();
        }

    }

?>
