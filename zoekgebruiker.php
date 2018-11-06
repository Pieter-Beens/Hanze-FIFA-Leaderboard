<html>
  <head>
     <?php include('layouts/header.php'); ?>
  </head>
<body>
<form action = "resultaatgebruiker.php" method = "post"><br>
Om de ID van de speler achterhalen, vul de username van de speler in: <input type="text" name = "users"><br>
OF <a style=color:orange href = "alles.php"> laat alle gebruikers zien </a>
<input type = "submit">
</form>
<br>
<a style=color:orange href=maakgebruiker.php>CREATE USER</a><br>
<a style=color:orange href=zoekgebruiker2.php>EDIT USER</a><br>
<a style=color:orange href=verwijdergeb.php>DELETE USER</a><br>
</body>
</html>
