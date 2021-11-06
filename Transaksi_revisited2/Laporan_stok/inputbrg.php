<?php 
    include "../koneksi.php";
    $kodebar = $_GET['kodebarang'];
    $db = mysqli_query($conn , "SELECT * FROM tbbarang WHERE kodebarang = '$kodebar'");
    while($res = mysqli_fetch_array($db)) {
?>

     <div class="auto_form">
				    <div class="form-control mt-3 flex items-center">
					<label>Jumlah_stock : </label>
					<input id="jumlah" style="width:400px" type="number" placeholder="Number" value="<?php echo $res['jlh_barang'] ?>" class="py-3 px-3 border mx-3">	
					</div>
					  <div class="form-control mt-3 flex items-center">
					<label>Merk_brangs : </label>
					<input id="merk" style="width:400px" type="text" placeholder="merk" value="<?php echo $res['merk'] ?>" class="py-3 px-3 border mx-3">	
					</div>
					  <div class="form-control mt-3 flex items-center">
					<label>Jenis_brangs : </label>
					<input id="jenis" style="width:400px" type="text" placeholder="jenis" value="<?php echo $res['jenis'] ?>" class="py-3 px-3 border mx-3">	
					</div>
					</div>

<?php } ?>