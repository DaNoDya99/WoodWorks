<?php

class Discount extends Controller
{
    public function index()
    {
        
    }

    public function add()
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $name = $_POST['Name'];
        $discount = $_POST['Discount_percentage'];
        $active = $_POST['Active'] === null ? 0 : $_POST['Active'];
        $expired_at = $_POST['Expired_at'];
        $categories = $_POST['categories'];
        $products = explode(',', $_POST['products']);

        $discounts = new Discounts();
        $furniture = new Furnitures();

        $random_str = $discounts->random_string(10);

        while (true){
            $discount_row = $discounts->getDiscount($random_str);
            if(empty($discount_row)){
                break;
            }
            $random_str = $discounts->random_string(10);
        }

        $discountRow = [
            'DiscountID' => $random_str,
            'Name' => $name,
            'Discount_percentage' => $discount,
            'Active' => $active,
            'Created_at' => date('Y-m-d H:i:s'),
            'Modified_at' => date('Y-m-d H:i:s'),
            'Expired_at' => $expired_at
        ];

        $discounts->insert($discountRow);

        foreach ($products as $product){
            $furniture->updateDiscount($product, $random_str);
        }

        echo "<div class='cat-success'>
                  <h3>Discount Added Successfully!</h3>
              </div>";
    }

    
}