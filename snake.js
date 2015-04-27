var snake = {
    currentDirection: 'up',
    pendingGrowth: false,
    pendingDirections: [],
    eatenFoods: 0,
    cells: [
        {
            x: 5,
            y: 16
        },
        {
            x: 5,
            y: 17
        },
        {
            x: 5,
            y: 18
        },
        {
            x: 5,
            y: 19
        },
        {
            x: 5,
            y: 20
        }
    ]
};

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

/*
 * Moves the snake by one cell. If the snake has eaten a food, pendingGrowth will be true.
 * If there is no pendingGrowth, then the tail cell will pop off.
 */
function snakeMove(fillSnake)
{
    var newHeadCell;

    updateDirection();

    switch(snake.currentDirection) {
        case 'up':
            newHeadCell = {x: snake.cells[0].x, y: snake.cells[0].y - 1};
            break;
        case 'down':
            newHeadCell = {x: snake.cells[0].x, y: snake.cells[0].y + 1};
            break;
        case 'right':
            newHeadCell = {x: snake.cells[0].x + 1, y: snake.cells[0].y};
            break;
        case 'left':
            newHeadCell = {x: snake.cells[0].x - 1, y: snake.cells[0].y};
            break;
    }
    
    function posInSnake(el) {
        return el.x === newHeadCell.x && el.y === newHeadCell.y;
    }
    
    // check if this move is valid
    if(newHeadCell.x < 0 || newHeadCell.x > 24 ||
      newHeadCell.y < 0 || newHeadCell.y > 24 ||
      snake.cells.some(posInSnake))
        return false;

    snake.cells.splice(0, 0, newHeadCell);

    if (newHeadCell.x === game.currentFoodPosition.x && newHeadCell.y === game.currentFoodPosition.y) {
        snake.pendingGrowth = true;
        changeFoodPosition();
        snake.eatenFoods++;
    }

    if(!snake.pendingGrowth)
        // Pop tail cell off
        snake.cells.pop();
    else
        // Don't pop off tail cell, but reset pendingGrowth
        snake.pendingGrowth = false;

    fillSnake();
    
    return true;
}