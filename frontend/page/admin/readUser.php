<?php
include 'function.php';
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 10;

$stmt = $pdo->prepare('SELECT * FROM users ORDER BY user_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_users = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
?>

<?=template_header('Read-User')?>

<div class="content read">
    <h2>Daftar Pengguna</h2>
    <table>
        <thead>
            <tr>
                <td>No</td>
                <td>Username</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?=$user['user_id']?></td>
                <td><?=$user['username']?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1): ?>
        <a href="readUser.php?page=<?=$page - 1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_users): ?>
        <a href="readUser.php?page=<?=$page + 1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<?=template_footer()?>
