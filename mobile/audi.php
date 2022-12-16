<?php
include('connection.php');
include('status.php');
if (!session_start()) {
    session_start();
} else {
    if (isset($_SESSION['stno'])) {
        $sno = $_SESSION['stno'];
        $getvotequery = "SELECT votedaudi FROM studentvote WHERE sno = '$sno'";
        $vote = mysqli_query($conn, $getvotequery);
        $data = mysqli_fetch_array($vote);
        $status = $data['votedaudi'];
        if ($status == 0) {
            if (isset($_POST['voteaudi'])) {
                $id = $_POST['voteaudi'];
                $votequery = "SELECT votes FROM audi WHERE audi_no = '$id'";
                $vote = mysqli_query($conn, $votequery);
                $data = mysqli_fetch_array($vote);
                $getvote = $data['votes'];
                $getvote = $getvote + 1;
                $updatevote = "UPDATE audi SET votes = '$getvote' WHERE audi_no = '$id'";
                mysqli_query($conn, $updatevote);
                $updatestudent = "UPDATE studentvote SET votedaudi = '$id' WHERE sno = '$sno'";
                mysqli_query($conn, $updatestudent);
                header('Location: piom.php');
                exit;
            }
        } else {
            header('Location: piom.php');
            exit;
        }
    } else {
        header('Location: dashboard.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/vote.css">
    <title>Document</title>
</head>

<body>
    <script>
        function toggleMobileMenu(menu) {
            menu.classList.toggle('open');
        }
    </script>
    <header>
        <div class="top g-0 py-0">
            <div class="logo">
                <img src="/src/cict.png" class="icon">
            </div>
            <div class="name">
                <p class="schoolname">Taguig City University</p>
                <p class="webname">Computer Science Voting Portal</p>
            </div>
            <div id="hamburger-icon" onclick="toggleMobileMenu(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
                <ul class="mobile-menu">
                    <li><a href="dashboard.php">Home</a></li>
                    <li><a href="president.php">President</a></li>
                    <li><a href="vpresi.php">VP - Internal</a></li>
                    <li><a href="vprese.php">VP - External</a></li>
                    <li><a href="gensec.php">General Secretary</a></li>
                    <li><a href="depsec.php">Deputy Secretary</a></li>
                    <li><a href="trea.php">Treasurer</a></li>
                    <li><a href="audi.php">Auditor</a></li>
                    <li><a href="piom.php">PIO - Male</a></li>
                    <li><a href="piof.php">PIO - Female</a></li>
                    <li><a href="report.php">Report</a></li>
                    <li><a href="">Voter's Count</a></li>
                    <li><a href="studentsettings.php">Settings</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>

    </header><br>
    <div>
        <?php
        include('connection.php');
        $countquery = "SELECT * FROM candidate WHERE candidateposition = 'Auditor'";
        $countres = mysqli_query($conn, $countquery);
        while ($getrow = mysqli_fetch_array($countres)) {
            $cname = $getrow["candidatename"];
            $cpos = $getrow["candidateposition"];
            $cstno = $getrow["candidatestudentnumber"];
            $cpartylist = $getrow["candidatepartylist"];
            $imageurl = $getrow["candidatepicture"];
            echo    '<form method = "post">
                        <div class="row pb-3 ml-4 mr-0">
                            <div class="col-11 card text-center" style="width: 18rem;">
                                    <img src="src/candidate/Auditor/' . $imageurl . '" class="card-img-top py-3 rounded-circle" alt="...">
                                    <div class="card-body-lg py-0 px-0">
                                        <p class="card-text">' . $cname . '</p>
                                        <p class="text-secondary">' . $cpos . '</p>
                                        <p class="text-secondary">' . $cpartylist . '</p>
                                        <button class="btn btn-primary mb-2" type="submit" name = "voteaudi" value = "' . $cstno . '" >Vote ' . $cname . ' </button>
                                    </div>
                                </div>
                            </div>
                        </form>';
        }
        ?>
    </div>

</body>


</html>