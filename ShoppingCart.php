<?php
require_once "DBController.php";
class ShoppingCart extends DBController
{
    function getAllProduct()
    {
        $query = "SELECT * FROM tbl_product";

        $productResult = $this->getDBResult($query);
        return $productResult;
    }
    function getMemberCartItem($member_id)
    {
        $query = "SELECT tbl_product.name, tbl_product.image, tbl_product.id, tbl_product.price, tbl_cart.quantity  FROM tbl_product, tbl_cart WHERE tbl_product.id = tbl_cart.product_id AND tbl_cart.id_member = ?";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );

        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }
    function getProductByCode($product_code)
    {
        $query = "SELECT * FROM tbl_product WHERE id=?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_code
            )
        );

        $productResult = $this->getDBResult($query, $params);
        return $productResult;
    }
    function getCartItemByProduct($product_id, $member_id)
    {
        $query = "SELECT * FROM tbl_cart WHERE product_id = ? AND id_member = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }
    function addToCart($product_id, $quantity, $member_id)
    {
        $query = "INSERT INTO tbl_cart (product_id, quantity, id_member) VALUES (?,?,?)";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );

        $this->updateDB($query, $params);
    }
    function updateCartQuantity($quantity, $cart_id)
    {
        $query = "UPDATE tbl_cart SET quantity = ? WHERE id= ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );
        $this->updateDB($query, $params);
        //echo $cart_id;
    }
    function deleteCartItem($cart_id)
    {
        $user_id = $_SESSION['id'];
        $query = "DELETE FROM tbl_cart WHERE product_id = ? AND id_member = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $user_id
            )
        );
        $this->updateDB($query, $params);
    }
    function emptyCart($member_id)
    {
        $query = "DELETE FROM tbl_cart WHERE id_member = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );

        $this->updateDB($query, $params);
    }
}