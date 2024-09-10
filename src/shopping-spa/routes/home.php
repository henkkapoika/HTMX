<?php
$title = "Jacket Shop";
include "../templates/header.php";

?>

<main id="shop">
    <h2>Jackets For Everyone</h2>
    <ul id="products">
        <?php foreach($PRODUCTS as $product): ?>
            <article class="product">
                <a href="../public/product/<?= $product['id'] ?>">
                    <img src="../public/images/<?= $product['image'] ?>" alt="<?= $product['title'] ?>">
                    <div class="product-content">
                        <h3><?= $product['title'] ?></h3>
                        <p class="product-price"><?= $product['price'] ?>€</p>
                    </div>
                </a>
            </article>
        <?php endforeach; ?>
    </ul>
</main>


<?php
include "../templates/footer.php";
?>