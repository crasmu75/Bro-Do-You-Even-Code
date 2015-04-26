var game = {
    currentFoodPosition: { x: 5, y: 5 },

    // How many moves per second we want the snake to do
    movesPerSec: 2,
    snakeTimer: undefined,
    currentScore: 0
}

/*
 * Resets all game and snake properties
 */
function gameOver()
{
    dbscore("Jim", snake.eatenFoods);
    
    // stop the snake moving
    clearInterval(game.snakeTimer);
    
    // reset game properties
    game.currentFoodPosition = {x:5, y:5};
    game.movesPerSec = 2;
    game.snakeTimer = undefined;
    game.currentScore = 0;
    
    // reset snake properties
    snake.currentDirection = 'up';
    snake.pendingGrowth = false;
    snake.cells = [
    {
        x: 0,
        y: 0
    },
    {
        x: 0,
        y: 1
    },
    {
        x: 0,
        y: 2
    },
    {
        x: 0,
        y: 3
    },
    {
        x: 0,
        y: 4
    }
    ];
}

/*
 * Begins the movement of the snake
 */
function startGame(fillSnake)
{
    // Start moving the snake every movesPerSec seconds
    game.snakeTimer = setInterval(function() {
        if (!snakeMove(fillSnake))
            gameOver();
    }, 80);
}

/*
 * Generates a random position for the food to appear within the 25 X 25 grid.
 * However, if the generated position is within the snake cells, a new position is generated.
 */
function changeFoodPosition()
{
    // get random integer between 0 and 25
    var randomPos;
    
    function generateRandomPos() {
        randomPos = {x: Math.floor(Math.random() * (25)), y: Math.floor(Math.random() * (25))};
    }
    
    generateRandomPos();
    
    // make sure the position is not in the snake
    // while the position is part of the snake, get another random position
    
    function posInSnake(el) {
        return el.x === randomPos.x && el.y === randomPos.y;
    }

    while (snake.cells.some(posInSnake)) {
        generateRandomPos();
    }
    
    game.currentFoodPosition = randomPos;
}

function dbscore(name, score)
{
    var d1;
    var d2;
    d1 = "&name=" + name;
    d2 = "&score=" + score;
    
    $.ajax(
        {
            type:'POST',
            url: "score.php",
            data: d1+d2,
            dataType: 'html',
            
            success: function(response)
            {
                if(response == "1")
                {
                    alert("New high score, your name and score will be displayed in the highscore table on the home page.");
                }
            }
        });
    return false;
}