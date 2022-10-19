<script>
    function Cate() {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        var f = document.form1;
        //id
        if (f.txtID.value == "") {
            alert("Enter Category ID!");
            return false;
        }
        if (format.test(f.txtID.value)) {
            alert("The Category ID does not contain special characters!");
            return false;
        }
        //name
        if (f.txtName.value == "") {
            alert("Enter Category Name!");
            return false;
        }
        if (format.test(f.txtName.value)) {
            alert("The Category Name does not contain special characters!");
            return false;
        }
        //country
        if (f.txtCountry.value == "") {
            alert("Enter Country!");
            return false;
        }
        if (format.test(f.txtCountry.value)) {
            alert("The Country does not contain special characters!");
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
    echo "<script>alert('You must LOG-IN')</script>";
    echo '<meta http-equiv="refresh" content="0;URL=?page=Login"/>';
} else {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
        echo "<script>alert('You are not administrator')</script>";
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    } else {
?>
        <?php
        include_once("Connection.php");
        if (isset($_POST["btnAdd"])) {
            $id = $_POST["txtID"];
            $name = $_POST["txtName"];
            $country = $_POST["txtCountry"];
            $des = $_POST["txtDes"];
            
            $sq = "SELECT * FROM category WHERE CategoryID = '$id' or CategoryName = '$name'";
            $result = mysqli_query($conn, $sq);
            if (mysqli_num_rows($result) == 0) {
                mysqli_query($conn, "INSERT INTO category (CategoryID, CategoryName, Country, DescriptionCate) VALUES ('$id','$name', '$country','$des')");
                echo "<script>alert('Adding successfully!');</script>";
                echo '<meta http-equiv= "refresh" content="0;URL=?page=ManagementCate"/>';
            } else {
                echo "<script>alert('Duplicate category ID or Name!');</script>";
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
                    <h3 class="text-center">Adding new Category</h3>
                    <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form" onsubmit="return Cate()">
                        <div class="form-group">
                            <div class="col-sm-12 mt-5">
                                <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Category ID">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Category Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <input type="text" name="txtCountry" id="txtCountry" class="form-control" placeholder="Country">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 mt-3">
                                <input type="text" name="txtDes" id="txtDes" class="form-control" placeholder="Description">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-12 mt-3 mb-5">
                                <input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new" />
                                <input type="button" class="btn btn-primary ms-3" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=AddCategory'" />

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
}
?>