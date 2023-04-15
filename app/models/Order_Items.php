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
        'Image',
        'Is_purchased',
        'Date'
    ];

    public function getCustomerCartDetails($cart_id)
    {
        $query = "SELECT `ProductID`, `Name`, `Quantity`, `Cost`, `OrderID`, cart.`CartID`, `Image`, `Total_amount` FROM `order_item` LEFT JOIN cart ON order_item.CartID = cart.CartID where order_item.CartID = :CartID AND Is_purchased = :Is_purchased;";

        return $this->query($query,['CartID' => $cart_id,'Is_purchased' => 0]);
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

    public function getOrderItemCount($orderID)
    {
        $query = "SELECT COUNT(ProductID) AS Count FROM `order_item` WHERE OrderID = :OrderID;";

        return $this->query($query,['OrderID' => $orderID]);
    }

    public function getOrderItems($orderID)
    {
        $query = "SELECT order_item.ProductID, order_item.Name, order_item.Quantity, order_item.Cost, order_item.Image, furniture.Wood_type FROM order_item INNER JOIN furniture ON order_item.ProductID = furniture.ProductID WHERE order_item.OrderID = :OrderID; ";

        return $this->query($query,['OrderID' => $orderID]);
    }

    public function removeOrderItem($orderID,$productID)
    {
        $query = "DELETE FROM `order_item` WHERE OrderID = :OrderID AND ProductID = :ProductID;";

        $this->query($query,['OrderID' => $orderID, 'ProductID' => $productID]);
    }

    public function getOrderItem($orderID,$productID)
    {
        $query = "SELECT * FROM `order_item` WHERE OrderID = :OrderID AND ProductID = :ProductID;";

        return $this->query($query,['OrderID' => $orderID, 'ProductID' => $productID]);
    }

    public function updateIsPurchased($orderID)
    {
        $query = "UPDATE $this->table SET Is_purchased = 1 WHERE OrderID = :OrderID;";

        $this->query($query,['OrderID' => $orderID]);
    }
}