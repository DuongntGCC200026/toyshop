<script>
  function CheckLogin() {
    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    var us = document.login.txtUsername.value;
    var pa = document.login.txtPass.value;
    if (us == "") {
      alert("Enter Username!");
      return false;
    }
    if (pa == "") {
      alert("Enter Password!");
      return false;
    }

    if (format.test(us)) {
      alert("The username does not contain special characters!");
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
if (isset($_POST['btnLogin'])) {
  $us = $_POST['txtUsername'];
  $pa = $_POST['txtPass'];
  $err = "";

  if ($err != "") {
    echo $err;
  } else {
    include_once("Connection.php");
    $pass = md5($pa);
    $res = pg_query($conn, "SELECT * FROM public.customer WHERE username = '$us' AND password = '$pass'") or die(pg_errormessage($conn));
    if (pg_num_rows($res) == 1) {
      $row = pg_fetch_array($res,PGSQL_ASSOC);
      $_SESSION['us'] = $us;
      $_SESSION['admin'] = $row['Role'];
      echo '<meta http-equiv="refresh" content = "0; URL=index.php"/>';
      echo "<script>alert('Log in successfully!');</script>";
    } else {
      echo "<script>alert('Username or password is incorrect!');</script>";
    }
  }
}
?>
<section style="background-color: #9A616D;">
  <div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="Images/nick-nice-login.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-4 text-black">

                <form method="POST" name="login" onsubmit="return CheckLogin()">

                  <div class="text-center align-items-center mb-5 pb-1">
                    <i class="fas fa-cubes fa-2x" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0"><span>Sign into your account</span>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="text" name="txtUsername" class="form-control form-control-lg" placeholder="User name" />
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" name="txtPass" class="form-control form-control-lg" placeholder="Password" />
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit" id="btnLoginF" name="btnLogin">Login</button>
                  </div>

                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mt-2 mb-5 pb-lg-2">Don't have an account? <a href="?page=Register" id="small">Register here</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>