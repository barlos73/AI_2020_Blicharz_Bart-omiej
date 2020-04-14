<?php
if(isset($_POST['rejestruj'])){
	
	require 'polaczenie.php';
	
	$username = $_POST['login'];
	$email = $_POST['email'];
	$password = $_POST['haslo1'];
	$passwordRepeat = $_POST['haslo2'];
	
if(empty($username)|| empty($email) || empty($password) || empty($passwordRepeat)){
	header("Location: ../index.html?error=emptyfield&login=".$username."&email=".$email);
	exit();
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)&& !preg_match("/^[a-zA-Z0-9]*$/",$username)){
	header("Location: ../index.html?error=invalidemaillogin");
	exit();
	
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	header("Location: ../index.html?error=invalidemail&login=".$username);
	exit();
	
}
else if (!preg_match("/^[a-zA-Z0-9]*$/",$username)){
	header("Location: ../index.html?error=invalidlogin&email=".$email);
	exit();
	
}
else if($password !== $passwordRepeat){
	header("Location: ../index.html?error=passwordcheck&login=".$username."&email=".$email);
	exit();
	
}
else {
	$sql ="SELECT login FROM uzytkownik WHERE login=?";
	$stmt =mysqli_stmt_init($conn);	
if (!mysqli_stmt_prepare($stmt,$sql)){
	header("Location: ../index.html?error=sqlerror");
	exit();
}
else {
	mysqli_stmt_bind_param($stmt,"s",$username);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	$resultCheck = mysqli_stmt_num_rows($stmt);
if($resultCheck>0){
	header("Location: ../index.html?error=usertaken&email=".$email);
	exit();
	}
else {	
		$sql ="INSERT INTO uzytkownik (login,email,haslo) VALUES(?,?,?)";
		$stmt =mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)){
	header("Location: ../index.html?error=sqlerror");
	exit();
	}
else {
	$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
	mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hashedPwd);
	mysqli_stmt_execute($stmt);
	header("Location: ../index.html?signup=success");
	exit();
	}
}
}
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
}
else {
	header("Location: ../index.html");
	exit();
}
