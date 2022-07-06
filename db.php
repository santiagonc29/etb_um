<?php

$conexión = oci_connect("suma","Colombia_2022","SIVO");
if (!$conexión) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}// Preparar la sentencia

?>