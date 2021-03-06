<?php
class View {
    public static function start($title){
        $html = "<!DOCTYPE html>
                 <html>
                 <head>
                    <meta charset=\"utf-8\">
                    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
                    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\">
                    <script src=\"http://code.jquery.com/jquery-3.3.1.min.js\"></script>
                    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
                    <script src=\"https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js\"></script>
                    <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
                    <script src=\"ajax.js\"></script>
                    <title>$title</title>
                 </head>
                 <body>";

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
        <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Pacientes <span class="caret"></span></a>
         <ul class="dropdown-menu">
          <!--<li class="letter-space"><a href="profile.php">Ver mis pacientes <i class="fa fa-eye"></i> </a></li>-->
          <li class="letter-space"><a href="add.php">Añadir Pacientes  <i class="fa fa-plus"></i> </a></li>
          <li class="letter-space"><a href="search.php">Buscar Pacientes <i class="fa fa-search"></i></a></li>
        </ul>
        </li>
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
            <li><div class="busqueda"><form action = "search.php" name="searchForm" method="get">
                <input type ="text"  class="search_box" name=" inputValue" placeholder="Busque Paciente " id ="search_box">
                <button type ="submit" class="search_button" style="width: 50px; height: 40px; border-radius: 10px; " name="search" value="Buscar" id ="search_button"><i class="fa fa-search"></i></button>
            </form></div> </li>
          <li class="letter-space"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout
              </a></li>
      </ul>
      </div>
  </div>
</nav> ';

    }

    public static function showSearch(){

        $html="

            <form action = \"search.php\" name=\"searchForm\" method=\"get\">
                <input type =\"text\"  class=\"search_box\" name=\" inputValue\" placeholder=\"Busque Paciente \" id =\"search_box\">
                <input type =\"submit\" class=\"search_button\" name=\"search\" value=\"Buscar\" id =\"search_button\">
            </form>
        ";
        echo $html;
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
            self::$connection = $db = new PDO("mysql:host=localhost; dbname=gestmedf", "root", "");
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
        $inst = $db -> prepare('SELECT * FROM medico WHERE DNI=? and Password=?');
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
    public static function search(){
        $db=DB::get();
        if(isset($_GET['inputValue'])){
            $resultadoBusqueda=$db->prepare("SELECT * FROM paciente where Nombre  LIKE ? or DNI  LIKE ? ");
            $resultadoBusqueda-> execute(array($_GET['inputValue'].'%',$_GET['inputValue'].'%' ));

            if($resultadoBusqueda){
                echo'<h2 id="searchResults" style="text-align: center">Resultados de la búsqueda</h2>';
                $resultadoBusqueda->setFetchMode(PDO::FETCH_NAMED);
                echo"<p><table class='tabla' id=\"pacientes\">
                        
                            <th class='colum'>Nombre</th>
                            <th class='colum'>DNI</th>
                            <th class='colum'>Telefono</th>
                            <th class='colum'>Edad</th>
                            <th class='colum'>Ciudad</th>
                            
                            <th class='colum'>Mimedico</th>
                        ";
                foreach($resultadoBusqueda as $regis){
                    echo "<tr>";
                    echo"<td class='colum'>{$regis['Nombre']}</td>";
                    echo"<td class='colum'>{$regis['DNI']}</td>";
                    $DNI = $regis['DNI'];
                    echo"<td class='colum'>{$regis['Telefono']}</td>";
                    echo"<td class='colum'>{$regis['Edad']}</td>";
                    echo"<td class='colum'>{$regis['Ciudad']}</td>";
                    //echo"<td>{$regis['Foto']}</td>";
                    echo"<td class='colum'>{$regis['Mimedico']}</td>";
                    echo "<td><a class='enlace' href='profile.php?id=$DNI'> Ver Paciente </a></td>";

                }


                echo"<tr>";

                echo'</table></p>';

            }
        }else if(!isset($_GET['inputValue']) ){
            echo"No se han encontrado resultados";

        }
    }
}