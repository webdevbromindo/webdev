<?php

use Mpdf\Output\Destination;

require 'db.php';

include_once "vendor/autoload.php";
include_once "drawcert.php";

set_time_limit(0);
header( 'Content-type: text/html; charset=utf-8' );

if (!file_exists('tmp')) {
    mkdir('tmp', 0777, true);
}

$sql = "SELECT * FROM peserta";
$files = [];
$result = $conn->query($sql);
while ($data = $result->fetch_assoc()) {

    $seri = 'ID '.$data['seri'];
    $nama = $data['nama'];
    $gambar = "./sertifikat.jpg";
    $fname = $seri . '-' . $nama;
    $image = drawCert($gambar, $nama, $seri);

    formatPdf($image, $fname)->Output($files[] = $f =  "./tmp/$fname.pdf", Destination::FILE);
    echo $f.'<br>';
    flush();
}
echo 'zipping<br>';


$zip = new ZipArchive();
$outf = './tmp/allcert.zip';
if ($zip->open($outf, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
    exit("cannot open <$outf>\n");
}
foreach ($files as $ff) {
    $zip->addFile($ff);
}
$zip->close();

echo "<script>location = '$outf'</script>";
