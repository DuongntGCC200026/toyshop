<?php
include_once("Connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = pg_query($conn, "SELECT * FROM product a, supplier b, category d
                                    WHERE pro_id = '$id' AND a.sup_id = b.sup_id AND a.cate_id = d.cate_id");
    $row = pg_fetch_array($result);
    $proName = $row['pro_name'];
    $price = $row['price'];
    $cate = $row['cate_name'];
    $sup = $row['sup_name'];
    $img = $row['img'];
    $Des = $row['descrip'];
}
?>
<div class="container bootdey mt-5 mb-5">
    <div class="col-md-12">
        <section class="panel">
            <div class="row">
                <div class="col-md-6 col-12 text-center">
                    <div class="pro-img-details">
                        <img src="Images/<?php echo $img; ?>" width="50%" height="50%" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-12 vwpro">
                    <h1 class="text-uppercase"><?php echo $proName; ?></h1>
                    <h6>Provided By <?php echo $sup; ?></h6>
                    <p class="des">With Category Is <?php echo $cate; ?></p>
                    <h2><?php echo $Des; ?></h2>
                    <i>Price: <?php echo $price; ?>$</i>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <a href="index.php" class="btn btn-round btn-primary mt-3" type="button"><i class="bi bi-chevron-double-left"></i> Continue Shoping</a>
                        </div>
                        <div class="col-md-6 col-12">
                            <form action="?page=PersonalCart" method="POST">
                                <input type="number" min="1" name="Quantity" value="1" class="col-2 mt-3">
                                <input class="btn btn-round btn-warning" type="submit" name="AddCart" value="Add To Cart">
                                <input type="hidden" name="ProName" value="<?php echo $row['pro_name'] ?>">
                                <input type="hidden" name="CateName" value="<?php echo $row['cate_name'] ?>">
                                <input type="hidden" name="SupName" value="<?php echo $row['sup_name'] ?>">
                                <input type="hidden" name="Price" value="<?php echo $row['price'] ?>">
                                <input type="hidden" name="Img" value="<?php echo $row['img'] ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>