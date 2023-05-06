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

    public function getActiveDiscounts()
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $discounts = new Discounts();
        $discounts = $discounts->getUnExpiredDiscounts();

        if (empty($discounts))
        {
            echo "<tr>
                    <td colspan='8' style='text-align: center'>No Active Discounts</td>
                  </tr>";
            exit();
        }

        $stm = "";

        foreach ($discounts as $discount)
        {
            $status = '';

            if($discount->Active === 1)
            {
                $status = 'Active';
            }else
            {
                $status = 'Inactive';
            }

            $stm .= "<tr>
                    <td>$discount->DiscountID</td>
                    <td>$discount->Name</td>
                    <td>$discount->Discount_percentage %</td>
                    <td>$status</td>
                    <td>$discount->Created_at</td>
                    <td>$discount->Modified_at</td>
                    <td>$discount->Expired_at</td>
                    <td>
                        <div class='inv-table-btns manager-btns'>
                            <button onclick='editDiscount(`".$discount->DiscountID."`)'><img src='http://localhost/WoodWorks/public/assets/images/admin/edit-4-svgrepo-com.svg' alt=''></button>
                            <button onclick='deleteDiscount(`".$discount->DiscountID."`)'><img src='http://localhost/WoodWorks/public/assets/images/admin/delete-svgrepo-com.svg' alt=''></button>
                            <button onclick='getDiscountsInfo(`".$discount->DiscountID."`,`".$discount->Discount_percentage."`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/info-svgrepo-com.svg' alt=''></button>
                        </div>                  
                    </td>
                  </tr>";
        }

        echo $stm;
    }

    public function getPastDiscounts()
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $discounts = new Discounts();
        $discounts = $discounts->getExpiredDiscounts();

        $stm = "";

        if(empty($discounts))
        {
            $stm .= "<tr>
                        <td colspan='8' style='text-align: center'>No Past Discounts</td>
                    </tr>";

            echo $stm;
            exit();
        }

        foreach ($discounts as $discount)
        {
            $status = '';

            if($discount->Active === 1)
            {
                $status = 'Active';
            }else
            {
                $status = 'Inactive';
            }

            $stm .= "<tr>
                    <td>$discount->DiscountID</td>
                    <td>$discount->Name</td>
                    <td>$discount->Discount_percentage %</td>
                    <td>$status</td>
                    <td>$discount->Created_at</td>
                    <td>$discount->Modified_at</td>
                    <td>$discount->Expired_at</td>
                    <td>
                        <div class='inv-table-btns manager-btns'>                      
                            <button class='deletion-btn' onclick='deleteDiscount(`".$discount->DiscountID."`)'><img src='http://localhost/WoodWorks/public/assets/images/admin/delete-svgrepo-com.svg' alt=''></button>                       
                        </div>                  
                    </td>
                  </tr>";
        }

        echo $stm;
    }

    public function getDiscountInfo($id,$percentage)
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $furniture = new Furnitures();

        $rows = $furniture->getDiscountedFurniture($id);

        foreach ($rows as $row)
        {
            $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
        }

        $stm = "";

        foreach ($rows as $row)
        {
            $stm .= "<tr>
                        <td>$row->ProductID</td>
                        <td><img src='http://localhost/WoodWorks/public/".$row->Image."' alt=''></td>
                        <td>$row->Name</td>
                        <td>Rs. ".$row->Cost.".00</td>
                        <td>Rs. ".round($row->Cost*(100 - $percentage)/100).".00</td>
                    </tr>";
        }

        echo $stm;
    }

    public function deleteDiscount($id)
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $discounts = new Discounts();
        $furniture = new Furnitures();

        $furniture->updateDiscount($id, null);
        $discounts->deleteDiscount($id);

        echo "<div class='cat-success cat-deletion'>
                  <h3>Discount Deleted Successfully!</h3>
              </div>";
    }

    public function editDiscount($id)
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $discounts = new Discounts();
        $discount = $discounts->getDiscount($id)[0];

        $discount->Expired_at = explode(" ",$discount->Expired_at)[0];

        echo json_encode($discount);
    }

    public function updateDiscount($id)
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $discounts = new Discounts();

        $_POST['DiscountID'] = $id;
        $_POST['Modified_at'] = date('Y-m-d H:i:s');

        $discounts->updateDiscount($_POST);

        echo "<div class='cat-success'>
                  <h3>Discount Updated Successfully!</h3>
              </div>";
    }

    
}