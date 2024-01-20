<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Item Details</title>
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    // Ensure that the necessary database connection is established
    include 'header.php';
    ?>
    <div class="heading">
   <h3>your orders</h3>
</div>

<div class="list">
    <div class="box-container">


<?php

    if (isset($_GET['item_id'])) {

        $item_id = $_GET['item_id'];

        // Fetch the clothing item details from the ClothingItems table
        // Assuming you have a database connection established, adjust the query accordingly
        $query = "SELECT * FROM ClothingItems WHERE item_id = $item_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $item = mysqli_fetch_assoc($result);
            ?>
            <div class="box">

            <?php
            echo "<h1>" . $item['item_name'] . "</h1>";
            echo "<p>Description: " . $item['item_description'] . "</p>";
            echo "<p>Price: Rs." . $item['price'] . "</p>";
            echo "<p>Size: " . $item['size'] . "</p>";
            echo "<p>Color: " . $item['color'] . "</p>";
            echo "<p>Material: " . $item['material'] . "</p>";

            // Fetch the respective images from the ClothingImages table
            // Assuming you have a database connection established, adjust the query accordingly
            $query_images = "SELECT image_url FROM ClothingImages WHERE item_id = $item_id";
            $result_images = mysqli_query($conn, $query_images);

            if (mysqli_num_rows($result_images) > 0) {
                echo "<h2>Images</h2>";
                while ($image = mysqli_fetch_assoc($result_images)) {
                    echo "<img src='" . $image['image_url'] . "' alt='Item Image'><br>";
                }
            } else {
                echo "No images found for this item.";
            }
            ?>
                </div>
            <?php
        } else {
            echo "Item not found.";
        }

        // Close the result set
        mysqli_free_result($result);
        mysqli_free_result($result_images);
    } else {
        echo "Invalid item ID.";
    }
    ?>
        </div>
</div>
    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>
</html>
