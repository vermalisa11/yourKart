<?php
    include '../../config.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location : ../loginsystemUsers/index.php");
    }
    
    $user = $_SESSION['uid'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="stylecart/cart.css">
    <script src="stylecart/cart.js" charset="utf-8"></script>
    <title>Document</title>
</head>
<body>
    
  <h1>Shopping Cart</h1>

  <div class="shopping-cart">
  
    <div class="column-labels">
      <label class="product-image">Image</label>
      <label class="product-details">Product</label>
      <label class="product-price">Price</label>
      <label class="product-quantity">Quantity</label>
      <label class="product-removal">Remove</label>
      <label class="product-line-price">Total</label>
    </div>

    <?php 
        $sql = "SELECT * FROM products WHERE productid in(SELECT productid FROM cartproductrelation WHERE userid=$user)";
        $result = mysqli_query($conn, $sql);

        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>

    <?php  foreach($products as $product): 
        $image=$product['image'];    
    ?>
  
    <div class="product">
      <div class="product-image">
        <img src= '<?php echo "../../admin/myShop/images/$image" ?>'>
      </div>
      <div class="product-details">
        <div class="product-title"><?php echo $product['pname']; ?></div>
        <p class="product-description"><?php echo $product['description'];?></p>
      </div>
      <div class="product-price"><?php echo $product['price']; ?></div>
      <div class="product-quantity">
        <input type="number" value="2" min="1">
      </div>
      <div class="product-removal">
        <button class="remove-product">
          Remove
        </button>
      </div>
      <div class="product-line-price"><?php echo $product['price']; ?></div>
    </div>
  
    <?php endforeach?>
        
    <button class="checkout">Checkout</button>
  
  </div>

  </body>
</html>