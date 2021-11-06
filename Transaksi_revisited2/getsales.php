<?php

 include "koneksi.php";
 $kodesup = $_GET['kodepel'];
 $counter = 0;
 $query = mysqli_query($conn , "SELECT*FROM tbpelangan WHERE kodepel='$kodesup'");
 while($res = mysqli_fetch_array($query)) {
?>

<input type="text" placeholder="telp" value="<?php echo $res['telp'] ?>" class="w-full my-2 py-2 px-3 rounded-sm border-2 border-gray-200">
<input type="text" placeholder="alamat" value="<?php echo $res['alamat'] ?>" class="w-full py-2 px-3 rounded-sm border-2 border-gray-200">

<?php
 $counter++;
?>
<?php } ?>
