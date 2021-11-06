<?php
   include "koneksi.php";
   $kodebarang = $_GET['kodebarang'];
   $query = mysqli_query($conn,"SELECT*FROM tbbarang WHERE kodebarang='$kodebarang' LIMIT 1");
   $counter = 0;
   while($res = mysqli_fetch_array($query)) {
?>

<input class="py-2 px-3 border-2 border-gray-200 rounded-sm" value="<?php echo $res['jenis'] ?>" type='text' placeholder="jenis">
 <input class="py-2 px-3 border-2 border-gray-200 rounded-sm" value="<?php  echo $res['merk'] ?>"  type="text" placeholder="merk">
 <input class="py-2 px-3 border-2 border-gray-200 rounded-sm" value="<?php echo $res['satuan'] ?>"  type="text" placeholder="satuan">
 <input id="jumlah" class="py-2 px-3 border-2 border-gray-200 rounded-sm" value="<?php echo $res['jlh_barang'] ?>"  type='number' placeholder="jumlah">
 <input id="harga" class="py-2 px-3 border-2 border-gray-200 rounded-sm" value="<?php echo  $res['hargajual'] ?>" type="number" placeholder="harga">

<?php $counter++;  ?>
<?php } ?>
