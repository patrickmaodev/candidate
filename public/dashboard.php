<?php
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../views/layouts/header.php';
?>

<div class="container">
    <h2>Admin Dashboard</h2>
    <p>Welcome, <?php echo $_SESSION['admin_name']; ?> | <a href="logout.php">Logout</a></p>

    <h3>All Candidates</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>CV</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($candidates)): ?>
                <?php foreach($candidates as $candidate): ?>
                    <tr>
                        <td><?php echo $candidate['id']; ?></td>
                        <td><?php echo htmlspecialchars($candidate['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($candidate['email']); ?></td>
                        <td><?php echo htmlspecialchars($candidate['phone']); ?></td>
                        <td><?php echo $candidate['status']; ?></td>
                        <td>
                            <?php if(!empty($candidate['cv'])): ?>
                                <a href="uploads/<?php echo basename($candidate['cv']); ?>" target="_blank">View CV</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form action="../app/controllers/CandidateController.php" method="POST">
                                <input type="hidden" name="candidate_id" value="<?php echo $candidate['id']; ?>">
                                <select name="status">
                                    <option value="applied" <?php if($candidate['status']=='applied') echo 'selected'; ?>>Applied</option>
                                    <option value="interviewed" <?php if($candidate['status']=='interviewed') echo 'selected'; ?>>Interviewed</option>
                                    <option value="hired" <?php if($candidate['status']=='hired') echo 'selected'; ?>>Hired</option>
                                    <option value="rejected" <?php if($candidate['status']=='rejected') echo 'selected'; ?>>Rejected</option>
                                </select>
                                <button type="submit" name="update_status">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">No candidates found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
require_once __DIR__ . '/../views/layouts/footer.php';
?>
