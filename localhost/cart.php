<?php
include "components/core.php";
if(!isset($_SESSION['user'])){ header("Location: index.php"); exit; }
if(!isset($_SESSION['cart'])){ $_SESSION['cart'] = []; }
include "components/header.php";
?>
<h1>Корзина</h1>
<?php if(empty($_SESSION['cart'])){ ?>
    <p style="text-align: center; color: #a0aec0; font-size: 18px;">Корзина пуста</p>
<?php } else {
    $total = 0;
    foreach($_SESSION['cart'] as $state_id){
        $state = $link->query("SELECT * FROM `states` WHERE `id` = '$state_id'")->fetch_assoc();
        if($state){
            $total += $state['price'];
?>
<div class="cart-item">
    <?php if(!empty($state['image'])){ ?>
        <img src="images/<?= $state['image'] ?>" alt="<?= $state['number'] ?>">
    <?php } ?>
    <div class="cart-info">
        <p><strong><?= $state['number'] ?></strong> - <?= $state['price'] ?> руб.</p>
        <p><?= $state['description'] ?></p>
    </div>
    <form action="remove_from_cart.php" method="post">
        <input type="hidden" name="state_id" value="<?= $state_id ?>">
        <button class="btn-delete">Удалить из корзины</button>
    </form>
</div>
<?php
        }
    } ?>
    <h2 style="text-align: center; margin: 30px 0;">Итого: <?= $total ?> руб.</h2>
    <form action="checkout.php" method="post" style="text-align: center;">
        <button>Оформить заказ</button>
    </form>
<?php } ?>
<?php include "components/footer.php"; ?>