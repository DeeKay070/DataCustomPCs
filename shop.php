<?php
// services.php: Define services as an array for dynamic rendering
$services = [
    ["name" => "Custom PCs", "description" => "High-performance custom PCs tailored to your needs.", "price" => 1200],
    ["name" => "Console Modding", "description" => "Professional modding services for gaming consoles.", "price" => 300],
    ["name" => "Hardware Repair", "description" => "Comprehensive hardware repair services.", "price" => 150],
    ["name" => "Slow Computer Tune Up", "description" => "Tune-up services to optimize your computer.", "price" => 100],
    ["name" => "Phone Screen Repair", "description" => "Reliable and affordable phone screen repairs.", "price" => 200]
];
?>

<?php include 'head.php'; ?>
<body>
<?php include 'nav.php'; ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Shop Our Services</h1>

    <!-- Service List -->
    <div class="row" id="services">
        <?php foreach ($services as $service): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= $service['name'] ?></h5>
                        <p class="card-text"><?= $service['description'] ?></p>
                        <p class="text-primary fw-bold">$<?= $service['price'] ?></p>
                        <button class="btn btn-success add-to-cart" 
                                data-name="<?= $service['name'] ?>" 
                                data-price="<?= $service['price'] ?>">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Checkout Section -->
    <h2 class="text-center my-4">Your Cart</h2>
    <div id="cart" class="border p-3 mb-4">
        <p class="text-muted">Your cart is empty.</p>
    </div>

    <button id="checkout-button" class="btn btn-primary" disabled>Submit</button>
</div>

<script>
    // JavaScript for Cart Management
    const cart = [];

    // Function to render cart items
    function renderCart() {
        const cartContainer = document.getElementById('cart');
        cartContainer.innerHTML = '';

        if (cart.length === 0) {
            cartContainer.innerHTML = '<p class="text-muted">Your cart is empty.</p>';
            document.getElementById('checkout-button').disabled = true;
            return;
        }

        const list = document.createElement('ul');
        list.className = 'list-group';
        let total = 0;

        cart.forEach(item => {
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            listItem.textContent = `${item.name} - $${item.price}`;
            total += item.price;

            const removeButton = document.createElement('button');
            removeButton.textContent = 'Remove';
            removeButton.className = 'btn btn-danger btn-sm';
            removeButton.onclick = () => {
                removeFromCart(item);
            };

            listItem.appendChild(removeButton);
            list.appendChild(listItem);
        });

        cartContainer.appendChild(list);

        const totalDisplay = document.createElement('p');
        totalDisplay.className = 'mt-3 fw-bold';
        totalDisplay.textContent = `Total: $${total}`;
        cartContainer.appendChild(totalDisplay);

        document.getElementById('checkout-button').disabled = false;
    }

    // Function to add an item to the cart
    function addToCart(name, price) {
        cart.push({ name, price });
        renderCart();
    }

    // Function to remove an item from the cart
    function removeFromCart(item) {
        const index = cart.indexOf(item);
        if (index > -1) {
            cart.splice(index, 1);
        }
        renderCart();
    }

    // Add event listeners to Add to Cart buttons
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            const name = button.getAttribute('data-name');
            const price = parseFloat(button.getAttribute('data-price'));
            addToCart(name, price);
        });
    });

    // Checkout button functionality
    document.getElementById('checkout-button').addEventListener('click', () => {
        alert('Thank you for your order! This feature is under development.');
    });
</script>
</body>
</html>
