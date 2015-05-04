<?php

// Get database connection info
require_once 'hidden/db.php';

try
{
    $name = 0;
    $score = 0;
    $diff = 0;
    if (isset($_POST['name']))
    {
      $name = $_POST['name'];
    }
    if (isset($_POST['score']))
    {
      $score = $_POST['score'];
    }
    if (isset($_POST['diff']))
    {
      $diff = $_POST['diff'];
    }
    
    // Open connection 
    $DBH = openDBConnection();

    // If the player scored insert into database
    if($name !== 0 && $score > 0)
    {
        $highscore = 0;
        
        // Check to see if they got a highscore 
        $query = "SELECT * FROM snake.scores WHERE diff=? order by scores.score desc limit 10;";
        $statement = $DBH->prepare( $query );
        $statement->bindValue(1, $diff);
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
        
        // Insert score into scores table
        $query = "INSERT INTO scores (name, score, diff) VALUES (?,?,?)";
        $statement = $DBH->prepare( $query );
        $statement->bindValue(1, $name);
        $statement->bindValue(2, $score);
        $statement->bindValue(3, $diff);
        $statement->execute(  );

        echo $highscore;
    }
}
catch(PDOException $e)
{
    $e = "ERROR";
}

?>