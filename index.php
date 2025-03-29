<?php
    session_start();
    ob_start();
?>


    <header>
        <nav class="accueil">
            <a href="recap.php" class="linkPanier">
                <p>Voir mon panier</p>
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
        </nav>
        <h1>Ajouter un produit</h1>
    </header>
    <main>
        <form class="form-ajout" action="traitement.php?action=add" method="post">
            <div class="formulaire">
                <label>
                   <p>Nom du produit :</p>
                    <input class="input-product" type="text" name="name">
                </label>

                <label>
                    <p>Prix du produit :</p>
                    <input class="input-prix" type="number" step="any" name="price">
                </label>

                <label>
                    <p>Quantité désirée :</p>
                    <input class="input-qtt"type="number" name="qtt" value="1">
                </label>
            </div>
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