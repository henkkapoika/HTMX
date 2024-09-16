<?php
require '../data/db-conn.php';

$stmt = $conn->prepare("SELECT * FROM product");
$stmt->execute();
$PRODUCTS = $stmt->get_result();
$stmt->close();


if(!isset($_GET["id"])){
    die("Product not found.");
}

$productId = $_GET["id"];

$stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
$stmt->bind_param("s", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();
$title = $product["title"];

include "../templates/header.php";
?>

<main id="product">
    <header>
        <img src="/shopping-spa/public/images/<?= $product['image'] ?>" alt="<?= $product['title'] ?>">
        <div>
            <h1><?= $product["title"] ?></h1>
            <p id="product-price"><?= $product["price"] ?></p>
            <form method="post" action="/shopping-spa/public/cart">
                <button>Add to cart</button>
            </form>
        </div>
    </header>
    <p id="product-description"><?= $product["description"] ?></p>
</main>

<?php
include "../templates/footer.php";
?>





