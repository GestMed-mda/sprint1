<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

View::start("Añadir Paciente");
View::navbar();


if(isset($_POST['regist'])){
   $Nombre = $_POST['name'];
   $Ciudad = $_POST['city'];
   $Telefono = $_POST['telephone'];
   $Edad = $_POST['age'];
   $Dni = $_POST['dni'];
   $Foto = file_get_contents($_FILES['image']['tmp_name']);
   $Mimedico= User::getLoggedUser()['DNI'];

    $res = DB::execute_sql("INSERT INTO paciente(Nombre, DNI,Ciudad, Telefono,Edad, Foto, Mimedico)
      VALUES (?,?,?,?,?,?,?)", array($Nombre,$Dni,$Ciudad, $Telefono,$Edad, $Foto, $Mimedico));
	  
    if ($res) {
        echo '<script type="text/javascript"> myAlert(1);</script>';
    }


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

View::footer();
View::end();
?>