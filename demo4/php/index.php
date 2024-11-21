<?php
header("Content-Type: application/json");
include 'config.php'; // Pastikan file config.php berisi koneksi database yang sesuai

$method = $_SERVER['REQUEST_METHOD'];
parse_str(file_get_contents("php://input"), $input);

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $result = $conn->query("SELECT * FROM products WHERE id = $id");
            echo json_encode($result->fetch_assoc());
        } else {
            $result = $conn->query("SELECT * FROM products");
            $products = [];
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
            echo json_encode($products);
        }
        break;

    case 'POST':
        $product_name = $input['product_name'];
        $product_Harga = intval($input['product_Harga']);
        $Tanggal_kadaluwarsa = $input['Tanggal_kadaluwarsa'];
        $sql = "INSERT INTO products (product_name, product_Harga, Tanggal_kadaluwarsa) VALUES ('$product_name', $product_Harga, '$Tanggal_kadaluwarsa')";
        $result = $conn->query($sql);
        echo json_encode(["id" => $conn->insert_id]);
        break;

    case 'PUT':
        $id = intval($input['id']);
        $product_name = $input['product_name'];
        $product_Harga = intval($input['product_Harga']);
        $Tanggal_kadaluwarsa = $input['Tanggal_kadaluwarsa'];
        $sql = "UPDATE products SET product_name = '$product_name', product_Harga = $product_Harga, Tanggal_kadaluwarsa = '$Tanggal_kadaluwarsa' WHERE id = $id";
        $result = $conn->query($sql);
        echo json_encode(["updated" => $result]);
        break;

    case 'DELETE':
        $id = intval($input['id']);
        $sql = "DELETE FROM products WHERE id = $id";
        $result = $conn->query($sql);
        echo json_encode(["deleted" => $result]);
        break;

    default:
        echo json_encode(["message" => "Method not allowed"]);
        break;
}

$conn->close();
?>
