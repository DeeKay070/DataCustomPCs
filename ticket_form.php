<form id="ticketForm" action="submit_ticket.php" method="post" novalidate>
    <label for="name">Your Name*:</label><br>
    <input type="text" id="name" name="name" class="form-control" required>
    <small class="error-message" id="name-error"></small><br>

    <label for="email">Your Email*:</label><br>
    <input type="email" id="email" name="email" class="form-control" required>
    <small class="error-message" id="email-error"></small><br>

    <label for="phone_number">Your Phone Number*:</label><br>
    <input type="tel" id="phone_number" name="phone_number" class="form-control" required>
    <small class="error-message" id="phone-error"></small><br>

    <label>Type of Device Affected*:</label><br>
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
    <small class="error-message" id="device-error"></small><br>

    <div id="other-info-container">
        <label for="other_info">If you check other, what device are you needing help with?:</label><br>
        <input type="text" id="other_info" name="other_info" class="form-control"><br>
    </div>

    <label>Damage Information (if applicable):</label><br>
    <div>
        <input type="checkbox" id="water-damage" name="water_damage" value="yes">
        <label for="water-damage">Water Damage</label><br>
        <input type="checkbox" id="physical-damage" name="physical_damage" value="yes">
        <label for="physical-damage">Physical Damage</label>
    </div><br>

    <label for="description">Issue Description*:</label><br>
    <textarea id="description" name="description" class="col-12 form-control p-3" rows="10" required></textarea>
    <small class="error-message" id="description-error"></small><br><br>

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
    document.getElementById('ticketForm').addEventListener('submit', function (event) {
        let hasErrors = false;
        let firstErrorField = null;

        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(error => error.textContent = '');
        document.querySelectorAll('.form-control').forEach(input => input.classList.remove('error-input'));

        // Validate Name
        const nameInput = document.getElementById('name');
        if (!nameInput.value.trim()) {
            document.getElementById('name-error').textContent = 'Name is required.';
            nameInput.classList.add('error-input');
            if (!firstErrorField) firstErrorField = nameInput;
            hasErrors = true;
        }

        // Validate Email
        const emailInput = document.getElementById('email');
        if (!emailInput.value.trim()) {
            document.getElementById('email-error').textContent = 'Email is required.';
            emailInput.classList.add('error-input');
            if (!firstErrorField) firstErrorField = emailInput;
            hasErrors = true;
        }

        // Validate Phone Number
        const phoneInput = document.getElementById('phone_number');
        if (!phoneInput.value.trim()) {
            document.getElementById('phone-error').textContent = 'Phone number is required.';
            phoneInput.classList.add('error-input');
            if (!firstErrorField) firstErrorField = phoneInput;
            hasErrors = true;
        }

        // Validate Device Type
        const deviceTypeInputs = document.getElementsByName('device_type');
        const isDeviceTypeSelected = Array.from(deviceTypeInputs).some(input => input.checked);
        if (!isDeviceTypeSelected) {
            document.getElementById('device-error').textContent = 'Please select a device type.';
            if (!firstErrorField) firstErrorField = document.getElementById('windows');
            hasErrors = true;
        }

        // Validate Issue Description
        const descriptionInput = document.getElementById('description');
        if (!descriptionInput.value.trim()) {
            document.getElementById('description-error').textContent = 'Issue description is required.';
            descriptionInput.classList.add('error-input');
            if (!firstErrorField) firstErrorField = descriptionInput;
            hasErrors = true;
        }

        // Scroll to the first error field
        if (hasErrors) {
            event.preventDefault();
            firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstErrorField.focus();
        }
    });
</script>
