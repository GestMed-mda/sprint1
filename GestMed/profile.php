<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

View::start("Perfil");
View::navbar();

$num = $_GET['id'];
$res = DB::execute_sql("SELECT * FROM paciente WHERE DNI = ?",array($num));
$result = $res->fetch(PDO::FETCH_NAMED);
$foto = $result["Foto"];
$picture_src = "data:image/jpeg;base64," . base64_encode($foto);
?>
<div class="limite" style="width: 100%">
    <div  style="width: 30%">
        <div class="card" style="margin: 8px 5px 25px 30px    ">
            <?php  echo "<img  style='margin-top: 10px; height: 250px; max-width: 300px  ' src='$picture_src'>"; ?>
            <h2><?php echo $result["Nombre"]; ?></h2>
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

<?php
    View::footer();
    View::end()
?>