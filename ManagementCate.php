<?php
if (isset($_SESSION['us']) == false) {
    echo "<script>alert('You must LOG-IN')</script>";
    echo '<meta http-equiv="refresh" content="5;URL=?page=Login"/>';
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
                mysqli_query($conn, "DELETE FROM category WHERE CategoryID = '$id'");
                echo '<meta http-equiv="refresh" content="0;URL=?page=ManagementCate"/>';
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
                        <h3 class="text-center">CATEGORIES MANAGEMENT</h3>
                        <p>
                            <a href="?page=AddCategory" class="text-decoration-none">
                                <img src="Img/add.png" alt="Add new" width="16" height="16" border="0" /> Add new</a>
                        </p>
                        <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><strong>No.</strong></th>
                                    <th><strong>Category ID</strong></th>
                                    <th><strong>Category Name</strong></th>
                                    <th><strong>Country</strong></th>
                                    <th><strong>Description</strong></th>
                                    <th><strong>Edit</strong></th>
                                    <th><strong>Delete</strong></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                include_once("Connection.php");
                                $No = 1;
                                $result = mysqli_query($conn, "SELECT * FROM category");
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                ?>
                                    <tr>
                                        <td><?php echo $No; ?></td>
                                        <td><?php echo $row["CategoryID"]; ?></td>
                                        <td><?php echo $row["CategoryName"]; ?></td>
                                        <td><?php echo $row["Country"]; ?></td>
                                        <td><?php echo $row["DescriptionCate"]; ?></td>
                                        <td style='text-align:center'>
                                            <a href="?page=UpdateCate&&id=<?php echo $row["CategoryID"]; ?>">
                                                <img src='Img/edit.png' border='0' /></a>
                                        </td>
                                        <td style='text-align:center'>
                                            <a href="?page=ManagementCate&&function=del&&id=<?php echo $row["CategoryID"]; ?>" onclick="return deleteConfirm()">
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