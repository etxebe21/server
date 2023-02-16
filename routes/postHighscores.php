<?php
    require_once (__DIR__."/../controller/Controller.php");

    //TEST POST ROUTE. Quitar posteriormente
    // $_POST['name'] = 'MIM';
    // $_POST['score'] = '7700';

    if(isset($_POST['name']) && isset($_POST['score']))
    {
        //Si se reciben todos los datos por POST creamos nuestro onjeto Classic
        $newHighscore['name']   = $_POST['name'];
        $newHighscore['score']  = $_POST['score'];

        //Añadimos el nuevo objeto a la BD
        $returnValue = $highscore->addNew($newHighscore);

        if($returnValue == FALSE)
        {
            echo "Error en la introduccion de nuevo elemento en la BD";
        }
        else
        {
            //Devolvemos el resultado añadido de la BD como Json
            echo json_encode($newHighscore);
        }
    }
    else
        {
            die("Forbidden");
        }
    
    ?>