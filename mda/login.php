    <?php
include_once 'lib.php';

if (isset($_POST['submit'])) {
    $DNI = $_POST['DNI'];
    $Password = $_POST['Password'];

    $exist = User::login($DNI, $Password);

    if ($exist == true) {
        header("Location: index.php");
    } else {
        echo '<div style="margin-bottom: 47px;">Error de identificación. Inténtelo de nuevo.</div>';
    }
} else {
    View::start('GestMed: Inicio de Sesión');

    echo '<div class=""><form action="" method="post">
            <input name="DNI" type="text" placeholder="DNI"/>
            <input name="Password" type="password" placeholder="Contraseña"/>
            <input type="submit" name="submit" value="Acceder">
          </form></div>
    ';

    View::end();
}
?>