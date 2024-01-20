<?php

include 'config.php';

// Ensure that the necessary database connection is established
include 'admin_header.php';

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
    //mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Clothing Item</title>
    
</head>
<body>
    
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom admin css file link  -->
<link rel="stylesheet" href="css/admin_style.css">
    <section class="clothing">
        <h1 class="title">Add Clothing Item</h1>
        <div class="box-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h3 class="h3">ADD ITEM</h3>
                <div class="box">
                    <input type="text" id="item_name" name="item_name"placeholder="enter item name" class="box"required><br>
                    <textarea id="item_description" name="item_description" placeholder="enter item description" class="box"></textarea><br>
                    <input type="number" id="price" name="price" step="0.01" placeholder="enter price" class="box" required><br>
                    <input type="text" id="size" name="size" placeholder="enter size" class="box"><br>
                    <input type="text" id="color" name="color" placeholder="enter color" class="box"><br>
                    <input type="text" id="material" name="material" placeholder="enter material" class="box"><br>
                    <select id="category_id" name="category_id"  class="box" required>
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
                    <!--<label for="brand_id">Brand:</label>-->
                    <select id="brand_id" name="brand_id" class="box" required>
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

                    <input type="submit" value="Add Item"  class="btn">
                </div>
            </form>
        </div>
    </section>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>
</html>
