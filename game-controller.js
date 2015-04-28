function drawBoard() {
    resetSquares();
    snake.cells.forEach(function(el) {
        $('#' + el.x + '-' + el.y).css('background-color', 'green');
    });

    $('#' + game.currentFoodPosition.x + '-' + game.currentFoodPosition.y).css('background-color', 'red');
    $('#score').html('Score: ' + (snake.eatenFoods || 0));
}

function resetSquares() {
    $('.cell').css('background-color', 'white');
}

$(document).keydown(function(e) {
    switch (e.which) {
        case 37: //left
            snake.pendingDirections.push('left');
            break;
        case 38: //up
                snake.pendingDirections.push('up');
            break;
        case 39: //right
                snake.pendingDirections.push('right');
            break;
        case 40: //down
                snake.pendingDirections.push('down');
            break;
        case 13: //enter
            startGame(drawBoard, $('#player-name').val());
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

    $('#new-game-btn').click(function() {
        startGame(drawBoard, $('#player-name').val());
    });
});