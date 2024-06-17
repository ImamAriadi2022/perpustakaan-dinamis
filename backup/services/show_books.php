<?php
    include "database.php";

    $sql = "SELECT borrowing.borrow_id, books.book_id, books.title, borrowing.borrow_date, borrowing.return_date
            FROM borrowing
            JOIN users ON borrowing.user_id = users.user_id
            JOIN books ON borrowing.book_id = books.book_id
            WHERE users.username = '".$_SESSION['username']."'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Daftar Buku yang di Pinjam</h2>";
        echo "<table border='1'>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Opsi</th>
                </tr>";
        $index = 1;
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$index."</td>
                    <td>".$row["title"]."</td>
                    <td>".$row["borrow_date"]."</td>
                    <td>".$row["return_date"]."</td>
                    <td>
                        <form action='dashboard.php' method='POST'>
                            <input type='hidden' name='return' value='".$row['borrow_id']."'>
                            <button type='submit' name='return_button'>Hapus</button>
                        </form>
                    </td>
                </tr>";
            $index++;
        }
        echo "</table>";
    } else {
        echo "<h2>Daftar Buku yang di Pinjam</h2>";
        echo "<p>".$_SESSION['username']." belum meminjam buku</p>";
    }

    $db->close();
?>
