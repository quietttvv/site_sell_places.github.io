<?php
include "components/core.php";
if($_POST){
    $users = $link->query ("SELECT * FROM `users` WHERE `login` = '{$_POST['login']}'"); // ->    =   обращение к функции или свойству внутри объекта например для взщятия объекта с бд link и выполни функцию query
    if($users->num_rows == 0){
        $link->query("INSERT INTO `users`(`fullname`, `email`, `login`, `password`, `phone`, `role_id`)
        VALUES (
        '{$_POST['fullname']}',
        '{$_POST['email']}',
        '{$_POST['login']}',
        '{$_POST['password']}',
        '{$_POST['phone']}',
        1
        )");
        header("Location: index.php"); // выводим сюда
        exit; // больше код не выполняется
    } else {
        $error = "Такой пользователь существует!";
    }
}
include "components/header.php";
?>
<h1>Регистрация</h1>
<form action="" method="post">
    <p>
        <label for="login">Логин</label>
        <input type="text" name="login" id="login" required>
    </p>
    <p>
        <label for="password">Пароль</label>
        <input type="password" name="password" minlength="6" id="password" required>
    </p>
    <p>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
    </p>
    <p>
        <label for="phone">Телефон</label>
        <input type="text" name="phone" id="phone" required>
    </p>
    <p>
        <label for="fullname">ФИО</label>
    </p>
    <?php if(isset($error)){
        echo "<p style='color: red'>$error</p>";
    } ?>
    <button>Зарегистрироваться</button>
   
</form>
</main>
<script src="./scripts/main.js"></script>
</body>
</html>