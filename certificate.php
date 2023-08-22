<?php
use Mpdf\Output\Destination;
include_once "vendor/autoload.php";
include_once "drawcert.php";


if (!file_exists('tmp')) {
    mkdir('tmp', 0777, true);
}

$seri = $_POST['sericetak'];
$nama = $_POST['namacetak'];
$gambar = "./sertifikat.jpg";
$fname = $seri . '-' . $nama;
$image = drawCert($gambar, $nama, $seri);

formatPdf($image, $fname)->Output("./dest/$fname.pdf", Destination::FILE);
