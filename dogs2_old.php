<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:index.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:index.php');
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="dogs2_style.css">

   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

   <title>Dogs2</title>

</head>

<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>


   <header class="header">
      <a href="#" class="logo"><i class="fa-solid fa-paw">Pet shop</i></a>

      <nav class="navbar">
         <a href="homepage1.html">Home</a>
         <a href="cats.html">Cats</a>
         <a href="dogs.html">Dogs</a>
         <a href="register.html">Register</a>
         <a href="aboutus.html">About</a>
      </nav>

      <div class="icons">
         <a href="cart.html">
            <div class="fa fa-shopping-cart" id="cart-btn"></div>
         </a>
         <a href="login.html">
            <div class="fa fa-user" id="user-btn"></div>
         </a>
      </div>

   </header>



   <div class="container">



   <div class="user-profile">

   <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>

   <p> username : <span><?php echo $fetch_user['username']; ?></span> </p>
   <p> email : <span><?php echo $fetch_user['email']; ?></span> </p>
   <div class="flex">
      <a href="login.php" class="btn">login</a>
      <a href="register.php" class="option-btn">register</a>
      <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('are your sure you want to logout?');" class="delete-btn">logout</a>
   </div>

   </div>






      <button class="dry_dog_food">Dry Dog Food</button>
      <div id="div1" class="products-container">

         <div class="product" data-name="p-1">
            <img src="drools_puppy_food.jpg" alt="">
            <h3>Drools Dry Dog Food for Puppies - Chicken and Egg</h3>
            <div class="price">₹679</div>
         </div>

         <div class="product" data-name="p-2">
            <img src="himalayan_puppy_food.jpg" alt="">
            <h3>Himalaya Healthy Pet Food - Puppy - Chicken & Rice</h3>
            <div class="price">₹774</div>
         </div>

         <div class="product" data-name="p-3">
            <img src="royal_canin_german_puppy_food.jpg" alt="">
            <h3>Royal Canin German Shepherd Puppy Dry Dog Food </h3>
            <div class="price">₹864</div>
         </div>
         <div class="product" data-name="p-4">
            <img src="pedigree_puppy_food.jpg" alt="">
            <h3>Pedigree Puppy Dry Dog Food </h3>
            <div class="price">₹814</div>
         </div>


      </div>
      <br>
      <!-- wet dog food -->

      <button class="wet_dog_food">Wet Dog Food</button>
      <div id="div2" class="products-container">

         <div class="product" data-name="p-5">
            <img src="pedigree_wet_dog_food.jpg" alt="">
            <h3>Pedigree Puppy Wet Dog Food, Chicken Chunks in Gravy, 70 g</h3>
            <div class="price">₹675</div>
         </div>
         <div class="product" data-name="p-6">
            <img src="drools-puppy-wet-dog-food-real-chicken-chicken-liver-chunks-in-gravy.webp" alt="">
            <h3>Drools Wet Food for Puppies - Real Chicken and Chicken Liver Chunks in Gravy </h3>
            <div class="price">₹425</div>
         </div>
         <div class="product" data-name="p-7">
            <img src="Kennel Kitchen Wet Dog Food.webp" alt="">
            <h3>Kennel Kitchen Wet Dog Food - Chicken Chunks in Gravy (Pack of 12 x 70g Pouches) </h3>
            <div class="price">₹408</div>
         </div>






      </div>
      <br>

      <!-- toys -->
      <button class="dog_toys">Dog Toys</button>
      <div id="div3" class="products-container">
         <div class="product" data-name="p-8">
            <img src="chuckit_fetch_toy.jpg" alt="">
            <h3>Chuckit! Dog Toys - Kick Fetch Ball </h3>
            <div class="price">₹2750</div>
         </div>

         <div class="product" data-name="p-9">
            <img src="kong_goodie_bone.jpg" alt="">
            <h3>KONG Goodie Bone </h3>
            <div class="price">₹810</div>
         </div>
         <div class="product" data-name="p-10">
            <img src="petsport.webp" alt="">
            <h3>Petsport 4" Giant Tuff Ball (1pk) </h3>
            <div class="price">₹495</div>
         </div>
      </div>
      <br>
      <!-- dog accessories -->
      <button class="dog_accessories">Dog Accessories</button>
      <div id="div4" class="products-container">
         <div class="product" data-name="p-11">
            <img src="M-Pets_Dog_Collars.webp" alt="">
            <h3>M-Pets Dog Collars - Sportline Collar (Black)</h3>
            <div class="price">₹189</div>
         </div>
         <div class="product" data-name="p-12">
            <img src="ruffwear.webp" alt="">
            <h3>Ruffwear Harnesses for Dogs - Web Master</h3>
            <div class="price">₹5500</div>
         </div>
         <div class="product" data-name="p-13">
            <img src="leashes.webp" alt="">
            <h3>For The Love Of Dogs - Extra Long Leashes </h3>
            <div class="price">₹1200</div>
         </div>
      </div>
      <br>
      <!-- carriers & travel -->
      <button class="carriers_travel">Carriers & Travel</button>
      <div id="div5" class="products-container">
         <div class="product" data-name="p-14">
            <img src="Savic_Trotter.webp" alt="">
            <h3>Savic Trotter 1 Pet Carrier - Holds up to 5kg </h3>
            <div class="price">₹2115</div>
         </div>

         <div class="product" data-name="p-15">
            <img src="backpack.webp" alt="">
            <h3>Trixie Dan Backpack Pet Carrier </h3>
            <div class="price">₹5095</div>
         </div>

         <div class="product" data-name="p-16">
            <img src="m-pet_stroller.webp" alt="">
            <h3>M-Pets Aventura Pet Stroller (Black) </h3>
            <div class="price">₹21,149</div>
         </div>
      </div>





      <div class="products-preview">

         <div class="preview" data-target="p-1">
            <i class="fas fa-times"></i>
            <img src="drools_puppy_food.jpg" alt="">
            <h3>Drools Dry Dog Food for Puppies - Chicken and Egg</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 150 )</span>
            </div>
            <div class="price">₹679</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-2">
            <i class="fas fa-times"></i>
            <img src="himalayan_puppy_food.jpg" alt="">
            <h3>Himalaya Healthy Pet Food - Puppy - Chicken & Rice</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 50 )</span>
            </div>
            <div class="price">₹774</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-3">
            <i class="fas fa-times"></i>
            <img src="royal_canin_german_puppy_food.jpg" alt="">
            <h3>Royal Canin German Shepherd Puppy Dry Dog Food</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹864</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-4">
            <i class="fas fa-times"></i>
            <img src="pedigree_puppy_food.jpg" alt="">
            <h3>Pedigree Puppy Dry Dog Food</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 100 )</span>
            </div>
            <div class="price">₹814</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-5">
            <i class="fas fa-times"></i>
            <img src="pedigree_wet_dog_food.jpg" alt="">
            <h3>Pedigree Puppy Wet Dog Food, Chicken Chunks In Gravy, 70 G</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹675</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-6">
            <i class="fas fa-times"></i>
            <img src="drools-puppy-wet-dog-food-real-chicken-chicken-liver-chunks-in-gravy.webp" alt="">
            <h3>Drools Wet Food For Puppies - Real Chicken And Chicken Liver Chunks In Gravy</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹425</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>


         <div class="preview" data-target="p-7">
            <i class="fas fa-times"></i>
            <img src="Kennel Kitchen Wet Dog Food.webp" alt="">
            <h3>Kennel Kitchen Wet Dog Food - Chicken Chunks In Gravy (Pack Of 12 X 70g Pouches)</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹408</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-8">
            <i class="fas fa-times"></i>
            <img src="chuckit_fetch_toy.jpg" alt="">
            <h3>Chuckit! Dog Toys - Kick Fetch Ball</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹2750</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-9">
            <i class="fas fa-times"></i>
            <img src="kong_goodie_bone.jpg" alt="">
            <h3>KONG Goodie Bone</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹810</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-10">
            <i class="fas fa-times"></i>
            <img src="petsport.webp" alt="">
            <h3>Petsport 4" Giant Tuff Ball (1pk)</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹495</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-11">
            <i class="fas fa-times"></i>
            <img src="M-Pets_Dog_Collars.webp" alt="">
            <h3>M-Pets Dog Collars - Sportline Collar (Black)</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹189</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-12">
            <i class="fas fa-times"></i>
            <img src="ruffwear.webp" alt="">
            <h3>Ruffwear Harnesses For Dogs - Web Master</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹5500</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-13">
            <i class="fas fa-times"></i>
            <img src="leashes.webp" alt="">
            <h3>For The Love Of Dogs - Extra Long Leashes</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹1200</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-14">
            <i class="fas fa-times"></i>
            <img src="Savic_Trotter.webp" alt="">
            <h3>Savic Trotter 1 Pet Carrier - Holds Up To 5kg</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹2115</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-15">
            <i class="fas fa-times"></i>
            <img src="backpack.webp" alt="">
            <h3>Trixie Dan Backpack Pet Carrier </h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹5095</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

         <div class="preview" data-target="p-16">
            <i class="fas fa-times"></i>
            <img src="m-pet_stroller.webp" alt="">
            <h3>M-Pets Aventura Pet Stroller (Black) </h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
               <span>( 250 )</span>
            </div>
            <div class="price">₹21,149</div>
            <div class="buttons">
               <a href="#" class="buy">buy now</a>
               <a href="cart.html" class="cart">add to cart</a>
            </div>
         </div>

      </div>

      <script src="dogs2_script.js" defer></script>

</body>

</html>