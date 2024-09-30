<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .body 
        {
            padding:0px;
            margin:0px;
        }
        .parent
	    {
	    	width:1535px;
	    	height:690px;
	    	background-color:#073763;
	    	position:absolute;
	    }
    </style>
</head>
<body>
    <div class="parent">
        <h1 align = "center"> not found </h1>
        <form action="http://localhost/college/index.php" method="POST">
            <button type="submit">Go Back!</button>
        </form>
        <?php header("Refresh:3;url=http://localhost/college/index.php");?>
    </div>
    
</body>
</html>