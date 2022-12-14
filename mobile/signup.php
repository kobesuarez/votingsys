<?php
include('connection.php');
$password = "";
$cpassword = "";
$errmsg = "";
if (!isset($password)) {
    $password = $_POST['password'];
}
if (!isset($cpassword)) {
    $cpassword = $_POST['cpassword'];
}
if (strcmp($password, $cpassword) == 0) {
    if (isset($_POST['signup'])) {
        $sname = $_POST['fname'] . ' ' . $_POST['mname'] . ' ' . $_POST['lname'];
        $sno = $_POST['sno'];
        $smail = $_POST['smail'];
        $syear = $_POST['syear'];
        $ssection = $_POST['ssection'];
        $scno = $_POST['scno'];
        $spassword = $_POST['password'];
        $votingstatus = 0;
        $sname = mysqli_real_escape_string($conn, $sname);
        $sno = mysqli_real_escape_string($conn, $sno);
        $smail = mysqli_real_escape_string($conn, $smail);
        $syear = mysqli_real_escape_string($conn, $syear);
        $ssection = mysqli_real_escape_string($conn, $ssection);
        $scno = mysqli_real_escape_string($conn, $scno);
        $spassword = mysqli_real_escape_string($conn, $spassword);
        $insertquery = "insert into studentlist(studentname, studentnumber, studentemail, studentyear, studentsection, studentcontactnumber, studentpassword) values ('$sname', '$sno', '$smail', '$syear', '$ssection', '$scno', '$spassword')";
        $performquery = mysqli_query($conn, $insertquery);
        if ($performquery) {
            $vinsertquery = "insert into studentvote(sno, votedpres, votedvpresi, votedvprese, votedgs, votedds, votedtrea, votedaudi, votedpiom, votedpiof) values ('$sno', '$votingstatus', '$votingstatus', '$votingstatus', '$votingstatus', '$votingstatus', '$votingstatus', '$votingstatus', '$votingstatus', '$votingstatus')";
            $vperformquery = mysqli_query($conn, $vinsertquery);
            if ($vperformquery) {
                echo "form updated";
                header('Location: login.php');
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }
} else {
    $errmsg = "Password Doesn't match.";
}

if (isset($_POST['login'])) {
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/signup.css">
    <title>Sign Up</title>
</head>

<body>
    <div class="top">
        <div class="logo">
            <img src="/src/cict.png" class="icon">
        </div>
        <div class="name">
            <p class="webname">Computer Science Voting Portal</p>
            <p class="schoolname">Taguig City University</p>
        </div>
    </div>
    <form method="post">
        <p>First Name</p>
        <input type="text" name="fname" class="signtext w-100" required>
        <p>Middle Name</p>
        <input type="text" name="mname" class="signtext w-100" required>
        <p>Last Name</p>
        <input type="text" name="lname" class="signtext w-100" required>
        <p>Student Number</p>
        <input type="text" name="sno" class="signtext w-100" required>
        <p>E-mail</p>
        <input type="email" name="smail" class="signtext w-100" required>
        <p>Year</p>
        <select class="form-select w-100" name="syear" required>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
        </select>
        <p>Section</p>
        <input type="text" name="ssection" class="signtext" required>
        <p>Contact Number</p>
        <input type="text" name="scno" class="signtext" required>
        <p>Password</p>
        <input type="password" name="password" class="signtext" required>
        <p>Confirm Password</p>
        <input type="password" name="cpassword" class="signtext" required><br><br>
        <p class="text-danger"><?php echo $errmsg; ?></p>
        <div class="btns">
            <button type="button" name='signup' class="signup">Sign Up</button>
            <div class="sep">
                <button type="submit" name='login' class="login">Log in</button>
            </div>
        </div>
        <br><br>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>