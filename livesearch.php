<?php
include("config.php"); 
if(isset($_POST['input'])){

    $input = $_POST['input'];
    
    $query = "SELECT * FROM data WHERE nama LIKE '{$input}%' OR jenis_bunga LIKE '($input}%' OR nomer_telepon LIKE '{$input}%' OR alamat LIKE '{$input}%' ";

    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) > 0){?>
    
        <table class="table my-5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Bunga</th>
                    <th>Nomer Telepon</th>
                    <th>Alamat</th>
                    <th>created at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                
                while($row = mysqli_fetch_assoc($result)){

                    $no = $row['no'];
                    $nama = $row['nama']; 
                    $jenis_bunga = $row['jenis_bunga'];
                    $nomer_telepom = $row['nomer_telepon'];
                    $alamat = $row['alamat'];
                    $created_at = $row['created_at'];
                }
                ?>

                <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $nama;?></td>
                    <td><?php echo $jenis_bunga;?></td>
                    <td><?php echo $nomer_telepom;?></td>
                    <td><?php echo $alamat;?></td>
                    <td><?php echo $created_at;?></td>

                    <td>
                        <a class='btn btn-primary btn-sm' href='/edit.php?no=$row[no]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/delete.php?no=$row[no]'>Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php
}else{
    echo "<h6 class='text-danger text-center mt-3'> No Data Found</h6>";
    }
}
?>