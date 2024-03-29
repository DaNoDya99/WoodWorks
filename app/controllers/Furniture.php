<?php

class Furniture extends Controller
{
    public function index(){

        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

    }

    public function view_product($id = null){

        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $customer = new Customer();
        $cus_id = Auth::getCustomerID();


        $allowedCols = [
            'ratings.Rating',
            'ratings.Reviews',
            'ratings.Date',
            'customer.Firstname',
            'customer.Lastname',
            'customer.Image'

        ];

        $furniture = new Furnitures();
        $review = new Reviews();

        $data['row'] = $customer->where('CustomerID',$cus_id);
        $data['furniture'] = $furniture->viewFurniture($id);
        $data['reviews'] = $review->getReview($allowedCols,$id);
        $data['rating'] = round($review->getProductRating($id)[0]->Average,1);
        $data['images'] = $furniture->getAllImages($id);

        $this->view("reg_customer/product", $data);
    }


    public function details($id){

        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $furniture = new Furnitures();
        $primary_image = $furniture->getDisplayImage($id);
        $secondary_images = $furniture->getSecondaryImages($id);
        $fur = $furniture->getFurnitureByID($id);
        $categories = new Categories();
        $cat = $categories->getCategories();
        $sub_categories = new Sub_Categories();
        $sub_cat = $sub_categories->getSubcategoryName();

        $stm = "
            <div class='fur-img-upload-container'>
                 <div class='fur-img'>
                 <img id='first-img' src='".ROOT."/".$primary_image[0]->Image."' alt=''>
            </div>
            <label>
                Primary Image
                <input onchange='load_image_primary(this.files)' type='file' name='PrimaryImage'>
            </label>
            <div class='fur-img'>
                <img id='second-img' src='".ROOT."/".$secondary_images[0]->Image."' alt='Product Image'>
                <img id='third-img' src='".ROOT."/".$secondary_images[1]->Image."' alt='Product Image'>
            </div>
            <label>
                Secondary Images
                <input onchange='load_image_secondary(this.files)' type='file' name='Images[]' multiple>
            </label>
            </div>
            <div class='add-fur-fields'>
                <div class='add-fur-field-set set-one'>
                    <div class='add-fur-field edit-fur'>
                        <label>Product ID</label>
                        <input type='text' name='ProductID' placeholder='SKU' value='".$fur[0]->ProductID."' disabled>
                    </div>
                    <div class='add-fur-field edit-fur'>
                        <label>Name<span class='dis-err' style='color: red;font-size: small' id='name-error'></span></label>
                        <input type='text' name='Name' placeholder='Name' value='".$fur[0]->Name."'>
                    </div>
                    <div class='add-fur-field edit-fur'>
                        <label>Category<span class='dis-err' style='color: red;font-size: small' id='category-error'></span></label>
                        <select name='CategoryID'>
                            <option value='".$fur[0]->CategoryID."' selected>".$fur[0]->CategoryID." - ".$categories->getCategoryByID($fur[0]->CategoryID)[0]->Category_name."</option>";

        foreach ($cat as $val){
            $stm .= "<option value='".$val->CategoryID."'>".$val->CategoryID." - ".$val->Category_name."</option>";
        }

        $stm .=   "</select>
                    </div>
                    <div class='add-fur-field edit-fur'>
                        <label>Sub Category<span class='dis-err' style='color: red;font-size: small' id='sub-category-error'></span></label>
                        <select name='Sub_category_name'>
                            <option value='".$fur[0]->Sub_category_name."' selected>".$fur[0]->Sub_category_name."</option>";

        foreach ($sub_cat as $val){
            $stm .= "<option value='".$val->Sub_category_name."'>".$val->Sub_category_name."</option>";
        }

        $stm .= "</select>
                    </div>
                    <div class='add-fur-field edit-fur'>
                        <label>Quantity</label>
                        <input type='text' name='Quantity' placeholder='Quantity' value='".$fur[0]->Quantity."' disabled>
                    </div>
                </div>
                <div class='add-fur-field-set set-two'>
                    <div class='add-fur-field edit-fur'>
                        <label>Cost</label>
                        <input type='text' name='Cost' placeholder='Cost' value='".$fur[0]->Cost."' disabled>
                    </div>
                    <div class='add-fur-field edit-fur'>
                        <label>Warrenty Period (Format: 2 Years)<span class='dis-err' style='color: red;font-size: small' id='warrenty-error'></label>
                        <input type='text' name='Warrenty_period' placeholder='Warrenty Period' value='".$fur[0]->Warrenty_period."'>
                    </div>
                    <div class='add-fur-field edit-fur'>
                        <label>Wood Type<span class='dis-err' style='color: red;font-size: small' id='wood-type-error'></label>
                        <input type='text' name='Wood_type' placeholder='Wood Type' value='".$fur[0]->Wood_type."'>
                    </div>
                    <div class='add-fur-field edit-fur'>
                        <label>Supplier ID</label>
                        <input type='text' name='SupplierID' placeholder='Supplier' value='".$fur[0]->SupplierID."' disabled>
                    </div>
                </div>
            </div>
            <div class='add-fur-field edit-fur'>
                <label>Description<span class='dis-err' style='color: red;font-size: small' id='description-error'></label>
                <textarea name='Description' placeholder='Description' >".$fur[0]->Description."</textarea>
            </div>
            <div class='add-fur-btn'>
                <button id='edit-fur-save' onclick='save(`".$id."`)' type='submit'>Save</button>
            </div>
        ";

        echo $stm;
    }

    public function filter()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $furniture = new Furnitures();

        if($_POST['Category'] != "-- All --")
        {
            $rows = $furniture->filterFurniture(trim($_POST['Category']," "));
        }else{
            $rows = $furniture->getInventory();
        }

        if(empty($rows))
        {
            echo "<tr><td colspan='6' style='text-align: center;'>No Products Found</td></tr>";
            return;
        }

        foreach ($rows as $row){
            $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
        }

        $str = "
            <tr class='inv-header-tr'>
                            <th>SKU</th>
                            <th>Image</th>
                            <th class='inv-fur-name'>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th></th>
                        </tr>    
            " ;


        foreach ($rows as $row){
            $str .= "<tr class='inv-product'>
                        <td>".$row->ProductID."</td>
                        <td><img src='".ROOT."/".$row->Image."' alt=''></td>
                        <td>".$row->Name."</td>
                        <td>".$row->Quantity."</td>
                        <td>Rs.".$row->Cost.".00</td>
                        <td>
                            <div>
                                <span onclick='openPopup(`".$row->ProductID."`)'>Edit</span>
                            </div>
                       </td>
                    </tr>";

        }

        echo $str;

    }

    public function search()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $furniture = new Furnitures();
        $rows = '';

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $search = trim($_POST['product']);

            if($search[0] == 'P' && preg_match('/[0-9]/', substr($search, 1)))
            {
                $rows = $furniture->searchFurnitureByID($search);
            }else if(preg_match('/[a-zA-Z ]/', $search)){
                $rows = $furniture->searchFurnitureByName($search);
            }
        }

        if(empty($rows))
        {
            echo "<tr><td colspan='6' style='text-align: center;'>No Products Found</td></tr>";
        }else{
            foreach ($rows as $row){
                $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
            }

            $str = "
            <tr class='inv-header-tr'>
                            <th>SKU</th>
                            <th>Image</th>
                            <th class='inv-fur-name'>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th></th>
                        </tr>    
            " ;


            foreach ($rows as $row){
                $str .= "<tr class='inv-product'>
                        <td>".$row->ProductID."</td>
                        <td><img src='".ROOT."/".$row->Image."' alt=''></td>
                        <td>".$row->Name."</td>
                        <td>".$row->Quantity."</td>
                        <td>Rs.".$row->Cost.".00</td>
                        <td>
                            <div>
                                <span onclick='openPopup(`".$row->ProductID."`)'>Edit</span>
                            </div>
                       </td>
                    </tr>";

            }

            echo $str;
        }


    }

    public function filterPosts($category)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $furniture = new Furnitures();

        $rows = '';

        if ($category != "All") {
            $rows = $furniture->filterFurniture($category);
        } else {
            $rows = $furniture->getInventory();
        }

        if (empty($rows)) {
            echo "<tr><td colspan='6' style='text-align: center;'>No Products Found</td></tr>";
            return;
        }

        foreach ($rows as $row) {
            $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
        }

        $str = '';

        foreach ($rows as $row) {
            if ($row->Visibility == 1) {
                $visibility = "Visible";
            } else {
                $visibility = "Hidden";
            }

            $str .= "<tr>
                        <td>" . $row->ProductID . "</td>
                        <td><img src='" . ROOT . "/" . $row->Image . "' alt=''></td>
                        <td>" . $row->Name . "</td>
                        <td>" . $row->Quantity . "</td>
                        <td>Rs." . $row->Cost . ".00</td>
                        <td>
                            <a style='text-decoration: none' href='" . ROOT . "/manager/change_visibility/$row->ProductID/$row->Visibility'>$visibility</a>
                            <a style='text-decoration: none' href='" . ROOT . "/manager/reviews/$row->ProductID'>Reviews</a>
                            <a>More</a>
                       </td>
                    </tr>";
        }

        echo $str;
    }

    public function searchPosts($value)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $furniture = new Furnitures();
        $rows = $furniture->searchFurnitureByGivenID($value);


        $stm = '';

        if(empty($rows))
        {
            echo "<tr><td colspan='6' style='text-align: center;'>No Products Found</td></tr>";
            return;
        }

        foreach ($rows as $row) {
            $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
        }

        foreach ($rows as $row) {
            if ($row->Visibility == 1) {
                $visibility = "Visible";
            } else {
                $visibility = "Hidden";
            }

            $stm  .= "<tr>
                        <td>" . $row->ProductID . "</td>
                        <td><img src='" . ROOT . "/" . $row->Image . "' alt=''></td>
                        <td>" . $row->Name . "</td>
                        <td>" . $row->Quantity . "</td>
                        <td>Rs." . $row->Cost . ".00</td>
                        <td>
                            <a style='text-decoration: none' href='" . ROOT . "/manager/change_visibility/$row->ProductID/$row->Visibility'>$visibility</a>
                            <a style='text-decoration: none' href='" . ROOT . "/manager/reviews/$row->ProductID'>Reviews</a>
                            <a>More</a>
                       </td>
                    </tr>" ;
        }

        echo $stm;
    }

    public function save($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $furniture = new Furnitures();
        $_POST['ProductID'] = $id;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $furniture->update($id, $_POST);
            $allowedFileType = ['image/jpeg', 'image/png'];
            $folder = "uploads/images/";

            if(!empty($_FILES['PrimaryImage']['name']))
            {
                if($_FILES['PrimaryImage']['error'] == 0){
                    if(in_array($_FILES['PrimaryImage']['type'], $allowedFileType))
                    {
                        $destination = $folder . time() . 'primary' . $_FILES['PrimaryImage']['name'];

                        $existing_primary_image = $furniture->getDisplayImage($id)[0]->Image;
                        $furniture->updateImage($id,$destination,$existing_primary_image);
                        move_uploaded_file($_FILES['PrimaryImage']['tmp_name'], $destination);
                        unlink($existing_primary_image);
                    }
                }
            }

        }

        echo 'success';
    }
}