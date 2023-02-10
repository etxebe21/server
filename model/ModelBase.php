<?php

require_once (__DIR__. "/../db/Conexion.php");

class ModelBase extends Conexion
{
    protected $conexion;
    protected $table_name;


    function __construct()
    {
        $this->conexion = parent::getInstance();
    }

    //Obtiene todos los elementos de la tabla
    function getAll()
    {
        $query = $this->selectDB($this->table_name);

        //echo "Table_name: " . $this->table_name;
        $result = $this->conexion->query($query);

        //Creamos el array asociativo para devolver los datos
        $array = $this->createArray($result);

        $result->close();
        return $array;
    }


    //Obtiene todos los elementos de la tabla, filtrando por un valor de una columna
    function getAllByColumn($search_name, $search_value)
    {
        $query = $this->selectDB($this->table_name, "*", $search_name, $search_value);
        $result = $this->conexion->query($query);

        //Creamos el array asociativo para devolver datos
        $array = $this->createArray($result);

        $result->close();
        return $array;
    }

    //Funcion que añade un elemento nuevo a la tabla
    function addNew($array)
    {
        $query = $this->insertDB($this->table_name, $array);
       
        $result = $this->conexion->query($query);
        return $result;
        
    }


    protected function createArray($data)
    {
        //Creamos el array asociativo para devolver los datos
        while ($row = $data->fetch_array(MYSQLI_ASSOC))
        {

            //Añadimmos la siguiente fila
            $array[] = $row;
        }
        return $array;
    }


//Devuelve un Query de la forma "SELECT * from table WHERE author = 'Jane Austen'"
//Parametros:
//$table: Nombre de la tabla (FROM)
//$columns: Columnas a extraer (SELECT). Si no se pasa este parametro se entiende que se extraen todas (*)
//$condition: condicion de busqueda (WHERE) Si no se pasa este parametro se entiende que no hay condicion de busqueda
protected function selectDB($table, $columns = "*", $name = "" , $value = "")
{
    $query = "SELECT $columns FROM $table";
    if($name != "" && $value != "")
        $query .= " WHERE $name = '$value'";

        //echo $query;
        return $query;
}

//Devuelve un Query de la forma "INSERT INTO table(author, title, category)VALUES ('JRR Tolkien', the rings', 'Fiction')"
//Parametros:
//$table : nombre de la tabla
//$array: Array asociativo con los pares (name,value) correspondiente al nombre de la columna y valor
protected function insertDB($table, $array)
{
    foreach ($array as $name => $value) 
    {
        $insert_name[] = $name;
        $insert_value[] = $value;
    }

    $query = "INSERT INTO $table(";

    $num_elem = count($insert_name);
    for($i = 0; $i < $num_elem; ++$i)
    {
        $query .= "$insert_name[$i]";
        if($i != $num_elem -1)
            $query .= ", ";
        else
            $query .= ") ";
    }
$query .= "VALUES(";
    for($i = 0; $i < $num_elem; ++$i)
    {
        $query .= "'$insert_value[$i]'";
        if($i != $num_elem -1)
            $query .= ", ";
        else
            $query .= ") ";
    }
    return $query;
}


}
?>