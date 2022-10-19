<?php
include_once("Connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT ProductID, ProductName, Price, CategoryName, Image, SmallDes, DetailDes 
                                    FROM product a, category b 
                                    WHERE a.CategoryID=b.CategoryID AND ProductID = '$id'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $proName = $row['ProductName'];
    $price = $row['Price'];
    $cate = $row['CategoryName'];
    $img = $row['Image'];
    $smallDes = $row['SmallDes'];
    $detailDes = $row['DetailDes'];
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
                    <h1><?php echo $proName; ?></h1>
                    <h6>Provided By <?php echo $cate; ?></h6>
                    <p class="des">Products for: <?php echo $smallDes; ?></p>
                    <h2><?php echo $detailDes; ?></h2>
                    <i>Price: <?php echo $price; ?>$</i>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <a href="index.php" class="btn btn-round btn-primary mt-3" type="button"><i class="bi bi-chevron-double-left"></i> Continue Shoping</a>
                        </div>
                        <div class="col-md-6 col-12">
                            <form action="?page=PersonalCart" method="POST">
                                <input type="number" min="1" name="Quantity" value="1" class="col-2 mt-3">
                                <input class="btn btn-round btn-warning" type="submit" name="AddCart" value="Add To Cart">
                                <input type="hidden" name="ProName" value="<?php echo $proName; ?>">
                                <input type="hidden" name="CateName" value="<?php echo $cate; ?>">
                                <input type="hidden" name="Gender" value="<?php echo $smallDes ?>">
                                <input type="hidden" name="Price" value="<?php echo $price ?>">
                                <input type="hidden" name="Img" value="<?php echo $img ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>