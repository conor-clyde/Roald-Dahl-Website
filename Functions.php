<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = 'student';
    $DATABASE_NAME = 'group_12_db';
    try
    {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception)
     {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
// Template header, feel free to customize this
function template_header($title)
{
// Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="Resources/Stylesheets/ProductOrderStyles.css" rel="stylesheet" type="text/css">
    <link href="Resources/Stylesheets/navLoginRegStyles.css" rel="stylesheet" type="text/css">
    <link href="Resources/Stylesheets/HomeStyles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
  <div class="NavLoginReg">
        <header>
            <div class="navLoginReg content-wrapper">
                <img src="Resources/Images/Logo.png" class="logo" width="auto" height="120px">
                <nav>
                    <a href="index.php?page=home"><button class="navBtn">Home</button></a>
                    <a href="index.php?page=products"><button class="navBtn">Books</button></a>
                    <a href="index.php?page=login"><button class="navBtn">Log In</button></a>
                    <a href="index.php?page=cart"><button class="cartBtn"></button></a>




                </nav>

            </div>
        </header>
        </div>
        <main>



EOT;





}
