var game;
var snake;

// -------------------------------  GAME SPECIFIC -------------------------------

function startGame(drawBoard, playerName) {
    $('#start-button').blur();
    resetGame();
    game.playerName = playerName;
    game.timer = setInterval(function() {
        moveSnake(drawBoard);
    }, game.speed);
}

function endGame() {
    clearTimeout(game.timer);
    dbscore(game.playerName || 'Anonymous', game.score);
}

function generateFood() {
    var foodPosition;

    function generatePosition() {
        foodPosition = {
            x: Math.floor(game.size * Math.random()),
            y: Math.floor(game.size * Math.random())
        };
    }

    generatePosition();

    while (cellInSnake(foodPosition)) {
        generatePosition();
    }

    game.currentFoodPosition = foodPosition;
}

function resetGame() {
    $('#reset-button').blur();
    snake = {
        currentDirection: 'right',
        pendingDirections: [],
        pendingGrowth: false,
        cells: [
            { x: 7, y: 5 },
            { x: 6, y: 5 },
            { x: 5, y: 5 },
            { x: 4, y: 5 },
            { x: 3, y: 5 }
        ]
    };

    game = {
        size: 25,
        speed: 75,
        score: 0,
        timer: null,
        currentFoodPosition: null
    };

    generateFood();
}

function dbscore(name, score)
{
    var d1;
    var d2;
    d1 = "&name=" + name;
    d2 = "&score=" + score;

    console.log('name: ' + name + ' - score: ' + score);
    
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

// -------------------------------  SNAKE SPECIFIC -------------------------------

function cellInSnake(el) {
    return snake.cells.some(function(snakeEl) {
        return el.x === snakeEl.x && el.y === snakeEl.y;
    });
}

function updateDirection() {
    if (snake.pendingDirections.length > 0) {
        var newDirection = snake.pendingDirections.splice(0, 1)[0];
        if (!((newDirection === 'up' && snake.currentDirection === 'down') ||
                    (newDirection === 'down' && snake.currentDirection === 'up') ||
                    (newDirection === 'right' && snake.currentDirection === 'left') ||
                    (newDirection === 'left' && snake.currentDirection === 'right'))) {

            snake.currentDirection = newDirection;

        }
    }
}

function moveSnake(drawBoard) {
    var newHead;

    updateDirection();

    switch (snake.currentDirection) {
        case 'up':
            newHead = { x: snake.cells[0].x, y: snake.cells[0].y - 1 };
            break;
        case 'right':
            newHead = { x: snake.cells[0].x + 1, y: snake.cells[0].y };
            break;
        case 'down':
            newHead = { x: snake.cells[0].x, y: snake.cells[0].y + 1 };
            break;
        case 'left':
            newHead = { x: snake.cells[0].x - 1, y: snake.cells[0].y };
            break;
    }

    if (newHead.x < 0 || newHead.x >= game.size ||
        newHead.y < 0 || newHead.y >= game.size ||
        cellInSnake(newHead)) {
        endGame();
        return;
    }

    if (!snake.pendingGrowth)
        snake.cells.pop();
    else
        snake.pendingGrowth = false;

    snake.cells.splice(0, 0, newHead);

    if (newHead.x === game.currentFoodPosition.x &&
        newHead.y === game.currentFoodPosition.y) {
        snake.pendingGrowth = true;
        generateFood();
        game.score++;
    }

    drawBoard();
}