<?php
class HelperlandController
{
    function __construct()
    {
        include('Models/Connection.php');
        $this->model = new Helperland();
        session_start();
    }
    public function HomePage()
    {
        include("./Views/homepage.php");
    }
    public function ContactUs()
    {
        if (isset($_POST)){
            $base_url = 'http://localhost/Helperland/Contact';
            $FirstName =  $_POST['FirstName'];
            $LastName =  $_POST['LastName'];
            $array = [
                'Name' => $FirstName . " " . $LastName,
                'Email' => $_POST['Email'],
                'Subject' => $_POST['Subject'],
                'PhoneNumber' => $_POST['PhoneNumber'],
                'Message' => $_POST['Message'],
                'CreatedOn' => date('Y-m-d H:i:s')
            ];
            $this->model->ContactUs('contactus', $array);
            header('Location: ' . $base_url);
        }
        else{
            echo 'Error Occurring in Data';
        }
    }

}