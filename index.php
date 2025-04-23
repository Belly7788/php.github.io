<?php
require_once 'connection.php';

$stmt = $conn->prepare("SELECT * FROM products WHERE status = 1");

$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Product CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Product List</h1>
        <a href="create.php" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add New Product</a>
        
        <table class="w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">ID</th>
                    <th class="p-2">Name</th>
                    <th class="p-2">Description</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                <tr>
                    <td class="p-2"><?php echo $product['id']; ?></td>
                    <td class="p-2"><?php echo $product['name']; ?></td>
                    <td class="p-2"><?php echo $product['description']; ?></td>
                    <td class="p-2">$<?php echo number_format($product['price'], 2); ?></td>
                    <td class="p-2">
                        <a href="edit.php?id=<?php echo $product['id']; ?>" class="text-blue-500">Edit</a>
                        <a href="delete.php?id=<?php echo $product['id']; ?>" class="text-red-500 ml-2" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>