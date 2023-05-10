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

    public function updateQuantity($orderID,$productID,$quantity)
    {
        $query = "UPDATE order_item SET Quantity = :Quantity WHERE OrderID = :OrderID AND ProductID = :ProductID; ";

        $data = [
            'Quantity' => $quantity,
            'ProductID' => $productID,
            'OrderID' => $orderID
        ];




        $this->query($query, $data);
    }

    public function deleteItem($cartID,$productID)
    {
        $query = "DELETE FROM `order_item` WHERE CartID = :CartID AND ProductID = :ProductID;";

        $this->query($query,['CartID' => $cartID, 'ProductID' => $productID]);
    }

    //delete all order items in a cart

    public function deleteAllItems($cartID)
    {
        $query = "DELETE FROM `order_item` WHERE CartID = :CartID;";

        $this->query($query,['CartID' => $cartID]);
    }

    public function getOrderItemCount($orderID)
    {
        $query = "SELECT COUNT(ProductID) AS Count FROM `order_item` WHERE OrderID = :OrderID;";

        return $this->query($query,['OrderID' => $orderID]);
    }

    public function getOrderItems($orderID)
    {
        $query = "SELECT order_item.ProductID, order_item.OrderID, order_item.Name, order_item.Quantity, order_item.Cost, order_item.Image,order_item.Date, furniture.Wood_type,furniture.Warrenty_period,furniture.Name FROM order_item INNER JOIN furniture ON order_item.ProductID = furniture.ProductID WHERE order_item.OrderID = :OrderID; ";
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

    public function getSoldProductsLastWeek()
    {
        $query = "SELECT ProductID, SUM(Quantity) AS SoldQuantity FROM order_item WHERE Is_purchased = 1 AND Date >= DATE_SUB(NOW(), INTERVAL 1 WEEK) GROUP BY ProductID; ";

        return $this->query($query);
    }

    public function getTopSellingProducts()
    {
        $query = "SELECT ProductID, SUM(Quantity) as QuantitySold FROM order_item WHERE Date >= DATE_SUB(NOW(), INTERVAL 1 WEEK) AND Is_purchased = 1 GROUP BY ProductID ORDER BY QuantitySold DESC LIMIT 10; ";

        return $this->query($query);
    }

   

    public function getIncomeLastWeek()
    {
        $query = "SELECT DATE(Date) AS OrderDate, SUM(Quantity * Cost) AS TotalIncome FROM order_item WHERE Date >= DATE(NOW()) - INTERVAL 7 DAY GROUP BY DATE(Date);";

        return $this->query($query);
    }


}