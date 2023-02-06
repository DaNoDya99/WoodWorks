<?php

class Home extends Controller
{
    public function index(){

        if(Auth::logged_in())
        {
            Auth::logout();
        }

        $db = new Database();
        $db->create_tables();

        $furniture =  new Furnitures();

        $data['furnitures'] = $rows = $furniture->getNewFurniture(['ProductID','Name','Cost','Sub_category_name']);

        foreach ($rows as $row)
        {
            if(!empty($furniture->getDisplayImage($row->ProductID)[0]->Image))
            {
                $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
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
            }
        }

        if(empty($sub_cat)){
            $this->redirect('home/sub_category/'.$id."/".$rows[0]->Sub_category_name);
        }


        $this->view("sub_category",$data);
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