<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Candidate Registration</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Candidate Registration</h2>
        <?php if(isset($_GET['success'])): ?>
            <div class="success">Registration successful!</div>
        <?php endif; ?>
        <form action="../../app/controllers/CandidateController.php" method="POST" enctype="multipart/form-data">
            <label>Full Name:</label><br>
            <input type="text" name="full_name" required><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>

            <label>Phone:</label><br>
            <input type="text" name="phone" required><br><br>

            <label>Upload CV:</label><br>
            <input type="file" name="cv" accept=".pdf,.doc,.docx" required><br><br>

            <button type="submit" name="register">Register</button>
        </form>
    </div>
</body>
</html>
