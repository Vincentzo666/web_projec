<?php 
    include("../inc/header.php");
    include("../php/function.php");
    
    if(isset($_POST["action"]) && $_POST["action"]=='register'){
        // echo "<script>console.log('1111')</script>";
        if (!empty($_POST['register_password']) && !empty($_POST['register_username'])
        && !empty($_POST['register_fname'])&& !empty($_POST['register_lname'])) {
            // echo "<script>console.log('2222')</script>";
            $lms = new lms();
            $fname = mysqli_real_escape_string($lms->dbConnect, trim($_POST['register_fname']));
            $lname = mysqli_real_escape_string($lms->dbConnect, trim($_POST['register_lname']));
            $username = mysqli_real_escape_string($lms->dbConnect, trim($_POST['register_username']));
            $password = mysqli_real_escape_string($lms->dbConnect, trim($_POST['register_password']));
            $en_password = $lms->encode($password);
            
            $check_username = $lms->select('teacher',"*","username='$username'");
            
            if(!empty($check_username)) {
                
                $_SESSION['error'] = "ชื่อผู้ใช้นี้มีในระบบแล้ว!";
                echo "<script>window.history.back();</script>";
                exit;
                
            }else{
                
                $register = $lms->insert('teacher',['fname'=>$fname,'lname'=>$lname,'username'=>$username,'password'=>$en_password,'cr_time'=>$date]); 
                
                if(!empty($register)) {
                    
                    $_SESSION['success'] = "สมัครสมาชิกสำเร็จ!";
                    echo "<script>window.location.href='login.php';</script>";
                    exit;
                    
                } else {
                    
                    whenerror();
                    exit;
                    
                }
            }      
            
        }else{
            
            whenerror();
            exit;
            
        } 
    }
?>
<style>
.gradient-custom {
    /* fallback for old browsers */
    background: #6a11cb;

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
}
</style>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-black" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-2 md-4 pb-3 ">

                            <h2 class="fw-bold mb-2 text-uppercase text-white">Register</h2>
                            <p class="text-white-50 mb-3">Please enter email and password!</p>
                            <form method="post" action="">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="register_fname" id="register_fname"
                                        placeholder="First name" required>
                                    <label for="floatingInput">First name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="register_lname" id="register_lname"
                                        placeholder="Last name" required>
                                    <label for="floatingInput">Last name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="register_username"
                                        id="register_username" placeholder="Username" minlength="6" required>
                                    <label for="floatingInput">Username</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" name="register_password"
                                        id="register_password" placeholder="Password"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="a-Z ต้องมีตัวพิมพ์ใหญ่ ตัวพิมพ์เล็กและตัวเลข(อย่างน้อย 8 ตัวอักษร)"
                                        required>
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <input type="hidden" name="action" value="register">
                                <button class=" fw-bold btn btn-outline-light btn-lg px-5" id="submit_register"
                                    type="submit">Register</button>
                            </form>

                        </div>
                        <div class="mb-0">
                            <p class="mb-0 text-white">I have an account &nbsp;<a href="login.php"
                                    class="text-danger fw-bold">Back to Login</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
include("../inc/footer.php");
?>