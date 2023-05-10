<?php

class Deliveries extends Model
{
    protected $table = "delivery_cost";
    protected $errors = [];

    protected $allowedColumns = [
        'Distance_from',
        'Distance_to',
        'Cost_per_km',
    ];

    public function find($id): false|array
    {
        $query = "SELECT * FROM $this->table WHERE id = :id;";

        return $this->query($query,['id' => $id]);
    }

    public function  updateRate($data)
    {
        $query = "UPDATE $this->table SET Distance_from = :Distance_from, Distance_to = :Distance_to, Cost_per_km = :Cost_per_km WHERE id = :id;";

        return $this->query($query, $data);
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id;";

        return $this->query($query,['id' => $id]);
    }

    function getDeliveryRate($distance)
    {
        $query = "SELECT * FROM $this->table WHERE Distance_from <= :distance AND Distance_to >= :distance;";

        return $this->query($query,['distance' => $distance]);
    }
}