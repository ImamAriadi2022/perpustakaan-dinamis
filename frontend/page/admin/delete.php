<?php
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM books WHERE book_id = ?');
    $stmt->execute([$_GET['id']]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$book) {
        exit('Book doesn\'t exist with that ID!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $filePath = __DIR__ . "/uploads/" . $book['foto'];
            if (file_exists($filePath)) {
                unlink($filePath);
            } else {
                $msg = 'File not found!';
            }
            $stmt = $pdo->prepare('DELETE FROM books WHERE book_id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the book!';
        } else {
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
    <h2>Delete Book #<?=$book['book_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Are you sure you want to delete book #<?=$book['book_id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$book['book_id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$book['book_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
    <a href="read.php" class="back-button">Back</a>
</div>

<?=template_footer()?>
