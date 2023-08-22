<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require 'db.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Certificate Online</title>
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	</head>
	<body>
	<br>
		<a href="certificate_all.php" class="btn btn-success">Download All</a>
	<br>
	<div class="row">

		<div class="col-md-1"></div>

		<div class="col-md-10">
		<table class="table table-bordered" style="border-color:#1976D2;">
                <thead>
                    <tr style="background-color:#1976D2; color:white;">
                        <th><center>No Seri</center></th>
						<th><center>Nama</center></th>
						<th><center>Email</center></th>
						<th><center>Aksi</center></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM peserta";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($data = $result->fetch_array()){
                ?>
                    <tr>
                        <td>
                            <?php echo $data['seri']; ?>
                        </td>
						<td>
                            <?php echo $data['nama']; ?>
                        </td>
						<td>
                            <?php echo $data['email']; ?>
                        </td>

                        <td width="120px" class="text-center">
							<form action="certificate.php" method="post">
								<input type="hidden" name="sericetak" value="ID <?php echo $data['seri'];?>">
								<input type="hidden" name="namacetak" value="<?php echo $data['nama'];?>">
								<input id="get" type="submit" class="btn btn-primary" value="Cetak" name="certificate"></input>
							</form>
                        </td>
                    </tr>

                <?php
                        }
					}

					$conn->close();
                ?>

                </tbody>
            </table>
		<div>

		</div>

		</div>

		<div class="col-md-1"></div>

	</div>

</div>

	</body>
</html>