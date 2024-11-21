<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Properti</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      line-height: 1.6;
    }

    header {
      background-color: #333;
      color: white;
      padding: 1rem;
    }

    header nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header nav h1 {
      margin: 0;
    }

    header nav ul {
      display: flex;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    header nav ul li {
      margin-left: 1rem;
    }

    header nav ul li a {
      color: white;
      text-decoration: none;
    }

    main {
      padding: 2rem;
    }

    /* Table styling similar to previous horizontal card design */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 1rem;
    }

    table th,
    table td {
      border: 1px solid #ddd;
      padding: 1rem;
      text-align: left;
    }

    table th {
      background-color: #f4f4f4;
      color: #333;
    }

    table tr:hover {
      background-color: #f1f1f1;
      transition: background-color 0.3s ease;
    }

    /* Form styling */
    .search-container,
    .form-container {
      margin-bottom: 1rem;
    }

    .search-container input[type="text"],
    .form-container input[type="text"] {
      padding: 0.5rem;
      width: 300px;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-right: 0.5rem;
    }

    .search-container button,
    .form-container button {
      padding: 0.5rem 1rem;
      border: none;
      background-color: #007BFF;
      color: white;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .search-container button:hover,
    .form-container button:hover {
      background-color: #0056b3;
    }

    /* Tabs styling */
    .tabs {
      display: flex;
      margin-bottom: 1rem;
      border-bottom: 1px solid #ddd;
    }

    .tabs div {
      padding: 0.75rem 1.5rem;
      cursor: pointer;
      border-bottom: 2px solid transparent;
      transition: all 0.3s ease;
    }

    .tabs div.active {
      border-bottom-color: #007BFF;
      color: #007BFF;
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 1rem;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    /* Responsive design */
    @media (max-width: 768px) {
      header nav {
        flex-direction: column;
        align-items: center;
      }

      header nav ul {
        margin-top: 1rem;
      }

      table {
        font-size: 0.9rem;
      }

      .search-container input[type="text"],
      .form-container input[type="text"] {
        width: 100%;
        margin-bottom: 0.5rem;
      }
    }
  </style>
</head>

<body>
  <!-- Header Section -->
  <header>
    <nav>
      <h1>Pencarian Rumah</h1>
      <ul>
        <li><a href="Home.php">Home</a></li>
        <li><a href="Produk.html">Daftar Rumah</a></li>
        <li><a href="Add.html">Tambah Rumah</a></li>
      </ul>
    </nav>
  </header>

  <h1>Daftar Properti</h1>

  <!-- Tab navigation -->
  <div class="tabs">
    <div class="tab" data-tab="get">GET</div>
    <div class="tab" data-tab="post">POST</div>
    <div class="tab" data-tab="put">PUT</div>
    <div class="tab" data-tab="delete">DELETE</div>
  </div>

  <!-- Form GET -->
  <div class="tab-content" id="get">
    <h2>Cari Properti berdasarkan ID</h2>
    <form method="GET" action="">
      <input type="text" name="search" placeholder="Cari properti berdasarkan ID..."
        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
      <button type="submit">Cari</button>
    </form>
  </div>

  <!-- Form POST -->
  <div class="tab-content" id="post">
    <h2>Tambah Properti Baru</h2>
    <form method="POST" action="">
      <input type="text" name="properti_rumah" placeholder="Nama Properti" required>
      <input type="text" name="properti_harga" placeholder="Harga Properti" required>
      <button type="submit" name="action" value="create">Tambahkan</button>
    </form>
  </div>

  <!-- Form PUT -->
  <div class="tab-content" id="put">
    <h2>Ubah Data Properti</h2>
    <form method="POST" action="">
      <input type="text" name="id" placeholder="ID Properti" required>
      <input type="text" name="properti_rumah" placeholder="Nama Properti Baru" required>
      <input type="text" name="properti_harga" placeholder="Harga Properti Baru" required>
      <button type="submit" name="action" value="update">Ubah</button>
    </form>
  </div>

  <!-- Form DELETE -->
  <div class="tab-content" id="delete">
    <h2>Hapus Properti</h2>
    <form method="POST" action="">
      <input type="text" name="id" placeholder="ID Properti yang akan dihapus" required>
      <button type="submit" name="action" value="delete">Hapus</button>
    </form>
  </div>

  <!-- Menampilkan data Properti -->
  <div class="search-container">
    <?php
    // Sertakan file konfigurasi database
    include 'PHP/Config/config.php';

    // Proses POST (create, update, dan delete)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $action = $_POST['action'];

      // Tambah Properti Baru
      if ($action === 'create') {
        $properti_rumah = $conn->real_escape_string($_POST['properti_rumah']);
        $properti_harga = $conn->real_escape_string($_POST['properti_harga']);

        $sqlInsert = "INSERT INTO properti (properti_rumah, properti_harga) VALUES ('$properti_rumah', '$properti_harga')";
        if ($conn->query($sqlInsert) === TRUE) {
          echo "<p>Properti berhasil ditambahkan.</p>";
        } else {
          echo "<p>Error: " . $conn->error . "</p>";
        }
      }

      // Ubah Properti (PUT emulasi)
      if ($action === 'update') {
        $id = intval($_POST['id']);
        $properti_rumah = $conn->real_escape_string($_POST['properti_rumah']);
        $properti_harga = $conn->real_escape_string($_POST['properti_harga']);

        $sqlUpdate = "UPDATE properti SET properti_rumah = '$properti_rumah', properti_harga = '$properti_harga' WHERE id = $id";
        if ($conn->query($sqlUpdate) === TRUE) {
          echo "<p>Properti berhasil diubah.</p>";
        } else {
          echo "<p>Error: " . $conn->error . "</p>";
        }
      }

      // Hapus Properti (DELETE emulasi)
      if ($action === 'delete') {
        $id = intval($_POST['id']);

        $sqlDelete = "DELETE FROM properti WHERE id = $id";
        if ($conn->query($sqlDelete) === TRUE) {
          echo "<p>Properti berhasil dihapus.</p>";
        } else {
          echo "<p>Error: " . $conn->error . "</p>";
        }
      }
    }

    // Tangkap parameter ID (jika ada)
    $searchID = isset($_GET['search']) ? intval($_GET['search']) : 0;
    $sql = "SELECT * FROM properti";

    // Filter query berdasarkan ID jika parameter ada
    if ($searchID > 0) {
      $sql .= " WHERE id = " . $conn->real_escape_string($searchID);
    }

    $result = $conn->query($sql);

    // Cek apakah ada data
    if ($result->num_rows > 0) {
      echo "<table>";
      echo "<thead>";
      echo "<tr>";
      echo "<th>ID</th>";
      echo "<th>Nama Properti</th>";
      echo "<th>Harga Properti</th>";
      echo "<th>Tanggal Terdaftar</th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";

      // Iterasi hasil query
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['properti_rumah']) . "</td>";
        echo "<td>" . htmlspecialchars($row['properti_harga']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tanggal_terdaftar']) . "</td>";
        echo "</tr>";
      }

      echo "</tbody>";
      echo "</table>";
    } else {
      echo "<p>Tidak ada properti ditemukan.</p>";
    }
    ?>
  </div>

  <!-- Footer Section -->
  <footer>
    <p>&copy; 2024 Pencarian Rumah. All rights reserved.</p>
  </footer>

  <script>
    // Tab switching logic
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(tab => tab.classList.remove('active'));
        tabContents.forEach(content => content.classList.remove('active'));

        tab.classList.add('active');
        const targetTab = tab.getAttribute('data-tab');
        document.getElementById(targetTab).classList.add('active');
      });
    });

    // Default tab yang aktif adalah 'GET'
    document.querySelector('.tab[data-tab="get"]').classList.add('active');
    document.getElementById('get').classList.add('active');
  </script>
</body>

</html>