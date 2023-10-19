<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;
$lastResult = isset($_SESSION['lastResult']) ? $_SESSION['lastResult'] : [];
$username = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result1 = rand(1, 3);
    $result2 = rand(1, 3);
    $result3 = rand(1, 3);
    $lastResult = [$result1, $result2, $result3];

    if ($result1 === $result2 && $result2 === $result3) {
        $score += 20;
    } else {
        $score--;
    }

    $_SESSION['score'] = $score;
    $_SESSION['lastResult'] = $lastResult;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Jogo da Roleta</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Jogo da Roleta</h1>
        <p>Bem-vindo, <?php echo $username; ?>!</p>
        <p>Seu score atual: <?php echo $score; ?></p>
        <div class="roulette">
            <?php foreach ($lastResult as $number) : ?>
                <div class="number"><?php echo $number; ?></div>
            <?php endforeach; ?>
        </div>

        <form method="POST">
            <input type="submit" value="Girar a Roleta">
        </form>

        <a id="area-secreta" href="area_secreta.php">Botão</a>

        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
