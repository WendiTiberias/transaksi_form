<!DOCTYPE html>
<html>
	<head>
		<title>Laporan_stok</title>
		<meta charset='utf-8'>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	</head>
	<body class='bg-gray-50'>
		<div class="container w-full">
			<header class="w-full bg-blue-500 py-3 text-white text-left">
				<h3 class="w-4/5 mx-auto text-2xl font-medium">Form_Laporan</h3>
			</header>
			<form class="">
				<div class="barang mt-10 w-4/5 mx-auto flex flex-col ">
					<div class="form-control flex items-center">
						<label>Nama Barang : </label>
					<select onchange="auto_fill(this)" style="width:400px" class="mx-3 inline-block py-2 border px-2">
						<?php 

                           include "../koneksi.php";
                           $db = mysqli_query($conn,"SELECT * FROM tbbarang");
                           $counter = 0;
                           while($res = mysqli_fetch_array($db)) {

                            ?>

                          <option value="<?php echo $res['kodebarang'] ?>"><?php echo $res['nama'] ?></option>

                      <?php $counter++; ?>
                  <?php } ?>
                   
					</select>
					</div>
					<div class="auto_form">
				    <div class="form-control mt-3 flex items-center">
					<label>Jumlah_stock : </label>
					<input id="jumlah" style="width:400px" type="number" placeholder="Number" class="py-3 px-3 border mx-3">	
					</div>
					  <div class="form-control mt-3 flex items-center">
					<label>Merk_brangs : </label>
					<input id='merk' style="width:400px" type="text" placeholder="merk" class="py-3 px-3 border mx-3">	
					</div>
					  <div class="form-control mt-3 flex items-center">
					<label>Jenis_brangs : </label>
					<input id="jenis" style="width:400px" type="text" placeholder="jenis" class="py-3 px-3 border mx-3">	
					</div>
					</div>
					<button style="width:200px;" class='text-white font-medium mt-5 py-2 px-3 bg-blue-500 rounded-sm'>View item</button>
				</div>
			</form>
			<div class="table">
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
			</div>
		</div>
		<script>
			
          function auto_fill(e) {
          	  const auto = document.querySelector('.auto_form');
          	  const req = new XMLHttpRequest();
          	  const url = `inputbrg.php?kodebarang=${e.value}`;
          	  req.onload = async function() {
          	  	const response = await this.responseText;
                auto.innerHTML = response;
          	  }
          	  req.open('GET',url , true);
          	  req.send();
          }

          const form = document.querySelector('form');
          const tb = document.querySelector('table');
          form.addEventListener('submit' , (e) => {
          	e.preventDefault();
          	let jlh,jenis,merk;
            jlh = document.getElementById('jumlah');
            jenis = document.getElementById('jenis');
            merk = document.getElementById('merk');
          	const select = document.querySelector('select');
          	const value = select.options[select.selectedIndex].value;
          	const req = new XMLHttpRequest();
          	const url = `view.php?kodebarang=${value}&jlh=${jlh.value}&jenis=${jenis.value}&merk=${merk.value}`;
          	req.onload = async function() {
                const item = await this.responseText;
                tb.innerHTML = item;
          	}
          	req.open('GET',url,true);
          	req.send();
          })

		</script>
	</body>
</html>