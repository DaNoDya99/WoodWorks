<?php

require '../app/services/DistanceMatrixService.php';

class Home extends Controller
{

    private function getUser()
    {
        $customer = new Customer();
        $id = Auth::getCustomerID();
        return $customer->where('CustomerID',$id);
    }

    public function index(){

        if(Auth::logged_in())
        {
            Auth::logout();
        }

        $db = new Database();
        $db->create_tables();

        $furniture =  new Furnitures();
        $review = new Reviews();

        $data['furnitures'] = $rows = $furniture->getNewFurniture(['ProductID','Name','Cost','Sub_category_name']);

        foreach ($rows as $row)
        {
            if(!empty($furniture->getDisplayImage($row->ProductID)[0]->Image))
            {
                $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
                $row->Rate = round($review->getProductRating($row->ProductID)[0]->Average,1);
                $row->Rating = (($row->Rate/5)*100).'%';
            }
        }

        $this->view('home',$data);
    }

    public function product($id = null)
    {

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

        $data['furniture'] = $furniture->viewFurniture($id);
        $data['reviews'] = $review->getReview($allowedCols,$id);
        $data['rating'] = round($review->getProductRating($id)[0]->Average,1);
        $data['images'] = $furniture->getAllImages($id);

        $this->view('product',$data);
    }

    public function category()
    {
        $categories = new Categories();
        $data['categories'] = $categories->findAll();


        $this->view('category',$data);
    }

    public function sub_category($id = null,$sub_cat = null)
    {

        $sub_cat = preg_split('/(?=[A-Z])/',$sub_cat);
        unset($sub_cat[0]);
        $sub_cat = implode(" ",$sub_cat);
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
        $data['flag'] = 'f';

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
            $this->redirect('home/sub_category/'.$id."/".$rows[0]->Sub_category_name);
        }


        $this->view("sub_category",$data);
    }

    public function viewAdvertisements()
    {
        $limit = 8;

        $pager = new Pager($limit);
        $offset = $pager->offset;

        $advertisements = new Advertisements();
        $rows = $advertisements->getRefurbishedFurniture($limit,$offset);

        foreach ($rows as $row) {
            $row->ProductID = $row->AdvertisementID;
            $row->Name = $row->Product_name;
            $row->Cost = $row->Price;
            $row->Discount_percentage = '';
            $row->Active = '';
            $row->Rate = 0;
            $row->Image = $advertisements->getDisplayImage($row->AdvertisementID)[0]->Image;
        }

        $data['row'] = $this->getUser();
        $data['furniture'] = $rows;
        $data['sub_categories'] = 'Refurbished Furniture';
        $data['pager'] = $pager;
        $data['flag'] = 'rf';

        $this->view('sub_category',$data);
    }

    public function about()
    {
        $this->view('about');
    }

    public function contact()
    {
        $this->view('contact');
    }
}