<?php include 'head.php'; ?>
<body>
<?php include 'nav.php'; ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Complete Your Order</h1>
    <p>Please fill out your information to complete the order. A summary of your cart is displayed below.</p>

    <!-- Cart Summary -->
    <div class="border p-3 mb-4">
        <h3>Cart Summary</h3>
        <ul id="cart-summary" class="list-group"></ul>
        <div id="cart-total"></div>
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
    <!-- User Information Form -->
    <form id="order-form" action="submit_order.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" id="phone" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Extra Details</label>
            <textarea id="details" name="details" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Order</button>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
<script>
    // Load cart from localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Redirect if cart is empty
    if (cart.length === 0) {
        window.location.href = 'shop.php';
    }

    // Render the cart summary on the checkout page
    const cartSummary = document.getElementById('cart-summary');
    let total = 0;

    cart.forEach(item => {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
        listItem.textContent = `${item.name} - $${item.price}`;
        total += item.price;
        cartSummary.appendChild(listItem);
    });

    // Show total
    const totalDisplay = document.createElement('p');
    totalDisplay.className = 'mt-3 fw-bold';
    totalDisplay.textContent = `Total: $${total}`;
    document.getElementById('cart-total').appendChild(totalDisplay);

    // Attach cart data to form
    document.getElementById('order-form').addEventListener('submit', () => {
        const cartInput = document.createElement('input');
        cartInput.type = 'hidden';
        cartInput.name = 'cart';
        cartInput.value = JSON.stringify(cart);
        document.getElementById('order-form').appendChild(cartInput);
    });

</script>
</html>
