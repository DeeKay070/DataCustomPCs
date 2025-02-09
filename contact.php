<?php include 'head.php'; 
?>

<body>
    <div class="content-wrapper">
        <?php include 'nav.php'; ?>
        <main class="container my-4">
            <h2>Send a Request</h2>
            <p class = "text-start px-0">Need help with your hardware? Let us know, and we can give you a quote.</p>
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

            <?php include 'ticket_form.html'; ?>
        </main>
        <?php include 'footer.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
