<?php
// Koneksi ke database
include 'php/Config/config.php';

// Ambil data rumah dari database
$result = $conn->query("SELECT * FROM properti");

if ($result->num_rows > 0) {
    $properti = [];
    while ($row = $result->fetch_assoc()) {
        $properti[] = $row;
    }
} else {
    $properti = [];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Rumah</title>
    <link rel="stylesheet" href="css/Home.css">
</head>

<body>
    <header>
        <nav>
            <h1>Pencarian Rumah</h1>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Produk.html">Daftar Rumah</a></li>
                <li><a href="CRUD.PHP">Tambah Rumah</a></li>
            </ul>
        </nav>
    </header>
    <main id="home">
        <section>
            <h2>Selamat Datang di Pencarian Rumah</h2>
            <p>Temukan rumah impian Anda dengan mudah dan cepat.</p>
            <div id="product-list">
            </div>
        </section>
        <section class="product">
            <h2>Daftar Rumah</h2>

            <?php if (count($properti) > 0): ?>
                <ul>
                    <section class="daftar-rumah">
                        <?php foreach ($properti as $propertis): ?>
                            <div class="product-card">
                                <div class="product-cover">
                                    <img src="Foto/Rekomendasi1.png" alt="Rumah">
                                </div>
                                <div class="product-info">
                                    <h3 class="product-title"><?php echo htmlspecialchars($propertis['properti_rumah']); ?></h3>
                                    <p class="product-price"><strong>properti_harga:</strong>
                                        Rp<?php echo number_format($propertis['properti_harga'], 0, ',', '.'); ?></p>
                                    <p class="product-location"><strong>tanggal_terdaftar:</strong>
                                        <?php echo htmlspecialchars($propertis['tanggal_terdaftar']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </section>
                </ul>
            <?php else: ?>
                <p>Belum ada rumah yang tersedia.</p>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Pencarian Rumah. All rights reserved.</p>
    </footer>
</body>

</html>