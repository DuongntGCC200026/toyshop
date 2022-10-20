<script>
    function category() {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        var f = document.form1;
        //name
        if (f.txtName.value == "") {
            alert("Enter Category Name!");
            return false;
        }
        if (format.test(f.txtName.value)) {
            alert("The Category Name does not contain special characters!");
            return false;
        }
        //des
        if (f.txtDes.value == "") {
            alert("Enter Category Description!");
            return false;
        }
    }
</script>
<?php
if (isset($_SESSION['us']) == false) {
    echo "<script>alert('You must be LOG-IN')</script>";
    echo '<meta http-equiv="refresh" content="0;URL=?page=Login"/>';
} else {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] != true) {
        echo "<script>alert('You are not administrator')</script>";
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    } else {
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
                    <?php
                    include_once("Connection.php");
                    if (isset($_GET["id"])) {
                        $id = $_GET["id"];
                        $result = pg_query($conn, "SELECT * FROM public.category WHERE cate_id = '$id'");
                        $row = pg_fetch_array($result);
                        $cat_id = $row['cate_id'];
                        $cat_name = $row['cate_name'];
                        $cat_des = $row['description'];
                    ?>
                        <h3 class="text-center">Updating Category</h3>
                        <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form" onsubmit="return category()">
                            <div class="form-group">
                                <label for="txtCate" class="col-sm-2 control-label mt-4">Category ID(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Catepgy ID" readonly value='<?php echo $cat_id; ?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtName" class="col-sm-2 control-label mt-3">Category Name(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Catepgy Name" value='<?php echo $cat_name;  ?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtDesCate" class="col-sm-2 control-label mt-3">Description(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="txtDes" id="txtDes" class="form-control" placeholder="Description" value='<?php echo $cat_des; ?>'>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-12 mt-3 mb-5">
                                    <input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
                                    <input type="button" class="btn btn-primary ms-3" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=ManagementCate'" />

                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST["btnUpdate"])) {
                            $id = $_POST["txtID"];
                            $name = $_POST["txtName"];
                            $des = $_POST["txtDes"];
                            $sq = "SELECT * FROM public.category WHERE cate_id != '$id' and cate_name = '$name'";
                            $result = pg_query($conn, $sq);
                            if (pg_num_rows($result) == 0) {
                                pg_query($conn, "UPDATE public.category SET cate_name = '$name', description ='$des' WHERE cate_id ='$id'");
                                echo "<script>alert('Updating successfully!');</script>";
                                echo '<meta http-equiv="refresh" content="5; URL=?page=ManagementCate"/>';
                            } else {
                                echo "<script>alert('Product Name is already exist!');</script>";
                            }
                        }
                        ?>
                    <?php
                    } else {
                        echo '<meta http-equiv="refresh" content=0; URL=?page=ManagementCate"/>';
                    }
                    ?>
                </div>

            </div>
        </div>
<?php
    }
}
?>