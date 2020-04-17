<?php
require_once ('../vendor/autoload.php');


$name = $_POST['name'] ?: null;

$sandbox = new \Wizmo\Sandbox();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sandbox</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1><img src="img/wizmo_logo.jpeg" width="150"> Sandbox</h1>

            <p><?php echo $sandbox->run($name); ?></p>

            <form id="hello-world" method="post">
                <label>
                    <input type="text" name="name" placeholder="Name" autocomplete="off"/>
                </label>
                <button type="submit">Senden</button>
            </form>
        </div>
    </div>

    <script type="module" src="js/main.js"></script>
</body>
</html>
