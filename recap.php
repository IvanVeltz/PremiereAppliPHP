<?php
session_start();
ob_start();
?>

    <header>
        <nav>
            <a href="index.php" class="link"><i class="fa-solid fa-house"></i><p>Accueil</p></a>
        </nav>
        <h1>Liste des produit</h1>
    </header>
    <main>
        <?php
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p class='aucun'>Aucun produit en séléction</p>";
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            ";
            $totalGeneral = 0;
            foreach($_SESSION['products'] as $index => $product){
                echo "<tr>",
                "<td>".$index."</td>",
                "<td>".$product['name']."</td>",
                "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                "<td class='actions'>";
                    // Ajout du bouton "-"
                    if ($product['qtt'] != 0){
                        echo "<form  method='post' action='traitement.php?action=down-qtt'>
                            <input type='hidden' name='minus' value='".filter_var($index, FILTER_VALIDATE_INT)."'></input>
                            <button class= 'minus' type='submit'>-</button>
                        </form>";
                    }
                    echo "<span class='produit'>".$product['qtt']."</span>",
                    // Ajout du bouton "+"
                    "<form  method='post' action='traitement.php?action=up-qtt'>
                        <input type='hidden' name='plus' value='".filter_var($index, FILTER_VALIDATE_INT)."'></input>
                        <button class='plus' type='submit'>+</button>
                    </form>",
                "</td>",
                "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                "<td>",
                // Ajout du bouton pour supprimer
                    "<form method='post' action='traitement.php?action=delete'>
                        <input type='hidden' name='index' value='".filter_var($index, FILTER_VALIDATE_INT)."'></input>
                        <button type='submit' class='submit'>Supprimer</button>
                    </form>",
                
                "</td></tr>";
                $totalGeneral += $product['total'];
            }
            echo "<tr>",
                "<td class= 'total' colspan=4>Total Général : </td>",
                "<td><strong>", number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                // Ajout du bouton pour tout supprimer
                "<td>
                    <form method='post' action='traitement.php?action=clear'>
                        <input type='hidden' name='delete_all' value='1'></input>
                        <button type='submit' class='submit'>Tous supprimer</button>
                    </form>
                </td></tr>",
            "</tr>",  
            "</tbody></table>";
            $totalProduit = 0;
            foreach($_SESSION['products'] as $index => $product){
                $totalProduit += $product['qtt'];
            }
            echo "<p class='qtt'>Nombre de produits dipsonibles : ",
            $totalProduit,
            " produits.</p>";

            if (isset($_SESSION['messageDelete'])){
                echo "<p class = 'delete'>" . $_SESSION['messageDelete'] . "</p>";
                unset($_SESSION['messageDelete']); // Supprime le message après l'affichage
            
            }
            
        }
        ?>
    </main>

<?php 

$title = "Liste des produits";
$content = ob_get_clean();
require_once "template.php";