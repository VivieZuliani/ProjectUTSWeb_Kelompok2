<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button[type="button"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        /* Style the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        /* Style table headers */
        th {
            background-color: #f2f2f2;
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        /* Style table cells */
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Invoice</h2>
        <form action="add_invoice.php" method="post">
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>
            <label for="order_number">Order Number:</label>
            <input type="text" id="order_number" name="order_number" required>
            <label for="order_date">Order Date:</label>
            <input type="date" id="order_date" name="order_date" required>
            <label for="payment_method">Payment Method:</label>
            <input type="text" id="payment_method" name="payment_method" required>
            
            <!-- Tambahkan entri untuk produk, jumlah, dan harga -->
            <h3>Products:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="products[]" required></td>
                        <td><input type="number" name="quantities[]" required></td>
                        <td><input type="text" name="prices[]" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="products[]" required></td>
                        <td><input type="number" name="quantities[]" required></td>
                        <td><input type="text" name="prices[]" required></td>
                    </tr>
                </tbody>
            </table>

            <input type="submit" value="Add Invoice">
    </div>
</body>
</html>