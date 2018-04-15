<!DOCTYPE html>
<html lang="en">
<head>
    <title>GestMed</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
include_once "lib.php";
if (!User::getLoggedUser()){
    header("location: login.php");
}
View::navbar();


if(isset($_POST['regist'])){
   echo'estamos dentro';
   $Nombre = $_POST['name'];
   $Ciudad = $_POST['city'];
   $Telefono = $_POST['telephone'];
   $Edad = $_POST['age'];
   $Dni = $_POST['dni'];
   $Foto = file_get_contents($_FILES['image']['tmp_name']);
   print_r($_FILES);
   $Mimedico= User::getLoggedUser()['DNI'];

    $res = DB::execute_sql("INSERT INTO paciente(Nombre, DNI,Ciudad, Telefono,Edad, Foto, Mimedico)
      VALUES (?,?,?,?,?,?,?)", array($Nombre,$Dni,$Ciudad, $Telefono,$Edad, $Foto, $Mimedico));
    header('location: index.php');


}else{
    echo '
<div id="contenido">
    <div id="wrapper">
        <h2>Añadir nuevo paciente</h2>
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div id="username_div">
                <label>Nombre de paciente</label> <br>
                <input type="text" name="name" id="name" class="textInput" placeholder="Nombre de Usuario...">
                <div id="name_error"></div>
            </div>
            <div id="dni_div"><br>
                <label>DNI</label> <br>
                <input type="text" name="dni" id="dni" class="textInput" placeholder="DNI del paciente...">
                <div id="name_error"></div>
            </div>
            <div id="edad_div"><br>
                <label>Edad</label> <br>
                <input type="number" name="age" id="age" class="textInput" placeholder="Edad del paciente...">
                <div id="name_error"></div>
            </div>

            <div id="telefono_div"><br>
                <label>Telefono</label> <br>
                <input type="tel" name="telephone" id="telephone" class="textInput" placeholder="Telefono del paciente...">
                <div id="name_error"></div>
            </div>

            <div id="ciudad_div"><br>
                <label>Ciudad</label> <br>
                <input type="text" name="city" id="city" class="textInput" placeholder="Ciudad donde reside el paciente...">
                <div id="name_error"></div>
            </div>

            <div id="foto_div"><br>
                <label>Foto de perfil:</label> <br>
                <input type="file" name="image" >
                <div id="name_error"></div>
            </div>
            <br>

            <div>
                <input type="submit" name="regist" value="Registrarse" class="btno">
            </div>

        </form>
    </div>
</div>
';
}
?>
<?php View::footer()?>
