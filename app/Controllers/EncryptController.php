<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class EncryptController extends BaseController
{
    private $metdhod        = 'AES-128-CBC';
    private $privateKey     = 'VISION4000007688';  
    private $ivLen          = 16;
    private $initialVector = openssl_random_pseudo_bytes($this->ivLen);

    public function EncryptData($data)
    {
        $encrypt = openssl_encrypt($data, $this->metdhod, $this->privateKey, 0, $this->initialVector);
        return base64_encode($encrypt);
    }

    public function DecryptData($data)
    {
        $encrypter = \Config\Services::encrypter();
        $encrypter->decrypt(base64_decode($data));
    }
}