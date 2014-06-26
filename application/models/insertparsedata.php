<?php

require APPPATH . 'models/Entity/OwnerInfo.php';

class InsertParseData extends \CI_Model{

    public function __construct(){
        parent::__construct();
        $this->em = $this->doctrine->em;
        $this->load->library('email');
    }

    public function insertData($parseArray){
        $leadDetails = new \Entity\LeadDetails();
        $leadDetails->setName($parseArray['name']);
        $leadDetails->setEmailId($parseArray['email_id']);
        $leadDetails->setPhone($parseArray['phone']);
        $leadDetails->setMessage($parseArray['message']);
        $leadDetails->setPropertyId($parseArray['property_id']);
        $leadDetails->setEmailSent(0);
        $this->em->persist($leadDetails);
        $this->em->flush();
    }

    public function dataMapping(){
        $new_data = $this->em->getRepository('Entity\LeadDetails')->findBy(array('emailSent' => 0));
        foreach($new_data as $data){
            $property_id = $data->getPropertyId();
            $commonfloor_match = $this->em->getRepository('Entity\OwnerInfo')->findOneBy(array('commonfloorId' => $property_id));
            $ninetynineacres_match = $this->em->getRepository('Entity\OwnerInfo')->findOneBy(array('ninetynineacresId' => $property_id));
            $magicbricks_match = $this->em->getRepository('Entity\OwnerInfo')->findOneBy(array('magicbricksId' => $property_id));
            if($magicbricks_match){
                $magicbricks_data['owner_name'] = $magicbricks_match->getOwnerName();
                $magicbricks_data['email_id'] = $magicbricks_match->getEmailId();
                $magicbricks_data['lead_name'] = $data->getName();
                $magicbricks_data['lead_phone'] = $data->getPhone();
                $magicbricks_data['lead_email'] = $data->getEmailId();
                $magicbricks_data['lead_message'] = $data->getMessage();
                $this->sendEmail($magicbricks_data);
            }
            if($ninetynineacres_match){
                $ninetynineacres_data['owner_name'] = $ninetynineacres_match->getOwnerName();
                $ninetynineacres_data['email_id'] = $ninetynineacres_match->getEmailId();
                $ninetynineacres_data['lead_name'] = $data->getName();
                $ninetynineacres_data['lead_phone'] = $data->getPhone();
                $ninetynineacres_data['lead_email'] = $data->getEmailId();
                $ninetynineacres_data['lead_message'] = $data->getMessage();
                $this->sendEmail($ninetynineacres_data);
            }
        }
        exit;
    }

    public function sendEmail($dataToBeSent){
        $date = new DateTime();
        $message = 'Dear'.' '.$dataToBeSent["owner_name"].','.PHP_EOL.PHP_EOL;
        $message.= 'Date'.' '.$date->format('Y-m-d').PHP_EOL.PHP_EOL;
        $message.='Lead Name:'.' '.$dataToBeSent["lead_name"].PHP_EOL.PHP_EOL;
        $message.='Lead Email:'.' '.$dataToBeSent["lead_email"].PHP_EOL.PHP_EOL;
        $message.='Lead Phone:'.' '.$dataToBeSent["lead_phone"].PHP_EOL.PHP_EOL;
        $message.='Lead Message:'.' '.$dataToBeSent["lead_message"].PHP_EOL.PHP_EOL;
        $message.= 'Regards,'.PHP_EOL;
        $message.= 'House Linx Team,'.PHP_EOL.PHP_EOL;
        $config = array(
            'protocol'  =>  'smtp',
            'smtp_host' =>  'ssl://smtp.gmail.com',
            'smtp_user' =>  '',
            'smtp_pass' =>  '',
            'smtp_port' =>  '465'
        );

        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('aanchlia@rediffmail.com', 'House Linx Team');
        $this->email->to($dataToBeSent['email_id']);
        $this->email->subject('Congrats! You have one new leads');
        $this->email->message($message);

        $this->email->send();
    }
}