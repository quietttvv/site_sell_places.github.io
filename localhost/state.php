<?php
include "components/core.php";
if(!isset($_SESSION['user'])){ header("Location: index.php"); exit; }
$states = $link->query("SELECT `states`.*, `statuses`.`status` FROM `states` LEFT JOIN `statuses` ON `states`.`status_id` = `statuses`.`id` WHERE `states`.`user_id` = '{$_SESSION['user']['id']}'");
include "components/header.php";
?>
<h1>Мои заявления</h1>
<section>
<?php if($states->num_rows == 0){ ?>
    <p style="text-align: center; color: #a0aec0; font-size: 18px;">У вас пока нет заявок.</p>
<?php } else { ?>
<?php foreach($states as $v){ ?>
<div class="my-state-card">
    <div class="my-state-info">
        <?php if(!empty($v['image'])){ ?>
            <img src="images/<?= $v['image'] ?>" alt="<?= $v['number'] ?>">
        <?php } ?>
        <div class="my-state-text">
            <p><strong>Статус:</strong> <?= $v['status'] ?></p>
            <p><strong>Товар:</strong> <?= $v['number'] ?></p>
            <p><strong>Цена:</strong> <?= $v['price'] ?> руб.</p>
            <p><strong>Описание:</strong> <?= $v['description'] ?></p>
        </div>
    </div>
    <div class="my-state-buttons">
        <form action="edit_state.php" method="get" style="margin: 0;">
            <input type="hidden" name="id" value="<?= $v['id'] ?>">
            <button class="btn-edit">Редактировать</button>
        </form>
        <form action="delete_state.php" method="post" style="margin: 0;">
            <input type="hidden" name="state_id" value="<?= $v['id'] ?>">
            <button class="btn-delete">Удалить</button>
        </form>
    </div>
</div>
<?php } ?>
<?php } ?>
</section>
<?php include "components/footer.php"; ?>