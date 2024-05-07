<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            position: relative;
            min-height: 100vh;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-details {
            margin-bottom: 200px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
        }
        .right-align {
            text-align: right;
        }
        .add-invoice-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php

        require_once('includes/load.php');

        // Query untuk mengambil data invoice
        $sql_invoices = "SELECT * FROM invoices";
        $result_invoices = $db->query($sql_invoices);

        // Menampilkan data invoice
        if ($result_invoices->num_rows > 0) {
            while($row_invoice = $result_invoices->fetch_assoc()) {
                echo "<div class='invoice-header'>";
                echo "<h1>INVOICE</h1>";
                echo "</div>";
                echo "<div class='invoice-details'>";
				echo "<h3>Toko Kita Berempat</h3>";
                echo "<p>" . $row_invoice["customer_name"] . "<br>";
                echo $row_invoice["address"] . "<br>";
                echo $row_invoice["phone_number"] . "</p>";
                echo "<div class='right-align'>";
                echo "<p><span style='font-weight: bold;'>Order Number:</span> " . $row_invoice["order_number"] . "<br>";
                echo "<span style='font-weight: bold;'>Order Date:</span> " . formatDate($row_invoice["order_date"]) . "<br>";
                echo "<span style='font-weight: bold;'>Payment Method:</span> " . $row_invoice["payment_method"] . "</p>";
                echo "</div>";

                // Query untuk mengambil data produk pada invoice
                $invoice_id = $row_invoice["id"];
                $sql_products = "SELECT * FROM invoice_items WHERE invoice_id = $invoice_id";
                $result_products = $db->query($sql_products);

                // Menampilkan data produk pada invoice
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Product</th>";
                echo "<th>Quantity</th>";
                echo "<th>Price</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $subtotal = 0;
                while($row_product = $result_products->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_product["product_name"] . "</td>";
                    echo "<td>" . $row_product["quantity"] . "</td>";
                    echo "<td>Rp. " . number_format($row_product["price"], 0, ',', '.') . "</td>";
                    echo "</tr>";
                    $subtotal += $row_product["quantity"] * $row_product["price"];
                }
                echo "</tbody>";
                echo "<tfoot>";
                echo "<tr>";
                echo "<td colspan='2' class='total'>Sub Total</td>";
                echo "<td>Rp. " . number_format($subtotal, 0, ',', '.') . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td colspan='2' class='total'>Shipping</td>";
                echo "<td>Rp. 15.000</td>"; // Biaya pengiriman statis
                echo "</tr>";
                echo "<tr>";
                echo "<td colspan='2' class='total'>Kode Pembayaran</td>";
                echo "<td>332</td>"; // Kode pembayaran statis
                echo "</tr>";
                $total = $subtotal + 15000; // Total = Subtotal + Biaya pengiriman
                echo "<tr>";
                echo "<td colspan='2' class='total'>Total</td>";
                echo "<td>Rp. " . number_format($total, 0, ',', '.') . "</td>";
                echo "</tr>";
                echo "</tfoot>";
                echo "</table>";

                echo "</div>";
            }
        } else {
            echo "No invoices found";
        }

        // Fungsi untuk memformat tanggal
        function formatDate($date) {
            return date("F d, Y", strtotime($date));
        }
        ?>
    </div>
    <button class="add-invoice-button" onclick="window.location.href='add_invoice_form.php'">Add Invoice</button>
</body>
</html>
