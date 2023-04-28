<!-- File ini digunakan seperti komponen di framework besar agar tidak melakukan pengulangan kode -->
<div>
    <a href='./home.php'>Home</a>
    <!-- Check apakah user sudah login, kalau belom di beri tombol login sama register -->
    <!-- kalo sudah dikasih tombol logout -->
    <?php if (!isset($_SESSION['user'])) : ?>
        <a href='./login.php'>Login</a>
        <a href="./register.php">Register</a>
    <?php else : ?>
        <span> User : <?= $_SESSION['user']['username'] ?></span>
        <a href="./dashboard.php">Dashboard</a>
        <a href="./logout.php">Logout</a>
    <?php endif; ?>
</div>