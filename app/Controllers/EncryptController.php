<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class EncryptController extends BaseController
{
    private $method         = "AES-128-CBC";
    private $privateKey     = "VISION4000007688";
    //public $initialVector  = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    //private $initialVector  = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method));
    //private $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    //private $iv = mcrypt_create_iv($this->iv_size, MCRYPT_RAND);


    public function EncryptData($data)
    {
        $encrypt = openssl_encrypt($data, $this->method, $this->privateKey, 0, chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0));
        //$encrypt = openssl_encrypt($data, $this->method, $this->privateKey, 0, openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method)))
        //$encrypt = openssl_encrypt($data, $this->method, $this->privateKey, 0, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND));
        //return base64_encode($encrypt);
        return $encrypt;
    }

    public function DecryptData($data)
    {
        $encrypter = \Config\Services::encrypter();
        $encrypter->decrypt(base64_decode($data));
    }
}