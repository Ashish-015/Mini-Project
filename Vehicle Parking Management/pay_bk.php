<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dummy Payment Gateway</title>
    <script src="path/to/qrious.min.js"></script>
    <style>
        body {
            font-family: 'Amazon Ember', Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            color: #111;
        }

        h2 {
            color: #111;
            text-align: center;
            margin-top: 20px;
        }

        #payment-options-container {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            justify-content: center;
        }

        button {
            background-color: #ff9900;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e68a00;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            text-align: center;
            border-radius: 4px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button[type="button"] {
            background-color: #007185;
            transition: background-color 0.3s;
        }

        button[type="button"]:hover {
            background-color: #005b6e;
        }

        #timer-container {
            margin-top: 10px;
            font-size: 18px;
            color: #007185;
        }

        #success-message {
            color: #008000;
        }

        #transaction-complete-popup {
            color: #008000;
        }

        #transaction-complete-popup span {
            font-size: 48px;
        }

        #random-qr-image {
            width: 200px;
            height: 200px;
            margin: 10px auto;
        }

        #qr-timer {
            display: none;
            margin-top: 10px;
            font-size: 18px;
            color: #007185;
        }
    </style>
</head>
<body>

<h2>Payment Details</h2>

<form action="process_payment.php" method="post" id="payment-form">
    <div id="payment-options-container">
        <button type="button" onclick="showPaymentDetails('card')">Online Payment</button>
        <button type="button" onclick="showPaymentDetails('upi')">UPI</button>
        <button type="button" onclick="showPaymentDetails('cash')">Pay with Cash</button>
    </div>

    <div id="payment-details-container" style="text-align: center; display: none;"></div>
</form>

<!-- Popup for card details -->
<div id="card-details-popup" class="popup">
    <h3>Enter Card Details</h3>
    <label for="card_number">Card Number:</label>
    <input type="text" id="card_number" name="card_number" placeholder="Enter card number" required>
    <br>
    <label for="expiry_date">Expiry Date:</label>
    <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YYYY" required>
    <br>
    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" placeholder="CVV" required>
    <br>
    <button type="button" onclick="validateCardDetails()">Pay Now</button>
</div>

<!-- Popup for QR code -->
<div id="qr-code-popup" class="popup">
    <h3>Scan QR Code</h3>
    <div id="qr-code-container">
        <a href="https://tse3.mm.bing.net/th?id=OIP.GtEo127m_vzHw4SOcz0B6gHaHa&pid=Api&P=0&h=220" target="_blank">
            <img id="random-qr-image" src="https://tse3.mm.bing.net/th?id=OIP.GtEo127m_vzHw4SOcz0B6gHaHa&pid=Api&P=0&h=220" alt="Random QR Image">
        </a>
    </div>
    <br>
    <div id="qr-timer" style="display: none;"></div>
</div>

<!-- Popup for cash payment -->
<div id="cash-popup" class="popup">
    <h3>Transaction Processing...</h3>
</div>

<!-- Popup for transaction in process -->
<div id="transaction-process-popup" class="popup">
    <h3>Transaction in process...</h3>
    <div id="process-timer" style="font-size: 18px; color: #007185;"></div>
</div>

<!-- Popup for transaction complete -->
<div id="transaction-complete-popup" class="popup">
    <h3 id="success-message">Transaction completed <span>&#10004;</span></h3>
</div>

<!-- Overlay for popups -->
<div id="overlay" style="display: none;" onclick="closePopups()"></div>

<script>
    function showPaymentDetails(paymentMethod) {
        var paymentDetailsContainer = document.getElementById('payment-details-container');

        // Hide the payment details container by default
        paymentDetailsContainer.style.display = 'none';

        if (paymentMethod === 'card') {
            // Display the card details popup
            document.getElementById('card-details-popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        } else if (paymentMethod === 'upi') {
            // Display the QR code popup
            document.getElementById('qr-code-popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';

            // Generate and display the QR code
            generateQRCode();
        } else if (paymentMethod === 'cash') {
            // Display the cash payment popup
            document.getElementById('cash-popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';

            // Simulate a redirect and display success message after 2 seconds
            setTimeout(function() {
                document.getElementById('cash-popup').style.display = 'none';
                document.getElementById('overlay').style.display = 'none';
                document.getElementById('transaction-process-popup').style.display = 'block';

                // Start the timer for 15 seconds on "Transaction in process" popup
                startTimer(15, 'process-timer', function() {
                    document.getElementById('transaction-process-popup').style.display = 'none';
                    document.getElementById('overlay').style.display = 'none';
                    document.getElementById('transaction-complete-popup').style.display = 'block';

                    // Close the popup after 5 seconds on "Transaction Complete" popup
                    setTimeout(function() {
                        document.getElementById('transaction-complete-popup').style.display = 'none';
                        document.getElementById('overlay').style.display = 'none';
                    }, 5000);
                });
            }, 2000);
        }
    }

    function closePopups() {
        document.getElementById('card-details-popup').style.display = 'none';
        document.getElementById('qr-code-popup').style.display = 'none';
        document.getElementById('cash-popup').style.display = 'none';
        document.getElementById('transaction-process-popup').style.display = 'none';
        document.getElementById('transaction-complete-popup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    function validateCardDetails() {
        // Implement card details validation logic here
        // For simplicity, assume validation passes
        document.getElementById('card-details-popup').style.display = 'none';
        document.getElementById('transaction-process-popup').style.display = 'block';

        // Start the timer for 15 seconds on QR popup
        startTimer(15, 'qr-timer', function() {
            document.getElementById('qr-code-popup').style.display = 'none';

            // Display "Transaction in process" message after 10 seconds
            setTimeout(function() {
                document.getElementById('transaction-process-popup').style.display = 'none';
                document.getElementById('overlay').style.display = 'none';
            }, 10000);

            // Display "Transaction complete" message after 6 seconds
            setTimeout(function() {
                document.getElementById('transaction-complete-popup').style.display = 'block';

                // Close the popup after 5 seconds
                setTimeout(function() {
                    document.getElementById('transaction-complete-popup').style.display = 'none';
                    document.getElementById('overlay').style.display = 'none';
                }, 5000);
            }, 6000);
        });
    }

    function generateQRCode() {
        var upiCode = "dummyupicode"; // Replace with your actual UPI code
        var qrCodeContainer = document.getElementById('qr-code-container');

        // Clear any existing content in the container
        qrCodeContainer.innerHTML = '';

        // Use qrious library to generate QR code
        var qr = new QRious({
            element: qrCodeContainer,
            value: 'upi://' + upiCode,
            size: 200
        });

        // Start the timer for 15 seconds on QR popup
        startTimer(15, 'qr-timer', function() {
            document.getElementById('qr-code-popup').style.display = 'none';

            // Display "Transaction in process" message after 10 seconds
            setTimeout(function() {
                document.getElementById('transaction-process-popup').style.display = 'none';
                document.getElementById('overlay').style.display = 'none';
            }, 10000);

            // Display "Transaction complete" message after 6 seconds
            setTimeout(function() {
                document.getElementById('transaction-complete-popup').style.display = 'block';

                // Close the popup after 5 seconds
                setTimeout(function() {
                    document.getElementById('transaction-complete-popup').style.display = 'none';
                    document.getElementById('overlay').style.display = 'none';
                }, 5000);
            }, 6000);
        });
    }

    function initiateUpiPayment() {
        // Function not needed for UPI payment in this example
    }

    function startTimer(duration, timerId, callback) {
        var timer = duration;
        var timerContainer = document.getElementById(timerId);
        timerContainer.innerHTML = 'Time remaining: ' + timer + 's';

        var intervalId = setInterval(function() {
            timer--;

            if (timer >= 0) {
                timerContainer.innerHTML = 'Time remaining: ' + timer + 's';
            } else {
                clearInterval(intervalId);

                // Execute the callback function when the timer reaches zero
                if (typeof callback === 'function') {
                    callback();
                }
            }
        }, 1000);
    }
</script>

</body>
</html>




