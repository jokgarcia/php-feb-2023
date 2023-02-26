<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['id'])){
        
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'mystore';

        $id = $_POST["id"];
        $product_name = $_POST["product_name"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $sale_price = $_POST["sale_price"];
        $quantity = $_POST["quantity"];
        $image = $_POST["image"];
        $date_now = date('Y-m-d H:i:s');
        
        
        try {
            $db = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        } catch (PDOException $exception) {
            // If there is an error with the connection, stop the script and display the error.
            exit('Failed to connect to database!');
        }
        
        //Update or DELETE
        if (isset($_POST['add'])) {
            $sql = "INSERT INTO `products`(`name`, `desc`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES (?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$product_name, $description, $price, $sale_price, $quantity, $image, $date_now]);
        }
        elseif (isset($_POST['update'])){
            $sql = "UPDATE `products` SET `name`=?,`desc`=?,`price`=?,`rrp`=?,`quantity`=?,`img`=? WHERE `id` = ?";
            $stmt= $db->prepare($sql);
            $stmt->execute([$product_name, $description, $price, $sale_price, $quantity, $image, $id]);
        }
        elseif (isset($_POST['delete'])) {
            //DELETE FROM `products` WHERE 0
            $sql = "DELETE FROM `products` WHERE `id` = ?";
            $stmt= $db->prepare($sql);
            $stmt->execute([$id]);
        }

        header("location: index.php?page=products");
    }
    elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET['id'])){
            $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            // Check if the product exists (array is not empty)
            if (!$product) {
                // Simple error to display if the id for the product doesn't exists (array is empty)
                exit('Product does not exist!');
            }
        }
        
        else {
            exit('Product does not exist!');
        }
    }
?>
<?=template_header('Add Product')?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h4>Update Product</h4>
                
                <form action="updateproduct.php" method="POST">
                <input type="hidden" name="id" value="<?=$product['id']?>">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="product_name" value="<?=$product['name']?>">
                    </div>

                    <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description"><?=$product['desc']?></textarea>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" name="price" value="<?=$product['price']?>">
                </div>

                <div class="form-group">
                    <label>Selling Price</label>
                    <input type="number" class="form-control" name="sale_price" value="<?=$product['rrp']?>">
                </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" class="form-control" name="quantity" value="<?=$product['quantity']?>">
                </div>

                <div class="form-group">
                    <label>Image Name</label>
                    <input type="text" name="image" value="<?=$product['img']?>">
                </div>
                    <input type="submit" class="btn btn-danger" name="update" value="UPDATE" >
                    <input type="submit" class="btn btn-danger" name="delete" value="DELETE" >

                    <br>
                    <br>
                    <input type="submit" class="btn btn-danger" name="add" value="ADD(NOT-WORKING)" >
                </form>
                
                <a href="index.php?page=products">Back to Products</a>
            </div>
        </div>
    </div>
<?=template_footer()?>