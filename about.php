<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>About us</h3>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">

         <p>
         At Mimik Traders, we believe that fashion is not just about clothing,it's a form of self-expression.
         We are dedicated to supporting eco-friendly and fair-trade practices,knowing that your purchase contributes to a more 
         sustainable future.Whether you visit us in-store or explore our online boutique, you'll find an extensive 
         range of clothing options. We constantly update our inventory to stay ahead of the fashion curve, ensuring 
         that you're always up-to-date with the latest trends.
         Embrace your uniqueness with our exceptional collection of clothing.Thank you for choosing us as your fashion destination. 
         We look forward to providing you with an exceptional shopping experience and being a part of your fashion story.
         </br> Welcome to Mimik Traders - Where Style Meets You!
         </p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>