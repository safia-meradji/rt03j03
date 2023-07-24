<!DOCTYPE html>
<html>
<head>
    <title>Job 01</title>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
</head>
<body>
    <article id="citation" style="display: none;">La vie a beaucoup plus d’imagination que nous.</article>
    <button id="button">Show/Hide</button>

    <script>
        $(document).ready(function() {
            $("#button").click(function() {
                $("#citation").toggle();
            });
        });
    </script>
</body>
</html>
