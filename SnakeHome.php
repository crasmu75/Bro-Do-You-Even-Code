<!--
    Author: Daniel Cushing
    Version: 1.0 
    Date: 4/17/2015
    Info: Snake Home Page
-->

<?php

require_once 'db.php';

try
{
    $DBH = openDBConnection();

    $return_table = "";
    
    $query = "SELECT * FROM snake.scores order by scores.score desc limit 10;";
    $statement = $DBH->prepare( $query );
    $statement->execute(  );
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($result as $row)
    {
        $return_table .= "<tr>"
            . "<td>" . $row['name'] . "</td>"
            . "<td>" . $row['score'] . "</td>"
            . "</tr>";
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
            
<!--    Link Jquery-->
<!--    
        Link Home Screen View Controller (javascript)
        Link High Scores View Controller (javascript)
-->
        
    <!-- Do the following in the view controller -->
    <script type="text/javascript"> 
        
    function aboutClicked()
    {
        location.href = "#aboutDiv";
    }
        
    function highScoresClicked()
    {
        location.href = "#highScoresDiv";
    }
        
    function instructionsClicked()
    {
        location.href = "#instructionsDiv";
    }
        
    function newGameClicked()
    {
        location.href = "SnakeGame.html";
    }

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
                     <button id="aboutButton" type="button" onclick="aboutClicked()" 
                     onmouseover="imgHighlight(this);" onmouseout="imgReturnToDefault();"></button> 
                     <button id="highScoresButton" type="button" onclick="highScoresClicked()" 
                     onmouseover="imgHighlight(this);" onmouseout="imgReturnToDefault();"></button> 
                     <button id="instructionsButton" type="button" onclick="instructionsClicked()" 
                     onmouseover="imgHighlight(this);" onmouseout="imgReturnToDefault();"></button> 
                     <button id="newGameButton" type="button" onclick="newGameClicked()" 
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
        
        <!-- High Scores -->
        <div id="highScoresDiv" class="highScores"> 
            <h1>High Scores</h1>

            <table class="table table-striped">
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
        
        <!-- About Us -->
        <div id="aboutDiv" class="about"> 
            <h1>About</h1>
            <p> 
                Authors <br/>
                Camille Rasmussen, Victor Johnson, Dustin Reitstetter, Daniel Cushing
            </p>
            </br>
            <p> 
                Additional Info <br/>
                We are enthusiastic University of Utah students working on our final project for
                Web Software Architecture. We chose Snake to demonstrate our familiarity with 
                html5, javascript, php, and css. 
            </p>
        </div>
    </body>
</html>
