<?php

class View {
    public static function start($title){
        $html = "<!DOCTYPE html>
                 <html>
                 <head>
                    <meta charset=\"utf-8\">
                    <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
                    <!--<script src=\"http://code.jquery.com/jquery-3.3.1.min.js\"></script>-->
                    <script src=\"messages.js\"></script>
                    <title>$title</title>
                 </head>
                 <body>
<!--<div id=\"fijo\">
    <img id=\"logop\" src=\"imagenes/logopeq.jpg\" alt=\"Logo bebercio\"/>
    <h1 id=\"empresa\">Bebercio S.L.</h1>
</div><div id=\"cuerpo\">-->";

        User::session_start();
        echo $html;
    }

    public static function navigation(){
        echo "<nav>";
        echo "</nav>";
    }

    public static function navbar(){
      echo ' <nav class="navbar navbar-inverse navbar-color">
  <div class="container-fluid">
    <div class="navbar-header">
        <a href = index.php><img src="Imagenes/logo-gestmed.png"  class="logo" alt="logo"></a>

    </div>
    <ul class="nav navbar-nav">
        <li class="active letter-space"><a href="profile.php"  >Pacientes</a></li>
      <li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#"> Mi Perfil <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="letter-space"><a href="#">Información general</a></li>
          <li class="letter-space"><a href="#">Biblioteca</a></li>
          <li class="letter-space"><a href="#">Ajustes</a></li>
        </ul>
      </li>
      <li class="letter-space"><a href="#">Noticias</a></li>
    </ul>
    <div>
      <ul class="nav navbar-nav navbar-right">
          <li class="letter-space"><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Logout
              </a></li>
      </ul>
      </div>
  </div>
</nav> ';

    }

    public static function footer(){

     echo '   <br>
<!--Footer-->
<footer class="page-footer font-small indigo pt-0">

    <!--Footer Links-->
    <div class="container">

        <!--First row-->
        <div class="row">

            <!--First column-->
            <div class="col-md-12 py-5">

                <div class="mb-5 flex-center">

              <div style="float: left;">
        <img src="Imagenes/logo-gestmed.png"  alt="logo">
        </div>
           <div class="footer-copyright py-3" style="float: right">
        © 2018 Copyright:GestMed
        </div>
                    
                </div>
                
            </div>
            <!--/First column-->
         
        </div>
        <!--/First row-->
        
    </div>
    <!--/Footer Links-->
    
    <!--Copyright-->
 

</footer>
<!--/Footer--> ';
    }

    public static function end(){
        echo '</div></body>
</html>';
    }
}

class DB {
    private static $connection = null;

    public static function get(){  // Inicia la conexión con la base de datos
        if(self::$connection === null){
            self::$connection = $db = new PDO("mysql:host=localhost; dbname=gestmed", "root", "");
            self::$connection -> exec('PRAGMA foreign_keys = ON;');
            self::$connection -> exec('PRAGMA encoding="UTF-8";');
            self::$connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$connection;
    }

    public static function execute_sql($sql, $parms = null){  // Ejecuta sentencias SQL
        try {
            $db = DB::get();
            $ints = $db -> prepare($sql);

            if ($ints -> execute($parms)) {
                return $ints;
            }
        } catch (PDOException $e) {
            echo '<h1>Error en la Base de Datos: ' . $e -> getMessage() . '</h1>';
        }

        return false;
    }
}

class User {
    public static function session_start(){  // Crea sesión
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    public static function getLoggedUser(){ // Devuelve un array con los datos del perfil o devuelve falso
        self::session_start();
        if(!isset($_SESSION['user'])) return false;
        return $_SESSION['user'];
    }

    public static function login($dni, $passwd){ // Inicia sesión si el usuario figura en la base de datos o devuelve falso
        self::session_start();
        $db = DB::get();
        $inst = $db -> prepare('SELECT * FROM medicos WHERE DNI=? and Password=?');
        $inst -> execute(array($dni, md5($passwd)));
        $inst -> setFetchMode(PDO::FETCH_NAMED);
        $res = $inst -> fetchAll();

        if(count($res) == 1){
            $_SESSION['user'] = $res[0]; // Almacena datos del usuario en la sesión
            return true;
        }

        return false;
    }

    public static function logout(){  // Cierra sesión
        self::session_start();
        unset($_SESSION['user']);
    }
}