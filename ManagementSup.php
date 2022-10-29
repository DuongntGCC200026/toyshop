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
                pg_query($conn, "DELETE FROM public.supplier WHERE sup_id = '$id'");
                echo '<meta http-equiv="refresh" content="0;URL=?page=ManagementSup"/>';
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
                        <h3 class="text-center">SUPPLIERS MANAGEMENT</h3>
                        <p>
                            <a href="?page=AddSup" class="text-decoration-none">
                                <img src="Img/add.png" alt="Add new" width="16" height="16" border="0" /> Add new</a>
                        </p>
                        <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><strong>Supplier ID</strong></th>
                                    <th><strong>Supplier Name</strong></th>
                                    <th><strong>Address</strong></th>
                                    <th><strong>Mail</strong></th>
                                    <th><strong>Edit</strong></th>
                                    <th><strong>Delete</strong></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                include_once("Connection.php");
                                $No = 1;
                                $result = pg_query($conn, "SELECT * FROM public.supplier");
                                while ($row = pg_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row["sup_id"]; ?></td>
                                        <td><?php echo $row["sup_name"]; ?></td>
                                        <td><?php echo $row["sup_address"]; ?></td>
                                        <td><?php echo $row["sup_mail"]; ?></td>
                                        <td style='text-align:center'>
                                            <a href="?page=UpdateSup&&id=<?php echo $row["sup_id"]; ?>">
                                                <img src='Img/edit.png' border='0' /></a>
                                        </td>
                                        <td style='text-align:center'>
                                            <a href="?page=ManagementSup&&function=del&&id=<?php echo $row["sup_id"]; ?>" onclick="return deleteConfirm()">
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