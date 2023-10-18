<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class QRController extends BaseController
{
    public function createQr($data,$name)
	{
		$writer = new PngWriter();

		// Create QR code
		$qrCode = QrCode::create($data)
			->setEncoding(new Encoding('UTF-8'))
			->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
			->setSize(250)
			->setMargin(10)
			->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
			->setForegroundColor(new Color(0, 0, 0))
			->setBackgroundColor(new Color(255, 255, 255));

		$result = $writer->write($qrCode);
		$result->saveToFile( FCPATH .'assets/qrcode/'.$name.'.png');

		$dataUri = $result->getDataUri();

		return $dataUri;
	}
}
