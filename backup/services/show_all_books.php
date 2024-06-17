<?php
    include "database.php";

    $sql = "SELECT * FROM books";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Daftar Buku Perpustakaan</h2>";
        echo "<table border='1'>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Kategori</th>
                    <th>Opsi</th>
                </tr>";
        $index = 1;
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$index."</td>
                    <td>".$row["title"]."</td>
                    <td>".$row["author"]."</td>
                    <td>".$row["publisher"]."</td>
                    <td>".$row["publication_date"]."</td>
                    <td>".$row["category"]."</td>
                    <td>
                        <form action='dashboard.php' method='POST'>
                            <input type='hidden' name='borrow' value='".$row['book_id']."'>
                            <button type='submit' name='borrow_button'>Pinjam</button>
                        </form>
                        <form action='dashboard.php' method='POST'>
                            <input type='hidden' name='delete' value='".$row['book_id']."'>
                            <button type='submit' name='delete_button'>Hapus</button>
                        </form>
                    </td>
                </tr>";
            $index++;
        }
        echo "</table>";
    } else {
        echo "<h2>Daftar Buku Perpustakaan</h2>";
        echo "<p>Perpustakaan masih kosong</p>";
    }

    $db->close();
?>