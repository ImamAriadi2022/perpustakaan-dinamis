<?php
include 'function.php';

// Koneksi ke Basis Data MySQL
$pdo = pdo_connect_mysql();

// Dapatkan halaman via GET request (URL param: page), jika tidak ada default ke halaman 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Jumlah data per halaman
$records_per_page = 5;

// Menyiapkan pernyataan SQL dan mendapatkan data dari tabel books, LIMIT akan menentukan halaman
$stmt = $pdo->prepare('SELECT * FROM books ORDER BY book_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// Ambil data untuk ditampilkan di template
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Dapatkan jumlah total buku untuk menentukan apakah ada tombol next dan previous
$num_books = $pdo->query('SELECT COUNT(*) FROM books')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
    <h2>Read books</h2>
    <a href="create.php" class="create-contact">Tambah Buku</a>
    <table>
        <thead>
            <tr>
                <td>No</td>
                <td>Judul buku</td>
                <td>Autor buku</td>
                <td>Publisher buku</td>
                <td>Tahun Terbit</td>
                <td>Foto buku</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
            <tr>
                <td><?=$book['book_id']?></td>
                <td><?=$book['title']?></td>
                <td><?=$book['author']?></td>
                <td><?=$book['publisher']?></td>
                <td><?=$book['year']?></td>
                <td>
                        <?php if (!empty($book['foto'])): ?>
                            <!-- Debug: Menampilkan data base64 -->
                            <?php 
                            $base64_image = base64_encode($book['foto']);
                            echo '<!-- ' . $base64_image . ' -->';
                            ?>
                            <img src="data:image/jpeg;base64,<?=$base64_image?>" width="100" alt="Book Image"/>
                        <?php else: ?>
                            <span>No image</span>
                        <?php endif; ?>
                </td>
                <td class="actions">
                    <a href="update.php?book_id=<?=$book['book_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?book_id=<?=$book['book_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1): ?>
        <a href="read.php?page=<?=$page - 1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_books): ?>
        <a href="read.php?page=<?=$page + 1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>


<?=template_footer()?>
