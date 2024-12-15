<?php
// checkout.php: Form for user details
$cart = json_decode($_GET['cart'], true);
?>

<?php include 'head.php'; ?>
<body>
<?php include 'nav.php'; ?>
<div class="container my-5">
    <div class="border p-3 mb-4">
        <h3>Cart Summary</h3>
        <ul class="list-group">
            <?php 
            $total = 0;
            foreach ($cart as $item): 
                $total += $item['price'];
            ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($item['name']) ?> 
                    <span class="fw-bold">$<?= number_format($item['price'], 2) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="mt-3 fw-bold">Total: $<?= number_format($total, 2) ?></p>
    </div>
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
    <h1 class="text-center mb-4">Complete Your Order</h1>
    <p>You will not need to pay until after the services are fullfilled. Please fill out your information to complete the order. Our support team will be in contact with you soon to complete your order.</p>
    <form action="submit_order.php" method="post" id="checkoutForm">
        <input type="hidden" name="cart" value='<?= json_encode($cart) ?>'>
        <label for="name">Name*</label><br>
        <input type="text" id="name" name="name" class="form-control" required>
        <br>

        <label for="email">Email*</label><br>
        <input type="email" id="email" name="email" class="form-control" required>
        <br>

        <label for="phone_number">Phone Number*</label><br>
        <input type="tel" id="phone_number" name="phone_number" class="form-control" required>
        <br>
        <div class="mb-3">
            <label for="details" class="form-label">Extra Details</label>
            <textarea id="details" name="details" class="form-control" rows="5"></textarea>
        </div>
        <input type="submit" value="Submit Ticket" class="btn btn-primary">
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
