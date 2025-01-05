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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST["nama"];
    $jenis_bunga = $_POST["jenis_bunga"];
    $nomer_telepon = $_POST["nomer_telepon"];
    $alamat = $_POST["alamat"];

    do {
        if (empty($nama) || empty($jenis_bunga) || empty($nomer_telepon) || empty($alamat)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // add new client to database
        $sql =  "INSERT INTO data (nama, jenis_bunga, nomer_telepon, alamat)" .
            "VALUES ('$nama', '$jenis_bunga', '$nomer_telepon', '$alamat')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $nama = "";
        $jenis_bunga = "";
        $nomer_telepom = "";
        $alamat = "";

        $successMessage = "Client added correctly";

        header("location: /data.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta nama="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .container-center {
            margin: 0 auto;
            padding: 100px;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><span class="text-warning">Flawer</span>shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="data.php">Data</a>
                    </li>
                  
            </div>
        </div>
    </nav>
    
    <div class="container container-center my-5">
        <h2>New Client</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
          <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div> 
          ";
        }
        ?>
        <form method="post">
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
            if (!empty($successMessage)) {
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
                    <a class="btn btn-outline-primary" href="/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

</body>

</html>