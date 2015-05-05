<?php

// Get database connection info
require_once 'hidden/db.php';

try
{
    // Open connection
    $DBH = openDBConnection();

    $return_table = "";
    
    // Set query statement. Get easy scores. 
    $query = "SELECT * FROM snake.scores WHERE diff='easy' order by scores.score desc limit 10;";
    $statement = $DBH->prepare( $query );
    $statement->execute(  );

    // Execute
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    // Parse results
    foreach($result as $row)
    {
        // Build table
        $return_table .= "<tr>"
            . "<td>" . $row['name'] . "</td>"
            . "<td>" . $row['score'] . "</td>"
            . "</tr>";
    }
    
     $return_table2 = "";
    
    // Get medium scores
    $query = "SELECT * FROM snake.scores WHERE diff='medium' order by scores.score desc limit 10;";
    $statement = $DBH->prepare( $query );
    $statement->execute(  );
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($result as $row)
    {
        $return_table2 .= "<tr>"
            . "<td>" . $row['name'] . "</td>"
            . "<td>" . $row['score'] . "</td>"
            . "</tr>";
    }
    
     $return_table3 = "";
    
    // Get hard scores
    $query = "SELECT * FROM snake.scores WHERE diff='hard' order by scores.score desc limit 10;";
    $statement = $DBH->prepare( $query );
    $statement->execute(  );
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($result as $row)
    {
        $return_table3 .= "<tr>"
            . "<td>" . $row['name'] . "</td>"
            . "<td>" . $row['score'] . "</td>"
            . "</tr>";
    }
    
    // Get number of games. 
    $query = "SELECT COUNT(*) as c FROM snake.scores";
    $statement = $DBH->prepare( $query );
    $statement->execute(  );
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row)
    {
        $num_games = $row['c'];
    }
}
catch(PDOException $e)
{
    $e = "ERROR";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Snake </title>
        <link rel="stylesheet" type="text/css" href="CSS/SnakeHomeStyle.css">
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
            
    <script type="text/javascript"> 
    
    // Snake Buttons Clicked Event
    function navigationButtonClicked(element)
    {
        if(element.id == "aboutButton")
        {
            location.href = "#aboutDiv";
        }
        else if(element.id == "highScoresButton")
        {
            location.href = "#highScoresDiv";    
        }
        else if(element.id == "instructionsButton")
        {
            location.href = "#instructionsDiv";
        }
        else if(element.id == "newGameButton")
        {
            location.href = "SnakeGame.html";    
        }
    }

    // Snake Buttons Highlight event
    function imgHighlight(element)
    {
        if(element.id == "aboutButton")
        {
            document.getElementById("homeScreenImage").src = "Images/SnakeHomeAbout.png"; 
        }
        else if(element.id == "highScoresButton")
        {
            document.getElementById("homeScreenImage").src = "Images/SnakeHomeScores.png"; 
        }
        else if(element.id == "instructionsButton")
        {
            document.getElementById("homeScreenImage").src = "Images/SnakeHomeHowToPlay.png"; 
        }
        else if(element.id == "newGameButton")
        {
            document.getElementById("homeScreenImage").src = "Images/SnakeHomeNewGame.png"; 
        }
    }

    // Snake Buttouns Mouse Out event
    function imgReturnToDefault()
    {
        document.getElementById("homeScreenImage").src = "Images/SnakeHomeDefault.png";
    }
        
    </script>
    
    </head>
    
    <body>
        
        <div class="homeScreen">
            
            <!-- Snake Home Screen Image Div -->
            <div class="homeScreenImage"> 

                <!-- Home Screen Buttons Div -->
                <div class="homeScreenButtons"> 
                     <button id="aboutButton" type="button" onclick="navigationButtonClicked(this)" 
                     onmouseover="imgHighlight(this);" onmouseout="imgReturnToDefault();"></button> 
                     <button id="highScoresButton" type="button" onclick="navigationButtonClicked(this)" 
                     onmouseover="imgHighlight(this);" onmouseout="imgReturnToDefault();"></button> 
                     <button id="instructionsButton" type="button" onclick="navigationButtonClicked(this)" 
                     onmouseover="imgHighlight(this);" onmouseout="imgReturnToDefault();"></button> 
                     <button id="newGameButton" type="button" onclick="navigationButtonClicked(this)" 
                     onmouseover="imgHighlight(this);" onmouseout="imgReturnToDefault();"></button> 
                </div>

                <img id="homeScreenImage" src="Images/SnakeHomeDefault.png" alt="Home Screen Image">
            </div>
        </div>
            
        <!-- Instructions -->
        <div id="instructionsDiv" class="instructions"> 
            <h1>How To Play</h1>
            
            </br>
            <p> 
                Your snake is constantly in motion. Don't run into a wall or your tail or you'll die!
                Move your snake in different directions, using your arrow keys, to avoid death.
                Collect food to grow in size and increase your score. The larger your snake gets the harder it is to stay alive.     
            </p>
            <p style="text-align:center;"> Good Luck and Have Fun! </p>
            
            
        </div>
        
        <!-- High Scores Hard -->
        <div id="highScoresDiv" class="highScores"> 
            <h1>High Scores</h1>


            <div class="row">
              <div class="col-xs-4">
                <table class="table table-striped">
                    <caption> Hard </caption>
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Score</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php echo $return_table3 ?>
                    </tbody>
                </table>
              </div>
              
              <div class="col-xs-4">
                <table class="table table-striped">
                  <caption> Medium </caption>
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Score</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php echo $return_table2 ?>
                    </tbody>
                </table>
             </div>

              <div class="col-xs-4">
                <table class="table table-striped">
                  <caption> Easy </caption>
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Score</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php echo $return_table ?>
                    </tbody>
                </table>
              </div>
            </div>

        </div>

        <!-- About Us -->
        <div id="aboutDiv" class="about"> 
            <h1>About</h1>
            <p> 
                Authors <br/>
                Camille Rasmussen, Victor Johnson, Dustin Reitstetter, Daniel Cushing
                <br/> Team: Bro, Do You Even Code? 
            </p>
            </br>
            <p> 
                Additional Info <br/>
                We are enthusiastic University of Utah students working on our final project for
                Web Software Architecture. We chose Snake to demonstrate our familiarity with 
                html5, javascript, php, and css. 
            </p>

            <br/>
            <h3> Total Number Of Games </h3>
            <p> <?php echo $num_games ?> </p>
        </div>
    </body>
</html>
