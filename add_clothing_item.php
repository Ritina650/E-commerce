<?php

include 'config.php';
// Ensure that the necessary database connection is established yo haina!!!11

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $item_name = $_POST["item_name"];
    $item_description = $_POST["item_description"];
    $price = $_POST["price"];
    $size = $_POST["size"];
    $color = $_POST["color"];
    $material = $_POST["material"];
    $category_id = $_POST["category_id"];
    $brand_id = $_POST["brand_id"];
    // Validate the form data (you can add more validation if needed)

    // Insert the data into the ClothingItems table
    // Assuming you have a database connection established, adjust the query accordingly
    $query = "INSERT INTO ClothingItems (item_name, item_description, price, size, color, material, category_id, brand_id)
              VALUES ('$item_name', '$item_description', $price, '$size', '$color', '$material', $category_id, $brand_id)";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "New clothing item added successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    header('location:add_clothing_image_form.php');
    // Close the database connection (if you have not already done so)
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Clothing Item</title>
</head>
<body>
    <h1>Add New Clothing Item</h1>
    <form action="add_clothing_item.php" method="post">
        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" required><br>

        <label for="item_description">Item Description:</label>
        <textarea id="item_description" name="item_description"></textarea><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <label for="size">Size:</label>
        <input type="text" id="size" name="size"><br>

        <label for="color">Color:</label>
        <input type="text" id="color" name="color"><br>

        <label for="material">Material:</label>
        <input type="text" id="material" name="material"><br>

        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            <option value="">Select a category</option>
            <?php
            // Ensure that the necessary database connection is established

            // Fetch categories from the Categories table
            $query = "SELECT category_id, category_name FROM Categories";
            $result = mysqli_query($conn, $query);

            // Generate options for the dropdown
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                }
            }

            // Close the result set
            mysqli_free_result($result);
            ?>
        </select><br>

        <label for="brand_id">Brand:</label>
        <select id="brand_id" name="brand_id" required>
            <option value="">Select a brand</option>
            <?php
            // Fetch brands from the Brands table
            $query = "SELECT brand_id, brand_name FROM Brands";
            $result = mysqli_query($conn, $query);

            // Generate options for the brand dropdown
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['brand_id'] . "'>" . $row['brand_name'] . "</option>";
                }
            }

            // Close the result set
            mysqli_free_result($result);
            ?>
        </select><br>

        <input type="submit" value="Add Item">
    </form>
</body>
</html>
