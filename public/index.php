<?php
// Include header template
require_once __DIR__ . '/../views/layouts/header.php';
?>

<div class="container">
    <h2>Candidate Registration</h2>

    <?php if(isset($_GET['success'])): ?>
        <div class="success">Registration successful!</div>
    <?php endif; ?>

    <form action="../app/controllers/CandidateController.php" method="POST" enctype="multipart/form-data">
        <label>Full Name:</label>
        <input type="text" name="full_name" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Phone:</label>
        <input type="text" name="phone" required><br>

        <label>Upload CV:</label>
        <input type="file" name="cv" accept=".pdf,.doc,.docx" required><br>

        <button type="submit" name="register">Register</button>
    </form>

    <p>Admin? <a href="login.php">Login here</a></p>
</div>

<?php
// Include footer template
require_once __DIR__ . '/../views/layouts/footer.php';
?>
