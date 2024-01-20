<?php

include 'config.php';
// Ensure that the necessary database connection is established
include 'admin_header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $brand_name = $_POST['brand_name'];
    $brand_description = $_POST["brand_description"];
    $brand_country = $_POST['brand_country'];

    // Validate the form data (you can add more validation if needed)

    // Insert the data into the Brands table
    // Assuming you have a database connection established, adjust the query accordingly
    $query = "INSERT INTO Brands (brand_name, brand_description, brand_country)
              VALUES ('$brand_name', '$brand_description', '$brand_country')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
      echo "New brand added successfully!";
      
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    header('location:add_clothing_item_form.php');

    // Close the database connection (if you have not already done so)
    mysqli_close($conn);

}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Brand</title>
</head>
<body>
  
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

    <section class="add-brand">
    <h1  class="title">Add New Brand</h1>
    <div class="box-container">
    <form action="" method="post" enctype="multipart/form-data">
        <h3 class="sub">ADD BRAND</h3>
    <div class="box">
        
        <input type="text" name="brand_name" placeholder="enter brand name" class="box" required><br>
        <textarea name="brand_description"placeholder="enter brand description" class="box"></textarea><br>
        <input type="text" name="brand_country"placeholder="enter brand country" class="box"><br>
        <input type="submit" value="Add Brand" name="add_product" class="btn">
    </div>
    </form>
    </div>
</section>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>
</html>
