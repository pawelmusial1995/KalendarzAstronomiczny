<html>
<style>
        body {
    background-image: url("../png/earth.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
            
            font-weight: 700;
            color: #fff;
    }    
    
</style>
<body>
<form method="post" style=" width: 200px; height: 130px; margin: 0 auto;" action="home1.php">
        &nbsp Szerokość geograficzna<br>
        <input style="margin-left:10px;" type="number" step="0.0001" name="lat" ><br>
        &nbsp Długość geograficzna<br>
        <input style="margin-left:10px;" type="number" step="0.0001" name="long" ><br>

        <input style="margin-left:10px; margin-top: 5px; background:#691414;color: #fff; font-weight:700; border-radius: 3px;" type="submit">
</form>
</body>
</html>  