<?php
require_once "ShoppingCart.php"; ?>
<HTML>

<HEAD>
    <TITLE>Creare cos cumparaturi </TITLE>
    <link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>

<BODY>
    <div id="product-grid">
        <div class="txt-heading">
            <div class="txt-headinglabel">Products</div>
        </div>
        <?php
 $shoppingCart = new ShoppingCart();
 $query = "SELECT * FROM tbl_product";
 $product_array = $shoppingCart->getAllProduct();
 if (!empty($product_array)) {
     foreach ($product_array as $key => $value) {
 ?>
        <div class="product-item">
            <form method="post" action="Cos.php?action=add&code=<?php echo $product_array[$key]["id"]; ?>">
                <div class="product-image">
                    <img src="product-images/<?php echo $product_array[$key]["image"]; ?>" width="80px" height="80px"> 
                </div>
                <div>
                    <strong>
                        <?php echo $product_array[$key]["id"];
 ?>
                    </strong>
                </div>
                <div>
                    <strong>
                        <?php echo $product_array[$key]["name"];
 ?>
                    </strong><br><br>
                    <strong>
                        Categorie:
                        <?php echo $product_array[$key]["categorie"];
 ?>
                    </strong><br><br>
                    <strong>
                        Descriere:
                        <?php echo $product_array[$key]["descriere"];
 ?>
                    </strong><br><br>
                </div>
                <div class="product-price">
                    <?php echo "$" . $product_array[$key]["price"]; ?>

                </div>
                <div>
                    <input type="text" name="quantity" value="1" size="2" />
                    <input type="submit" value="Add to cart" class="btnAddAction btn-5" />
                </div>
            </form>
        </div>
        <?php
     }
 }
 ?>
    </div>
</BODY>

</HTML>