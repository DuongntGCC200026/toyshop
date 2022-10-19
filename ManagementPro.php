<?php
if (isset($_SESSION['us']) == false) {
    echo "<script>alert('You must LOG-IN')</script>";
    echo '<meta http-equiv="refresh" content="0;URL=?page=Login"/>';
} else {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
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
                $sq = "SELECT Image FROM product WHERE ProductID = '$id'";
                $res = mysqli_query($conn, $sq);
                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                $filePic = $row['Image'];
                unlink("Images/" . $filePic);
                mysqli_query($conn, "DELETE FROM product WHERE ProductID = '$id'");
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
                                    <th><strong>No.</strong></th>
                                    <th><strong>Product ID</strong></th>
                                    <th><strong>Product Name</strong></th>
                                    <th><strong>Price</strong></th>
                                    <th><strong>Quantity</strong></th>
                                    <th><strong>Category</strong></th>
                                    <th><strong>Product For</strong></th>
                                    <th><strong>Image</strong></th>
                                    <th><strong>Edit</strong></th>
                                    <th><strong>Delete</strong></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                include_once("Connection.php");
                                $No = 1;
                                $result = mysqli_query($conn, "SELECT ProductID, ProductName, Price, Quantity, CategoryName, SmallDes, Image 
                                                        FROM product a, category b WHERE a.CategoryID=b.CategoryID ORDER BY ProDate DESC");
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                ?>
                                    <tr>
                                        <td><?php echo $No;  ?></td>
                                        <td><?php echo $row["ProductID"]; ?></td>
                                        <td><?php echo $row["ProductName"]; ?></td>
                                        <td><?php echo $row["Price"]; ?></td>
                                        <td><?php echo $row["Quantity"]; ?></td>
                                        <td><?php echo $row["CategoryName"]; ?></td>
                                        <td><?php echo $row["SmallDes"]; ?></td>
                                        <td align='center'>
                                            <img src='Images/<?php echo $row['Image'] ?>' border='0' width="50" height="50" />
                                        </td>
                                        <td align='center'>
                                            <a href="?page=UpdatePro&&id=<?php echo $row["ProductID"]; ?>">
                                                <img src='Img/edit.png' border='0' /></a>
                                        </td>
                                        <td align='center'>
                                            <a href="?page=ManagementPro&&function=del&&id=<?php echo $row["ProductID"]; ?>" onclick="return deleteConfirm()">
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