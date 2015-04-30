function drawBoard() {
    resetSquares();
    snake.cells.forEach(function(el) {
        $('#' + el.x + '-' + el.y).css('background-color', 'green');
    });
    console.log(game.wallCells);
    game.wallCells.forEach(function(el) {
        $('#' + el.x + '-' + el.y).css('background-color', 'black');
    });

    $('#' + game.currentFoodPosition.x + '-' + game.currentFoodPosition.y).css('background-color', 'red');
    //$('#' + game.currentFoodPosition.x + '-' + game.currentFoodPosition.y).html("<img src='Images/orange.png' style='width:12px;height:12px'>");
    $('#score').html('Score: ' + (game.score || 0));
}

function resetSquares() {
    $('.cell').css('background-color', 'white');
}

$(document).keydown(function(e) {
    switch (e.which) {
        case 37: //left
            e.preventDefault();
            snake.pendingDirections.push('left');
            break;
        case 38: //up
            e.preventDefault();
                snake.pendingDirections.push('up');
            break;
        case 39: //right
            e.preventDefault();
                snake.pendingDirections.push('right');
            break;
        case 40: //down
            e.preventDefault();
                snake.pendingDirections.push('down');
            break;
        case 13: //enter
            e.preventDefault();
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

    startGame(drawBoard, $('#player-name').val(), $('#difficultySelected').val());

    $('#new-game-btn').click(function() {
        startGame(drawBoard, $('#player-name').val(), $('#difficultySelected').val());
    });
});