<?php
    require_once (__DIR__."/../controller/Controller.php");

    $result = $classic->getAll();

    //Devlvemos el resultado de la DB como JSON
    echo json_encode($result);

    ?>

