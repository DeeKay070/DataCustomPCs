<?php
// services.php: Define services as an array for dynamic rendering
$services = [
    [
        "name" => "High End Custom PC", 
        "description" => "Experience unmatched performance with our high-end custom PCs, featuring cutting-edge components and tailored configurations for gaming, productivity, and more.", 
        "price" => 1200,
        "img" => "https://images.pexels.com/photos/24613564/pexels-photo-24613564/free-photo-of-components-of-computer.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
    ],
    [
        "name" => "Middle Custom PC", 
        "description" => "Get the perfect balance of performance and affordability with our mid-range custom PCs, ideal for everyday tasks and moderate gaming.", 
        "price" => 800,
        "img" => "https://images.pexels.com/photos/2225618/pexels-photo-2225618.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
    ],
    [
        "name" => "Budget Custom PC", 
        "description" => "Affordable and reliable custom PCs designed for basic computing needs, offering great value for everyday use.", 
        "price" => 500,
        "img" => "https://images.pexels.com/photos/3977908/pexels-photo-3977908.jpeg?auto=compress&cs=tinysrgb&w=600"
    ],
    [
        "name" => "Your Parts, Our Build", 
        "description" => "If you buy the parts, we'll build the PC! Our expert technicians will assemble and test your custom PC to ensure optimal performance, reliability, and cable management.", 
        "price" => 50,
        "img" => "https://images.pexels.com/photos/6913135/pexels-photo-6913135.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
    ],
    [
        "name" => "Slow Computer Tune Up", 
        "description" => "Revitalize your sluggish computer with our comprehensive tune-up service, including system cleanup, optimization, and malware checks.", 
        "price" => 30,
        "img" => "https://media.istockphoto.com/id/1369357107/photo/software-update.jpg?b=1&s=612x612&w=0&k=20&c=hkWBBmJdnDo6BaAV4CNkqx9IpvSt6xHPTEXfymoR4NI="
    ],
    [
        "name" => "Wii Hack", 
        "description" => "Unlock new features on your Nintendo Wii with our professional hacking services, including homebrew installation and game backups.", 
        "price" => 25,
        "img" => "https://www.nintendo.com/eu/media/images/10_share_images/support_9/H2x1_NintendoWii_support_no_logo_image800w.jpg"
    ],
    [
        "name" => "Wii U Hack", 
        "description" => "Enhance your Wii U with advanced hacking services, enabling custom software, homebrew games, and more.", 
        "price" => 25,
        "img" => "https://m.media-amazon.com/images/I/51TQPhqO9YL._AC_UF894,1000_QL80_.jpg"
    ],
    [
        "name" => "3DS Hack", 
        "description" => "Expand the capabilities of your Nintendo 3DS with our hacking service, offering access to custom firmware, game backups, and unique features.", 
        "price" => 25,
        "img" => "https://media.gamestop.com/i/gamestop/10129117/Nintendo-3DS-Purple?\$pdp$"
    ],
    [
        "name" => "GBA Screen Mod", 
        "description" => "Upgrade your GBA to have a backlit LCD screen. You will be able to see games like you never could before while retaining the feel of the original console.", 
        "price" => 50,
        "img" => "https://godofgamingshop.com/cdn/shop/files/GBAGlacierIPScopy.jpg?v=1698181308"
    ],
    [
        "name" => "Custom JoyCons", 
        "description" => "Personalize your Nintendo Switch Joy-Con controllers with our custom designs, colors, and enhanced grips for a unique gaming experience.", 
        "price" => 100,
        "img" => "https://itsmysnap.com/cdn/shop/files/PassionRedShellsForNSSwitchJoycon_OLEDJoycon.webp?v=1718071789&width=1445"
    ]
];

?>

<?php include 'head.php'; ?>
<body>
<?php include 'nav.php'; ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Shop Our Services</h1>
    <p>There is no need to pay at this time, an invoice will be sent later in the process. Feel free to add any service that you want and submit to create an email request.</p>

    <!-- Service List -->
    <div class="row" id="services">
        <?php foreach ($services as $service): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class ="mb-3 p-0">
                            <img src=<?= $service['img'] ?> alt="Company Overview" class="img-fluid rounded py-10">        
                        </div>
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
<?php include 'footer.php'; ?>

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
        const orderSummary = JSON.stringify(cart);
        const formUrl = `checkout.php?cart=${encodeURIComponent(orderSummary)}`;
        window.location.href = formUrl;
    });

</script>
</body>
</html>
