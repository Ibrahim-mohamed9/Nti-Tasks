<!DOCTYPE html>
<html>
<head>
    <title>E-commerce Checkout</title>
</head>
<body>

    <form method="POST" action="">
        <label>Product Price:</label>
        <input type="text" name="price" required><br><br>
        
        <label>Quantity:</label>
        <input type="text" name="qty" required><br><br>
        
        <button type="submit">Calculate Invoice</button>
    </form>

    <hr>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $price = $_POST['price'];
        $qty = $_POST['qty'];

        if (!is_numeric($price) || !is_numeric($qty)) {
            echo "<h3 style='color:red;'>Error: Please enter valid numbers only, no letters!</h3>";
        } 
        elseif ($price < 0 || $qty < 0) {
            echo "<h3 style='color:red;'>Error: Negative numbers are not allowed, bro!</h3>";
        } 
        else {
            $total_before = $price * $qty;
            $discount_percentage = 0;

            if ($total_before < 1000) {
                $discount_percentage = 0.10; 
            } elseif ($total_before > 1000) {
                $discount_percentage = 0.15;
            }

            $discount_value = $total_before * $discount_percentage;
            $total_after = $total_before - $discount_value;

            echo "<h3>Total before discount: EGP " . $total_before . "</h3>";
            echo "<h3>Discount applied: " . ($discount_percentage * 100) . "%</h3>";
            echo "<h3>Total after discount: EGP " . $total_after . "</h3>";
        }
    }
    ?>

</body>
</html>