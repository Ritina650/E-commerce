<?php

include 'config.php';

// Ensure that the necessary database connection is established

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $category_name = $_POST["category_name"];

    // Validate the form data (you can add more validation if needed)

    // Insert the data into the Categories table
    // Assuming you have a database connection established, adjust the query accordingly
    $query = "INSERT INTO Categories (category_name) VALUES ('$category_name')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "New category added successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Close the database connection (if you have not already done so)
    mysqli_close($conn);
}
?>
