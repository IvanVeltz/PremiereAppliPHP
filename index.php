<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajout produit</title>
</head>
<body>
    <header>
        <h1>Ajouter un produit</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="recap.php">Liste des produits</a>
        </nav>
    </header>
    <main>
        <form action="traitement.php?action=add" method="post">
            <p class="formulaire">
                <label>
                    Nom du produit :
                    <input type="text" name="name">
                </label>

                <label>
                    Prix du produit :
                    <input type="number" step="any" name="price">
                </label>

                <label>
                    Quantité désirée :
                    <input type="number" name="qtt" value="1">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit" class="submit">
            </p>
        </form>

        <?php
        $totalProduit = 0;
        if (isset($_SESSION['products'])){
            foreach($_SESSION['products'] as $index => $product){
                $totalProduit += $product['qtt'];
            }
        }
        echo "<p class='qtt'>Nombre de produits dipsonibles : ",
        $totalProduit,
        " produits.</p>";
        
        if (isset($_SESSION['messageAjout'])){
            echo "<p class = 'ajout'>" . $_SESSION['messageAjout'] . "</p>";
            unset($_SESSION['messageAjout']); // Supprime le message après l'affichage
        
        }
        ?>


            
    </main>
    
</body>
</html>