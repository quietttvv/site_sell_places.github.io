<?php
include "components/core.php";
if(!isset($_SESSION['user']))
    {
    header("Location: index.php");
    exit; // дальше скрипт не выполняется
}

$states = $link->query("SELECT * FROM `states` 
WHERE `user_id` = '{$_SESSION['user']['id']}' 
ORDER BY `id` DESC");

include "components/header.php";
?>
<h1>Мои заявки</h1>
<?php foreach($states as $s){ ?>
    <div>
        <p><strong><?= $s['number'] ?></strong> - <?= $s['price'] ?> руб.</p>
        <p><?= $s['description'] ?></p>
        <form action="delete_state.php" method="post">
            <input type="hidden" name="state_id" value="<?= $s['id'] ?>">
            <button>Удалить</button>
        </form>
    </div>
<?php } ?>
</main>
</body>
</html>