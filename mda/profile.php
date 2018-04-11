<?php
include_once "lib.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="application/javascript" src="ajax.js"></script>
    <title>User´s Profile</title>
    <style>

    </style>
</head>

<body>

<?php View::navbar() ?>


<div class="limite" style="width: 100%">
    <div  style="width: 30%">
        <div class="card" style="margin: 15px 5px 10px 30px    ">
            <img  src="Imagenes/paciente.jpeg"  alt="John" class="borderimag">
            <h1>Nombre del paciente</h1>
            <p class="title">Ciudad:</p>
            <p class="title">Edad:</p>
            <p class="title">Telf:</p>
            <p class="colorboton"><button><i class="glyphicon glyphicon-plus"></i>Añadir entrada a historial</button></p>
            <p class="colorboton"><button style="margin-bottom: 20px "><i class="glyphicon glyphicon-star-empty"></i>Añadir a mis pacientes</button></p>
        </div>




    </div >

    <div >
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
<?php View::footer() ?>
</body>
</html>
