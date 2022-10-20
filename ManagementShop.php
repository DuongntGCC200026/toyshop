<?php
if (isset($_SESSION['us']) == false) {
    echo "<script>alert('You must LOG-IN')</script>";
    echo '<meta http-equiv="refresh" content="5;URL=?page=Login"/>';
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
                pg_query($conn, "DELETE FROM public.shop WHERE shop_id = '$id'");
                echo '<meta http-equiv="refresh" content="0;URL=?page=ManagementShop"/>';
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
                        <h3 class="text-center">SHOP MANAGEMENT</h3>
                        <p>
                            <a href="?page=AddShop" class="text-decoration-none">
                                <img src="Img/add.png" alt="Add new" width="16" height="16" border="0" /> Add new</a>
                        </p>
                        <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><strong>Shop ID</strong></th>
                                    <th><strong>Shop Name</strong></th>
                                    <th><strong>Address</strong></th>
                                    <th><strong>Phone</strong></th>
                                    <th><strong>Edit</strong></th>
                                    <th><strong>Delete</strong></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                include_once("Connection.php");
                                $No = 1;
                                $result = pg_query($conn, "SELECT * FROM public.shop");
                                while ($row = pg_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row["shop_id"]; ?></td>
                                        <td><?php echo $row["shop_name"]; ?></td>
                                        <td><?php echo $row["shop_address"]; ?></td>
                                        <td><?php echo $row["shop_phone"]; ?></td>
                                        <td style='text-align:center'>
                                            <a href="?page=UpdateShop&&id=<?php echo $row["shop_id"]; ?>">
                                                <img src='Img/edit.png' border='0' /></a>
                                        </td>
                                        <td style='text-align:center'>
                                            <a href="?page=ManagementShop&&function=del&&id=<?php echo $row["shop_id"]; ?>" onclick="return deleteConfirm()">
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