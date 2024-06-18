<?php
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    $judul_buku = isset($_POST['title']) ? $_POST['title'] : '';
    $autor = isset($_POST['author']) ? $_POST['author'] : '';
    $publisher = isset($_POST['publisher']) ? $_POST['publisher'] : '';
    $tahun_terbit = isset($_POST['year']) ? $_POST['year'] : '';
    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $fotoTmpName = $_FILES['foto']['tmp_name'];
        $fotoName = uniqid() . '-' . $_FILES['foto']['name'];
        move_uploaded_file($fotoTmpName, "uploads/$fotoName");

        $stmt = $pdo->prepare('INSERT INTO books (title, author, publisher, year, foto) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$judul_buku, $autor, $publisher, $tahun_terbit, $fotoName]);
        $msg = 'Created Successfully!';
    } else {
        $msg = 'Failed to upload photo!';
    }
}
?>

<?=template_header('Create')?>

<div class="content update">
    <h2>Create Book</h2>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <label for="title">Judul Buku</label>
        <input type="text" name="title" id="title">
        <label for="publisher">Publisher Buku</label>
        <input type="text" name="publisher" id="publisher">
        <label for="author">Author Buku</label>
        <input type="text" name="author" id="author">
        <label for="year">Tahun Terbit</label>
        <input type="text" name="year" id="year">
        <label for="foto">Foto Buku</label>
        <input type="file" name="foto" id="foto">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <a href="read.php" class="back-button">Back</a>
    <?php endif; ?>
</div>

<?=template_footer()?>
