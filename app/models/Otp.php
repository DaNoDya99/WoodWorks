<?php
date_default_timezone_set("Asia/Colombo");
class Otp extends Model
{
    public $errors = [];
    protected $table = 'otp';

    protected $allowedColumns = [
        'Email',
        'otpCode',
        'TimeCreated',
    ];

    protected $beforeInsert = [
        'hash_otp'
    ];

    public function setOTP($id) //generate an OTP and save it to the database
    {
        $res = $this->where('Email', 'nisuraindisa2000@gmail.com');


        if ($res) { // if otp has been sent previously , generate new otp and send to email
            $email = $res[0]->Email;
            $otp =  rand(100000, 999999);
            $this->update($email, ['Email' => $email, 'otpCode' => $otp, 'TimeCreated' => date('Y-m-d H:i:s')]);
            return $otp;
        } else { // else generate new otp and add to table
            $email = $id;
            $otp = rand(100000, 999999);
            $date = date('Y-m-d H:i:s');
            $this->insert([
                'Email' => $email,
                'otpCode' => $otp,
                'TimeCreated' => $date,
            ]);
            return $otp;
        }
    }


    public function getOTP($id) //get the OTP from the database
    {
        $otp = $this->where('Email', $id)[0]->otpCode;
        return $otp;
    }

    public function validateOTP($id, $otp) // check the validity of the OTP Code
    //otp = customer inserted otp
    {
        $db = $this->where('Email', $id)[0];
        $d1 = strtotime(date($db->TimeCreated));
        $d2 = strtotime(date("y-m-d h:i:sa"));
        if (password_verify($otp, $db->otpCode)) {
            if (floor(($d2 - $d1) / 3600 * 60) > 30) {
                echo ("OTP Expired");
                die;
            } else {
                return TRUE;
            }
        }
    }

    public function hash_otp($data)
    {
        $data['otpCode'] = password_hash($data['otpCode'], PASSWORD_DEFAULT);
        return $data;
    }
}
