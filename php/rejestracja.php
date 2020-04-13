<?php
if(isset($_POST['rejestruj'])){
	
	require 'polaczenie.php';
	
	$username = $_POST['login'];
	$email = $_POST['email'];
	$password = $_POST['haslo1'];
	$passwordRepeat = $_POST['haslo2'];
	
if(empty($username)|| empty($email) || empty($password) || empty($passwordRepeat)){
	header("Location: ../index.php?error=emptyfield&login=".$username."&email=".$email);
	exit();
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)&& !preg_match("/^[a-zA-Z0-9]*$/",$username)){
	header("Location: ../index.php?error=invalidemaillogin");
	exit();
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	header("Location: ../index.php?error=invalidemail&login=".$username);
	exit();
}
else if (!preg_match("/^[a-zA-Z0-9]*$/",$username)){
	header("Location: ../index.php?error=invalidlogin&email=".$email);
	exit();
}
else if($password !== $passwordRepeat){
	header("Location: ../index.php?error=passwordchecklogin=".$username."&email=".$email);
	exit();
}
else {

	$sql ="SELECT id FROM uzytkownik WHERE id=?";
	$stmt =mysqli_stmt_init($conn);
	
if (!mysqli_stmt_prepare($stmt,$sql)){
	header("Location: ../index.php?error=sqlerror");
	exit();
}
else {
	mysqli_stmt_bind_param($stmt,"s",$username);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	$resultCheck = mysqli_stmt_num_rows();
if($resultCheck > 0){
	header("Location: ../index.php?error=usertaken&email=".$email);
	exit();
	}
else {
		
		$sql = "INSTER INTO uzytkownik (login,email,haslo) VALUES(?, ?, ?)";
		$stmt =mysqli_stmt_init();
if (!mysqli_stmt_prepare($stmt,$sql)){
	header("Location: ../index.php?error=sqlerror");
	exit();
	}
else {
	$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
	
	mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hashedPwd);
	mysqli_stmt_execute($stmt);
	header("Location: ../index.php?signup=success");
	exit();
	}
}
}
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
}
else {
	header("Location: ../index.php");
	exit();
}
?>