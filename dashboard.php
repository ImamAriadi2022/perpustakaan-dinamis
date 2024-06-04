<?php
    include "services/database.php";
    include "services/function.php";
    include "function/header.php";
    session_start();

    $username = $_SESSION['username'];
    $add_book_result = "";
    $borrow_book_result = "";
    $return_book_result = "";
    $delete_book_result = "";

    if (!isset($_SESSION['is_login'])) {
        header("Location: index.php");
    }

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: index.php");
    }

    if (isset($_POST['add_book'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $publication_date = $_POST['publication_date'];
        $category = $_POST['category'];

        $add_book_result = validateBook($title, $author, $publisher, $publication_date, $category, $db);
        $db->close();
    }

    if (isset($_POST['borrow_button'])) {
        $book_id = $_POST['borrow'];
        $borrow_book_result = borrowBook($_SESSION['user_id'], $book_id, $db);
        $db->close();
    }

    if (isset($_POST['delete_button'])) {
        $book_id = $_POST['delete'];
        $delete_book_result = deleteBook($_SESSION['user_id'], $book_id, $db);
        $db->close();
    }

    if (isset($_POST['return_button'])) {
        $borrow_id = $_POST['return'];
        $return_book_result = returnBook($borrow_id, $db);
        $db->close();
    }

    function validateBook($title, $author, $publisher, $publication_date, $category, $db) {
        if (isEmpty($title) && isEmpty($author) && isEmpty($publisher) && isEmpty($publication_date) && isEmpty($category)) {
            return "Semua field tidak boleh kosong";
        }

        if (isEmpty($title)) {
            return "Judul tidak boleh kosong";
        }

        if (isEmpty($author)) {
            return "Penulis tidak boleh kosong";
        }

        if (isEmpty($publisher)) {
            return "Penerbit tidak boleh kosong";
        }

        if (isEmpty($publication_date)) {
            return "Tanggal terbit tidak boleh kosong";
        }

        if (isEmpty($category)) {
            return "Kategori tidak boleh kosong";
        }

        if (strlen($title) > 255) {
            return "Judul terlalu panjang";
        }

        if (strlen($author) > 255) {
            return "Penulis terlalu panjang";
        }

        if (strlen($publisher) > 255) {
            return "Penerbit terlalu panjang";
        }

        if (strlen($category) > 255) {
            return "Kategori terlalu panjang";
        }

        if (!isYearValid($publication_date)) {
            return "Tanggal terbit tidak boleh kurang dari 0 atau lebih dari 2,147,483,647";
        }

        try {
            $sql = "INSERT INTO books (title, author, publisher, publication_date, category) 
                    VALUES ('$title', '$author', '$publisher', '$publication_date', '$category')";

            $db->query($sql);
            return "Buku berhasil Ditambahkan";
        } catch (Exception $e) {
            return "Gagal menambahkan buku karena: " . $e->getMessage();
        }
    }

    function borrowBook($user_id, $book_id, $db) {
        $current_date = date("Y-m-d");
        $return_date = date("Y-m-d", strtotime($current_date . "+1 month"));

        $sql = "INSERT INTO borrowing (user_id, book_id, borrow_date, return_date)
                VALUES ('$user_id', '$book_id', '$current_date', '$return_date')";

        if (validateBorrowBookByUser($user_id, $book_id, $db)) {
            return "Buku sudah dipinjam";
        }

        try {
            $db->query($sql);
            return "Buku berhasil dipinjam";
        } catch (Exception $e) {
            return "Gagal meminjam buku karena: " . $e->getMessage();
        }
    }

    function deleteBook($user_id, $book_id, $db) {
        $sql = "DELETE FROM books WHERE book_id = '$book_id'";

        if (validateBorrowBookByUser($user_id, $book_id, $db)) {
            return "Buku sedang dipinjam, kembalikan terlebih dahulu";
        } else if (validateBorrowBookByOther($book_id, $db)) {
            return "Buku sedang dipinjam oleh user lain";
        }

        try {
            $db->query($sql);
            return "Buku berhasil dihapus";
        } catch (Exception $e) {
            return "Gagal menghapus buku karena: " . $e->getMessage();
        }
    }

    function returnBook($borrow_id, $db) {
        $sql = "DELETE FROM borrowing WHERE borrow_id = '$borrow_id'";

        try {
            $db->query($sql);
            return "Buku berhasil dikembalikan";
        } catch (Exception $e) {
            return "Gagal mengembalikan buku karena: " . $e->getMessage();
        }
    }

    function validateBorrowBookByUser($user_id, $book_id, $db) {
        $sql = "SELECT * FROM borrowing WHERE user_id = '$user_id' AND book_id = '$book_id'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            return true;
        }
    }

    function validateBorrowBookByOther($book_id, $db) {
        $sql = "SELECT * FROM borrowing WHERE book_id = '$book_id'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            return true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assest/style.css">
    <title>Perpustakaan ts0ra</title>
</head>
<body>
    <?=Navbar('')?>
    <section class="dashboard">
            <div class="container">
                <h1>Selamat datang di &lt;ts0ra Library&gt;, <?= $username ?>!</h1>
                
                <form action="dashboard.php" method="POST">
                    <button type="submit" name="daftar_buku_pinjaman">Daftar Pinjaman</button>
                    <button type="submit" name="daftar_buku">Daftar Buku</button>
                    <button type="submit" name="tambah_buku">Tambah Buku</button>
                    <button type="submit" name="logout">Logout</button>
                </form>
            </div>
    </section>
        
    
    <?php
        if (isset($_POST['daftar_buku_pinjaman']) || isset($_POST['return_button'])) {
            include "services/show_books.php";
            
            echo "<p>$return_book_result</p>";
        }
        
        if (isset($_POST['daftar_buku']) || isset($_POST['borrow_button']) || isset($_POST['delete_button'])) {
            include "services/show_all_books.php";
            
            echo "<p>$borrow_book_result</p>";
            echo "<p>$delete_book_result</p>";
        }
        
        if (isset($_POST['tambah_buku']) || isset($_POST['add_book'])) {
            include "layouts/tambah_buku.html";
            
            echo "<p>$add_book_result</p>";
        }
        ?>
        <?=footer()?>
</body>
</html>