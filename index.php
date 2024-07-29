<?php
// Incluir el archivo de conexión a la base de datos
include 'config/database.php'; // Ajusta el path si es necesario

// Consultar libros más buscados
$stmt = $pdo->query('SELECT * FROM titulos ORDER BY visitas DESC LIMIT 8    ');
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>
<main class="main-content">
    <h1 class="page-title">Bienvenido a la Librería Online</h1>
    <p class="welcome-text">Consulta nuestros libros y autores disponibles.</p>

    <section class="featured">
        <h2 class="section-title">Libros Más Buscados</h2>
        <div class="featured-books">
            <?php foreach ($books as $book): ?>
                <div class="book-item">
                    <h3 class="book-title"><?php echo htmlspecialchars($book['titulo']); ?></h3>
                    <p class="book-author"><?php echo htmlspecialchars($book['autor']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</main>
<?php include 'footer.php'; ?>