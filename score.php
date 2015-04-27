<?php

require_once 'db.php';

try
{
    $name = 0;
    $score = 0;
    if (isset($_POST['name']))
    {
      $name = $_POST['name'];
    }
    if (isset($_POST['score']))
    {
      $score = $_POST['score'];
    }
    
    $DBH = openDBConnection();

    if($name !== 0 && $score > 0)
    {
        $highscore = 0;
        
        $query = "SELECT * FROM snake.scores order by scores.score desc limit 10;";
        $statement = $DBH->prepare( $query );
        $statement->execute(  );
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($result as $row)
        {
            $s = $row['score'];
            if($score > $s)
            {
                $highscore = 1;
            }
        }
        
        $query = "INSERT INTO scores (name, score) VALUES (?,?)";
        $statement = $DBH->prepare( $query );
        $statement->bindValue(1, $name);
        $statement->bindValue(2, $score);
        $statement->execute(  );

        echo $highscore;
    }
}
catch(PDOException $e)
{
    $e = "ERROR";
}

?>