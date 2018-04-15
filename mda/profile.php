<?php
include_once "lib.php";
if (!User::getLoggedUser()){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="application/javascript" src="ajax.js"></script>
    <title>User´s Profile</title>
    <style>

    </style>
</head>


<?php View::navbar() ?>

<?php
$num = 10;
$res = DB::execute_sql("SELECT * FROM paciente WHERE DNI = ?",array($num));
$result = $res->fetch(PDO::FETCH_ASSOC);
$foto = $result["Foto"];
$picture_src = "data:image/jpeg;base64," . base64_encode($foto);
?>
<body>
<div class="limite" style="width: 100%">
    <div  style="width: 30%">
        <div class="card" style="margin: 8px 5px 25px 30px    ">
            <?php echo"<img  style='margin-top: 10px' src='$picture_src' height='250px'>"; ?>
            <h1><?php echo $result["Nombre"]; ?></h1>
            <p class="title">Ciudad: <?php echo $result["Ciudad"]; ?></p>
            <p class="title">Edad: <?php echo $result["Edad"]; ?></p>
            <p class="title">Telf: <?php echo $result["Telefono"]; ?></p>
            <p class="colorboton"><button><i class="glyphicon glyphicon-plus"></i>Añadir entrada a historial</button></p>
            <p class="colorboton"><button style="margin-bottom: 20px "><i class="glyphicon glyphicon-star-empty"></i>Añadir a mis pacientes</button></p>
        </div>

    </div >

    <div>
        <ul class="tamhref ulprofile">
            <li class="li-profile" style="float: left"><a class="noReload lia" style="text-decoration: none" href="alergias.html"> Alergias </a></li>
            <li class="li-profile" style="float: left"><a class="noReload lia" style="text-decoration: none" href="historial.php"> Historial </a></li>
            <li class="li-profile" style="float: left"><a class="noReload lia" style="text-decoration: none" href="familiares.html">Antecedentes Familiares</a></li>
            <li class="li-profile" style="float: left"><a a class="noReload lia" style="text-decoration: none" href="personales.html">Antecedentes Personales</a></li>
        </ul>
        <div id="page" class="margin" "></div>
    </div>



    </div>

</div>
</body>

<?php View::footer()?>