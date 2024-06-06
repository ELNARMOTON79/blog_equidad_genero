<?php
$pagina_actual = basename($_SERVER['PHP_SELF']);
session_start();
?>
<style>
    .custom-bg { background-color: #B784B7; }
    .hover\:bg-custom-hover:hover { background-color: #8E7AB5; }
    .active { background-color: #8E7AB5; }
    .logo { width: 100px; }
    .dropdown-menu { display: none; position: absolute; right: 10px; background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    .dropdown-menu a { display: block; padding: 10px; color: black; text-decoration: none; }
    .dropdown-menu a:hover { background-color: #f0f0f0; }
</style>
<nav class="fixed top-0 w-full z-10 flex items-center justify-between px-10 py-4 custom-bg">
    <div>
        <a href="home.php">
            <img class="logo" src="source/log.png" alt="Logo">
        </a>
    </div>
    <div class="flex items-center space-x-4">
        <a href="home.php" class="<?php if($pagina_actual == "home.php") echo 'active'; ?> hover:bg-custom-hover px-3 py-2 rounded">Home</a>
        <a href="post.php" class="<?php if($pagina_actual == "post.php") echo 'active'; ?> hover:bg-custom-hover px-3 py-2 rounded">Posts</a>
        <a href="about.php" class="<?php if($pagina_actual == "about.php") echo 'active'; ?> hover:bg-custom-hover px-3 py-2 rounded">About</a>
        <?php if (isset($_SESSION['user'])): ?>
            <div class="relative">
            <button onclick="toggleDropdown()" class="bg-purple-400 hover:bg-purple-300 px-3 py-2 rounded text-black">Manage</button>
                <div id="dropdown" class="dropdown-menu">
                    <?php if (isset($_SESSION['type_user']) && $_SESSION['type_user'] == 0): ?>
                        <a href="admin/dashboard.php">Admin Dashboard</a>
                    <?php else: ?>
                        <a href="user/dashboard.php">User Dashboard</a>
                    <?php endif; ?>
                    <a href="logins/logout.php">Log Out</a>
                </div>
            </div>
        <?php else: ?>
            <div class="relative">
                <button class="bg-teal-500 hover:bg-teal-600 px-3 py-2 rounded text-white"><a href="logins/login.php">Login</a></button>
            </div>
        <?php endif; ?>
    </div>
</nav>
<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("dropdown");
        if (dropdown.style.display === "none" || dropdown.style.display === "") {
            dropdown.style.display = "block";
        } else {
            dropdown.style.display = "none";
        }
    }
</script>
