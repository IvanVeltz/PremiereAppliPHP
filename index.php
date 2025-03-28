<?php
    session_start();
    ob_start();
?>


    <header>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="recap.php">Liste des produits</a>
        </nav>
        <h1>Ajouter un produit</h1>
    </header>
    <main>
        <form class="form-ajout" action="traitement.php?action=add" method="post">
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
                <input type="submit" name="submit" value="Ajouter" class="submit">
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
    
<?php

$title = "Ajouter un produit";
$content = ob_get_clean();
require_once "template.php";