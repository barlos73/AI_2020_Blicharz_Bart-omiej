<?php
if(isset($_POST['zaloguj'])){
	require 'polaczenie.php';
	$mailuid = $_POST['loginemail'];
	$password = $_POST['haslo'];
if(empty($mailuid)|| empty($password)){
	header("Location: ../logowanie.html?error=emptyfields");
	exit();
	}
	else {
		$sql = "SELECT * FROM uzytkownik WHERE login=? OR email=? ";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../logowanie.html?error=sqlerror");
			exit();
		}
		else {
			
			mysqli_stmt_bind_param($stmt,"ss",$mailuid,$mailuid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result)){
				$pwdCheck = password_verify($password,$row['haslo']);
				if($pwdCheck == false){
					header("Location: ../logowanie.html?error=wrongpwd");
					exit();
				}
				else if($pwdCheck == true){
					session_start();
					$_SESSION['id'] = $row['id'];
					$_SESSION['login'] = $row['login'];
					header("Location: ../glowna.html?login=success");
					exit();
				}
				else {
					header("Location: ../logowanie.html?error=wrongpwd");
					exit();
				}
			}
			else{
				header("Location: ../logowanie.html?error=nouser");
				exit();
			}
		}
	}
}
else{
	header("Location: ../glowna.html");
	exit();
}