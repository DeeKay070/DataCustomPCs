<form action="submit_ticket.php" method="post">
    <label for="name">Your Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Your Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="phone_number">Your Phone Number:</label><br>
    <input type="tel" id="phone_number" name="phone_number" required><br><br>

    <label>Type of Device Affected:</label><br>
    <input type="radio" id="windows" name="device_type" value="Windows" required>
    <label for="windows">Windows Computer</label><br>
    <input type="radio" id="phone" name="device_type" value="Phone">
    <label for="phone">Mobile Phone</label><br>
    <input type="radio" id="console" name="device_type" value="Console">
    <label for="console">Console</label><br>
    <input type="radio" id="macbook" name="device_type" value="MacBook">
    <label for="macbook">MacBook</label><br><br>

    <label>Damage Information(if applicable):</label><br>
    <input type="checkbox" id="water-damage" name="water_damage" value="yes">
    <label for="water-damage">Water Damage</label><br>

    <input type="checkbox" id="physical-damage" name="physical_damage" value="yes">
    <label for="physical-damage">Physical Damage</label><br><br>

    <label for="description">Issue Description:</label><br>
    <textarea id="description" name="description" class="col-12" required></textarea><br><br>

    <input type="submit" value="Submit Ticket">
</form>
