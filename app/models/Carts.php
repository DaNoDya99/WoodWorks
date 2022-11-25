<?php

class Carts extends Model
{
    public $errors = [];
    protected $table = 'cart';

    protected $allowedColumns = [
            'CartID',
            'Total_amount',
            'CustomerID',
        ];

    public function getCart($id) {
        $query = "select CartID from cart where CustomerID = :CustomerID";
        return $this->query($query, ['CustomerID' => $id]);
    }

    public function setCart($id)
    {
        $cartID = $this->make_cart_id();

        $data = [
            'CartID' => $cartID,
            'Total_amount' => 0,
            'CustomerID' => $id
        ];

        $this->insert($data);
    }

    public function make_cart_id(){

        $cartID = $this->random_string(60);
        $result = $this->where('CartID',$cartID);
        while ($result){
            $result = $this->where('CartID',$cartID);
            $cartID = $this->random_string(60);
        }

        return $cartID;
    }

    public function random_string($length)
    {
        $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
        $text = "";
        for ($x = 0; $x < $length; $x++) {
            $random = rand(0, 61);
            $text .= $array[$random];
        }

        return $text;
    }

    public function updateTotalAmountToIncrease($cartID, $cost)
    {
         $query = "UPDATE `cart` SET Total_amount = (SELECT Total_amount FROM cart WHERE CartID = :CartID ) + :Cost WHERE CartID = :CartID;";

         $this->query($query , ['CartID' => $cartID, 'Cost' => $cost]);
    }

    public function updateTotalAmountToDecrease($cartID, $cost)
    {
         $query = "UPDATE `cart` SET Total_amount = (SELECT Total_amount FROM cart WHERE CartID = :CartID ) - :Cost WHERE CartID = :CartID;";

         $this->query($query , ['CartID' => $cartID, 'Cost' => $cost]);
    }
}