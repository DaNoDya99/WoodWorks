<?php

class Delivery extends Controller
{
    public function index()
    {

    }

    public function getDeliveryCost()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $delivery = new Deliveries();
        $rows = $delivery->findAll();

        $stm = '<tr>
                     <th>Distance</th>
                     <th>Cost</th>
                     <th>Actions</th>
                </tr>';

        foreach ($rows as $row)
        {
            $stm .= "
                        <tr>
                            <td> ".$row->Distance_from."km - ".$row->Distance_to."km</td>
                            <td>Rs ".$row->Cost_per_km."</td>
                            <td>
                                <div class='inv-table-btns'>
                                     <button onclick='editRate(`".$row->id."`)'><img src='http://localhost/WoodWorks/public/assets/images/admin/edit-4-svgrepo-com.svg' alt=''></button>
                                     <button onclick='deleteRate(`".$row->id."`)'><img src='http://localhost/WoodWorks/public/assets/images/admin/delete-svgrepo-com.svg' alt=''></button>
                                </div>
                            </td>
                        </tr>            ";
        }

        echo $stm;
    }

    public function getRate($id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $delivery = new Deliveries();
        $row = $delivery->find($id)[0];

        if(!empty($row))
        {
            echo json_encode($row);
        }
        else
        {
            echo json_encode("error");
        }
    }

    public function addRate()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $delivery = new Deliveries();
        $delivery->insert($_POST);

        echo "success";
    }

    public function updateRate($id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $delivery = new Deliveries();
        $_POST['id'] = $id;

        if(!$delivery->updateRate($_POST)){
            echo "success";
        }else{
            echo "error";
        }
    }

    public function deleteRate($id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $delivery = new Deliveries();

        if($delivery->delete($id)){
            echo "error";
        }else{
            echo "success";
        }
    }
}