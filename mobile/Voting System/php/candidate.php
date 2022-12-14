<?php
include 'connection.php';
session_start();
if (isset($_POST['submit'])) {
    $cname = $_POST['fname'] . ' ' . $_POST['mname'] . ' ' . $_POST['lname'];
    $cno = $_POST['cno'];
    $cage = $_POST['cage'];
    $cgender = $_POST['cgender'];
    $course = $_POST['course'];
    $cposition = $_POST['cpositions'];
    $cpartylist = $_POST['cpartylist'];
    $votingstatus = 0;
    $cname = mysqli_real_escape_string($conn, $cname);
    $cno = mysqli_real_escape_string($conn, $cno);
    $cage = mysqli_real_escape_string($conn, $cage);
    $cgender = mysqli_real_escape_string($conn, $cgender);
    $course = mysqli_real_escape_string($conn, $course);
    $cposition = mysqli_real_escape_string($conn, $cposition);
    $cpartylist = mysqli_real_escape_string($conn, $cpartylist);
    if (($_FILES['my_file']['name'] != "")) {
        // Where the file is going to be stored
        $target_dir = "\\src\\candidate\\" . $cposition . "\\" . $cname;
        $file = $_FILES['my_file']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['my_file']['tmp_name'];
        $path_filename_ext = $target_dir . "." . $ext;
        $fileurl = $cname . '.' . $ext;
        // Check if file already exists
        if (file_exists($path_filename_ext)) {
            echo "Sorry, file already exists.";
        } else {
            move_uploaded_file($temp_name, $path_filename_ext);
            echo "Congratulations! File Uploaded Successfully.";
        }
    }

    $insertquery = "INSERT into candidate(candidatename, candidatestudentnumber, candidateage, candidategender, candidatecourse, candidateposition, candidatepartylist, candidatepicture) values ('$cname', '$cno', '$cage', '$cgender', '$course', '$cposition', '$cpartylist', '$fileurl')";
    $performquery = mysqli_query($conn, $insertquery);
    if ($performquery) {
        header('Location: candidate.php');
    } else {
        echo "error";
    }
    $insertpartylist = "INSERT INTO listpartylist(partylist) values ('$cpartylist')";
    $performquery = mysqli_query($conn, $insertpartylist);
    switch ($_POST['cpositions']) {
        case 'President':
            $insertcandidate = "INSERT into president(pres_no, pres_name, votes, partylist) values ('$cno','$cname', '0', '$cpartylist')";
            $inscan = mysqli_query($conn, $insertcandidate);
            break;
        case 'Vice President - Internal':
            $insertcandidate = "INSERT into vpresi(vpresi_no, vpresi_name, votes, partylist) values ('$cno','$cname', '0', '$cpartylist')";
            $inscan = mysqli_query($conn, $insertcandidate);
            break;
        case 'Vice President - External':
            $insertcandidate = "INSERT into vprese(vprese_no, vprese_name, votes, partylist) values ('$cno','$cname', '0', '$cpartylist')";
            $inscan = mysqli_query($conn, $insertcandidate);
            break;
        case 'General Secretary':
            $insertcandidate = "INSERT into gensec(gensec_no, gensec_name, votes, partylist) values ('$cno','$cname', '0', '$cpartylist')";
            $inscan = mysqli_query($conn, $insertcandidate);
            break;
        case 'Deputy Secretary':
            $insertcandidate = "INSERT into depsec(depsec_no, depsec_name, votes, partylist) values ('$cno','$cname', '0', '$cpartylist')";
            $inscan = mysqli_query($conn, $insertcandidate);
            break;
        case 'Treasurer':
            $insertcandidate = "INSERT into trea(trea_no, trea_name, votes, partylist) values ('$cno','$cname', '0', '$cpartylist')";
            $inscan = mysqli_query($conn, $insertcandidate);
            break;
        case 'Auditor':
            $insertcandidate = "INSERT into audi(audi_no, audi_name, votes, partylist) values ('$cno','$cname', '0', '$cpartylist')";
            $inscan = mysqli_query($conn, $insertcandidate);
            break;
        case 'Public Information Officer - Male':
            $insertcandidate = "INSERT into piom(piom_no, piom_name, votes, partylist) values ('$cno','$cname', '0', '$cpartylist')";
            $inscan = mysqli_query($conn, $insertcandidate);
            break;
        case 'Public Information Officer - Female':
            $insertcandidate = "INSERT into piof(piof_no, piof_name, votes, partylist) values ('$cno','$cname', '0', '$cpartylist')";
            $inscan = mysqli_query($conn, $insertcandidate);
            break;
        default:
            echo '<p>Nope</p>';
    }
}

$partylistquery = "SELECT DISTINCT partylist FROM listpartylist";
$result = mysqli_query($conn, $partylistquery);
if ($result) {
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Voting System/stylesheets/candidate.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Candidate</title>
</head>
<style>
    :required::after {
        content: "*";
        color: red;
    }
</style>

<body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function addlist() {
            var addlist = document.getElementById("list"),
                textValue = document.getElementById("addpartylist").value,
                newPartylist = document.createElement("OPTION"),
                newPartylistv = document.createTextNode(textValue);

            newPartylist.appendChild(newPartylistv);
            addlist.insertBefore(newPartylist, addlist.lastChild);
            document.getElementById("addpartylist").value = "";
        }
    </script>
    <div class="topnav w-100 py-0 px-0">
        <div class="row pt-2 mt-3 g-0">
            <div class="col-1 d-flex justify-content-end">
                <img src="/src//cict.png" class="img">
            </div>
            <div class="col-9 px-0">
                <h2>Taguig City University</h1>
                    <h4>College of Information Communication and Technology Admin Portal</h3>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-center px-0">
                <div class="col-2">
                    <h3 class="adminname mx-0 my-0"><?php echo $_SESSION['adminuser']; ?></h3>
                </div>
                <div class="col-3">
                    <div class="adminlogo mx-0 my-0">
                        <img src="" alt="" class="logo">
                    </div>
                </div>
            </div>
        </div>
        <div class="row flex-row g-0">
            <ul class="d-flex justify-content-around my-0 mx-0">
                <li><a href="dashboard.php" style="text-decoration: none; color: black">Dashboard</a></li>
                <li><a href="voter.php" style="text-decoration: none; color: black">Voter's List</a></li>
                <li class="act"><button class="actbtn">Candidates</button></li>
            </ul>
        </div>
    </div>


    <div class="title">
        <p>

        </p>
    </div>

    </div>

    <div class="row g-0 d-flex justify-content-center">
        <div class="col-7">
            <div class="list">
                <div class="toplist">
                    <div class="row">
                        <div class="col">
                            <input type="text" placeholder="ex: xx-xxxxx" class="d-flex justify-content-start mx-3 ">
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button class="btn btn-sm mx-2 px-5" id="a">Find</button>
                            <button class="btn btn-sm mx-2 px-5" id="b">Sort</button>
                            <button type="button" class="btn btn-sm mx-2 px-5 " id="c" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Add
                            </button>
                        </div>
                    </div>
                </div>

                <div class="tablelist table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Student Number</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Course</th>
                                <th>Position</th>
                                <th>Partylist</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'connection.php';
                            $filltable = "SELECT * FROM candidate";
                            $fill = mysqli_query($conn, $filltable);
                            while ($getrow = mysqli_fetch_array($fill)) {
                                echo '
                                <tr>
                                    <td>' . $getrow["candidatename"] . '</td>
                                    <td>' . $getrow["candidatestudentnumber"] . '</td>
                                    <td>' . $getrow["candidateage"] . '</td>
                                    <td>' . $getrow["candidategender"] . '</td>
                                    <td>' . $getrow["candidatecourse"] . '</td>
                                    <td>' . $getrow["candidateposition"] . '</td>
                                    <td>' . $getrow["candidatepartylist"] . '</td>
                                </tr>
                                ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4 my-3 px-1">
            <div class="vgraph">
                <form method="post">
                    <select class="form-select" name="list" id="">
                        <option value="" disabled selected>Select partylist</option>
                        <?php
                        foreach ($options as $option) {
                        ?>
                            <option value="<?php echo $option['partylist']; ?>"><?php echo $option['partylist']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </form>
                <canvas id="partylist" width="20%" height="20%"></canvas>
                <script>
                    const partylistlabel = ['President',
                        'Vice President - Internal',
                        'Vice President - External',
                        'General Secretary',
                        'Deputy Secretary',
                        'Treasurer',
                        'Auditor',
                        'Public Information Officer - Male',
                        'Public Information Officer - Female'
                    ];
                    const data = {
                        labels: partylistlabel,
                        datasets: [{
                            axis: 'y',
                            label: 'asd',
                            data: [10, 20, 30, 40, 50, 60, 70],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)'

                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)'
                            ],
                            borderWidth: 1
                        }]
                    };
                    const config = {
                        type: 'bar',
                        data: data,
                        options: {
                            indexAxis: 'y',
                            scales: {
                                x: {
                                    beginAtZero: true
                                }
                            }
                        },
                    };
                    const cookiechart = new Chart(document.getElementById('partylist'), config);
                </script>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="staticBackdropLabel">Add Candidate</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lname" required>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="fname" required>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" name="mname" required>
                                </div>
                            </div>

                            <label class="form-label">Age</label>
                            <input type="text" class="form-control" name="cage">

                            <input type="radio" name="cgender" class="form-check-input" value="Male" required>Male
                            <input type="radio" name="cgender" class="form-check-input" style="margin-left: 15px;" value="Female" required>Female </br>

                            <label class="form-label">Student Number</label>
                            <input type="text" class="form-control" name="cno" required>

                            <label class="form-label">Course</label>
                            <input type="text" class="form-control" name="course" required>

                            <label class="form-label">Position</label>
                            <select class="form-select" name="cpositions" required>
                                <option value="President">President</option>
                                <option value="Vice President - Internal">Vice President - Internal</option>
                                <option value="Vice President - External">Vice President - External</option>
                                <option value="General Secretary">General Secretary</option>
                                <option value="Deputy Secretary">Deputy Secretary</option>
                                <option value="Treasurer">Treasurer</option>
                                <option value="Auditor">Auditor</option>
                                <option value="Public Information Officer - Male">Public Information Officer - Male</option>
                                <option value="Public Information Officer - Female">Public Information Officer - Female</option>
                            </select>
                            <div class="row g-0 justify-content-between">
                                <div class="col-5">
                                    <label class="form-label">Partylist</label>
                                    <select class="form-select" name="cpartylist" id="list" required>
                                        <option value="" disabled selected>Select partylist</option>
                                        <?php
                                        foreach ($options as $option) {
                                        ?>
                                            <option value="<?php echo $option['partylist']; ?>"><?php echo $option['partylist']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Add Partylist</label>
                                    <input type="text" class="form-control" name="addpartylist" id="addpartylist">
                                </div>
                                <div class="col-2 d-flex align-self-end">
                                    <button type="button" class="btn btn-primary" onclick="addlist();" formnovalidate>Add Partylist</button>
                                </div>
                            </div>
                            <label class="form-label">Upload Picture</label>
                            <input class="form-control" type="file" name="my_file" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button>Apply</button>
                        <button type="submit" name="submit" data-bs-dismiss="modal">Save</button><br>
                        <button>Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>