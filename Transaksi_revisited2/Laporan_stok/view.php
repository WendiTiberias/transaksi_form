<?php 
 
  include "../koneksi.php";
  $kodebar = $_GET['kodebarang'];
  $jlh = $_GET['jlh'];
  $jenis = $_GET['jenis'];
  $merk = $_GET['merk'];

  $db = mysqli_query($conn,"SELECT * FROM tbbarang WHERE kodebarang='$kodebar'");
  while($res = mysqli_fetch_array($db)) {
     $satuan = $res['satuan'];
     $hargajual = $res['hargajual'];
     $hargabeli = $res['hargabeli'];
     $nama = $res['nama'];
  }

  $insert = mysqli_query($conn , "INSERT INTO tblaporanstok (kodebarang,nama,jenis,merk,satuan,hargajual,hargabeli,jlh_stock) VALUES('$kodebar','$nama','$jenis','$merk','$satuan','$hargajual','$hargabeli','$jlh')");

?>

        <table class="w-4/5 mx-auto mt-10 table-fixed">
  <thead>
    <tr class="bg-blue-500 text-white text-center">
      <th class="py-3 w-1/2 ...">No</th>
      <th class="w-1/4 ...">Kodebarang</th>
      <th class="w-1/4 ...">Nama</th>
      <th class="w-1/4 ...">Jenis</th>
      <th class="w-1/4 ...">Merk</th>
      <th class="w-1/4 ...">Satuan</th>
      <th class="w-1/4 ...">Harga beli</th>
      <th class="w-1/4 ...">Harga jual</th>
      <th class="w-1/4 ...">Jlh_stock</th>
    </tr>
  </thead>

  <tbody>
    <?php 
      
      include "../koneksi.php";
      $db = mysqli_query($conn , "SELECT * FROM tblaporanstok");
      $counter = 0;
      while($res = mysqli_fetch_array($db)) {

    ?> 
    <tr class="py-3 text-center bg-gray-100">
      <td class="py-3"><?php echo $res['No'] ?></td>
      <td><?php echo $res['kodebarang'] ?></td>
      <td><?php echo $res['nama'] ?></td>
      <td><?php echo $res['jenis'] ?></td>
      <td><?php echo $res['merk'] ?></td>
      <td><?php echo $res['satuan'] ?></td>
      <td><?php echo $res['hargajual'] ?></td>
      <td><?php echo $res['hargabeli'] ?></td>
      <td><?php echo $res['jlh_stock'] ?></td>
    </tr>
<?php $counter++; ?>
<?php } ?>
  </tbody>
</table>