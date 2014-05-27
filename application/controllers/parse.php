<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'models/OwnerInfo.php';
require_once("class.emailtodb.php");

class Parse extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //$this->load->library('doctrine');
        $this->em = $this->doctrine->em;
    }

    public function index(){
        $edb = new EMAIL_TO_DB();
        $edb->connect('mail.google.com', '', 'aanchlia@gmail.com', '');
        $edb->do_action();
        $data = $this->em->getRepository('Model\OwnerInfo')->findOneBy(array('id' => 2));
        print_r($data);

    }
}
