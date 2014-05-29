<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'models/OwnerInfo.php';
require_once("class.emailtodb.php");

class Parse extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->em = $this->doctrine->em;
        $this->load->library('CommonfloorParse');
    }

    public function index(){

        $this->commonfloorparse->connect('mail.google.com', 'aanchlia@gmail.com', '');
        $this->commonfloorparse->do_action();
        $data = $this->em->getRepository('Model\OwnerInfo')->findOneBy(array('id' => 2));
        print_r($data);

    }
}
