<?php

require_once('class/User.class.php');

$resultMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = User::Login($email, $password);
    if ($result) {
        header("Location: html.html");
        exit; 
    } else {
        $resultMessage = "Nie udało się zalogować";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz logowania</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        #buttoncolor {
            background-color: rgb(228, 123, 238);
            border-color: rgb(228, 123, 238);
        }
    </style>
</head>

<body>
    <div id="container">
        <h1 class="text-center mt-5 mb-5">Tu możesz się zalogować:</h1>
        <div id="loginForm" class="col-4 offset-4 mt-5">
            <form action="login.php" method="post"> 
                <label for="emailInput" class="form-label">E-mail:</label>
                <input type="email" class="form-control mb-3" name="email" id="emailInput" required>

                <label for="passwordInput" class="form-label">Hasło:</label>
                <input type="password" class="form-control mb-3" name="password" id="passwordInput" required minlength="8">

                <button type="submit" id="buttoncolor" class="btn btn-primary w-100 mt-3">Login</button> 
            </form>
            <?php if ($resultMessage): ?>
                <div class="mt-3">
                    <?php echo htmlspecialchars($resultMessage); ?>
                </div>
            <?php endif; ?>
            <div class="mt-3">
                <a href="html.html" class="btn btn-secondary w-100">Powrót do strony głównej</a>
            </div>
        </div>
    </div>
</body>

</html>
