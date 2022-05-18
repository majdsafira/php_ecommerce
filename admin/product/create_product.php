<?php 
include_once('../../connection/conn.php');
//header include
include_once('../../headfoot/header.php');



if($_SERVER['REQUEST_METHOD']=='POST'){
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_m_img = $_POST['product_m_img'];
    
    $statment = $pdo->prepare("INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_m_img`, `product_price`)
                VALUES (NULL, :product_name, :product_description, :product_m_img, :product_price)");
    $statment->bindValue(':product_name', $product_name);
    $statment->bindValue(':product_description', $product_description);
    $statment->bindValue(':product_price', $product_price);
    $statment->bindValue(':product_m_img', $product_m_img);
    $statment->execute();
    header("location: index.php");
    }


    ?>
    
    
    <!doctype html>
    <html lang="en">
      <head>
        <title>Product</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="style.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      </head>
      <body>
<section style = "margin-left: 4%;">

      <form method="post" style = "margin-left: 2%">
      <div class="form-group">
        <label>title</label>
        <input type="text" class="form-control" name = "product_name">
      </div>
      <div class="form-group">
        <label>discription</label>
        <input type="text" class="form-control" name = "product_description">
      </div>
      <div class="form-group">
        <label>price</label>
        <input type="text" class="form-control" name = "product_price">
      </div>
      <div class="form-group">
        <label>image</label>
        <input type="file" class="form-control" name = "product_m_img">
      </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href = "./index.php" class="btn btn-primary">Product Page</a>
    </form>
  </section>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      </body>
    </html>
<?php

//sidebar include 
include_once('../../headfoot/saidebar.php');

?>