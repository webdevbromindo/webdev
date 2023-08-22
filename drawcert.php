<?php

use Mpdf\Mpdf;

function drawCert($gambar, $nama, $seri)
{
	$image = imagecreatefromjpeg(realpath($gambar));
	$gray = imageColorAllocate($image, 154, 155, 156);
	$black = imageColorAllocate($image, 59, 71, 86);
	$font = realpath("./MinionPro-Medium.otf");
	$font2 = realpath("./GOTHIC.TTF");
	$size1 = 64;
	$size = 96;
	//definisikan lebar gambar agar posisi teks selalu ditengah berapapun jumlah hurufnya
	$image_width = imagesx($image);
	//membuat textbox agar text centered
	$text_box1 = imagettfbbox($size1, 0, $font2, $seri);
	$text_width1 = $text_box1[2] - $text_box1[0]; // lower right corner - lower left corner
	$text_height1 = $text_box1[3] - $text_box1[1];
	$x1 = ($image_width / 2) - ($text_width1 / 2);

	//membuat textbox agar text centered
	$text_box = imagettfbbox($size, 0, $font, $nama);
	$text_width = $text_box[2] - $text_box[0]; // lower right corner - lower left corner
	$text_height = $text_box[3] - $text_box[1];
	$x = ($image_width / 2) - ($text_width / 2);

	//generate sertifikat beserta namanya
	imagettftext($image, $size1, 0, $x1, 1110, $gray, $font2, $seri);
	imagettftext($image, $size, 0, $x, 1500, $black, $font, $nama);
	imagejpeg($image, $outfile = './tmp/' . $seri . '.jpg');
	imagedestroy($image);
	return $outfile;
}

function formatPdf($image, $name)
{
	$pdf = new Mpdf(['orientation' => 'L']);
	$pdf->Image($image, 0, 0, 297, 210, 'jpg', '', true, false);
	$pdf->WriteHTML(<<<HTML
<div style="position: absolute; left:0; right: 0; top: 0; bottom: 0;">
    <img src="$image" style="width: 297mm; height: 210mm; margin: 0;" />
</div>
HTML);
	return $pdf;
}
