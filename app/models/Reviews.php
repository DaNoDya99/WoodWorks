<?php

class Reviews extends Model
{
    public $errors = [];
    protected $table = "ratings";

    protected $allowedColumns = [
        'Rating',
        'Reviews',
        'CustomerID',
        'ProductID',
        'Date'
    ];

    public function getReview($fields = null, $id = null)
    {

        $query = "select ";

        foreach ($fields as $field) {
            $query .= $field . ", ";
        }

        $query = trim($query, ", ");
        $query .= " from " . $this->table . " INNER JOIN customer ON " . $this->table . ".CustomerID = customer.CustomerID WHERE " . $this->table . ".ProductID = '$id';";

        return $this->query($query);
    }

    public function getReviewsForManager($id)
    {
        $query = "select Rating, Reviews, Date from $this->table where ProductID = :ProductID;";

        return $this->query($query, ['ProductID' => $id]);
    }

    public function getProductReviews($productID, $customerID)
    {
        $query = "select Rating, Reviews, Date from $this->table where ProductID = :ProductID and CustomerID = :CustomerID;";

        return $this->query($query, ['ProductID' => $productID, 'CustomerID' => $customerID]);
    }

    public function updateReview($data,$productId,$customerId)
    {
        $query = "update $this->table set Rating = :Rating, Reviews = :Reviews where ProductID = :ProductID and CustomerID = :CustomerID;";

        $this->query($query, ['Rating' => $data['Rating'], 'Reviews' => $data['Reviews'], 'ProductID' => $productId, 'CustomerID' => $customerId]);
    }

    public function getProductRating($productID)
    {
        $query = "select avg(Rating) as Average from $this->table where ProductID = :ProductID;";

        return $this->query($query, ['ProductID' => $productID]);
    }

    public function getTop5RatedProducts(){
        $query = "select ProductID, avg(Rating) as Average from $this->table group by ProductID order by Average desc limit 5;";

        return $this->query($query);
    }
}