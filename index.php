<!DOCTYPE html>
<html lang="pl">
<head>
<title> Rejestracja </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<meta charset="utf-8">
<link rel="stylesheet" href="arkusz.css" text="text/css">
</head>
<body>
<div id="top">
<div class="logo">
<h1>
Witaj na stronie rejestracji
</h1>
</div>		
</div>
<div id="srodek">
<br>
<form action="php/rejestracja.php" method="post"> 
Login <br> <input type="text" name "login" > <br>
E-mail <br> <input type="text" name "email"> <br>
Hasło <br> <input type="password" name "haslo1"> <br>
Powtórz hasło <br> <input type="password" name "haslo2"> <br>
<input type="submit" value="Zarejestruj sie" name="rejestruj"/>
</form>
</div>
<div id="stopka">
<h2>© copyright wszystkie prawa zastrzeżone Bartłomiej Blicharz </h2>
</div>
</body>
</html>