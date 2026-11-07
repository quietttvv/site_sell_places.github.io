<?php
include "components/core.php";
if(!isset($_SESSION['user'])){ header("Location: index.php"); exit; }

// Пагинация
$per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;
$offset = ($page - 1) * $per_page;

// cчитаем общее колdj одобренных заявок
$total = $link->query("SELECT COUNT(*) as cnt FROM `states` WHERE `status_id` = 3")->fetch_assoc()['cnt'];
$total_pages = ceil($total / $per_page);
if($page > $total_pages && $total_pages > 0) $page = $total_pages;

$states = $link->query("SELECT `states`.*, `users`.`fullname` 
FROM `states` 
LEFT JOIN `users` ON `states`.`user_id` = `users`.`id` 
WHERE `states`.`status_id` = 3 
ORDER BY `states`.`id` DESC 
LIMIT $per_page OFFSET $offset");

include "components/header.php";
?>
<h1>Лента заявок</h1>
<?php if($states->num_rows == 0){ ?>
    <p style="text-align: center; color: #a0aec0; font-size: 18px;">Пока нет заявок. Будь первым!</p>
<?php } else { ?>
    <?php foreach($states as $s){ ?>
    <div class="state-card">
        <div class="card-top">
            <strong><?= $s['number'] ?></strong>
            <p><?= $s['description'] ?></p>
        </div>
        <div class="card-bottom">
            <div class="card-left">
                <?php if(!empty($s['image'])){ ?>
                    <img src="images/<?= $s['image'] ?>" alt="<?= $s['number'] ?>">
                <?php } ?>
                <p class="seller-name"><?= $s['fullname'] ?></p>
            </div>
            <div class="card-right">
                <p class="price"><?= $s['price'] ?> руб.</p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="state_id" value="<?= $s['id'] ?>">
                    <button>В корзину</button>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
    
    <?php if($total_pages > 1){ ?>
    <div class="pagination">
        <?php for($i = 1; $i <= $total_pages; $i++){ ?>
            <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php } ?>
    </div>
    <?php } ?>
<?php } ?>
<?php include "components/footer.php"; ?>