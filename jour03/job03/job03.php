<!DOCTYPE html>
<html>
<head>
    <title>Job 03</title>
    <style>
        .puzzle-container {
            width: 400px;
            height: 400px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            grid-gap: 5px;
        }

        .puzzle-piece {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            cursor: pointer;
        }

        .hidden-piece {
            background-image: url('logo9.jpg');
            pointer-events: none;
        }

        #restartButton {
            display: none;
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="puzzle-container">
        <?php for ($i = 1; $i <= 8; $i++) { ?>
            <div class="puzzle-piece" style="background-image: url('logo<?php echo $i; ?>.jpg');" data-index="<?php echo $i; ?>"></div>
        <?php } ?>
        <div class="puzzle-piece hidden-piece" data-index="9"></div>
    </div>
    <button id="restartButton">Recommencer</button>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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

                clickedPiece.insertBefore(emptyPiece);
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
                <?php for ($i = 1; $i <= 8; $i++) { ?>
                    var imageSrc<?php echo $i; ?> = "logo<?php echo $i; ?>.jpg";
                    var puzzlePiece<?php echo $i; ?> = $("<div class='puzzle-piece' style='background-image: url(" + imageSrc<?php echo $i; ?> + ");' data-index='<?php echo $i; ?>'></div>");
                    $(".puzzle-container").append(puzzlePiece<?php echo $i; ?>);
                <?php } ?>

                var hiddenPiece = $("<div class='puzzle-piece hidden-piece' data-index='9'></div>");
                $(".puzzle-container").append(hiddenPiece);

                $("#restartButton").hide();
            }
        });
    </script>
</body>
</html>
