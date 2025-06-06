
<?php
include 'db_connect.php';

$category = $_GET['category'] ?? '';
$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM inventory WHERE 1=1";
$params = [];

if (!empty($category)) {
    $sql .= " AND invCategory = :category";
    $params[':category'] = $category;
}

if (!empty($search)) {
    $sql .= " AND (invID LIKE :search OR invName LIKE :search)";
    $params[':search'] = "%$search%";
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($inventory);
?>