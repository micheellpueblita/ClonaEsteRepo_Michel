<?php
    $usuario = (isset($_POST["usuario"]) && $_POST["usuario"] != "") ?$_POST["usuario"] : false;
   
    $nombre = (isset($_POST["nombre"]) && $_POST["nombre"] != "") ?$_POST["nombre"] : false;
   
    $contraseña  = (isset($_POST["contraseña"]) && $_POST["contraseña"] != "") ?$_POST["contraseña"] : false;
   
    $casa  = (isset($_POST["casa"]) && $_POST["casa"] != "") ?$_POST["casa"] : false;

    echo "
    <h1>Mi avatar $usuario</h1>
    <br><br>
    <form action='./avatar.php' method='POST' enctype='multipart/form-data'
        <fieldset>
            <legend><strong>Subir imágenes</strong></legend>
            <br>
            <label>Nombre de la imagen</label>
            <input type='text' name='nombreImagenGaleria' for'nombreImagenGaleria' required>
            <br> 

            <label for='parteCuerpo'>Selecciona la parte del cuerpo:</label>
            <select type='parteCuerpo' name='parteCuerpo'required> 
                <option>Cabeza</option>
                <option>Torso</option>
                <option>Pantalon</option>
                <option>Zapatos</option>
            </select>
            <br> 

            <input type='file' name='archivoGaleria' for'archivoGaleria' required>
            <br><br>
            <input type='submit' value='subir'>
            <input type='reset' value='reset'>
        </fieldset>
    </form>";


    //Aqui revisa la extension del archivo que se subió
    $nombreImagenGaleria = (isset($_POST["nombreImagenGaleria"]) && $_POST["nombreImagenGaleria"] != "") ?$_POST["nombreImagenGaleria"] : false;
    $descripcionGaleria = (isset($_POST["descripcionGaleria"]) && $_POST["descripcionGaleria"] != "") ?$_POST["descripcionGaleria"] : false;
    $parteCuerpo = (isset($_POST["parteCuerpo"]) && $_POST["parteCuerpo"] != "") ?$_POST["parteCuerpo"] : false;

    if(isset($_FILES['archivoGaleria'])){

        $name=$_FILES['archivoGaleria']['name'];

        $ext=pathinfo($name,PATHINFO_EXTENSION);//Aqui la variable toma la extension del archivo

        if($ext=="png" || $ext=="jpg" || $ext=="jpge"){

            $arch=$_FILES['archivoGaleria']['tmp_name'];
            rename($arch,"../statics/avatar/$parteCuerpo.jpg");//ponerle nombre 
            echo "<strong>Tu archivo se subio correctamente a tu avatar</strong><br><br>";//Aqui comprueba la extension y imprime que todo bien 
        }
        else{
            echo"$name.  No se puede subir";
        }
    }
    $carpetaGaleria=opendir("../statics/avatar");//abre carpeta
    $archivosGaleria=[];
    $hay_archivosGaleria=true;
    $iGaleria=0;
    while($hay_archivosGaleria){
        $archivo1Galeria=readdir($carpetaGaleria);
        if($archivo1Galeria!=false){
            $iGaleria++;
            array_push($archivosGaleria, $archivo1Galeria);
        }
        else{
            $hay_archivosGaleria=false;
        }
    }
    if($iGaleria!=0){
        $cabeza=file_exists("../statics/avatar/cabeza.jpg");
        if($cabeza)
           echo"<th><img src='../statics/avatar/cabeza.jpg' width='200' height='150'/></th>";
        else
            echo "Aún no tienes cabeza.";

        $torso=file_exists("../statics/avatar/torso.jpg");
        if($torso)
            echo"<th><img src='../statics/avatar/torso.jpg' width='200' height='150'/></th>";
        else
            echo "<br>Aún no tienes torso.";
        $pantalon=file_exists("../statics/avatar/pantalon.jpg");
        if($pantalon)
            echo"<th><img src='../statics/avatar/pantalon.jpg' width='200' height='150'/></th>";
        else
            echo "<br>Aún no tienes pantalon.";
        $zapatos=file_exists("../statics/avatar/pantalon.jpg");
        if($zapatos)
            echo"<th><img src='../statics/avatar/zapatos.jpg' width='200' height='150'/></th>";
        else
            echo "<br>Aún no tienes zapatos.<br>";
    }
    else{
        echo "Aún no hay imagenes en tu avatar.";
    }
    
    echo"    
    <a href='./galeria.php'><input type='button' value='Galeria'></a>
    <a href='./casasencomun.php'><input type='button' value='Casa'></a><br>
    <a href='./cerrar_seccion.php'><input type='button' value='Cerrar sesión'></a>
"; //Botones de abajo, checar lo de cerrar sesion
?>