<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "toko";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$nama = "";
$jenis_bunga = "";
$nomer_telepon = "";
$alamat = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the ata of the client

    if(!isset($_GET["no"]) ) {
        header("location: /index.php");
        exit;
    }

    $no = $_GET["no"];

     // read the row of the selected client from database table
     $sql = "SELECT * FROM data WHERE no=$no";
     $result = $connection->query($sql);
     $row = $result->fetch_assoc();

     if(!$row) {
        header("location: /index.php");
        exit;
     }

    $nama = $row["nama"];
    $jenis_bunga = $row["jenis_bunga"];
    $nomer_telepon = $row["nomer_telepon"];
    $alamat = $row["alamat"];

}
else {
    // POST method: Update the data of the client

    $no = $_POST["no"];
    $nama = $_POST["nama"];
    $jenis_bunga = $_POST["jenis_bunga"];
    $nomer_telepon = $_POST["nomer_telepon"];
    $alamat = $_POST["alamat"];

    do {
        if ( empty($nama) || empty($jenis_bunga) || empty($nomer_telepon) || empty($alamat)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE data ". 
                "SET nama = '$nama', jenis_bunga = '$jenis_bunga', nomer_telepon = '$nomer_telepon', alamat = '$alamat' ". 
                "WHERE no = $no";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: ". $connection->error;
            break;
        }

        $successMessage = "Client updated correctly";

        header("location: /data.php");
        exit;
        
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2>

        <?php
        if( !empty($errorMessage) ) {
         echo "
          <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div> 
          "; 
        }
        ?>
        <form method="post">
            <input type="hidden" name="no" value="<?php echo $no; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>">
                </div>
            </div>
             <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Jenis Bunga</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="jenis_bunga" value="<?php echo $jenis_bunga; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nomer Telepon</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nomer_telepon" value="<?php echo $nomer_telepon; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="alamat" value="<?php echo $alamat; ?>">
                </div>
            </div>

            <?php
            if( !empty($successMessage) ) {
                echo "
                <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div> 
                    </div>
                 </div>
                 "; 
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/data.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>