<?php 
include 'config.php';
// Ensure that the necessary database connection is established
include 'admin_header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST["item_id"];

    // Process uploaded image
    $target_dir = "uploaded_img/"; // Change this path to your desired directory for storing uploaded images
    $target_file = $target_dir . uniqid() . "-"  . basename($_FILES["image_upload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the image file is a actual image or fake image
    $check = getimagesize($_FILES["image_upload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, the file already exists.";
        $uploadOk = 0;
    }

    // Check file size (adjust the max file size as needed)
    if ($_FILES["image_upload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // If $uploadOk is set to 0 by an error, do not upload the file
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // If everything is ok, try to upload the file
    } else {
        if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["image_upload"]["name"]) . " has been uploaded.";

            // Save the image information to the database
            // Assuming you have a database connection established, adjust the query accordingly
            $query = "INSERT INTO ClothingImages (item_id, image_url) VALUES ('$item_id', '$target_file')";
            if (mysqli_query($conn, $query)) {
                echo "Image data saved to the database.";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Clothing Image</title>
</head>
<body>
     <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">
 
    <section class="image">
        <h1 class="title"> Clothing Image</h1>
            <div class="box-container">
                <form action="" method="post" enctype="multipart/form-data">
                   <h3 class="a"> ADD IMAGE</h3>
                        <select id="item_id" name="item_id" class= "box" required>
                        <option value="">Select an item</option>
                       <?php
                            // Ensure that the necessary database connection is established

                            // Fetch clothing items from the ClothingItems table    
                            $query = "SELECT item_id, item_name FROM ClothingItems";
                            $result = mysqli_query($conn, $query);

                            // Generate options for the dropdown
                             if (mysqli_num_rows($result) > 0) {
                             while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['item_id'] . "'>" . $row['item_name'] . "</option>";
                                }
                            }
                            // Close the result set
                            mysqli_free_result($result);
                        ?>
                        </select><br>
                        <input type="file" id="image_upload" name="image_upload" class="box" required><br>
                        <input type="submit" value="Add Image" class= "btn">
                 
                </form>
            </div>
    </section>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>
</html>
