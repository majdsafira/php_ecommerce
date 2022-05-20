<?php 
include_once('../../connection/conn.php');
//header include
include_once('../../headfoot/header.php');


$id = $_GET['id'] ?? null;
if(!$id) {
    header('location: index.php');
    exit;
}


$statment = $pdo->prepare('DELETE FROM products WHERE product_id = :id');
$statment->bindvalue(':id', $id);
$statment->execute();
$products = $statment->fetchAll(PDO::FETCH_ASSOC);


$stat='SELECT * FROM categories';
      
      $cat=$pdo->query($stat);
      $share=$cat->fetchAll();
      $share_id = $share[0] ['category_id'];
      //echo '<pre>';
      //var_dump($share_id);
      //echo '<pre>'

if($_SERVER['REQUEST_METHOD']=='POST'){
  if (!is_dir('images')) {
    mkdir('images');
}
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    


    $image = $_FILES['image'] ?? null;
    $imagePath = '';
    if ($image) {
        $imagePath = 'images/' . randomString(8) . $image['name'];
        
        move_uploaded_file($image['tmp_name'], $imagePath);
    }
    

    $statment = $pdo->prepare("INSERT INTO `products` (`product_name`, `product_description`, `product_m_img`, `product_price`, `category_id`)
                VALUES (:product_name, :product_description, :image, :product_price, :category_id)");
    $statment->bindValue(':product_name', $product_name);
    $statment->bindValue(':product_description', $product_description);
    $statment->bindValue(':image', $imagePath);
    $statment->bindValue(':product_price', $product_price);
    $statment->bindValue(':category_id', $share_id);
    
    $statment->execute();
    header("location: index.php");
    }



    
function randomString($n)
{
    $str = '';
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }
    return $str;
}

      

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Product</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
    integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
  </script>
</head>

<body>
  <section style="margin-left: 4%;">

    <form method="post" style="margin-left: 2%; margin-right: 2%" enctype="multipart/form-data">

    <?php if ($product['product_m_img']): ?>
        <img src="<?php echo $product['product_m_img']; ?>">
    <?php endif ?>
      <div class="form-group">
        <label>Product Name</label>
        <input type="text" class="form-control" name="product_name">
      </div>
      <div class="form-group">
        <label>Product Discription</label>
        <textarea class="form-control" name="product_description"></textarea>
      </div>
      <div class="form-group">
        <label>Price</label>
        <input type="text" class="form-control" name="product_price">
      </div>
      <div class="form-group">
        <label>Priduct Image</label>
        <input type="file" class="form-control" name="image">
      </div>
      <div class="form-group">
        <label class="form-label">Categories</label>
        <select class="form-select" aria-label="Default select example" name="categories">
          <option selected>Open this select menu</option>
          <?php foreach ($share as $value):?>
          <option value="<?php echo $value['category_id'] ?>"><?php echo $value['category_name'] ?></option>
          <?php endforeach; ?>
        </select>

        </select>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="./index.php" class="btn btn-primary">Product Page</a>
    </form>

  </section>

</body>

</html>
<?php

//sidebar include 
include_once('../../headfoot/saidebar.php');

?>