<?php
if (isset($_SESSION['us']) == false) {
    echo "<script>alert('You must LOG-IN')</script>";
    echo '<meta http-equiv="refresh" content="0;URL=?page=Login"/>';
} else {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] != true) {
        echo "<script>alert('You are not administrator')</script>";
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    } else {
?>

        <Script>
            function deleteConfirm() {
                if (confirm("Are you sure to delete?")) {
                    return true;
                } else {
                    return false;
                }
            }
        </Script>
        <?php
        include_once("Connection.php");
        if (isset($_GET["function"]) == "del") {
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $sq = "SELECT img FROM public.product WHERE pro_id = '$id'";
                $res = pg_query($conn, $sq);
                $row = pg_fetch_array($res);
                $filePic = $row['img'];
                unlink("Images/" . $filePic);
                pg_query($conn, "DELETE FROM product WHERE pro_id = '$id'");
                echo '<meta http-equiv="refresh" content="0;URL=?page=ManagementPro"/>';
            }
        }
        ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-3">
                    <h3>MANAGEMENT</h3>
                    <div class="list-group list-group-flush">
                        <a href="?page=ManagementCate" class="list-group-item list-group-item-action py-2">CATEGORY</a>
                        <a href="?page=ManagementSup" class="list-group-item list-group-item-action py-2">SUPPLIER</a>
                        <a href="?page=ManagementShop" class="list-group-item list-group-item-action py-2">SHOP</a>
                        <a href="?page=ManagementPro" class="list-group-item list-group-item-action py-2">PRODUCT</a>
                    </div>
                    <hr class="d-sm-none">

                </div>
                <div class="col-sm-9">
                    <form name="frm" method="post" action="">
                        <h3 class="text-center">PRODUCTS MANAGEMENT</h3>
                        <p>
                            <a href="?page=AddProduct" class="text-decoration-none">
                                <img src="Img/add.png" alt="Add new" width="16" height="16" border="0" /> Add new</a>
                        </p>
                        <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><strong>ProductID</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Price</strong></th>
                                    <th><strong>Quantity</strong></th>
                                    <th><strong>Category</strong></th>
                                    <th><strong>Supplier</strong></th>
                                    <th><strong>Shop</strong></th>
                                    <th><strong>Description</strong></th>
                                    <th><strong>Image</strong></th>
                                    <th><strong>Edit</strong></th>
                                    <th><strong>Delete</strong></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                include_once("Connection.php");
                                $No = 1;
                                $result = pg_query($conn, "SELECT * FROM product a, supplier b, category d, shop s 
                                                    WHERE a.sup_id = b.sup_id AND a.cate_id = d.cate_id AND a.shop_id = s.shop_id");
                                while ($row = pg_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row["pro_id"]; ?></td>
                                        <td><?php echo $row["pro_name"]; ?></td>
                                        <td><?php echo $row["price"]; ?></td>
                                        <td><?php echo $row["quatity"]; ?></td>
                                        <td><?php echo $row["cate_name"]; ?></td>
                                        <td><?php echo $row["sup_name"]; ?></td>
                                        <td><?php echo $row["shop_name"]; ?></td>
                                        <td><?php echo $row["descrip"]; ?></td>
                                        <td align='center'>
                                            <img src='Images/<?php echo $row['img'] ?>' border='0' width="50" height="50" />
                                        </td>
                                        <td align='center'>
                                            <a href="?page=UpdatePro&&id=<?php echo $row["pro_id"]; ?>">
                                                <img src='Img/edit.png' border='0' /></a>
                                        </td>
                                        <td align='center'>
                                            <a href="?page=ManagementPro&&function=del&&id=<?php echo $row["pro_id"]; ?>" onclick="return deleteConfirm()">
                                                <img src='Img/delete.png' border='0' /></a>
                                        </td>
                                    </tr>
                                <?php
                                    $No++;
                                }
                                ?>
                            </tbody>

                        </table>

                    </form>
                </div>

            </div>
        </div>

<?php
    }
}
?>