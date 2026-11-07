<?php
include "components/core.php";    // вставляет содержимое другого файла в это место
if($_POST){
    $users = $link->query("SELECT * FROM `users` WHERE `login` = '{$_POST['login']}' AND `password` = '{$_POST['password']}'");
    if($users->num_rows != 0){
        $user = $users->fetch_assoc();
        $_SESSION['user'] = ['id' => $user['id'], 'role' => $user['role_id']];
        if($user['role_id'] == 2){
            header("Location: admin.php");
        } else {
            header("Location: main.php");
        }
        exit;
    } else {
        $error = "Не верный логин или пароль";
    }
}
include "components/header.php";
?>
<h1>Авторизация</h1>
<form action="" method="post">
    <p><label>Логин</label><input type="text" name="login" required></p>
    <p><label>Пароль</label><input type="password" name="password" required></p>
    <button>Войти</button>
    <?php if(isset($error)){ echo "<p style='color:red'>$error</p>"; } ?>
</form>
<p class="admin-note">логин admin, пасс - 123456 = для админки</p>
<div class="image"><img src="i.jpg" alt=""></div>
<?php include "components/footer.php"; ?>