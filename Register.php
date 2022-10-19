<script>
  function CheckRegister() {
    var validname = /^[A-Za-z]+|(\s)$/;
    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    var phone_pattern = /^(\(0\d{1,3}\)\d{7})|(0\d{9,10})$/;
    var f = document.register;
    var us = document.register.txtUsername.value;
    var pas1 = document.register.txtPass.value;
    var pas2 = document.register.txtRepass.value;
    var name = document.register.txtCusname.value;
    var ident = document.register.txtIdentitycard.value;
    var phone = document.register.txtPhone.value;
    var address = document.register.txtAddress.value;

    if (us == "" || pas1 == "" || pas2 == "" || ident == "" || phone == "" || address == "") {
      alert("Please fill out the form!");
      return false;
    }
    //us
    if (format.test(us)) {
      alert("The username does not contain special characters!");
      return false;
    }
    if (us.length <= 6) {
      alert("Username must be more than 6 characters!");
      return false;
    }
    //pass
    if (pas1.length <= 6) {
      alert("Password must be more than 6 characters!");
      return false;
    }
    if (pas1 != pas2) {
      alert("Confirm password does not match!");
      return false;
    }
    //fullname
    if (validname.test(f.txtCusname.value) == false || format.test(f.txtCusname.value)) {
      alert("The fullname does not contain special characters or number!");
      return false;
    }
    //identity
    if (format.test(ident)) {
      alert("The identity card does not contain special characters!");
      return false;
    }
    if (isNaN(ident)) {
      alert("The identity card does not contain characters!");
      return false;
    }
    //phone
    if (phone_pattern.test(f.txtPhone.value) == false) {
      alert("The phone number is invalid!");
      return false;
    }
  }
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
<?php
if (isset($_POST['btnRegister'])) {
  $us = $_POST['txtUsername'];
  $pa = $_POST['txtPass'];
  $repa = $_POST['txtRepass'];
  $cusname = $_POST['txtCusname'];
  $identitycard = $_POST['txtIdentitycard'];
  $phone = $_POST['txtPhone'];
  $address = $_POST['txtAddress'];

  $err = "";

  if ($err != "") {
    echo $err;
  } else {
    include_once("Connection.php");
    $pass = md5($pa);
    $sq = "SELECT * FROM customer WHERE Username = '$us'";
    $res = mysqli_query($conn, $sq);
    if (mysqli_num_rows($res) == 0) {
      mysqli_query($conn, "INSERT INTO customer(Username, Password, Cusname, Identitycard, Cusphone, Address, State) 
                Values ('$us','$pass','$cusname','$identitycard', '$phone','$address', 0)") or die(mysqli_error($conn));
      echo '<meta http-equiv="refresh" content = "0; URL=?page=Login"/>';
      echo "<script>alert('Register successfully!');</script>";
    } else {
      echo "<script>alert('Username already exist');</script>";
      echo '<meta http-equiv="refresh" content = "0; URL=?page=Register"/>';
    }
  }
}
?>
<section class="" style="background-color: #9A616D;">
  <div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="Images/playing-doll-figure-toys.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-4 text-black">

                <form method="POST" name="register" onsubmit="return CheckRegister()">

                  <div class="text-center align-items-center mb-1 pb-1">
                    <i class="fas fa-cubes fa-2x" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">REGISTER</span>
                  </div>

                  <div class="form-outline mb-3">
                    <input type="text" name="txtUsername" class="form-control form-control-lg" placeholder="User name" />
                  </div>

                  <div class="form-outline mb-3">
                    <input type="password" name="txtPass" class="form-control form-control-lg" placeholder="Password" />
                  </div>

                  <div class="form-outline mb-3">
                    <input type="password" name="txtRepass" class="form-control form-control-lg" placeholder="Re-Password" />
                  </div>

                  <div class="form-outline mb-3">
                    <input type="text" name="txtCusname" class="form-control form-control-lg" placeholder="Full name" />
                  </div>

                  <div class="form-outline mb-3">
                    <input type="text" name="txtIdentitycard" class="form-control form-control-lg" placeholder="Identity card" />
                  </div>

                  <div class="form-outline mb-3">
                    <input type="text" name="txtPhone" class="form-control form-control-lg" placeholder="Phone number" />
                  </div>

                  <div class="form-outline mb-3">
                    <input type="text" name="txtAddress" class="form-control form-control-lg" placeholder="Address to receive goods" />
                  </div>

                  <div class="pt-1 mb-4">
                    <button type="Submit" class="btn btn-dark btn-lg btn-block" id="btnRegisterF" name="btnRegister">Register</button>
                  </div>

                  <p class="mt-2 mb-5 pb-lg-2">Already have an available account? &nbsp;<a href="?page=Login" id="small">Login now</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>