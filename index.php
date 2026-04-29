<?php
// 1. DATABASE CONNECTION (The Bridge)
$conn = mysqli_connect("localhost", "root", "", "donation_db");

// 2. SAVING DATA (The Brains)
if(isset($_POST['submit'])) {
    $food = $_POST['food'];
    $qty = $_POST['qty'];
    $phone = $_POST['phone'];
    
    // This sends the data to your MySQL table
    $query = "INSERT INTO donations (food_item, quantity, phone) VALUES ('$food', '$qty', '$phone')";
    mysqli_query($conn, $query);
    echo "<h3 style='color:green;'>✅ Success! Your item has been listed.</h3>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>SDG Project - Food Share</title>
    <style>
        body { font-family: Arial; margin: 40px; background-color: #f4f4f4; }
        .container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px #ccc; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        button { background: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer; width: 100%; font-size: 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #28a745; color: white; }
    </style>
</head>
<body>

<div class="container">
    <h1>🌍 SDG 2: Zero Hunger Portal</h1>
    <p>Use this form to share extra food with people in need.</p>

    <form method="POST">
        <label>Food Item Name:</label>
        <input type="text" name="food" placeholder="e.g. 5 Boxes of Pasta" required>
        
        <label>Quantity:</label>
        <input type="text" name="qty" placeholder="e.g. 2 KG" required>
        
        <label>Your Phone:</label>
        <input type="text" name="phone" placeholder="Enter phone number" required>
        
        <button type="submit" name="submit">Post Donation</button>
    </form>

    <hr>

    <h2>Current Donations</h2>
    <table>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Contact</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM donations ORDER BY id DESC");
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['food_item'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>