<?php
require "db.php";
$result = mysqli_query($link, "SELECT * FROM documents ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Система согласования документов</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>📄 Система согласования документов</h1>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="success">✅ Документ создан!</div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="error">❌ Ошибка: <?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>
        
        <!-- Форма создания -->
        <div class="form-box">
            <h2>➕ Создать документ</h2>
            <form action="add.php" method="POST">
                <input type="text" name="title" placeholder="Название документа" required>
                <input type="text" name="author" placeholder="Автор" required>
                <input type="text" name="responsible" placeholder="Ответственный" required>
                <textarea name="description" placeholder="Описание документа" required></textarea>
                <button type="submit">Создать документ</button>
            </form>
        </div>
        
        <h2>📋 Список документов</h2>
        
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($doc = mysqli_fetch_assoc($result)): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($doc['title']) ?></h3>
                    
                    <p><strong>Автор:</strong> <?= htmlspecialchars($doc['author']) ?></p>
                    <p><strong>Ответственный:</strong> <?= htmlspecialchars($doc['responsible']) ?></p>
                    <p><strong>Описание:</strong> <?= nl2br(htmlspecialchars($doc['description'])) ?></p>
                    <p><strong>Дата:</strong> <?= $doc['created_at'] ?></p>
                    
                    <div class="status status-<?= str_replace(' ', '', $doc['status']) ?>">
                        Статус: <?= htmlspecialchars($doc['status']) ?>
                    </div>
                    
                    <div class="actions">
                        <form action="update_status.php" method="POST">
                            <input type="hidden" name="id" value="<?= $doc['id'] ?>">
                            <button type="submit" name="status" value="На согласовании" class="btn-pending">📋 На согласование</button>
                            <button type="submit" name="status" value="Одобрен" class="btn-approve">✅ Одобрить</button>
                            <button type="submit" name="status" value="Отклонен" class="btn-reject">❌ Отклонить</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty">
                <p>📭 Пока нет документов</p>
                <p>Создайте первый документ!</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>