<?php
session_start();
require 'config.php';
if ($_GET['direction'] == 'asc') {
    $query = $pdo->prepare("SELECT * FROM `products` ORDER BY price asc
    ");
    $query->execute();
} else {
    $query = $pdo->prepare("SELECT * FROM `products` ORDER BY price desc
    ");
    $query->execute();
}

while ($row = $query->fetch()) :
?>
                <div class="col-sm-6 col-md-4 col-lg-3 position-relative mb-4">
                <div class="card p-2" style="height:480px">
                    <img src="<?= $row['image'] ?>" style="height:300px">
                    <h3 class="position-absolute translate-middle" style="top:55px;left:53px;">
                        <span class="badge bg-info">
                            <?= $row['price'] ?> DH
                        </span>
                    </h3>
                    <form class="form">
                        <input type="hidden" class="id" value="<?= $row['id'] ?>">
                        <input type="hidden" class="name" value="<?= $row['name'] ?>">
                        <input type="hidden" id="price" value="<?= $row['price'] ?>">
                        <input type="hidden" class="image" value="<?= $row['image'] ?>">
                        <div class="input-group my-3 d-flex justify-content-between">
                            <span class="input-group-text">Quantity</span>
                            <input type="number" class="form-control quantity" value="1">
                            <button class="addToCart btn btn-primary">
                                <i class="icon-basket"></i>
                            </button>
                        </div>
                    </form>
                    <h3 class="mt-3 text-center">
                        <?= substr($row['name'], 0, 20) ?>
                    </h3>
                </div>
            </div>
<?php endwhile; ?>