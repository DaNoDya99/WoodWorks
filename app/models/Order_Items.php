<?php

class Order_Items extends Model
{
    public $errors = [];
    protected $table = "order_item";

    protected $allowedColumns = [
        'ProductID',
        'Name',
        'Quantity',
        'Cost',
        'OrderID',
        'CartID',
        'Image'
    ];

    public function getCustomerCartDetails($cart_id)
    {
        $query = "SELECT `ProductID`, `Name`, `Quantity`, `Cost`, `OrderID`, cart.`CartID`, `Image`, `Total_amount` FROM `order_item` LEFT JOIN cart ON order_item.CartID = cart.CartID where order_item.CartID = :CartID;";

        return $this->query($query,['CartID' => $cart_id]);
    }

    public function updateQuantity($cartID,$productID,$quantity)
    {
        $query = "UPDATE order_item SET Quantity = :Quantity WHERE CartID = :CartID AND ProductID = :ProductID; ";

        $data = [
            'Quantity' => $quantity,
            'ProductID' => $productID,
            'CartID' => $cartID
        ];

        $this->query($query, $data);
    }

    public function deleteItem($cartID,$productID)
    {
        $query = "DELETE FROM `order_item` WHERE CartID = :CartID AND ProductID = :ProductID;";

        $this->query($query,['CartID' => $cartID, 'ProductID' => $productID]);
    }
}