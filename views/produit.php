<?php

require_once 'classes/User.php';
$user = new User();

if (!$user->isLoggedIn()) {
    header("Location: login.php");
    exit;
}


require_once 'classes/Produit.php';
$product = new Product();
$products = $product->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        h4{
            text-align: center;
        }
    </style>
</head>
<body>
<button type="button" class="btn btn-danger"><a href="logout.php">se déconnecter</a></button>
<h4>bonjour <?php echo $_SESSION["username"]; ?>!</h4>
<h1>Produits disponibles</h1>
<main>
<div class="products">
    <?php foreach ($products as $p) { ?>
        <div class="product">
            <img src="img/<?php echo $p['image_produit']; ?>" alt="<?php echo $p['nom_produit']; ?>">
            <h5><?php echo $p['nom_produit']; ?></h5>
            <p><?php echo $p['prix_produit']; ?> €</p>
            <button type="button" class="btn btn-success"><a href="add_to_cart.php?id=<?php echo $p['id']; ?>"> Ajouter au panier</a></button>

        </div>
    <?php } ?>
</div>
<a href="cart.php">🛒Voir le panier</a>
</main>
</body>
</html>
