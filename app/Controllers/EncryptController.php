<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use BaconQrCode\Encoder\ByteMatrix;

class EncryptController extends BaseController
{
    private $metdhod        = 'AES-128-CBC';
    private $privateKey     = 'VISION4000007688';
    private $ivLen          = 16;

    public function EncryptedData($data)
    {
        $encrypt = openssl_encrypt($data, $this->metdhod, $this->privateKey, 0, random_bytes($this->ivLen));
        return base64_encode($encrypt);
    }
}
