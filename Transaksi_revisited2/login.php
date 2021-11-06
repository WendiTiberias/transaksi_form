<?php

  session_start();
  include "koneksi.php";
  if(isset($_POST['login'])) {
  	 $kodeuser = $_POST['kodeuser'];
  	 $pass = $_POST['password'];
  	 $query = mysqli_query($conn , "SELECT*FROM tbuser WHERE kodeuser='$kodeuser' AND papss='$pass' ");
     $_SESSION['kodeuser'] = $kodeuser;
  	 if(mysqli_num_rows($query)) {
      echo "<script> alert('berhasil login') </script>";
  	 	header('location:form.php');
    }else {
      echo "<script> alert('gagal login') </script>";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-blue-500 flex items-center justify-center">
	<form method="POST" class="w-2/5 mx-auto bg-white rounded-sm py-5 px-5">
	  <h3 class="text-xl uppercase text-center font-semibold">Login Form</h3>
	  <input name="kodeuser" type="number" placeholder="kodeuser" class="w-full mt-5 py-2 px-3 rounded-sm border-2 border-gray-400">
	  <input name='password' type="password" placeholder="password" class="w-full my-3 py-2 px-3 rounded-sm border-2 border-gray-400">
      <button name="login" type="submit" class="bg-blue-500 text-white py-2 px-5 rounded-sm">Login</button>
	</form>
	<script>
	  function reset() {
       const forminput = document.querySelectorAll('form input');
       setTimeout(() => {
         forminput.forEach((finding,id) => {
            finding.value = '';
         })
       } , 400);
    }
	</script>
</body>
</html>
