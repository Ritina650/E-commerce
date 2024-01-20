<?php
    include 'config.php';
    // Ensure that the necessary database connection is established
    include 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>List of Categories</title>
    
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>List of Categories</h1>

    
    <?php
    // Fetch categories from the Categories table
    $query = "SELECT * FROM Categories";
    $result = mysqli_query($conn, $query);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Display the categories as links to their respective pages
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li><a href='list_clothing_by_category.php?category_id=" . $row['category_id'] . "'>" . $row['category_name'] . "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "No categories found.";
    }
    
    // Close the result set
    //mysqli_free_result($result);
    include 'footer.php';
    ?>
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
