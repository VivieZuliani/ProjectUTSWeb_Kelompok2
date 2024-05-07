<?php
require_once('includes/load.php');

// Mengambil data dari formulir
$customer_name = $db->escape($_POST['customer_name']);
$address = $db->escape($_POST['address']);
$phone_number = $db->escape($_POST['phone_number']);
$order_number = $db->escape($_POST['order_number']);
$order_date = $db->escape($_POST['order_date']);
$payment_method = $db->escape($_POST['payment_method']);

// Query untuk menambahkan data invoice ke dalam database
$sql_invoice = "INSERT INTO invoices (customer_name, address, phone_number, order_number, order_date, payment_method)
                VALUES ('$customer_name', '$address', '$phone_number', '$order_number', '$order_date', '$payment_method')";

if ($db->query($sql_invoice)) {
    $invoice_id = $db->insert_id(); // Mengambil ID invoice yang baru saja dimasukkan

    // Mengambil data produk, jumlah, dan harga dari formulir
    $products = $_POST['products'];
    $quantities = $_POST['quantities'];
    $prices = $_POST['prices'];

    // Menambahkan data produk ke dalam tabel invoice_items
    for ($i = 0; $i < count($products); $i++) {
        $product_name = $db->escape($products[$i]);
        $quantity = $db->escape($quantities[$i]);
        $price = $db->escape($prices[$i]);

        $sql_product = "INSERT INTO invoice_items (invoice_id, product_name, quantity, price)
                        VALUES ('$invoice_id', '$product_name', '$quantity', '$price')";

        $db->query($sql_product);
    }

    // Setelah berhasil menambahkan data, arahkan pengguna ke halaman invoice.php
    header("Location: invoice.php");
    exit();
} else {
    echo "Error: " . $sql_invoice . "<br>" . $db->error;
}
?>
