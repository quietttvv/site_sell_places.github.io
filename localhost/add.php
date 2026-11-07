<?php
include "components/core.php";
if(!isset($_SESSION['user'])){ header("Location: index.php"); exit; }
if($_POST){
    $image_path = '';
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $file_name = time() . '_' . basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $file_name)){
            $image_path = $file_name;
        }
    }
    $link->query("INSERT INTO `states` (`user_id`, `status_id`, `number`, `description`, `price`, `image`) VALUES ('{$_SESSION['user']['id']}', 1, '{$_POST['number']}', '{$_POST['description']}', '{$_POST['price']}', '$image_path')");
    header("Location: state.php");
    exit;
}
include "components/header.php";
?>
<h1>Подать заявку</h1>
<form action="" method="post" enctype="multipart/form-data">
    <p><label>Название товара</label><input type="text" name="number" required></p>
    <p><label>Цена</label><input type="number" name="price" required></p>
    <p><label>Описание</label><textarea name="description" required></textarea></p>
    <p>
        <label>Картинка товара</label>
        <input type="file" name="image" id="image" accept="image/*">
        <label for="image" class="file-label" id="file-label">Выберите привью</label>
    </p>
    <button>Выставить заявку о продаже</button>
</form>
<script>
document.getElementById('image').addEventListener('change', function(e) {
    if(e.target.files.length > 0) {
        document.getElementById('file-label').textContent = e.target.files[0].name;
    }
});
</script>
<?php include "components/footer.php"; ?>