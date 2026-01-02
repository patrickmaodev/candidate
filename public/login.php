<?php
require_once __DIR__ . '/../views/layouts/header.php';
?>

<div class="container">
    <h2>Admin Login</h2>

    <?php if(isset($_GET['error'])): ?>
        <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <form action="../app/controllers/AuthController.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit" name="login">Login</button>
    </form>
</div>

<?php
require_once __DIR__ . '/../views/layouts/footer.php';
?>
