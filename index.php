<?php

include "includes/header.php";

?>

<div class="container">
    <div id="message"></div>
    <div class="my-4">
        <span>Category</span>
        <select class="form-select categories mt-2 mb-4">
            <?php
            include 'config.php';
            $query = $pdo->query("SELECT * FROM categories");
            while ($row = $query->fetch()) :
            ?>
                <option value="<?= $row['id'] ?>">
                    <?= $row['name'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <span>Sort</span>
        <select class="form-select sortable mt-2">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>
    </div>
    <div class="row products">
        <?php
        include 'config.php';
        $query = $pdo->query("SELECT * FROM products");

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
    </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>

<script src="./js/main.js"></script>
</body>

</html>