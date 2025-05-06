<?php
session_start();


require_once '../backend/classes/Produit.php'; 

// Initialisation panier si vide
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = &$_SESSION['cart'];

// Mise à jour des quantités si formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $productId => $qty) {
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = max(1, intval($qty)); // éviter 0 ou négatif
        }
    }
    // Redirige vers le même panier pour éviter la resoumission du formulaire
    header("Location: cart.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Panier</title>
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
        h1 {
            margin-top: 40px;
        }

        input[type="number"] {
            width: 60px;
            padding: 4px;
        }

        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #aaa;
            padding: 10px;
        }

        button {
            margin-top: 10px;
            padding: 8px 12px;
        }
    </style>
</head>

<body>
    <header>
        <img src="../backend/img/new face.png" alt="Logo NewFace">
    </header>
    <h1>Votre panier</h1>

    <?php if (!empty($cart)): ?>
        <form method="POST">
            <main>
                <table>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $total = 0;
                    foreach ($cart as $productId => $item):
                        $subtotal = $item['prix_produit'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nom_produit']) ?></td>
                            <td><?= number_format($item['prix_produit'], 2) ?> €</td>
                            <td>
                                <!-- Affichage de la quantité actuelle -->
                                Quantité actuelle : <?= $item['quantity'] ?><br />
                                <!-- Input pour modifier la quantité -->
                                <input type="number" name="quantity[<?= $productId ?>]" value="<?= $item['quantity'] ?>" min="1" />
                            </td>
                            <td><?= number_format($subtotal, 2) ?> €</td>
                            <td><a href="remove_from_cart.php?id=<?= $productId ?>">🗑 Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td><strong><?= number_format($total, 2) ?> €</strong></td>
                        <td></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary">🛒 Mettre à jour le panier</button>
        </form>
    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>
    </main>
    <button type="button" class="btn btn-danger"><a href="index.php">← Retour aux produits</a></button>

</body>

</html>