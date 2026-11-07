<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин плейсов Роблокс</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <h1>Магазин плейсов и режимов Роблокс</h1>
    <nav>
        <?php if(isset($_SESSION['user'])){ ?>
            <a href="main.php">Главная</a>
            <a href="add.php">Подать заявку</a>
            <a href="state.php">Мои заявки</a>
            <a href="cart.php">Корзина</a>
            <?php if($_SESSION['user']['role'] == 2){ ?>
                <a href="admin.php">Админ-панель</a>
            <?php } ?>
            <a href="logout.php">Выход</a>
        <?php } else { ?>
            <a href="index.php">Вход</a>
            <a href="reg.php">Регистрация</a>
        <?php } ?>
    </nav>
</header>
<main>