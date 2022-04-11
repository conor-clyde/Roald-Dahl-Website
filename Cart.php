<?php
//If user clicked add to cart button on product page - Check for form data
if (isset($_POST['book_id'], $_POST['quantity']) && is_numeric($_POST['book_id']) && is_numeric($_POST['quantity']))
{
    //Set the post variables
    $product_id = (int)$_POST['book_id'];
    $quantity = (int)$_POST['quantity'];

    //SQL statement to select product
    $stmt = $pdo->prepare('SELECT * FROM book WHERE Book_ID = ?');
    $stmt->execute([$_POST['book_id']]);

    //Fetch product from database and return result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    //Check if product exists (array is not empty)
    if ($product && $quantity > 0)
    {
        //Create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart']))
         {
            if (array_key_exists($product_id, $_SESSION['cart']))
                //Product already in cart so only update quanity
                $_SESSION['cart'][$product_id] += $quantity;
            else
                //Product not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
        }
        else
            //No products in cart - Add first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
    }
    //Prevent form resubmission
    header('location: index.php?page=cart');
    exit;
}

//Remove product from cart - Check for the URL param "remove" as this is the product id. Make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']]))
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart']))
 {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v)
    {
        if (strpos($k, 'quantity') !== false && is_numeric($v))
         {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0)
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart)
{
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM Book WHERE Book_ID IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product)
    {
        $subtotal += (float)$product['Price'] * (int)$products_in_cart[$product['Book_ID']];
    }
}

// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart']))
 {
   $cid = 1;

   $stmt = $pdo->prepare('INSERT INTO `ORDER`
   (Customer_ID)
   VALUES (:cid)');

   $stmt->bindParam(":cid", $cid);
   $stmt->execute();

   $select_sql = $pdo->prepare('select * from `Order` ORDER BY Order_ID DESC LIMIT 1;');
   $select_sql->execute();

   $order = $select_sql->fetch(PDO::FETCH_ASSOC);

       foreach ($products as $product):
        $oid = $order['Order_ID'];
         $bid = $product['Book_ID'];

         $test1= $product['Book_ID'];
         $test = "quantity-" . $test1;
         $qty = $_POST[$test];

         $stmt = $pdo->prepare('INSERT INTO `ORDER_BOOK`
         (Order_ID, Book_ID, Quantity)
         VALUES (:oid, :bid, :qty)');

        $stmt->bindParam(":oid", $oid);
        $stmt->bindParam(":bid", $bid);
        $stmt->bindParam(":qty", $qty);



         $stmt->execute();
         endforeach;
 header('Location: index.php?page=placeorder');




    exit;
}




?>

<?=template_header('Cart')?>
<div class="ProductOrder">
<div class="cart content-wrapper">
    <h1>Shopping Cart</h1>
    <form action="index.php?page=cart" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product):

                      $stmt2 = $pdo->prepare('SELECT *
                      FROM Book
                      INNER JOIN Stock
                      ON Book.Book_ID = Stock.Book_ID WHERE Book.Book_ID = ?');
                      $stmt2->execute([$product['Book_ID']]);

                      $product2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                   ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['Book_ID']?>">
                            <img src="<?=$product['Cover_Image']?>" width="100" height="150" alt="<?=$product['Book_Title']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$product['Book_ID']?>"><?=$product['Book_Title']?></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$product['Book_ID']?>" class="remove">Remove</a>
                    </td>
                    <td class="price">£<?=$product['Price']?></td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['Book_ID']?>" value="<?=$products_in_cart[$product['Book_ID']]?>" min="1" max="<?=$product2['Stock_Level']?>" placeholder="Quantity" required>
                    </td>
                    <td class="price">£<?=$product['Price'] * $products_in_cart[$product['Book_ID']]?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price">£<?=$subtotal?></span>
        </div>
        <div class="buttons">


            <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder">

    </form>
        </div>


    </form>
</div>
</div>
