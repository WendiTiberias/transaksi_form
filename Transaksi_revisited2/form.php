<!DOCTYPE html>
<html lang="id">
<head>
	<title>Form_Transaksi</title>
	<meta charset="utf-8">
	<meta name="viewport" content='width=device-width'>
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
  <body>
  	<div class="container">
  		<header class="w-full bg-blue-600 text-white py-3 text-center ">
  			<div class="header-content w-5/6 mx-auto flex items-center justify-between">
					 <h3 class="font-bold text-2xl">Form_Transaksi</h3>
					 <button type="button" class="border-2 border-white rounded-sm py-2 px-4">
						  <?php
  
								include "koneksi.php";
                session_start();
								$kodeuser = $_SESSION['kodeuser'];
								$counter = 0;
								$query = mysqli_query($conn , "SELECT*FROM tbuser WHERE kodeuser='$kodeuser'");
                while($res = mysqli_fetch_array($query)) {
							?>
  
							Username : <?php echo $res['nama'];  ?>

							<?php
                 $counter++;
							?>
						<?php } ?>
					 </button>
				</div>
  		</header>
       <div class="my-10 form-profile w-4/6 mx-auto">
				 <h3 class="font-medium text-lg">Input_Profile</h3>
				 <form class="w-full mt-3
				 form_profile flex items-center justify-between py-5 px-5 rounded-md border-2 border-gray-400">
					 <div style="width:48%;" class="left">
						 <input id="nobeli" type="text" placeholder="Nobeli" class="w-full py-2 px-3 rounded-sm border-2 border-gray-200">
						 <input value="<?php echo date("y/m/d") ?>" id="date" type="text" placeholder="Tanggal" class="w-full my-3 py-2 px-3 rounded-sm border-2 border-gray-200">
						 <select id="user" class="w-full py-2 px-3 border-2 border-gray-200">
							 <option disabled selected>pick</option>
							 <?php

							 include "koneksi.php";
							 session_start();
							 $kodeuser = $_SESSION['kodeuser'];
							 $counter = 0;
							 $query = mysqli_query($conn , "SELECT*FROM tbuser WHERE kodeuser='$kodeuser'");
							 while($res = mysqli_fetch_array($query)) {
						 ?>

						<option value="<?php echo $res['kodeuser'] ?>"><?php echo $res['nama'];  ?></option>

						 <?php
								$counter++;
						 ?>
					 <?php } ?>
						 </select>
					 </div>
					 <div style="width:48%;" class="right">
						 <select id="suplier" onchange="suplierRender(this)" class="w-full py-2 px-3 border-2 border-gray-200">
							 <?php

								 include "koneksi.php";
								 $counter = 0;
								 $query = mysqli_query($conn , "SELECT*FROM tbsuplier");
								 while($res = mysqli_fetch_array($query)) {

							 ?>

							 <option value="<?php echo $res['kodesup'] ?>"><?php echo $res['nama'] ?></option>

							 <?php $counter++; ?>
						 <?php } ?>
						 </select>
						 <div class="suplier-auto w-full">
							 <input type="text" placeholder="telp" class="w-full my-2 py-2 px-3 rounded-sm border-2 border-gray-200">
							<input type="text" placeholder="alamat" class="w-full py-2 px-3 rounded-sm border-2 border-gray-200">
						 </div>
					 </div>
				 </form>
			 </div>
			 <div class="form-barang w-4/6 mx-auto rounded-sm ">
				 <h3 class="font-medium text-xl">Input_Barang</h3>
        <form class="w-full mt-5 py-5 px-5 border-2 rounded-md border-gray-400">
					  <select id="barang" onchange="loadBarang(this)" class="w-full py-2 px-3 border-2 border-gray-200 rounded-sm">
							<?php
                 include "koneksi.php";
								 $counter = 0;
								 $query = mysqli_query($conn , "SELECT*FROM tbbarang");
								 while($res = mysqli_fetch_array($query)) {
							?>

							<option value="<?php echo $res['kodebarang'] ?>"><?php echo $res['nama'] ?></option>

							<?php $counter++; ?>
						<?php } ?>
						</select>
            <div class="auto-fill grid grid-cols-3 mt-5 mb-3 gap-2">
							<input class="py-2 px-3 border-2 border-gray-200 rounded-sm" type='text' placeholder="jenis">
							<input class="py-2 px-3 border-2 border-gray-200 rounded-sm"  type="text" placeholder="merk">
							<input class="py-2 px-3 border-2 border-gray-200 rounded-sm"  type="text" placeholder="satuan">
							<input id="jumlah" class="py-2 px-3 border-2 border-gray-200 rounded-sm"  type='number' placeholder="jumlah">
							<input id="harga" class="py-2 px-3 border-2 border-gray-200 rounded-sm"  type="number" placeholder="harga">
						</div>
						<div class="action">
							    <input id="total" type='number' class="py-2 px-3 border-2 border-gray-200 rounded-sm" placeholder="total..">
							 		<button onclick="addBarang()" id="add" type="button" class="bg-blue-500 ml-5 text-white py-2 px-5 rounded-sm">Submit</button>
						</div>
				</form>
			 </div>
			 <div class='table-render pt-10 pb-5'>
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
							 $query = mysqli_query($conn , "SELECT tbbarang.kodebarang, tbbarang.merk , tbbarang.nama , tbbarang.jenis , tbbarang.satuan , tempbelidetil.harga,tempbelidetil.no,tempbelidetil.jlh,tempbelidetil.total FROM tbbarang INNER JOIN tempbelidetil ON tbbarang.kodebarang=tempbelidetil.kodebarang ");
							 while($res = mysqli_fetch_array($query)) {

							?>

							 <tr class='text-center bg-gray-100'>
									<td class="py-4"><?php echo $res['no'] ?></td>
									<td class="py-4"><?php echo $res['kodebarang'] ?></td>
									<td class="py-4"><?php echo $res['nama'] ?></td>
									<td class="py-4"><?php echo $res['jenis'] ?></td>
									<td class="py-4"><?php echo $res['satuan'] ?></td>
									<td class="py-4"><?php echo $res['jlh'] ?></td>
									<td class="py-4"><?php echo $res['harga'] ?></td>
									<td class="py-4"><?php echo $res['total'] ?></td>
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
										<button onclick="deleteHandler(<?php echo $res['kodebarang']; ?> , <?php echo $res['total']; ?>)" type="button" class="bg-red-500 py-1 px-4 rounded-sm text-white">Delete</button>
									</td>
							 </tr>

							<?php $counter++; ?>
							<?php } ?>
						</tbody>
				 </table>
			 </div>
			 <div class="w-5/6 mx-auto flex items-center justify-end mx-auto form-grandtotal py-5">
				  <form class="grandtotal w-2/5 border-2 border-gray-400 rounded-md py-5 px-5">
						<input class="w-full border-2 border-gray-200 py-2 px-3 rounded-sm block" type="number" placeholder="subtotal">
						<div class="diskon-item w-full flex items-center">
							<input class="w-full border-2 mt-3 border-gray-200 py-2 px-3 rounded-sm block" type="number" placeholder="Diskon">
							<h5 class="diskon-find font-semibold text-lg">0</h5>
						</div>
						<div class="pajak-item flex items-center">
							<input class="w-full border-2 mt-3 border-gray-200 py-2 px-3 rounded-sm block" type="number" placeholder="Pajak">
							<h5 class="pajak-find font-semibold text-lg">0</h5>
						</div>
						<input class="w-full border-2 mt-3 border-gray-200 py-2 px-3 rounded-sm block" type="number" placeholder="Grandtotal">
						<button onclick="addBeli()" type="button" class="bg-blue-500 mt-7 py-2 px-5 text-white rounded-sm">Process</button>
					</form>
			 </div>
  	</div>
		<script>

		let totalRender = parseFloat(JSON.parse(localStorage.getItem('total'))) || 0;
    let stockIncrement = 0 ;
    let kodebarang = 0;
		//============================== DATE-RENDER ==
		//====================================

		function date() {
			 const date = document.getElementById('date');
			 const today = new Date();
			 date.value = today.getFullYear() + ' - ' + (today.getMonth()+1) + ' - ' +  today.getDate();
		}

		//=============================== NOBELI ==
		//====================================

		let dynamicBuy = JSON.parse(localStorage.getItem('nobeli')) || 1;

		function noBeliRender() {
        const nobeli = document.getElementById('nobeli');
				nobeli.value = dynamicBuy;
		}

		function noBeliIncrement() {
			  const nobeli = document.getElementById('nobeli');
        dynamicBuy++;
				localStorage.setItem('nobeli' , JSON.stringify(dynamicBuy));
				nobeli.value = JSON.parse(localStorage.getItem('nobeli')) || 1;
				return dynamicBuy;
		}

		//=============================== SUPLIER-RENDER ==
		//====================================

		function suplierRender(event) {
			   const suplierauto = document.querySelector('.suplier-auto');
			   const kodesup = event.options[event.selectedIndex].value;
				 const request = new XMLHttpRequest();
				 let url = `suplier.php?kodesup=${kodesup}`;
				 request.onload = function() {
					  suplierauto.innerHTML = this.responseText;
				 }
				 request.open('GET',url,true);
				 request.send();
		}

		//=============================== BARANG-RENDER ==
		//====================================

		function loadBarang(event) {
         const kodebar = event.options[event.selectedIndex].value;
				 const request = new XMLHttpRequest();
				 const auto = document.querySelector('.auto-fill');
				 request.onload = function() {
					  auto.innerHTML = this.responseText;
						hitungTotal();
				 }
				 let url = `loadBarang.php?kodebarang=${kodebar}`;
				 request.open('GET' , url , true);
				 request.send();
		}

		//=============================== TOTAL-RENDER ==
		//====================================

		function hitungTotal() {
        let total,jumlah,harga;
				total = document.getElementById('total');
				jumlah = document.getElementById('jumlah');
				harga = document.getElementById('harga');
				if(parseFloat(jumlah.value) < 0 || parseFloat(jumlah.value) < 1) {
					alert('cannot count it');
				}else {
					 const parsing = parseFloat(harga.value) * parseFloat(jumlah.value);
					 total.value = parsing;
					 jumlah.addEventListener('keyup' , function() {
						     if(this.value < 1) {
									 alert('cannot counting value under 1');
								 }else {
                 const parser = parseFloat(this.value) * parseFloat(harga.value);
								 total.value = parser;
               }
					 });
				}
		}

		//=============================== ADD-BARANG-JOIN-TABLE-RENDER ==
		//====================================

		function addBarang() {
			 const random = Math.floor(Math.random() * 10000) + 1;
			 const tablerender = document.querySelector('.table-render');
			 const input = document.querySelectorAll('.form-barang input');
			 const barang = document.getElementById('barang');
			 const kodebar = barang.options[barang.selectedIndex].value;
			 const nobeli = document.getElementById('nobeli');
			 const namabarang = barang.options[barang.selectedIndex].innerHTML;
			 const request = new XMLHttpRequest();
			 let url;
			 const add = document.querySelector('#add');
			 if(add.innerHTML === 'Submit') {
			 	   if(typeof totalRender === "number" && totalRender !== NaN) {
					 	 totalRender += parseFloat(input[5].value);
					 }else {
					 	totalRender = 0;
					 }
           url = `action.php?tombol=simpan&kodebarang2=${random}&kodebarang=${kodebar}&no=${nobeli.value}&namabarang=${namabarang}&jenis=${input[0].value}&merk=${input[1].value}&satuan=${input[2].value}&jumlah=${input[3].value}&harga=${input[4].value}&total= ${input[5].value}`;
					 localStorage.setItem('total' , JSON.stringify(totalRender));
					 grandTotal();
			 }else {
				   let kodebarang = JSON.parse(localStorage.getItem('kodebarang')) || 1;
				   localStorage.setItem('total',JSON.stringify(input[5].value));
					 url = `action.php?tombol=edit&kodebarang=${kodebarang}&jenis=${input[0].value}&merk=${input[1].value}&satuan=${input[2].value}&jumlah=${input[3].value}&harga=${input[4].value}&total=${input[5].value}`;
					 setTimeout(() => {
               add.innerHTML = 'Submit';
					 },200);
			 }

			 request.onload = function() {
				  showUp(tablerender,this.responseText);
			 }
			 request.open('GET',url,true);
			 request.send();
			 setTimeout(() => {
				 kosongInput(input);
			 } ,300);

		}

		function kosongInput(input) {
			 input.forEach((finding,id) => {
				  finding.value = '';
			 });
		}

		function showUp(table,response) {
         table.innerHTML = response;
				 return response;
		}

		//=============================== ACTION-HANDLER ==
		//====================================

		function deleteHandler(kodebar , total) {
			   let subtotal = document.querySelector('.grandtotal input');
			   let totalBinding = 0;
         if(JSON.parse(localStorage.getItem('total')) === 0 || JSON.parse(localStorage.getItem('total')) === NaN) {
         	  totalBinding = 0;
         }else {
            totalBinding = JSON.parse(localStorage.getItem('total')) - total;
         }
         localStorage.setItem('total' , totalBinding);
         const request = new XMLHttpRequest();
				 const url = `action.php?tombol=delete&kodebarang=${kodebar}`;
				 const tablerender = document.querySelector('.table-render');
				 request.onload = function() {
					  tablerender.innerHTML = this.responseText;
				 }
				 request.open('GET' , url , true);
				 request.send();
		}

		function editHandler(...data) {
				const [ kodebarang , jenis , merk , satuan , jumlah , harga , total ] = data;
				localStorage.setItem('kodebarang' , JSON.stringify(kodebarang));
        const btn = document.getElementById('add');
				const input = document.querySelectorAll('.form-barang input');
        input[0].value = jenis;
				input[1].value = merk;
				input[2].value = satuan;
				input[3].value = parseFloat(jumlah);
				input[4].value = parseFloat(harga);
				input[5].value = parseFloat(total);
				btn.innerHTML = 'Edit';
				hitungTotal();
		}

		//=============================== FORM-PROCESS ==
		//====================================

		function grandTotal() {
			   const grandtotal = document.querySelectorAll('.grandtotal input');
				 grandtotal[0].value = JSON.parse(localStorage.getItem('total')) || 1;
				 hitungPajakDiskon(grandtotal[1],grandtotal[2],grandtotal[0].value , grandtotal[3]);
		}

		function hitungPajakDiskon(diskon,pajak,subtotal , grandtotal) {
        const pajakFind = document.querySelector('.pajak-find');
        const diskonFind = document.querySelector('.diskon-find');

        pajak.onkeyup = function() {
            const reminder = (parseFloat(this.value) / 100) * parseFloat(subtotal);
            pajakFind.innerHTML = reminder;
						grandtotal.value = parseFloat(subtotal) + Math.floor(reminder);
				}

				diskon.onkeyup = function() {
            if(pajak.value === "") {
							const hitungtotal = (parseFloat(this.value) / 100) * subtotal;
							grandtotal.value = subtotal - Math.floor(hitungtotal);
						}else {
							const hitungdiskon = (parseFloat(diskon.value) / 100) * subtotal;
							diskonFind.innerHTML = hitungdiskon;
              const hitungPajak = (parseFloat(pajak.value) / 100) * subtotal
							const total = subtotal - (Math.floor(hitungdiskon) + Math.floor(hitungPajak));
							grandtotal.value = total;
						}
				}
		}

		//=============================== PROCESS-HANDLER  ==
		//====================================

		function addBeli() {
			 const request = new XMLHttpRequest();
			 const no = document.getElementById('nobeli');
			 const user = document.getElementById('user');
			 const suplier = document.getElementById('suplier');
			 const supvalue = suplier.options[suplier.selectedIndex].value;
			 const uservalue = user.options[user.selectedIndex].value;
			 const date = document.getElementById('date');
       const grandtotal = document.querySelectorAll('.grandtotal input');
			 let url = `grandtotal.php?form=tbbeli&no=${no.value}&date=${date.value}&kodesup=${supvalue}&kodeuser=${uservalue}&subtotal=${grandtotal[0].value}&diskon=${grandtotal[1].value}&pajak=${grandtotal[2].value}&grandtotal=${grandtotal[3].value}`;
			 request.open('GET' , url , true);
			 request.send();
			 setTimeout(() => {
				 grandtotal.forEach(finding => finding.value = '');
				 totalRender = 0;
				 localStorage.setItem('total' , JSON.stringify(totalRender));
			 }, 400);
			 
				noBeliIncrement();
		}

		//=============================== EXECUTIONS ==
		//====================================

   window.addEventListener('DOMContentLoaded' , function() {
		 date();
		 noBeliRender();
		 grandTotal();
	 })


		</script>
  </body>
</html>
