<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Récapitulatif des produits</title>
</head>
<body>
    <header>
        <h1>Liste des produit</h1>
        <nav>
            <a href="index.html">Accueil</a>
            <a href="recap.php">Liste des produits</a>
        </nav>
    </header>
    <main>
        <?php
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p>Aucun produit en séléction</p>";
        } else {
            echo "
            <table>
            <thead>
            <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Total</th>
            </tr>
            </thead>
            <tbody>
            ";
            $totalGeneral = 0;
            $totalProduit = 0;
            foreach($_SESSION['products'] as $index => $product){
                echo "<tr>",
                "<td>".$index."</td>",
                "<td>".$product['name']."</td>",
                "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                "<td>".$product['qtt']."</td>",
                "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                "</tr>";
                $totalGeneral += $product['total'];
                $totalProduit += $product['qtt'];
            }
            echo "<tr>",
            "<td class= 'total' colspan=4>Total Général : </td>",
            "<td><strong>", number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
            "</tr>",  
            "</tbody></table>",
            "<p class='qtt'>Nombre de produits dipsonibles : ",
            $totalProduit,
            " produits.</p>";
        }
        ?>
    </main>
</body>
</html>