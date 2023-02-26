<?php 
    if(isset($_SESSION['cart'])){
        
        $cart = $_SESSION['cart'];
        $name = "";


        foreach($_SESSION['cart']['id'] as $name){
            echo $name;
        }
        
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'mystore';
        
        try {
            $db = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        } catch (PDOException $exception) {
            // If there is an error with the connection, stop the script and display the error.
            exit('Failed to connect to database!');
        }
        
                
        //header("location: index.php?page=products");
    }
?>
<?=template_header('Place Order')?>

<div class="placeorder content-wrapper">
    <h1>Your Order Has Been Placed</h1>
    <p>Thank you for ordering with us, we'll contact you by email with your order details.</p>
</div>

<?=template_footer()?>