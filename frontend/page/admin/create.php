<?php
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['book_id']) && !empty($_POST['book_id']) && $_POST['book_id'] != 'auto' ? $_POST['book_id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $judul_buku = isset($_POST['title']) ? $_POST['title'] : '';
    $autor = isset($_POST['author']) ? $_POST['author'] : '';
    $publisher = isset($_POST['publisher']) ? $_POST['publisher'] : '';
    $tahun_terbit = isset($_POST['year']) ? $_POST['year'] : '';
    $foto = isset($_POST['foto']) ? $_POST['foto'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO books VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $judul_buku, $autor, $publisher, $tahun_terbit, $foto]);
    // Output message
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Create')?>

<div class="content update">
    <h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="book_id">id buku</label>
        <label for="title">Judul Buku</label>
        <input type="text" name="book_id" value="auto" id="book_id">
        <input type="text" name="title" id="title">
        <label for="publisher">Publisher buku</label>
        <label for="author">Author buku</label>
        <input type="text" name="publisher" id="publisher">
        <input type="text" name="author" id="author">
        <label for="year">tahun terbit</label>
        <input type="text" name="year" id="year">
        <label for="foto"> foto buku</label>
        <input type="file" name="foto" id="foto">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <a href="read.php" class="back-button"
    style="
        display: inline-block;
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #FF8826;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    "
    >Back</a>
    <?php endif; ?>
</div>

<?=template_footer()?>
