<?php include 'head.php'; ?>
<body>
<?php include 'nav.php'; ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Thank You for Your Order!</h1>
    <p class="text-center">We’ve received your order. A confirmation email has been sent to you, and our team will follow up shortly.</p>
    <?php
        session_start();
        if (isset($_SESSION['success_message'])) {
            echo "<div class='success-message'>" . htmlspecialchars($_SESSION['success_message']) . "</div>";
            unset($_SESSION['success_message']); // Clear the message
        }

        if (isset($_SESSION['error_message'])) {
            echo "<div class='error-message'>" . htmlspecialchars($_SESSION['error_message']) . "</div>";
            unset($_SESSION['error_message']); // Clear the message
        }
    ?>
    <a href="index.php" class="btn btn-primary d-block mx-auto" style="max-width: 200px;">Return to Home</a>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
