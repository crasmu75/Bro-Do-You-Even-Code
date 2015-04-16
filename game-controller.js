$(document).keydown(function(e) {
    switch (e.which) {
        case 37: //left
            if (snake.currentDirection !== 'right')
                snake.currentDirection = 'left';
            break;
        case 38: //up
            if (snake.currentDirection !== 'down')
                snake.currentDirection = 'up';
            break;
        case 39: //right
            if (snake.currentDirection !== 'left')
                snake.currentDirection = 'right';
            break;
        case 40: //down
            if (snake.currentDirection !== 'up')
                snake.currentDirection = 'down';
            break;
    }
});

$(document).ready(function() {
    for (var row = 0; row < 25; row++) {

        var rowhtml = '<tr>';

        for (var col = 0; col < 25; col++) {
            rowhtml += '<td class="cell" id="' + col + '-' + row + '"></td>';
        }

        rowhtml += '</tr>';

        $('#gameboard').append(rowhtml);
    }

    function resetSquares() {
        $('.cell').css('background-color', 'white');
    }

    changeFoodPosition();

    startGame(function() {
        resetSquares();
        snake.cells.forEach(function(el) {
            // console.log('setting:', el.x + '-' + el.y);
            $('#' + el.x + '-' + el.y).css('background-color', 'green');
        });

        $('#' + game.currentFoodPosition.x + '-' + game.currentFoodPosition.y).css('background-color', 'red');
    });
});

