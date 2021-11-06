<?php 

 include "../koneksi.php";
 $no = $_GET['nobeli'];
 $tgl = $_GET['tgl'];
 $user = $_GET['user'];
 $suplier = $_GET['pelanggan'];
 $tbbeli = mysqli_query($conn , "SELECT * FROM tbjual WHERE no='$no'");
 while($resi = mysqli_fetch_array($tbbeli)) {
    $total = $resi['grandtotal'];
    $subtotal = $resi['subtotal'];
 }
 
 $tempbeli = mysqli_query($conn , "SELECT * FROM tempjualdetil WHERE no='$no'");
 while($resi2 = mysqli_fetch_array($tempbeli)) {
    $kodebarang = $resi2['kodebarang'];
    $harga = $resi2['harga'];
    $jlh = $resi2['jlh'];
 }

$tbbarang = mysqli_query($conn , "SELECT * FROM tbbarang WHERE kodebarang='$kodebarang'");
 while($resi3 = mysqli_fetch_array($tbbarang)) {
    $nama = $resi3['nama'];
 }


 $db = mysqli_query($conn , "INSERT INTO tbstokpenjualan (Tgl,nobeli,pelanggan,user,nama,jlh,harga,total,subtotal) VALUES('$tgl','$no','$suplier','$user','$nama','$jlh','$harga','$total','$subtotal')");
 

?>

 <table class="w-4/5 mx-auto mt-10 table-fixed">
  <thead>
    <tr class="bg-blue-500 text-white text-center">
      <th class="py-3 w-1/2 ...">No</th>
      <th class="w-1/4 ...">tgl</th>
      <th class="w-1/4 ...">nobeli</th>
      <th class="w-1/4 ...">suplier</th>
      <th class="w-1/4 ...">user</th>
      <th class="w-1/4 ...">nama</th>
      <th class="w-1/4 ...">jlh</th>
      <th class="w-1/4 ...">harga</th>
      <th class="w-1/4 ...">total</th>
      <th class="w-1/4 ...">subtotal</th>

    </tr>
  </thead>

  <tbody>
    <?php 

      include "../koneksi.php";
      $db = mysqli_query($conn , "SELECT * FROM tbstokpenjualan");
      $counter = 0;

      while($res = mysqli_fetch_array($db)) {

    ?> 
    <tr class="py-3 text-center bg-gray-100">
        <td class="py-3"><?php echo $res['no'] ?></td>
        <td><?php echo $res['Tgl'] ?></td>
        <td><?php echo $res['nobeli'] ?></td>
        <td><?php echo $res['pelanggan'] ?></td>
        <td><?php echo $res['user'] ?></td>
        <td><?php echo $res['nama'] ?></td>
        <td><?php echo $res['jlh'] ?></td>
        <td><?php echo $res['harga'] ?></td>
        <td><?php echo $res['total'] ?></td>
        <td><?php echo $res['subtotal'] ?></td>
    </tr>
<?php $counter++; ?>
<?php } ?>
  </tbody>
</table>
