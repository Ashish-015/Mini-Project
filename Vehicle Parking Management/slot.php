
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slot Booking System</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .slot-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            justify-content: center;
            display: none; /* Hide initially */
        }

        .slot-button {
            display: inline-block;
            padding: 15px;
            margin: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        .slot-button.selected {
            background-color: #FF0000;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #333;
        }

        input[type="datetime-local"] {
            margin-bottom: 10px;
            padding: 8px;
            transition: border 0.3s; /* Smooth transition for border */
        }

        input[type="datetime-local"].invalid {
            border: 2px solid #FF0000;
        }

        button {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        button:hover {
            background-color: #0056b3;
        }

        .info-label {
            font-weight: bold;
            margin-top: 10px;
            color: #333;
        }

        .info-text {
            color: #007BFF;
        }

        /* Position number of slots selected to the right corner */
        .selected-slots {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        /* Popup styling */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #007BFF;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            text-align: center;
            border-radius: 10px;
            width: 300px;
        }

        .popup h3 {
            color: #007BFF;
        }

        .popup label {
            margin-top: 10px;
            display: block;
            color: #333;
            text-align: left;
        }

        .popup input {
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .popup button {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .popup button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>Available Slots</h2>

<form action="book_slots.php" method="post">
    <!-- Date and Time Pickers at the top -->
    <label for="search_date">Select Date and Time:</label>
    <input type="datetime-local" id="search_date" name="search_date" onchange="validateDateTimeInput()">
    <button type="button" onclick="searchSlots()">Search</button>

    <!-- Display the number of slots selected in the right corner -->
    <div id="selected-slots" class="selected-slots">Slots Selected: 0</div>

    <!-- Display the selected slot ID -->
    <label class="info-label" for="selected_slot_label">Selected Slot ID:</label>
    <label id="selected_slot_label" class="info-text"></label>

    <!-- Slot buttons container with a 5x5 matrix -->
    <div class="slot-container" id="slot-container">
        <?php
        // PHP code to fetch the number of slots from the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vpm";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch number of slots from the database
        $sql = "SELECT slot_id FROM slots";
        $result = $conn->query($sql);

        // Display slots
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $slotId = $row["slot_id"];
                echo '<button type="button" class="slot-button" onclick="selectSlot(' . $slotId . ')" id="slot' . $slotId . '">Slot ' . $slotId . '</button>';
            }
        } else {
            echo "No slots available.";
        }

        $conn->close();
        ?>
    </div>

    <input type="hidden" name="selected_slot" id="selected_slot">
    <br>

    <!-- Book Slots button -->
    <button type="button" id="book-slots-button" disabled onclick="showPopup()">Book Slots</button>

    <!-- Popup for duration and price -->
    <div id="duration-popup" class="popup">
        <h3>Select Duration</h3>
        <label for="duration">Duration (in hours):</label>
        <input type="number" id="duration" name="duration" min="1" max="24" oninput="updatePrice()" required>
        <br>
        <label for="price-per-hour">Price per Hour:</label>
        <span id="price-per-hour">&#8377; 30</span> <!-- Indian Rupee sign -->
        <br>
        <label for="total-price">Total Price:</label>
        <span id="total-price">&#8377; 0</span> <!-- Indian Rupee sign -->
        <br>
        <label for="slots-selected">Number of Slots Selected:</label>
        <span id="slots-selected">0</span>
        <br>
        <button type="button" onclick="bookSlots()">Book Now!</button>
    </div>
</form>

<script>
    var selectedSlots = [];
    var slotContainer = document.getElementById('slot-container');
    var bookSlotsButton = document.getElementById('book-slots-button');
    var selectedSlotField = document.getElementById('selected_slot');
    var selectedSlotLabel = document.getElementById('selected_slot_label');
    var selectedSlotsCount = document.getElementById('selected-slots');
    var durationPopup = document.getElementById('duration-popup');

    function selectSlot(slotId) {
        var slotButton = document.getElementById('slot' + slotId);
        var selectedSlotLabel = document.getElementById('selected_slot_label');
        var selectedSlotsCount = document.getElementById('selected-slots');

        // Toggle selected class to change color
        slotButton.classList.toggle('selected');

        // Update the hidden field with the selected slot ID
        if (slotButton.classList.contains('selected')) {
            selectedSlots.push(slotId);
        } else {
            selectedSlots = selectedSlots.filter(id => id !== slotId);
        }

        selectedSlotField.value = selectedSlots.join(',');

        // Update the selected slot ID label
        selectedSlotLabel.textContent = selectedSlots.join(', ');

        // Update the number of slots selected label in the right corner
        selectedSlotsCount.textContent = 'Slots Selected: ' + selectedSlots.length;

        // Enable/Disable the "Book Slots" button based on selection
        bookSlotsButton.disabled = selectedSlots.length === 0;
    }

    function validateDateTimeInput() {
        var input = document.getElementById('search_date');
        var selectedDate = new Date(input.value);
        var currentDate = new Date();

        // If the selected date and time is earlier than the current date and time
        if (selectedDate < currentDate) {
            input.classList.add('invalid'); // Add the 'invalid' class to highlight the input
            return false;
        } else {
            input.classList.remove('invalid'); // Remove the 'invalid' class if it was previously added
            return true;
        }
    }

    function searchSlots() {
        // Validate the date and time input before proceeding
        if (validateDateTimeInput()) {
            var searchDate = document.getElementById('search_date').value;

            // Show the slot container when a date and time are selected
            slotContainer.style.display = 'grid';
        } else {
            // Display an error message or take appropriate action for invalid date and time
            alert('Please select a date and time equal to or later than the current date and time.');
        }
    }

    function showPopup() {
        durationPopup.style.display = 'block';
        updatePrice();
    }

    function updatePrice() {
        var duration = parseFloat(document.getElementById('duration').value);
        var pricePerHour = 30; // Default price per hour
        var totalPrice = pricePerHour * duration * selectedSlots.length;

        // Update the total price label
        document.getElementById('total-price').textContent = '\u20B9 ' + totalPrice.toFixed(2); // Indian Rupee sign

        // Update the number of slots selected label in the popup
        document.getElementById('slots-selected').textContent = selectedSlots.length;
    }

    function bookSlots() {
        // Implement logic to book the selected slots for the specified duration
        // You can submit the form or perform any other necessary actions here
        window.location.href="pay_bk.php";
        // For now, let's close the popup
        durationPopup.style.display = 'none';
    }
</script>

</body>
</html>




   
