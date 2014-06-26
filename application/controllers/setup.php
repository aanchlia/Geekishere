<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller {

    /** @var   */
    protected $link;

    /** @var  string */
    protected $status;

    public function __construct(){
        parent::__construct();
        $this->em = $this->doctrine->em;
        $this->load->model('InsertParseData');
    }

    /**
     * Main action function
     */
    public function processing(){
        $email_data = $this->connect('{imap.gmail.com:993/imap/ssl/novalidate-cert/norsh}Inbox', '', '');
        /*$this->commonfloor_parsing($email_data);
        $this->ninety_nine_acres_parsing($email_data);
        $this->magic_bricks_parsing($email_data);*/
        $this->InsertParseData->dataMapping();
    }

    /**
     * Connect to email system
     * @param $host
     * @param $login
     * @param $pass
     * @return resource
     */
    public function connect($host, $login, $pass){

        $this->link = imap_open($host, $login, $pass);
        if($this->link) {
            $this->status = 'Connected';
        } else {
            $error[] = imap_last_error();
            $this->status = 'Not connected';
        }
        return $this->link;
    }

    /**
     * Parse the data and return
     * @param $email_data
     */
    public function commonfloor_parsing($email_data){
        $data = array();
        $results = imap_search($email_data, 'UNSEEN  FROM ""');

        foreach($results as $result){
            $header=imap_headerinfo($email_data, 6366); //Get email of the header
            $property_id = explode(':', $header->subject);
            $data['property_id'][1] = $property_id[sizeof($property_id)-1];

            $body = imap_body($email_data, 6366); //Get the body of the email.

            preg_match("/Name\s\s:\K(.*?)\ Is\K/s", $body, $data['name']);

            preg_match("/Broker\s\s:\K(.*?)\ Email\K/s", $body, $data['is_broker']);

            preg_match("/ID\s\s:\K(.*?)\ Phone\K/s", $body, $data['email_id']);

            preg_match("/Phone\sNo.\s\s:\K(.*?)\ Reply\K/s", $body, $data['phone']);

            preg_match("/Reply\s\s:\K(.*?)\ Please\sclick\K/s", $body, $data['message']);

            $formatted_data = $this->remove_spaces($data);

            $this->InsertParseData->insertData($formatted_data);
        }

    }

    /**
     * Parse the data and return
     * @param $email_data
     */
    public function ninety_nine_acres_parsing($email_data){
        $data = array();
        $results = imap_search($email_data, 'UNSEEN  FROM "10.ankush@gmail.com"');

        foreach($results as $result){
            $body = imap_body($email_data, 6371); //Get the body of the email.

            preg_match("/Property\s\sCode\s:\K(.*?)\ Details\K/s", $body, $data['property_id']);

            preg_match("/Name\s:\K(.*?)\Email\K/s", $body, $data['name']);
            $data['name'][1] = substr($data['name'][1], 0 , -1);

            preg_match("/ID\s:\K(.*?)\ Phone\s\sNo\K/s", $body, $data['email_id']);

            preg_match("/Phone\s\sNo\s:\K(.*?)\Enquiry\K/s", $body, $data['phone']);
            $data['phone'][1] = substr($data['phone'][1], 0 , -1);

            preg_match("/Enquiry\s:\K(.*?)\*Contact\sthis\K/s", $body, $data['message']);
            $formatted_data = $this->remove_spaces($data);

            $this->InsertParseData->insertData($formatted_data);
        }

    }

    /**
     * Parse the data and return
     * @param $email_data
     */
    public function magic_bricks_parsing($email_data){
        $data = array();
        $results = imap_search($email_data, 'UNSEEN  FROM "10.ankush@gmail.com"');

        foreach($results as $result){
            $body = imap_body($email_data, 6372); //Get the body of the email.

            preg_match("/Property,\sID\K(.*?)\:\K/s", $body, $data['property_id']);

            preg_match("/Sender's\sName:\K(.*?)\Mobile\K/s", $body, $data['name']);

            preg_match("/Mobile:\K(.*?)\sEmail\K/s", $body, $data['phone']);

            preg_match("/Email:\K(.*?)\sMessage\K/s", $body, $data['email_id']);

            preg_match("/Message:\K(.*?)\Click here\K/s", $body, $data['message']);
            $formatted_data = $this->remove_spaces($data);

            $this->InsertParseData->insertData($formatted_data);
        }

    }

    /**
     * Remove any white spaces before ot after the string.
     * @param $data
     * @return mixed
     */
    public function remove_spaces($data){
        foreach($data as $key => $value){
            $formatted_data[$key] = trim($value[1]);
        }
        return $formatted_data;
    }
}
