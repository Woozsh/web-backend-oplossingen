<?php
/**
 *
 */
class query extends AnotherClass
{

  function __construct(argument)
  {
    # code...
  }

  function query($db, $query, $tokens = false){
    $statement = $db->prepare($query);

    if($tokens){ //assign variables as $var[':var'] = $var
      foreach($tokens as $token => $tokenValue){
        $statement->bindValue($token, $tokenValue);
      }
    }

    $statement->execute();

    //Veldnamen
    $fieldNames = array();

    for($i = 0; $i < $statement->columnCount(); ++$i){ //overloopt alle kolommen
      $fieldnames[] = $statement->getColumnMeta($i)['name']; //slaat de headername van de kolom op
    }

    //De data ophalen
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      $data[] = $row;
    }

    $returnarray['fieldnames'] = $fieldnames;
    $returnarray['data'] = $data;

    return $returnarray;
}



 ?>
