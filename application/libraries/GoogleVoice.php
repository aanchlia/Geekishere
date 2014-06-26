<?php
/*// GoogleVoice(EMAIL, PASSWORD)
$gv = new GoogleVoice('example@gmail.com', 'password');
// Sends an SMS. send_sms(NUMBER, MESSAGE)
echo $gv->send_sms('+15555555555', 'Example');
// Gets all the sms
// get_sms() - returns all the sms
// get_sms(true) - returns all the unread sms
echo $gv->get_sms();*/

/**
 * Google Voice API Wrapper
 *
 * new GoogleVoice(EMAIL, PASSWORD)
 * send_sms(NUMBER, MESSAGE)
 * get_sms()
 * get_sms(true) - unread
 *
 * @author Artem Kalinchuk
 **/

Class GoogleVoice {
    /**
     * Modify this
     **/
    var $account_type = 'GOOGLE'; 	// The Google account type
    var $service = 'grandcentral'; 	// Service for Google Voice is grandcentral (it may change)
    var $source = '';				// The host of your site (for logging purposes)
    // _rnr_se - This can be found in the source code of the inbox page of your Google Voice
    // Simply view the source and search for '_rnr_se'. Should be a string of about 30
    // characters (numbers, letters, and symbols)
    var $_rnr_se = '';

    /**
     * Do not modify
     **/
    public $url = 'https://www.google.com/';	// Google HTTPS URL
    public $auth; 								// The AUTH key
    public  $email = 'aanchlia@gmail.com';								// Users email address
    public $password = 'jaiveerhanuman21';							// Users password

    function __construct () {
        /*if ($email)
            $this->email = $email;
        if ($password)
            $this->password = $password;*/

        // Authenticate if the Auth key is empty
        if ($this->auth == '') {
            $this->authenticate();
        }
    }

    /**
     * authenticate
     * Authenticates using the email and password.
     * @return Auth Session Key
     **/

    function authenticate () {
        $form_data = array();
        $form_data['accountType'] = $this->account_type;
        $form_data['Email'] = $this->email;
        $form_data['Passwd'] = $this->password;
        $form_data['service'] = $this->service;
        $form_data['source'] = $this->source;

        $response = $this->transmit($form_data, 'accounts/ClientLogin');
        preg_match("/Auth\=(.*)/", $response, $matches);

        if (count($matches) == 0) {
            return $response;
        } else {
            $this->auth = str_replace("Auth=", "", $matches[0]);
            return $this->auth;
        }
    }

    /**
     * transmit
     * Transmits the passed in POST data
     * @param $form_data An array of POST fields and values
     * @param $path The path to call
     * @return Response from the server
     **/

    function transmit ($form_data, $path, $USE_POST=true) {
        $url = $this->url.$path;
        $fields = array();

        foreach ($form_data as $field => $value)
            $fields[] = $field.'='.urlencode($value);

        // POST or GET?
        if ($USE_POST) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, count($form_data));
            curl_setopt($ch, CURLOPT_POSTFIELDS, implode('&', $fields));
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Authorization: GoogleLogin auth=".$this->auth));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        } else {
            $ch = curl_init($url.'?'.implode('&', $fields));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        }

        $response = curl_exec($ch);

        return $response;
    }

    /**
     * send_sms
     * Sends an SMS message
     * @param $phone_number The number to send the SMS message to
     * @param $text The message
     * @return Response from the server (success or fail)
     **/

    function send_sms ($phone_number, $text) {
        $form_data = array();
        $form_data['phoneNumber'] = $phone_number;
        $form_data['text'] = $text;
        $form_data['id'] = '';
        $form_data['_rnr_se'] = $this->_rnr_se;

        $response = $this->transmit($form_data, 'voice/sms/send/');

        return $response;
    }

    /**
     * get_sms
     * Gets the HTML of the SMS inbox
     * @param $UNREAD boolean - Show unread or not
     * @return The HTML from the SMS inbox page
     **/

    function get_sms($UNREAD=false) {
        $form_data = array();
        $form_data['auth'] = $this->auth;

        if ($UNREAD)
            $path = 'voice/inbox/recent/unread/';
        else
            $path = 'voice/inbox/recent/';

        $response = $this->transmit($form_data, $path, false);

        return $response;
    }
}
?>