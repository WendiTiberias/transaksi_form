<?php

 include "koneksi.php";
 $form = $_GET['form'];
  if($form === 'tbbeli') {
    $no = $_GET['no'];
    $date = $_GET['date'];  
    $kodesup = $_GET['kodesup'];
    $kodeuser = $_GET['kodeuser'];
    $sub = $_GET['subtotal'];
    $diskon = $_GET['diskon'];
    $pajak = $_GET['pajak'];
    $grandtotal = $_GET['grandtotal'];
    $query = mysqli_query($conn , "INSERT INTO tbbeli (no,tgl,kodesup,kodeuser,subtotal,disc,pajak,grandtotal) VALUES('$no','$date','$kodesup','$kodeuser','$sub','$diskon','$pajak','$grandtotal')");
    $query3 = mysqli_query($conn , "SELECT*FROM tempbelidetil WHERE no='$no'");
    while($res = mysqli_fetch_array($query3)) {
       $kodebarang = $res['kodebarang'];
       $no = $res['no'];
       $harga = $res['harga'];
       $total = $res['total'];
       $jlh = $res['jlh'];
       $que1 = mysqli_query($conn , "INSERT INTO tbdetil (no,kodebarang,harga,jlh,total) VALUES('$no','$kodebarang','$harga','$jlh','$total')");
       $que2 = mysqli_query($conn , "UPDATE tbbarang SET jlh_barang = jlh_barang + '$jlh' WHERE kodebarang='$kodebarang'");
    }
 }

 else if($form === 'tbjual') {
   $no = $_GET['no'];
    $date = $_GET['date'];  
    $kodesup = $_GET['kodepel'];
    $kodeuser = $_GET['kodeuser'];
    $sub = $_GET['subtotal'];
    $diskon = $_GET['diskon'];
    $pajak = $_GET['pajak'];
    $grandtotal = $_GET['grandtotal'];
    $query = mysqli_query($conn , "INSERT INTO tbjual (no,tgl,kodepel,kodeuser,subtotal,disc,pajak,grandtotal) VALUES('$no','$date','$kodesup','$kodeuser','$sub','$diskon','$pajak','$grandtotal')");
    $query4 = mysqli_query($conn , "SELECT*FROM tempjualdetil WHERE no='$no'");
    while($res2 = mysqli_fetch_array($query4)) {
       $kodebarang = $res2['kodebarang'];
       $no = $res2['no'];
       $harga = $res2['harga'];
       $total = $res2['total'];
       $jlh = $res2['jlh'];
       $que3 = mysqli_query($conn , "INSERT INTO tbdetiljual (no,kodebarang,harga,jlh,total) VALUES ('$no','$kodebarang','$harga','$jlh','$total')");
       $que4 = mysqli_query($conn , "UPDATE tbbarang SET jlh_barang = jlh_barang - $jlh WHERE kodebarang='$kodebarang'");
    }
 }

?>
