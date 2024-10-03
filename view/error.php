<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./view/css/styles.css" />
</head>

<body>
    <div class="parent">
        <h1> Something Wrong Happened ! </h1>
        <form action="index.php?mod=admin&view=login" method="POST">
            <button type="submit">Go Back!</button>
        </form>
        <?php header("Refresh:3;url=index.php?mod=admin&view=login"); ?>
    </div>

</body>

</html>