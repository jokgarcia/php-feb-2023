<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['product_name'])){
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'mystore';

        //Get Inputs
        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $selling_price = $_POST['selling_price'];
        $quantity = $_POST['quantity'];
        $image = $_POST['image'];
        $date_now = date('Y-m-d H:i:s');

        //Check Connection
        try {
            $db = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        } catch (PDOException $exception) {
            // If there is an error with the connection, stop the script and display the error.
            exit('Failed to connect to database!');
        }
        
        //MySQL PDO Steps
        $sql = "INSERT INTO `products`(`name`, `desc`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES (?,?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$product_name, $description, $price, $selling_price, $quantity, $image, $date_now]);

        echo "alert('Added the Product Sucessfully');";
        header("location: index.php?page=products");
    }
?>
<?=template_header('Add Product')?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h4>New Product</h4>
                <form action="addproduct.php" method="POST">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="product_name" required>
                    </div>

                    <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" name="price" required>
                </div>

                <div class="form-group">
                    <label>Selling Price</label>
                    <input type="number" class="form-control" name="selling_price" required>
                </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" class="form-control" name="quantity" required>
                </div>

                <div class="form-group">
                    <label>Image File</label>
                    <input type="file" accept="*/*" max-size="2024" class="form-control-file border" name="image" required>
                </div>

                    <input type="submit" class="btn btn-danger" name="add" value="ADD" >
                </form>
            </div>
        </div>
    </div>
<?=template_footer()?>