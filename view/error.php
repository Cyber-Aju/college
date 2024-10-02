<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./view/css/styles.css"/>
</head>
<body>
    <div class="parent">
        <h1 > Not Logged in ! </h1>
        <form action="http://localhost/college/index.php" method="POST">
            <button type="submit">Go Back!</button>
        </form>
        <?php header("Refresh:5;url=http://localhost/college/index.php");?>
    </div>
    
</body>
</html>