$(document).ready(function() {
    var emptyPieceIndex = 9;
    var gameInProgress = true;

    $(".puzzle-piece").click(function() {
        if (!gameInProgress) return;

        var clickedIndex = parseInt($(this).attr("data-index"));
        var emptyIndex = emptyPieceIndex;

        if (isAdjacentToEmpty(clickedIndex, emptyIndex)) {
            swapPieces(clickedIndex, emptyIndex);
            emptyPieceIndex = clickedIndex;
        }

        checkGameStatus();
    });

    $("#restartButton").click(function() {
        resetGame();
    });

    function isAdjacentToEmpty(clickedIndex, emptyIndex) {
        var adjacentIndices = [
            emptyIndex - 1, // left
            emptyIndex + 1, // right
            emptyIndex - 3, // top
            emptyIndex + 3  // bottom
        ];

        return adjacentIndices.includes(clickedIndex);
    }

    function swapPieces(clickedIndex, emptyIndex) {
        var clickedPiece = $(".puzzle-piece[data-index='" + clickedIndex + "']");
        var emptyPiece = $(".puzzle-piece[data-index='" + emptyIndex + "']");

        var clickedPieceSrc = clickedPiece.attr("src");
        var emptyPieceSrc = emptyPiece.attr("src");

        clickedPiece.attr("src", emptyPieceSrc);
        emptyPiece.attr("src", clickedPieceSrc);
    }

    function checkGameStatus() {
        var puzzlePieces = $(".puzzle-piece");

        var isGameOver = true;
        var currentOrder = [];

        puzzlePieces.each(function() {
            var pieceIndex = parseInt($(this).attr("data-index"));
            currentOrder.push(pieceIndex);

            if (pieceIndex !== currentOrder.length) {
                isGameOver = false;
                return false; // Break out of the loop
            }
        });

        if (isGameOver) {
            endGame();
        }
    }

    function endGame() {
        gameInProgress = false;
        $("#restartButton").show();
    }

    function resetGame() {
        $(".puzzle-container").html('');
        emptyPieceIndex = 9;
        gameInProgress = true;

        // Recreate puzzle pieces
        for (var i = 1; i <= 8; i++) {
            var logoSrc = "logo" + i + ".jpg";
            var puzzlePiece = $("<img class='puzzle-piece' data-index='" + i + "'>");
            puzzlePiece.attr("src", logoSrc);
            $(".puzzle-container").append(puzzlePiece);
        }

        var hiddenPiece = $("<img class='puzzle-piece hidden-piece' data-index='9'>");
        hiddenPiece.attr("src", "logo9.jpg");
        $(".puzzle-container").append(hiddenPiece);

        $("#restartButton").hide();
    }
});


