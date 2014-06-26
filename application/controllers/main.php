<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->em = $this->doctrine->em;

    }

    public function install(){
        shell_exec("ECHO '/1 * * * * cd " . FCPATH . " && ENVIRONMENT=development php index.php main sample' | crontab ");
    }

    public function sample(){
        $params = array('email' =>'e', 'password' =>'ee');
        /*$this->load->library('GoogleVoice');
        $data = $this->googlevoice->send_sms('+17134943178', 'ha');*/
        //$this->send_sms('+17134943178', 'ha');
        $data = mail("7134943178@txt.att.net", "", "Yoooo!");
        //$data = mail("9198928767653819@airtelmail.com", "", "Yoooo!");
        echo $data;
    }

    public function welcome_form(){

        $message = '';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $owner_data = new \Entity\OwnerInfo();
            $owner_data->setOwnerName($_POST['Name']);
            $owner_data->setEmailId($_POST['Email']);
            $owner_data->setPhone($_POST['Phone']);
            $owner_data->setType($_POST['Type']);
            $owner_data->setLocation($_POST['Location']);
            $owner_data->setBua($_POST['BUA']);
            $owner_data->setCarpet($_POST['Carpet']);
            $owner_data->setAmenities($_POST['Amenities']);
            $owner_data->setDescription($_POST['Description']);
            $this->em->persist($owner_data);
            $this->em->flush();
            $message = 'Thanks for submitting your request';
        }

        $this->load->view('owner_form', array('message' => $message));
    }
}
