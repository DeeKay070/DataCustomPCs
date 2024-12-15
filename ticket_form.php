<form id="ticketForm" action="submit_ticket.php" method="post">
    <label for="name">Name*</label><br>
    <input type="text" id="name" name="name" class="form-control" required>
    <br>

    <label for="email">Email*</label><br>
    <input type="email" id="email" name="email" class="form-control" required>
    <br>

    <label for="phone_number">Phone Number*</label><br>
    <input type="tel" id="phone_number" name="phone_number" class="form-control" required>
    <br>

    <label>Type of Device*</label><br>
    <div>
        <input type="radio" id="windows" name="device_type" value="Windows" required>
        <label for="windows">Windows Computer</label><br>
        <input type="radio" id="phone" name="device_type" value="Phone">
        <label for="phone">Mobile Phone</label><br>
        <input type="radio" id="console" name="device_type" value="Console">
        <label for="console">Console</label><br>
        <input type="radio" id="macbook" name="device_type" value="MacBook">
        <label for="macbook">MacBook</label><br>
        <input type="radio" id="other" name="device_type" value="Other">
        <label for="other">Other</label>
    </div>
    <br>

    <div id="other-info-container">
        <label for="other_info">If you check other, what device are you needing help with?</label><br>
        <input type="text" id="other_info" name="other_info" class="form-control"><br>
    </div>

    <label>Damage Information (if applicable)</label><br>
    <div>
        <input type="checkbox" id="water-damage" name="water_damage" value="yes">
        <label for="water-damage">Water Damage</label><br>
        <input type="checkbox" id="physical-damage" name="physical_damage" value="yes">
        <label for="physical-damage">Physical Damage</label>
    </div><br>

    <label for="description">Request Description*</label><br>
    <textarea id="description" name="description" class="col-12 form-control p-3" rows="10" required></textarea>
    <br><br>

    <input type="submit" value="Submit Ticket" class="btn btn-primary">
</form>
<script>
    const deviceTypeRadios = document.getElementsByName('device_type');
        const otherInfoContainer = document.getElementById('other-info-container');

        deviceTypeRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.id === 'other' && this.checked) {
                    otherInfoContainer.style.display = 'block';
                } else {
                    otherInfoContainer.style.display = 'none';
                }
            });
        });
</script>
