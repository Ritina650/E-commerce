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
    <title>List of Clothing Items</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
    <div class="heading">

        <h3>List of Clothing</h3>
    </div>
    <div class="list">
        <div class="box-container">
            
            <?php
                // Fetch clothing items from the ClothingItems table
                $query = "SELECT * FROM ClothingItems";
                $result = mysqli_query($conn, $query);

                // Check if there are any results
                if (mysqli_num_rows($result) > 0) {
                // Loop through the results and display each item
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="box">
            <a href="item_details.php?item_id=<?php echo $row['item_id']?>">
            <h2><?php echo $row['item_name']; ?></h2>    
            </a>
            <?php
                echo "<p>Description: " . $row['item_description'] . "</p>";
                echo "<p>Price: Rs." . $row['price'] . "</p>";
                echo "<p>Size: " . $row['size'] . "</p>";
                echo "<p>Color: " . $row['color'] . "</p>";
                echo "<p>Material: " . $row['material'] . "</p>";
                // Add more details as needed
                echo "<hr>
                </div>
                ";
                 }
                } else{
                        echo "No clothing items found.";
                    }
            ?>

        </div>
    </div>
    <?php
    // Close the result set
    mysqli_free_result($result);
    ?>
    <?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
