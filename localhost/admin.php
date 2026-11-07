<?php
include "components/core.php";
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 2){ // проверка доступа - проверка залогинин юзер или нет и является ли он админом
    header("Location: index.php");
    exit;
}
//обработка действий 
if(isset($_POST['action'])){     //обработка действий админа - срабатывание от от выбора админа по заявке 
    $state_id = (int)$_POST['state_id'];
    
    if($_POST['action'] == 'approve'){
        $link->query("UPDATE `states` SET `status_id` = 3 WHERE `id` = $state_id");
        header("Location: admin.php");
        exit;
    }
    if($_POST['action'] == 'reject'){
        $link->query("UPDATE `states` SET `status_id` = 2 WHERE `id` = $state_id");
        header("Location: admin.php");
        exit;
    }
    if($_POST['action'] == 'delete'){
        $state = $link->query("SELECT `image` FROM `states` WHERE `id` = $state_id")->fetch_assoc();
        if($state && !empty($state['image']) && file_exists('images/' . $state['image'])){
            unlink('images/' . $state['image']);
        }
        $link->query("DELETE FROM `states` WHERE `id` = $state_id");
        header("Location: admin.php");
        exit;
    }
}

$states = $link->query("SELECT `states`.*, `users`.`fullname`, `statuses`.`status` 
FROM `states` 
LEFT JOIN `users` ON `states`.`user_id` = `users`.`id` 
LEFT JOIN `statuses` ON `states`.`status_id` = `statuses`.`id` 
ORDER BY `states`.`id` DESC");

include "components/header.php";
?>
<h1>Админ-панель</h1>
</p>
<section>
<?php if($states->num_rows == 0){ ?>
    <p style="text-align: center; color: #a0aec0;">Заявок пока нет</p>
<?php } ?>
<?php foreach($states as $s){ ?>
<div class="my-state-card">
    <div class="my-state-info">
        <?php if(!empty($s['image'])){ ?>
            <img src="images/<?= $s['image'] ?>">
        <?php } ?>
        <div class="my-state-text">
            <p><strong>Статус:</strong> <?= $s['status'] ?></p>
            <p><strong>Продавец:</strong> <?= $s['fullname'] ?></p>
            <p><strong>Товар:</strong> <?= $s['number'] ?></p>
            <p><strong>Цена:</strong> <?= $s['price'] ?> руб.</p>
            <p><strong>Описание:</strong> <?= $s['description'] ?></p>
        </div>
    </div>
    <div class="my-state-buttons">
        <?php if($s['status_id'] != 3){ ?>
        <form action="" method="post" style="margin:0;">
            <input type="hidden" name="state_id" value="<?= $s['id'] ?>">
            <input type="hidden" name="action" value="approve">
            <button class="btn-approve">Одобрить</button>
        </form>
        <?php } ?>
        <?php if($s['status_id'] != 2){ ?> // не равно 
        <form action="" method="post" style="margin:0;">
            <input type="hidden" name="state_id" value="<?= $s['id'] ?>">
            <input type="hidden" name="action" value="reject">
            <button class="btn-reject">Отклонить</button>
        </form>
        <?php } ?>
        <form action="" method="post" style="margin:0;">
            <input type="hidden" name="state_id" value="<?= $s['id'] ?>">
            <input type="hidden" name="action" value="delete">
            <button class="btn-delete">Удалить</button>
        </form>
    </div>
</div>
<?php } ?>
</section>
<?php include "components/footer.php"; ?>