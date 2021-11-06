<?php 

include "koneksi.php"; 
$tombol = $_GET['tombol'];

 if($tombol === "simpan") {
 	$no = $_GET['no'];
     $namabarang = $_GET['namabarang'];
     $jenis = $_GET['jenis'];
     $merk = $_GET['merk'];
     $satuan = $_GET['satuan'];
     $kodebar = $_GET['kodebarang'];
     $jumlah = $_GET['jumlah'];
     $harga = $_GET['harga'];
     $total = $_GET['total'];
     $hargabeli = (float)$harga - 3000;
     $kodebar2 = (float)$kodebar * 2;
     $query = mysqli_query($conn , "INSERT INTO tempjualdetil ( no , kodebarang,jlh,harga,total ) VALUES('$no','$kodebar','$jumlah','$harga','$total')");

 }  

 else if($tombol === 'delete') {
    $kodebar = $_GET['kodebarang'];
    $query3 = mysqli_query($conn , "DELETE FROM tempjualdetil WHERE kodebarang='$kodebar'");
 }

 else if($tombol === 'edit') {
  $kodebar = $_GET['kodebarang'];
    $jenis = $_GET['jenis'];
    $merk = $_GET['merk'];
    $satuan = $_GET['satuan'];
    $jumlah = $_GET['jumlah'];
    $harga = $_GET['harga'];
    $total = $_GET['total'];
    $query = mysqli_query($conn , "UPDATE tempjualdetil SET jlh='$jumlah', harga='$harga',total='$total' WHERE kodebarang='$kodebar' ");
    $query2 = mysqli_query($conn, "UPDATE tbbarang SET jenis='$jenis',merk='$merk',satuan='$satuan' WHERE kodebarang='$kodebar'");
 }


?>

<table class="table-auto w-4/5 mx-auto">
  <thead>
    <tr class="text-center bg-blue-500 text-white">
      <th class="py-2">No</th>
      <th class="py-2">Kodebarang</th>
      <th class="py-2">Nama</th>
      <th class="py-2">Jenis</th>
      <th class="py-2">satuan</th>
      <th class="py-2">Jumlah</th>
      <th class="py-2">Harga</th>
      <th class="py-2">Total</th>
       <th class="py-2">Modifier</th>
    </tr>
  </thead>
  <tbody>
<?php

 include "koneksi.php";
 $counter = 0;
 $query = mysqli_query($conn , "SELECT tbbarang.kodebarang, tbbarang.nama , tbbarang.merk , tbbarang.jenis , tbbarang.satuan , tempjualdetil.harga,tempjualdetil.no,tempjualdetil.jlh,tempjualdetil.total FROM tbbarang INNER JOIN tempjualdetil ON tbbarang.kodebarang=tempjualdetil.kodebarang");
 while($res = mysqli_fetch_array($query)) {

?>

 <tr class='text-center bg-gray-100'>
    <td class="py-2"><?php echo $res['no'] ?></td>
    <td class="py-2"><?php echo $res['kodebarang'] ?></td>
    <td class="py-2"><?php echo $res['nama'] ?></td>
    <td class="py-2"><?php echo $res['jenis'] ?></td>
    <td class="py-2"><?php echo $res['satuan'] ?></td>
    <td class="py-2"><?php echo $res['jlh'] ?></td>
    <td class="py-2"><?php echo $res['harga'] ?></td>
    <td class="py-2"><?php echo $res['total'] ?></td>
    <td>
      <button onclick="editHandler(
       <?php echo $res['kodebarang']; ?>,
       '<?php echo $res['jenis']; ?>',
       '<?php echo $res['merk']; ?>',
       '<?php echo $res['satuan']; ?>',
       '<?php echo $res['jlh'] ?>',
       '<?php echo $res['harga'] ?>',
       '<?php echo $res['total']; ?>'
      )" type="button" class="bg-green-500 py-1 px-4 rounded-sm text-white">Edit</button>
      <button onclick="deleteRender(<?php echo $res['kodebarang']; ?>)" type="button" class="bg-red-500 py-1 px-4 rounded-sm text-white">Delete</button>
    </td>
 </tr>

<?php $counter++; ?>
<?php } ?>
<tbody/>
</table>