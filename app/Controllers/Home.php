<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $db;

    function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function inventory()
    {
        
    }

    public function enkrip()
    {
        $text = 'VISION|00176.I.23|1195780140.00|1327315955.00|146004755.05|0100032361617140';
        $encrypter = \Config\Services::encrypter();
        $enkrip = $encrypter->encrypt($text);

        echo "Encrypted String: ". $enkrip;

        $b64 = base64_encode($enkrip);

		echo "<br/><br/>";

        echo "BASE64 String: ". $b64;

        echo "<br/><br/>";

        echo "BASE64 String: ". base64_decode($b64);

        echo "<br/><br/>";

        //$dt = "26GHYljmyALwe3HnRCPkFUl4pR5qGDHBvSz8rrKiJTKF74Vno52FknIqAOtVT3kEpT/Stf5dwnIUa+E2NbAShSuHFN/OwJPQT9lwzaGaDC4=";

        //echo "Decrypted String: ". $encrypter->decrypt(base64_decode($dt));
    }
}
