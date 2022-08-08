<?php 
include('db.php'); 


switch($_GET['op']){
    case 'insertar':
        echo "se inserto el usuario";
            $id = $_POST['IDETB'];
            $tipo = $_POST['tipo'];
            $username = $_POST['username'];
            $cc = $_POST['cc'];
            $password = $_POST['password'];

            $cons="INSERT INTO TBL_UM_SUPERVISORES
            (SUPERVISOR,LOGIN,CLAVE,CONDICION,CARGO,CEDULA)
            VALUES
            ('$username','$id','$password','1','$tipo','$cc')";

            $stid = oci_parse($conexión, $cons);
            if (!$stid) {
                $e = oci_error($conexión);
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }// Realizar la lógica de la consulta
    
            $r = oci_execute($stid);
            if (!$r) {
                $e = oci_error($stid);
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                 echo '<script type="text/javascript">
                    alert("Se ingresado el usuario correctamente");
                    window.location.href="usuarios.php";
                    </script>';
            }// Obtener los resultados de la consulta
        break;

    case 'modificar':
        echo "se modifico el usuario";
        $id = $_POST['IDETB'];
        $tipo = $_POST['tipo'];
        $username = $_POST['username'];
        $cc = $_POST['cc'];
        $password = $_POST['password'];

        $cons="UPDATE tbl_um_supervisores set cargo ='$tipo',supervisor ='$username', cedula ='$cc', clave ='$password' WHERE login ='$id' ";

        $stid = oci_parse($conexión, $cons);
        if (!$stid) {
            $e = oci_error($conexión);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }// Realizar la lógica de la consulta

        $r = oci_execute($stid);
        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
             
        }// Obtener los resultados de la consulta
            echo '<script type="text/javascript">
                alert("Se modifico el usuario correctamente");
                window.location.href="usuarios.php";
                </script>';
        break;

    case 'habilitar':
        $id = $_GET['id'];
        $cond = $_GET['cond'];
            if($cond == 1){
                $cons="UPDATE tbl_um_supervisores set condicion = 0 WHERE login = '$id' ";
            
                    $stid = oci_parse($conexión, $cons);
                    if (!$stid) {
                        $e = oci_error($conexión);
                        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                    }// Realizar la lógica de la consulta
                
                    $r = oci_execute($stid);
                    if (!$r) {
                        $e = oci_error($stid);
                        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                    }// Obtener los resultados de la consulta
                    echo '<script type="text/javascript">
                    
                    window.location.href="usuarios.php";
                    </script>';
                   
                
            }else if($cond == 0){
                $id = $_GET['id'];
                $cons="UPDATE tbl_um_supervisores set condicion = 1 WHERE login = '$id' ";
            
                $stid = oci_parse($conexión, $cons);
                if (!$stid) {
                    $e = oci_error($conexión);
                    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                }// Realizar la lógica de la consulta
            
                $r = oci_execute($stid);
                if (!$r) {
                    $e = oci_error($stid);
                    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                }// Obtener los resultados de la consulta 
                    echo '<script type="text/javascript">
                        
                        window.location.href="usuarios.php";
                        </script>';
            }
        break;
}

?>