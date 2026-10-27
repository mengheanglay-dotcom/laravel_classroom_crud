<?php
$autoload = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoload)) {
    require $autoload;
}
// Use PDO directly to avoid bootstrapping the framework.
$pdo = new PDO('mysql:host=127.0.0.1;port=3307;dbname=classroom_crud','root','');
$stmt = $pdo->query("SELECT id,image FROM teachers");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $r){
    $img = $r['image'];
    if($img && (strpos($img,'\\') !== false || strpos($img,':') !== false)){
        $u = $pdo->prepare('UPDATE teachers SET image = NULL WHERE id = ?');
        $u->execute([$r['id']]);
        echo "Cleared id {$r['id']}\n";
    }
}
echo "Done\n";
