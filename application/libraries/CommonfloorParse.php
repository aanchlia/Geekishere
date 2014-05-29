<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/29/14
 * Time: 12:42 PM
 */
class CommonfloorParse extends CI_Controller{

    /** @var   */
    protected $link;

    /** @var  string */
    protected $status;

    /**
     * Connect to the Email system
     *
     * @param $host
     * @param $login
     * @param $pass
     */
    public function connect($host, $login, $pass){

        $this->link = imap_open($host, $login, $pass);
        if($this->link) {
            $this->status = 'Connected';
        } else {
            $error[] = imap_last_error();
            $this->status = 'Not connected';
        }
    }

    /**
     * Do parsing
     */
    public function do_action(){

        //$result = imap_search($this->link, 'UNSEEN  FROM "10.ankush@gmail.com"');

        //$header=imap_headerinfo($this->link, 6399, 80,80);

        $body = imap_body($this->link, 6366);

        preg_match("/Name\K(.*?)\ Is\K/s", $body, $matches);

        $name = explode(':', $matches[1]);

        preg_match("/Broker\K(.*?)\ Email\K/s", $body, $again);

        print_r($name[1].' '.$again[1]); exit;
    }

}