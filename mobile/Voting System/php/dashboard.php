<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['adminuser']) || !isset($_SESSION['adminpass'])) {
    header('Location: admin.php');
    exit;
}
$voted = "SELECT * from studentvote Where vstatus = 'Voted'";
$notvoted = "SELECT * from studentvote Where vstatus = 'Not Voted'";

$res = mysqli_query($conn, $voted);
$votedcount = mysqli_num_rows($res);

$res = mysqli_query($conn, $notvoted);
$notvotedcount = mysqli_num_rows($res);

$leadingq = "SELECT * FROM president ORDER BY votes DESC LIMIT 3";
$countres = mysqli_query($conn, $leadingq);
$count = array();

while ($getrow = mysqli_fetch_array($countres)) {
    $count[] = $getrow["votes"];
}
$selectquery = "select MAX(votes) from president";
$res = mysqli_query($conn, $selectquery);
$data = mysqli_fetch_array($res);
$cpresvote = $data['MAX(votes)'];

$selectquery = "select MAX(votes) from vpresi";
$res = mysqli_query($conn, $selectquery);
$data = mysqli_fetch_array($res);
$cvpresivote = $data['MAX(votes)'];

$selectquery = "select MAX(votes) from vprese";
$res = mysqli_query($conn, $selectquery);
$data = mysqli_fetch_array($res);
$cvpresevote = $data['MAX(votes)'];

$selectquery = "select MAX(votes) from gensec";
$res = mysqli_query($conn, $selectquery);
$data = mysqli_fetch_array($res);
$cgensecvote = $data['MAX(votes)'];

$selectquery = "select MAX(votes) from depsec";
$res = mysqli_query($conn, $selectquery);
$data = mysqli_fetch_array($res);
$cdepsecvote = $data['MAX(votes)'];

$selectquery = "select MAX(votes) from trea";
$res = mysqli_query($conn, $selectquery);
$data = mysqli_fetch_array($res);
$ctreavote = $data['MAX(votes)'];

$selectquery = "select MAX(votes) from audi";
$res = mysqli_query($conn, $selectquery);
$data = mysqli_fetch_array($res);
$caudivote = $data['MAX(votes)'];

$selectquery = "select MAX(votes) from piom";
$res = mysqli_query($conn, $selectquery);
$data = mysqli_fetch_array($res);
$cpiomvote = $data['MAX(votes)'];

$selectquery = "select MAX(votes) from piof";
$res = mysqli_query($conn, $selectquery);
$data = mysqli_fetch_array($res);
$cpiofvote = $data['MAX(votes)'];

$year1 = "SELECT * from studentlist WHERE studentyear = '1st Year'";
$year2 = "SELECT * from studentlist WHERE studentyear = '2nd Year'";
$year3 = "SELECT * from studentlist WHERE studentyear = '3rd Year'";
$year4 = "SELECT * from studentlist WHERE studentyear = '4th Year'";
if ($result = mysqli_query($conn, $year1)) {
    $year1row = mysqli_num_rows($result);
}
if ($result = mysqli_query($conn, $year2)) {
    $year2row = mysqli_num_rows($result);
}
if ($result = mysqli_query($conn, $year3)) {
    $year3row = mysqli_num_rows($result);
}
if ($result = mysqli_query($conn, $year4)) {
    $year4row = mysqli_num_rows($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Voting System/stylesheets/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Adminitrator</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <h3 class="adminname mx-0 my-0">Admin</h3>
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
                <li class="act"><button class="actbtn">Dashboard</button></li>
                <li><a href="voter.php" style="text-decoration: none; color: black">Voter's List</a></li>
                <li><a href="candidate.php" style="text-decoration: none; color: black">Candidates</a></li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row g-0">
            <div class="col-7 mx-3 my-3">
                <h4>Tally</h4>
                <div class="tally h-50 mb-2">
                    <div class="tablelist mx-2 table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Partylist</th>
                                    <th>Votes</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'connection.php';
                                $filltable = "SELECT `pres_name`, `pres_no`, `partylist`, `votes`, `votes` * 100 / t.s AS `Percentage` FROM president CROSS JOIN( SELECT SUM(`votes`) AS s FROM president ) t";
                                $fill = mysqli_query($conn, $filltable);
                                while ($getrow = mysqli_fetch_array($fill)) {
                                    echo '
                                <tr>
                                    <td>' . $getrow["pres_name"] . '</td>
                                    <td>' . $pos = "President" . '</td>
                                    <td>' . $getrow["partylist"] . '</td>
                                    <td>' . $getrow["votes"] . '</td>
                                    <td>' . $getrow["Percentage"] . '%' . '</td>
                                </tr>
                                ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h4>Leading votes per Position</h4>
                <div class="hgraph h-50">
                    <canvas id="partylist" width="700%" height="200%"></canvas>
                    <script>
                        const presvote = <?php echo json_encode($cpresvote);  ?>;
                        const vpresivote = <?php echo json_encode($cvpresivote);  ?>;
                        const vpresevote = <?php echo json_encode($cvpresevote);  ?>;
                        const gensecvote = <?php echo json_encode($cgensecvote);  ?>;
                        const depsecvote = <?php echo json_encode($cdepsecvote);  ?>;
                        const treavote = <?php echo json_encode($ctreavote);  ?>;
                        const audivote = <?php echo json_encode($caudivote);  ?>;
                        const piomvote = <?php echo json_encode($cpiomvote);  ?>;
                        const piofvote = <?php echo json_encode($cpiofvote);  ?>;
                        const data = {
                            labels: ['President', 'VP - Internal', 'VP - External', 'Gen. Sec.', 'Dep. Sec.', 'Treasurer', 'Auditor', 'PIO - Male', 'PIO - Female'],
                            datasets: [{
                                axis: 'x',
                                label: 'Leading Votes per Position',
                                data: [presvote, vpresivote, vpresevote, gensecvote, depsecvote, treavote, audivote, piomvote, piofvote],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(93, 155, 155, 0.2)',
                                    'rgba(100, 107, 099, 0.2)',
                                    'rgba(239, 169, 074, 0.2)',
                                    'rgba(037, 041, 074, 0.2)',
                                    'rgba(214, 174, 001, 0.2)'
                                ],
                                borderColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(089, 035, 033)',
                                    'rgb(096, 111, 140)',
                                    'rgb(193, 135, 107)',
                                    'rgb(037, 041, 074)',
                                    'rgb(091, 058, 041)'
                                ],
                                borderWidth: 1
                            }]
                        };
                        const config = {
                            type: 'bar',
                            data: data,
                            options: {
                                indexAxis: 'x',
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            },
                        };
                        const partylistbar = new Chart(document.getElementById('partylist'), config);
                    </script>
                </div>
            </div>
            <div class="col-2 mx-3 my-3">
                <h4>Year Level</h4>
                <div class="vgraph h-100">
                    <canvas id="yearlevelchart" width="50%" height="100%"></canvas>
                    <script>
                        const year1 = <?php echo json_encode($year1row);  ?>;
                        const year2 = <?php echo json_encode($year2row);  ?>;
                        const year3 = <?php echo json_encode($year3row);  ?>;
                        const year4 = <?php echo json_encode($year4row);  ?>;

                        const year = {
                            labels: ['1st Year', '2nd Year', '3rd Year', '4th Year'],
                            datasets: [{
                                label: 'Year Level',
                                data: [year1, year2, year3, year4],
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
                                    'rgb(75, 192, 192)'
                                ],
                                borderWidth: 1
                            }]
                        };
                        const dataconfig = {
                            type: 'bar',
                            data: year,
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            },
                        };
                        const cookiechart = new Chart(document.getElementById('yearlevelchart'), dataconfig);
                    </script>
                </div>
            </div>
            <div class="col-2 my-3 mx-3">
                <h4>Position</h4>
                <div class="position mb-2">
                    <canvas id="pos" width="250%" height="100%"></canvas>
                    <script>
                        const leadq = <?php echo json_encode($count);  ?>;
                        const lead = {
                            labels: [
                                '1st',
                                '2nd',
                                '3rd'
                            ],
                            datasets: [{
                                label: 'Top 3 Leading Votes',
                                data: leadq,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)'
                                ],
                                hoverOffset: 4
                            }]
                        };
                        const configpos = {
                            type: 'doughnut',
                            data: lead,
                        };
                        const pospie = new Chart(document.getElementById('pos'), configpos);
                    </script>
                </div>
                <h4>Voter's Status</h4>
                <div class="voters">
                    <canvas id="status" width="250%" height="100%"></canvas>
                    <script>
                        const votedcount = <?php echo json_encode($votedcount);  ?>;
                        const notcount = <?php echo json_encode($notvotedcount);  ?>;
                        const count = {
                            labels: [
                                'Voted',
                                'Not Voted'
                            ],
                            datasets: [{
                                label: 'Count',
                                data: [votedcount, notcount],
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 205, 86)'
                                ],
                                hoverOffset: 4
                            }]
                        };
                        const configstatus = {
                            type: 'doughnut',
                            data: count,
                        };
                        const statuspie = new Chart(document.getElementById('status'), configstatus);
                    </script>
                </div>
            </div>
        </div>
</body>

</html>