<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id']))
{
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM book WHERE Book_ID = ?');
    $stmt->execute([$_GET['id']]);

    $stmt2 = $pdo->prepare('SELECT *
    FROM Book
    INNER JOIN Stock
    ON Book.Book_ID = Stock.Book_ID WHERE Book.Book_ID = ?');
    $stmt2->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    $product2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product)
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
}
else
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
?>

<?=template_header('Product')?>
<div class="ProductOrder">
<div class="product content-wrapper">
    <img src="<?=$product['Cover_Image']?>" width="400" height="600" alt="<?=$product['Book_Title']?>">
    <div>
        <h1 class="name"><?=$product['Book_Title']?></h1>
        <span class="price">
            £<?=$product['Price']?>
        </span>
        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product2['Stock_Level']?>" placeholder="Quantity" required>
            <input type="hidden" name="book_id" value="<?=$product['Book_ID']?>">
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$product['Book_Desc']?>
        </div>
    </div>
</div>
</div>
