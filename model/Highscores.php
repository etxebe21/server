<?php
require_once "ModelBase.php";

class Highscores extends ModelBase
{
    function __construct()
    {
        //Inicializamos el nombre de la tabla
        $this->table_name = 'highscores';

        //Llamamos al constructor de la clase ModelBase
        parent::__construct();
    }
}

?>