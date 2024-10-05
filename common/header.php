<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
<link rel="stylesheet" href="./view/css/styles.css"/>
<style>

</style>
</head>
<body>
    <header class="header" >
        <div class="headername" > <?php echo "<h2>Welcome back <span class='adminname'> {$adminName} </span></h2>"; ?></div>
        <div class="logout"><a onClick = 'return logout()' href='index.php?mod=admin&view=logout'><span class="label other">Logout</span></a></div>
    </header>
</body>
</html>