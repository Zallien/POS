<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daza's Best</title>
    <link rel="stylesheet" href="">
</head>
<body>
<video id="overlayVideo" autoplay muted>
    <source src="./media/cool.mp4" type="video/mp4">
</video>
</body>
<style>
    body{
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        margin: 0;
        background-color: black;
    }
    video{
        height: 100dvh;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        setTimeout(hideOverlay, 4000);
        
    });

    function hideOverlay() {
        window.location.href = "./php/login.php"
    }
</script>
</html>