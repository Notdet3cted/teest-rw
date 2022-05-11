<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        apakahlogin();
    }

    public function index()
    {
        $url = "https://reqres.in/api/users/";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
        $data['reqres'] = json_decode($response, true);
        $this->load->view('home', $data);
    }
}
