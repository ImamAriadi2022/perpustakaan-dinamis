<?php
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $judul_buku = isset($_POST['title']) ? $_POST['title'] : '';
        $autor = isset($_POST['author']) ? $_POST['author'] : '';
        $publisher = isset($_POST['publisher']) ? $_POST['publisher'] : '';
        $tahun_terbit = isset($_POST['year']) ? $_POST['year'] : '';

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
            $stmt = $pdo->prepare('SELECT foto FROM books WHERE book_id = ?');
            $stmt->execute([$_GET['id']]);
            $book = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($book['foto'])) {
                unlink("uploads/" . $book['foto']);
            }
            $fotoTmpName = $_FILES['foto']['tmp_name'];
            $fotoName = uniqid() . '-' . $_FILES['foto']['name'];
            move_uploaded_file($fotoTmpName, "uploads/$fotoName");

            $stmt = $pdo->prepare('UPDATE books SET title = ?, author = ?, publisher = ?, year = ?, foto = ? WHERE book_id = ?');
            $stmt->execute([$judul_buku, $autor, $publisher, $tahun_terbit, $fotoName, $_GET['id']]);
        } else {
            $stmt = $pdo->prepare('UPDATE books SET title = ?, author = ?, publisher = ?, year = ? WHERE book_id = ?');
            $stmt->execute([$judul_buku, $autor, $publisher, $tahun_terbit, $_GET['id']]);
        }
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM books WHERE book_id = ?');
    $stmt->execute([$_GET['id']]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$book) {
        exit('Book doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Update')?>

<div class="content update">
    <h2>Update Book #<?=$book['book_id']?></h2>
    <form action="update.php?id=<?=$book['book_id']?>" method="post" enctype="multipart/form-data">
        <label for="title">Judul Buku</label>
        <input type="text" name="title" value="<?=$book['title']?>" id="title">
        <label for="publisher">Publisher Buku</label>
        <input type="text" name="publisher" value="<?=$book['publisher']?>" id="publisher">
        <label for="author">Author Buku</label>
        <input type="text" name="author" value="<?=$book['author']?>" id="author">
        <label for="year">Tahun Terbit</label>
        <input type="text" name="year" value="<?=$book['year']?>" id="year">
        <label for="foto">Foto Buku</label>
        <input type="file" name="foto" id="foto">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <a href="read.php" class="back-button">Back</a>
    <?php endif; ?>
</div>

<?=template_footer()?>
