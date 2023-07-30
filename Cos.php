<?php
require_once "ShoppingCart.php";
session_start();
// Dacă utilizatorul nu este conectat redirecționează la pagina de autentificare ...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
// pt membrii inregistrati

$member_id = $_SESSION['id'];
$shoppingCart = new ShoppingCart();
if (!empty($_GET["action"])) 
{     
    switch ($_GET["action"]) {
        case "add":
           
            if (!empty($_POST["quantity"])) {
                $productResult = $shoppingCart->getProductByCode($_GET["code"]);

                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"],$member_id);

                if (!empty($cartResult)) {
                    // Modificare cantitate in cos
                    $newQuantity = $cartResult[0]["quantity"]+$_POST["quantity"];
                    $shoppingCart->updateCartQuantity($newQuantity,$cartResult[0]["id"] );
                } else {
                    // Adaugare in tabelul cos
                    $shoppingCart->addToCart($productResult[0]["id"],$_POST["quantity"],$member_id);
                }
            }
            break;
        case "remove":
            // Sterg o sg inregistrare
            $shoppingCart->deleteCartItem($_GET["id"]);
            break;
        case "empty":
            // Sterg cosul
            $shoppingCart->emptyCart($member_id);
            break;
    }
}
?>
<HTML>

<HEAD>
    <TITLE>Creare cos permament in PHP</TITLE>
    <link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>

<BODY>
    <div id="shopping-cart">
        <div class="txt-heading">
            <div class="txt-heading-label">Cos Cumparaturi</div> <a id="btnEmpty" href="cos.php?action=empty"><img
                    src="empty-cart.png" width="60px" height="60px" alt="empty-cart" title="Empty Cart" /></a>
        </div>
        <?php
        $cartItem = $shoppingCart->getMemberCartItem($member_id);
        // echo $cartItem['nume'];
        if (!empty($cartItem)) {
            $item_total = 0;
        ?>
        <table cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th style="text-align: left;"><strong>Name</strong></th>
                    <th style="text-align: left;"><strong>Image</strong></th>
                    <th style="text-align: right;"><strong>Quantity</strong></th>
                    <th style="text-align: right;"><strong>Price</strong></th>
                    <!-- <th style="text-align:center;"><strong>Action</strong></th> -->
                </tr>
                <?php
                 
            foreach ($cartItem as $item) {
                // echo $item["image"];
                // echo $item["nume"];
                
                ?>
                <tr>
                    <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong>
                            <?php echo $item["name"]; ?>
                        </strong></td>
                    <td style="text-align: left; border-bottom: #F0F0F0 1px solid;">
                        
                        <img src="product-images/<?php echo $item["image"];?>" width="80px" height="80px"> 
                    </td>
                    <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong>
                        <?php echo $item["quantity"]; ?>
                    <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong>
                        <?php echo $item["price"]; ?>
                    <td style="text-align: center; border-bottom: #F0F0F0 1px solid;"><a href="cos.php?action=remove&id=<?php echo $item["id"]; ?>" class="btnRemoveAction">
                    <img src="icon-delete1.png" width="30px" height="30px" alt="icon-delete" title="Remove Item" /></a></td>
                </tr>
                <?php
                $item_total += ($item["price"] * $item["quantity"]);
            }
                ?>
                <tr>
                    <td colspan="3" align=right><strong>Total:</strong></td>
                    <td align=right>
                        <?php echo "$" . $item_total; ?>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <?php
        }
        ?>
    </div>
    <div><a href="magazin.php" class="a1">Alegeti alt produs</a></div><br>
    <div><a href="logout.php" class="a1">Abandonati sesiunea de cumparare</a></div><br>
    <a href="logout.php" class="a1">Logout</a>
    <?php //require_once "product-list.php"; ?>

</BODY>
</HTML>