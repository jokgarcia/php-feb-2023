<?php

function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'mystore';
    
    //Error Handling
    try {
                       //ConnectionString
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    }
    catch (PDOException $exception) {
        exit('Failed to connect to database!') . $exception;
    }
}

//Template
function template_header($title) {
$num_items_in_cart = "";
echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
     <meta charset="utf-8">
     <title>$title</title>
     <link href="css/style.css" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
        <header>
            <div class="content-wrapper">
              <h1>Shopping Cart System</h1>
               <nav>
                <a href="index.php">Home</a>
                <a href="index.php?page=products">Products</a>
               </nav>
              <div class="link-icons">
                <a href="index.php?page=cart">
                    <i class="fas fa-shopping-cart"></i>
                    <span>$num_items_in_cart</span>
                </a>
              </div>
            </div>
        </header>
    <main>
EOT;
}

function template_footer() {
    $year = date('Y');
    echo <<<EOT
            </main>
            <footer>
                <div class="content-wrapper">
                    <p>&copy; $year, Shopping Cart System</p>
                </div>
            </footer>
        </body>
    </html>
    EOT;
    }
?>

