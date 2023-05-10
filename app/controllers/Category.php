<?php

class Category extends Controller
{
    private function getUser()
    {
        $customer = new Customer();
        $id = Auth::getCustomerID();
        return $customer->where('CustomerID',$id);
    }

    public function index(){

        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $categories = new Categories();
        $data['row'] = $this->getUser();
        $data['categories'] = $categories->findAll();;

        $this->view("reg_customer/category",$data);
    }

    public function sub_category($id = null,$sub_cat = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $sub_cat = preg_split('/(?=[A-Z])/',$sub_cat);
        unset($sub_cat[0]);
        $sub_cat = implode(" ",$sub_cat);
        $data['row'] = $this->getUser();

        $sub_category = new Sub_Categories();
        $furniture = new Furnitures();
        $review = new Reviews();

        $limit = 8;

        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data['sub_categories'] =$rows= $sub_category->where('CategoryID',$id);
        $data['id'] = $id;
        $data['pager'] = $pager;
        $data['furniture'] = $furniture->getFurnitures($id,$sub_cat,$limit,$offset);

        if(!empty($data['furniture']))
        {
            foreach ($data['furniture'] as $row)
            {
                $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
                $row->Rate = round($review->getProductRating($row->ProductID)[0]->Average,1);
                $row->Rating = (($row->Rate/5)*100).'%';
            }
        }

        if(empty($sub_cat)){
            $this->redirect('category/sub_category/'.$id."/".$rows[0]->Sub_category_name);
        }

        $this->view("reg_customer/sub_category",$data);
    }

    public function addCategory()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $category = new Categories();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($category->validate($_POST))
            {
                if(!empty($_FILES["Image"]['name']))
                {
                    $folder = "uploads/images/";
                    if(!file_exists($folder)){
                        mkdir($folder,0777,true);
                        file_put_contents($folder."index.php","<?php Access Denied.");
                        file_put_contents("uploads/index.php","<?php Access Denied.");
                    }

                    $allowedFileType = ['image/jpeg','image/png'];

                    if($_FILES['Image']['error'] == 0)
                    {
                        if(in_array($_FILES['Image']['type'],$allowedFileType))
                        {
                            $destination = $folder.time().$_FILES['Image']['name'];
                            move_uploaded_file($_FILES['Image']['tmp_name'],$destination);

                            $_POST['Image'] = $destination;
                            $category->insert($_POST);
                        }else{
                            $category->errors['image'] = "This file type is not allowed.";
                        }
                    }else{
                        $category->errors['image'] = "Could not upload image.";
                    }
                }else{
                    $category->errors['image'] = "Please select an image.";
                }
            }
        }

        if(empty($category->errors))
        {
            echo "<div class='cat-success'>
                    <h3>Sub Category Added Successfully.</h3>
                  </div>";
        }else{
            $stm = "<div class='cat-errors''>
                        <ul>";
            foreach ($category->errors as $error)
            {
                $stm .= "<li>".$error."</li>";
            }

            $stm .= "</ul>
                    </div>";

            echo $stm;
        }


    }

    public function addSubcategory()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $sub_category = new Sub_Categories();


        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($sub_category->validate($_POST))
            {
                if(!empty($_FILES["Image"]['name']))
                {
                    $folder = "uploads/images/";
                    if(!file_exists($folder)){
                        mkdir($folder,0777,true);
                        file_put_contents($folder."index.php","<?php Access Denied.");
                        file_put_contents("uploads/index.php","<?php Access Denied.");
                    }

                    $allowedFileType = ['image/jpeg','image/png'];

                    if($_FILES['Image']['error'] == 0)
                    {
                        if(in_array($_FILES['Image']['type'],$allowedFileType))
                        {
                            $destination = $folder.time().$_FILES['Image']['name'];
                            move_uploaded_file($_FILES['Image']['tmp_name'],$destination);

                            $_POST['Image'] = $destination;
                            echo json_encode($_POST);
                            $sub_category->insert($_POST);
                        }else{
                            $sub_category->errors['image'] = "This file type is not allowed.";
                        }
                    }else{
                        $sub_category->errors['image'] = "Could not upload image.";
                    }
                }else{
                    $sub_category->errors['image'] = "Please select an image.";
                }
            }
        }

        if(empty($sub_category->errors))
        {
            echo "<div class='cat-success'>
                    <h3>Sub Category Added Successfully.</h3>
                  </div>";
        }else{
            $stm = "<div class='cat-errors''>
                        <ul>";
            foreach ($sub_category->errors as $error)
            {
                $stm .= "<li>".$error."</li>";
            }

            $stm .= "</ul>
                    </div>";

            echo $stm;
        }
    }

    public function deleteCategory($id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $category = new Categories();

        $row = $category->getCategoryByID($id);
        unlink($row[0]->Image);
        $category->deleteCategory($id);

        echo "<div class='cat-success cat-deletion'>
                  <h2>Category Deleted Successfully!</h2>
              </div>";
    }

    public function deleteSubCategory($id,$name)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $sub_category = new Sub_Categories();
        unlink($sub_category->getSubCategoryImage($name,$id)[0]->Image);
        $sub_category->deleteSubCategory($id,$name);

        echo "<div class='cat-success cat-deletion'>
                  <h2>Sub Category Deleted Successfully!</h2>
              </div>";
    }

    public function editCategory($id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $category = new Categories();
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($category->edit_validate($_POST))
            {
                if(!empty($_FILES["Image"]['name']))
                {
                    $folder = "uploads/images/";
                    if(!file_exists($folder)){
                        mkdir($folder,0777,true);
                        file_put_contents($folder."index.php","<?php Access Denied.");
                        file_put_contents("uploads/index.php","<?php Access Denied.");
                    }

                    $allowedFileType = ['image/jpeg','image/png'];

                    if($_FILES['Image']['error'] == 0)
                    {
                        if(in_array($_FILES['Image']['type'],$allowedFileType))
                        {
                            $destination = $folder.time().$_FILES['Image']['name'];
                            move_uploaded_file($_FILES['Image']['tmp_name'],$destination);
                            unlink($category->getCategoryImage($id)[0]->Image);

                            $_POST['Image'] = $destination;
                            $category->updateCategoryWithImage($_POST,$id);
                        }else{
                            $category->errors['image'] = "This file type is not allowed.";
                        }
                    }else{
                        $category->errors['image'] = "Could not upload image.";
                    }
                }else{
                    $category->updateCategoryName($_POST['Category_name'],$id);
                }
            }
        }

        if(empty($category->errors))
        {
            echo "<div class='cat-success'>
                    <h3>Category Edited Successfully.</h3>
                  </div>";
        }else{
            $stm = "<div class='cat-errors''>
                        <ul>";
            foreach ($category->errors as $error)
            {
                $stm .= "<li>".$error."</li>";
            }

            $stm .= "</ul>
                    </div>";

            echo $stm;
        }
    }

    public function editSubCategory($id,$name)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $sub_category = new Sub_Categories();
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($sub_category->edit_validate($_POST))
            {
                if(!empty($_FILES["Image"]['name']))
                {
                    $folder = "uploads/images/";
                    if(!file_exists($folder)){
                        mkdir($folder,0777,true);
                        file_put_contents($folder."index.php","<?php Access Denied.");
                        file_put_contents("uploads/index.php","<?php Access Denied.");
                    }

                    $allowedFileType = ['image/jpeg','image/png'];

                    if($_FILES['Image']['error'] == 0)
                    {
                        if(in_array($_FILES['Image']['type'],$allowedFileType))
                        {
                            $destination = $folder.time().$_FILES['Image']['name'];
                            move_uploaded_file($_FILES['Image']['tmp_name'],$destination);
                            unlink($sub_category->getSubCategoryImage($name,$id)[0]->Image);

                            $_POST['Image'] = $destination;
                            $sub_category->updateSubCategoryWithImage($_POST,$name,$id);
                        }else{
                            $sub_category->errors['image'] = "This file type is not allowed.";
                        }
                    }else{
                        $sub_category->errors['image'] = "Could not upload image.";
                    }
                }else{
                    $sub_category->updateSubCategoryName($_POST['Sub_category_name'],$name,$id);
                }
            }
        }

        if(empty($sub_category->errors))
        {
            echo "<div class='cat-success'>
                    <h3>Sub Category Edited Successfully.</h3>
                  </div>";
        }else{
            $stm = "<div class='cat-errors''>
                        <ul>";
            foreach ($sub_category->errors as $error)
            {
                $stm .= "<li>".$error."</li>";
            }

            $stm .= "</ul>
                    </div>";

            echo $stm;
        }
    }

    public function getSubCategories($id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $sub_category = new Sub_Categories();
        $furniture = new Furnitures();
        $rows = $sub_category->getSubCategoriesByCatID($id);

        $str = '';

        foreach($rows as $row)
        {
            $str .= "<div>
                          <input id='".$row->Sub_category_name."' type='checkbox' checked onclick='selectAllCategoryProducts(`".$row->Sub_category_name."`)'>
                          <span class='subcat-title'>".$row->Sub_category_name."</span>
                          <div class='sub-cat-items'>";

            $fur = $furniture->getFurnitureBySubCategoryName($row->Sub_category_name);

            if(!empty($fur)){
                foreach ($fur as $value) {
                    $image = $furniture->getDisplayImage($value->ProductID)[0]->Image;

                    $str .= "
                        <div class='furniture-item'>
                             <input category='".$row->Sub_category_name."' type='checkbox' name='products' value='".$value->ProductID."' checked>
                             <img src='http://localhost/WoodWorks/public/" . $image . "' alt=''>
                             <span>" . $value->Name . "</span>
                        </div>
                    ";
                }
            }else{
                $str .= "<div>
                             <span class='not-found'>No Furniture Found.</span>
                        </div>";
            }

            $str .= '</div>';
        }

        echo $str;
    }
}