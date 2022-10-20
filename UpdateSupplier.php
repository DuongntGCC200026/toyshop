<script>
    function supplier() {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        var f = document.form1;
        //name
        if (f.txtName.value == "") {
            alert("Enter Supplier Name!");
            return false;
        }
        if (format.test(f.txtName.value)) {
            alert("The Supplier Name does not contain special characters!");
            return false;
        }
        if (f.txtAdd.value == "") {
            alert("Enter Address!");
            return false;
        }
        if (f.txtMail.value == "") {
            alert("Enter Mail!");
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
                        <a href="?page=ManagementSup" class="list-group-item list-group-item-action py-2">SUPPLIER</a>
                        <a href="?page=ManagementShop" class="list-group-item list-group-item-action py-2">SHOP</a>
                        <a href="?page=ManagementPro" class="list-group-item list-group-item-action py-2">PRODUCT</a>
                    </div>
                    <hr class="d-sm-none">

                </div>
                <div class="col-sm-9">
                    <?php
                    include_once("Connection.php");
                    if (isset($_GET["id"])) {
                        $id = $_GET["id"];
                        $result = pg_query($conn, "SELECT * FROM public.supplier WHERE sup_id = '$id'");
                        $row = pg_fetch_array($result);
                        $sup_id = $row['sup_id'];
                        $sup_name = $row['sup_name'];
                        $sup_add = $row['sup_address'];
                        $sup_mail = $row['sup_mail'];
                    ?>
                        <h3 class="text-center">Updating Supplier</h3>
                        <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form" onsubmit="return supplier()">
                            <div class="form-group">
                                <label for="txtCate" class="col-sm-2 control-label mt-4">Suplier ID(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Suplier ID" readonly value='<?php echo $sup_id; ?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtName" class="col-sm-2 control-label mt-3">Suplier Name(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Suplier Name" value='<?php echo $sup_name;  ?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtDesCate" class="col-sm-2 control-label mt-3">Address(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="txtAdd" id="txtAdd" class="form-control" placeholder="Address" value='<?php echo $sup_add; ?>'>
                                </div>
                            </div><div class="form-group">
                                <label for="txtDesCate" class="col-sm-2 control-label mt-3">Mail(*): </label>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="txtMail" id="txtMail" class="form-control" placeholder="Mail" value='<?php echo $sup_mail; ?>'>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-12 mt-3 mb-5">
                                    <input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
                                    <input type="button" class="btn btn-primary ms-3" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=ManagementSup'" />

                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST["btnUpdate"])) {
                            $id = $_POST["txtID"];
                            $name = $_POST["txtName"];
                            $add = $_POST["txtAdd"];
                            $mail = $_POST["txtMail"];
                            $sq = "SELECT * FROM public.supplier WHERE sup_id != '$id' and sup_name = '$name'";
                            $result = pg_query($conn, $sq);
                            if (pg_num_rows($result) == 0) {
                                pg_query($conn, "UPDATE public.supplier SET sup_name = '$name', sup_address ='$add', sup_mail ='$mail' WHERE sup_id ='$id'");
                                echo "<script>alert('Updating successfully!');</script>";
                                echo '<meta http-equiv="refresh" content="0; URL=?page=ManagementSup"/>';
                            } else {
                                echo "<script>alert('Supplier Name is already exist!');</script>";
                            }
                        }
                        ?>
                    <?php
                    } else {
                        echo '<meta http-equiv="refresh" content=0; URL=?page=ManagementSup"/>';
                    }
                    ?>
                </div>

            </div>
        </div>
<?php
    }
}
?>