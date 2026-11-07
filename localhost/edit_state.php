<?php
include "components/core.php";

if(!isset($_SESSION['user']))
    { header("Location: index.php"); exit; }

if($_POST){
    $state_id = $_POST['state_id'];
    $image_update = '';
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $file_name = time() . '_' . basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $file_name)){
            $image_update = ", `image` = '$file_name'";
        }
    }
    $link->query("UPDATE `states` SET `number` = '{$_POST['number']}', `description` = '{$_POST['description']}', `price` = '{$_POST['price']}' $image_update WHERE `id` = '$state_id' AND `user_id` = '{$_SESSION['user']['id']}'");
    header("Location: state.php");
    exit;
}
$state_id = $_GET['id'] ?? null;
if(!$state_id){ header("Location: state.php"); exit; }
$state = $link->query("SELECT * FROM `states` WHERE `id` = '$state_id' AND `user_id` = '{$_SESSION['user']['id']}'")->fetch_assoc();
if(!$state){ header("Location: state.php"); exit; }
include "components/header.php";
?>
<h1>Редактирование заявки</h1>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="state_id" value="<?= $state['id'] ?>">
    <p><label>Название товара</label><input type="text" name="number" value="<?= $state['number'] ?>" required></p>
    <p><label>Цена</label><input type="number" name="price" value="<?= $state['price'] ?>" required></p>
    <p><label>Описание</label><textarea name="description" required><?= $state['description'] ?></textarea></p>
    <p>
        <label>Новая картинка/label>
        <input type="file" name="image" id="image" accept="image/*">
        <label for="image" class="file-label" id="file-label">Выберите файл</label>
    </p>
    <?php if(!empty($state['image'])){ ?>
        <p>Текущая картинка:</p>
        <img src="images/<?= $state['image'] ?>" alt="<?= $state['number'] ?>" style="max-width: 200px; border: 1px solid #fff;">
    <?php } ?>
    <button>Сохранить изменения</button>
</form>
<script>
document.getElementById('image').addEventListener('change', function(e) {
    if(e.target.files.length > 0) {
        document.getElementById('file-label').textContent = e.target.files[0].name;
    }
});
</script>
<?php include "components/footer.php"; ?>