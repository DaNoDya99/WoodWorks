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
        $data['categories'] = $categories->findAll();

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

        $limit = 8;

        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data['sub_categories'] =$rows= $sub_category->where('CategoryID',$id);
        $data['id'] = $id;
        $data['pager'] = $pager;
        $data['furniture'] = $furniture->getFurnitures($id,$sub_cat,$limit,$offset);

        foreach ($data['furniture'] as $row)
        {
            $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
        }

        if(empty($sub_cat)){
            $this->redirect('category/sub_category/'.$id."/".$rows[0]->Sub_category_name);
        }

        $this->view("reg_customer/sub_category",$data);
    }
}