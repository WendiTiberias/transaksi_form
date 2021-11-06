<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
	<div class="container w-full">
			<header class="w-full bg-blue-500 py-3 text-white text-left">
				<h3 class="w-4/5 mx-auto text-2xl font-medium">Form_Laporan_Penjualan</h3>
			</header>
			<form class="">
				<div class="barang mt-10 w-4/5 mx-auto flex flex-col ">
					<div class="form-control flex items-center">
						<label>TGL_JUAL : </label>
					    <input id="date" style="width:400px;" class="py-3 px-3 border mx-3" type="text" placeholder="tgl">
					</div>
					<div class="auto_form">
				    <div class="form-control mt-3 flex items-center">
					<label>No Jual : </label>
					<select id="nobeli" onchange="dateLoaded(this)" style="width:400px;" class="py-3 px-3 mx-3 border">
						<?php 

                          include "../koneksi.php";
                          $no = mysqli_query($conn,"SELECT * FROM tbjual");
                          $counter = 0;
                          while($res = mysqli_fetch_array($no)) {

						?>

						<option value="<?php echo $res['tgl'] ?>"><?php echo $res['no'] ?></option>

						<?php $counter++;?>
					<?php } ?>
					</select>	
					</div>
					  <div class="form-control mt-3 flex items-center">
					<label>Pelanggan : </label>
					<select id="suplier" style="width:400px" class="py-3 px-3 border mx-3">
						<?php 
                          
                          include "../koneksi.php";
                          $counter = 0;
                          $db = mysqli_query($conn  , "SELECT * FROM tbpelangan");
                          while($res = mysqli_fetch_array($db)) {
                           
						 ?>

						 <option value="<?php echo $res['nama'] ?>"><?php echo $res['nama'] ?></option>

						 <?php $counter++; ?>
						 <?php } ?>
					</select>
					</div>
					  <div class="form-control mt-3 flex items-center">
					<label>USER_ : </label>
					<select id="user" style="width:400px" class="py-3 px-3 border mx-3"> 
						<?php 

                          include "../koneksi.php"; 
                          $counter = 0;
                          $db = mysqli_query($conn,"SELECT * FROM tbuser");
                          while($res = mysqli_fetch_array($db)) {


						?>

						<option value="<?php echo $res['nama'] ?>"><?php echo $res['nama'] ?></option>

						<?php $counter++; ?>
					<?php } ?>
					</select>
					</div>
					</div>
					<button  style="width:200px;" class='text-white font-medium mt-5 py-2 px-3 bg-blue-500 rounded-sm'>View item</button>
				</div>
			</form>
			<div class="table-render">
						<table class="w-4/5 mx-auto mt-10 table-fixed">
  <thead>
    <tr class="bg-blue-500 text-white text-center">
      <th class="py-3 w-1/2 ...">No</th>
      <th class="w-1/4 ...">tgl</th>
      <th class="w-1/4 ...">nojual</th>
      <th class="w-1/4 ...">pelanggan</th>
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
			</div>

			<script>
				const dateLoaded = (event) => {
             const date = document.getElementById('date');
             date.value = event.value;
				}


				const dates = document.getElementById('date'); 
                const suplier = document.getElementById('suplier');
                const user = document.getElementById('user');
                const nobeli = document.getElementById('nobeli');
				const loadItem = (e) => {
					e.preventDefault();
					e.stopPropagation();
					const tablerender = document.querySelector('.table-render');
                     const inner = nobeli.options[nobeli.selectedIndex].innerHTML;

                    const req = new XMLHttpRequest();
                    const url = `loadPenjualan.php?nobeli=${inner}&tgl=${dates.value}&user=${user.value}&pelanggan=${suplier.value}`;
                    req.onload = async function() {
                    	const item = await this.responseText;
                    	tablerender.innerHTML = item;
                    }
                    req.open('GET',url,true);
                    req.send();

				}

				const form = document.querySelector('form');
				form.addEventListener('submit' , loadItem)


			</script>
</body>
</html>