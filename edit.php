<?php
require_once 'connection.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id AND status = 1");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    $stmt = $conn->prepare("UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id");
    $stmt->execute([
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'id' => $id
    ]);
    
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Product</h1>
        <form method="POST" class="bg-white p-6 rounded shadow-md">
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="name" value="<?php echo $product['name']; ?>" required class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="description" class="w-full p-2 border rounded"><?php echo $product['description']; ?></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Price</label>
                <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</a>
        </form>
    </div>
</body>
</html>