<?php

class Furnitures extends Model
{
    public $errors = [];
    protected $table = "furniture";

    protected $allowedColumns = [
        'ProductID',
        'Name',
        'CategoryID',
        'Sub_category_name',
        'Description',
        'Quantity',
        'Cost',
        'Visibility',
        'Availability',
        'Warrenty_period',
        'Wood_type',
        'Discount_percentage',
        'SupplierID',
        'Discount_given_by',
        'DiscountID',
        'Date'
    ];

    protected $beforeInsert = [
        'set_availability',
        'set_visibility'
    ];

    public function getNewFurniture($fields = null, $limit = 5, $order = 'desc')
    {
        $query = "select ";

        if (!empty($fields)) {
            foreach ($fields as $field) {
                $query .= $field . ", ";
            }
        }

        $query = trim($query, ", ");

        $query .= " from " . $this->table . " order by date $order limit $limit";

        return $this->query($query);
    }

    public function viewFurniture($id = null)
    {
        $query = "select ";

        $fields = [
            'ProductID',
            'furniture.Name',
            'Description',
            'Quantity',
            'Cost',
            'Availability',
            'Warrenty_period',
            'Wood_type ',
            'discounts.Discount_percentage'
        ];

        if (!empty($fields)) {
            foreach ($fields as $field) {
                $query .= $field . ", ";
            }
        }

        $query = trim($query, ", ");
        $query .= " from " . $this->table . " left join discounts on furniture.DiscountID = discounts.DiscountID where ProductID = '$id'";

        return $this->query($query);
    }

    public function getFurnitures($category ,$sub_cat,$offset,$limit = 2)
    {
        $query = "SELECT furniture.ProductID, furniture.Name, furniture.Cost, discounts.Discount_percentage FROM furniture LEFT JOIN discounts ON furniture.DiscountID = discounts.DiscountID WHERE furniture.CategoryID = '$category' && furniture.Sub_category_name = '$sub_cat' limit $limit offset $offset; ";

        return $this->query($query);
    }

    public function getFurniture($id)
    {

        $query = "select Name , Cost from furniture WHERE ProductID = :ProductID; ";

        return $this->query($query, ['ProductID' => $id]);
    }

    public function getDisplayImage($ProductId = null)
    {
        $query = "select Image from furniture_image where ProductId = :ProductId && Image like '%primary%';";

        return $this->query($query, ['ProductId' => $ProductId]);
    }

    public function getSecondaryImages($id = null){
        $query = "select Image from furniture_image where ProductId = :ProductId && Image not like '%primary%';";

        return $this->query($query, ['ProductId' => $id]);
    }

    public function getAllImages($id)
    {
        $query = "select Image from furniture_image WHERE ProductID = '$id';";

        return $this->query($query);
    }

    public function getInventory()
    {
        $query = "select ProductID , Name , Quantity , Cost, CategoryID,Visibility from furniture;";

        return $this->query($query);
    }
    public function getInventorywithDiscounts()
    {
        $query = "select ProductID , furniture.Name , Quantity , Cost, CategoryID, discounts.Discount_percentage FROM furniture LEFT JOIN discounts ON furniture.DiscountID = discounts.DiscountID";

        return $this->query($query);
    }

    public function deleteFurniture($id = null)
    {
        $query = "delete from furniture where ProductID = :ProductID;";

        return $this->query($query, ['ProductID' => $id]);
    }

    public function insertImages($productID, $images)
    {
        $query = "insert into furniture_image (`ProductID`, `Image`) values ('$productID','$images[0]'),('$productID','$images[1]'),('$productID','$images[2]');";

        return $this->query($query);
    }

    public function set_availability($DATA)
    {
        $DATA['Availability'] = 1;
        return $DATA;
    }

    public function set_visibility($DATA)
    {
        $DATA['Visibility'] = 1;
        return $DATA;
    }

    public function view_furniture_posts()
    {
        $query = "select ProductID, Name, Quantity, Cost, Visibility from $this->table";

        return $this->query($query);
    }

    public function updateVisibility($id, $visibility)
    {
        $query = "update $this->table set Visibility = :Visibility where ProductID = :ProductID;";

        return $this->query($query, ['Visibility' => $visibility, 'ProductID' => $id]);
    }

    public function validate($post)
    {
        $this->errors = [];

        if (empty($post['ProductID'])) {
            $this->errors['ProductID'] = "SKU ID is required";
        } elseif (strlen($post['ProductID']) != 5) {
            $this->errors['ProductID'] = "SKU ID must be 5 characters";
        } elseif (!ctype_alnum($post['ProductID'])) {
            $this->errors['ProductID'] = "SKU ID must be alphanumeric";
        } elseif ($this->where('ProductID', $post['ProductID'])) {
            $this->errors['ProductID'] = "SKU ID already exists";
        }

        if (empty($post['Name'])) {
            $this->errors['Name'] = "Name is required";
        }

        if (empty($post['CategoryID'])) {
            $this->errors['CategoryID'] = "Category is required";
        }

        if (empty($post['Sub_category_name'])) {
            $this->errors['Sub_category_name'] = "Sub Category is required";
        }

        if (empty($post['Description'])) {
            $this->errors['Description'] = "Description is required";
        }

        if (empty($post['Quantity'])) {
            $this->errors['Quantity'] = "Quantity is required";
        } elseif (!ctype_digit($post['Quantity'])) {
            $this->errors['Quantity'] = "Quantity must be a number";
        }

        if (empty($post['Cost'])) {
            $this->errors['Cost'] = "Cost is required";
        } elseif (!is_numeric($post['Cost'])) {
            $this->errors['Cost'] = "Cost must be a number";
        }

        if (empty($post['Warrenty_period'])) {
            $this->errors['Warrenty_period'] = "Warrenty Period is required";
        }

        if (empty($post['Wood_type'])) {
            $this->errors['Wood_type'] = "Wood Type is required";
        }

        if (empty($post['SupplierID'])) {
            $this->errors['SupplierID'] = "Supplier ID is required";
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    public function getOutOfStockFurniture()
    {
        $query = "select ProductID,Name from $this->table where Quantity = 0";

        return $this->query($query);
    }

    public function getFurnitureName($id = null)
    {
        $query = "select Name from $this->table where ProductID = :ProductID;";

        return $this->query($query, ['ProductID' => $id]);
    }


    public function view_furniture_orders()
    {
        $query = "select ProductID, Name, Quantity, Cost, Visibility from $this->table";

        return $this->query($query);
    }
    public function view_furniture_issues()
    {
        $query = "select ProductID, Name, Quantity, Cost, Visibility from $this->table";

        return $this->query($query);
    }

    public function getFurnitureCount()
    {
        $query = "select count(ProductID) as count from $this->table;";

        return    $this->query($query);
    }

    public function getOTScount()
    {
        $query = "select count(ProductID) as count from $this->table where Quantity = 0;";

        return $this->query($query);
    }

    public function getFurnitureByID($id)
    {
        $query = "SELECT * FROM $this->table WHERE ProductID = :ProductID;";

        return $this->query($query, ['ProductID' => $id]);
    }

    public function filterFurniture($id){
        $query = "SELECT ProductID,Name,Quantity,Cost,Visibility FROM furniture WHERE CategoryID = :CategoryID;";

        return $this->query($query,['CategoryID' => $id]);
    }

    public function searchFurnitureByID($id)
    {
        $query = "SELECT ProductID,Name,Quantity,Cost,Visibility FROM $this->table WHERE ProductID = :ProductID;";

        return $this->query($query, ['ProductID' => $id]);
    }

    public function searchFurnitureByGivenID($id)
    {
        $query = "SELECT ProductID,Name,Quantity,Cost,Visibility FROM $this->table WHERE ProductID LIKE '%$id%';";

        return $this->query($query);
    }


    public function searchFurnitureByName($name)
    {
        $query = "SELECT ProductID,Name,Quantity,Cost FROM $this->table WHERE Name like '%$name%';";

        return $this->query($query);
    }

    public function getFurnitureBySubCategoryName($name)
    {
        $query = "SELECT ProductID,Name,Quantity,Cost FROM furniture WHERE Sub_category_name LIKE '%$name%';";

        return $this->query($query);
    }

    public function updateDiscount($id, $discount)
    {
        $query = "update $this->table set DiscountID = :Discount where ProductID =:ProductID;";

        return $this->query($query, ['ProductID' => $id, 'Discount' => $discount]);
    }

    public function getDiscountedFurniture($id)
    {
        $query = "select ProductID, Name, Cost from $this->table where DiscountID = :DiscountID;";

        return $this->query($query, ['DiscountID' => $id]);
    }

    public function getProductsBySupplier($id)
    {
        $query = "select furniture.ProductID, furniture.Name, furniture.Quantity, furniture.CategoryID, furniture.Sub_category_name, Reorder_point from $this->table inner join inventory on furniture.ProductID = inventory.ProductID where SupplierID = :SupplierID ORDER BY CategoryID;";

        return $this->query($query, ['SupplierID' => $id]);
    }
    

    


    public function updateImage($id,$image,$prev_image)
    {
        $query = "update furniture_image set Image = :Image where ProductID = :ProductID && Image: :Previous_image;";

        return $this->query($query,['ProductID' => $id,'Image' => $image,'Previous_image' => $prev_image]);
    }

}
