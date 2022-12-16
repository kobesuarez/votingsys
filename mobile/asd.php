<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <button class="btn btn-primary" type="button" data-bs-target="#myModal" data-bs-toggle="modal">Open First Modal</button>

        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">First Modal</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
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
                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#secondModal">Submit</button>

                                    </div>
                                </div>
                                <label class="form-label">Upload Picture</label>
                                <input class="form-control" type="file" name="my_file" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#secondModal" data-bs-dismiss="modal">Submit</button>
                        <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="secondModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header alert alert-success">
                        <h5 class="modal-title">Second Modal</h5>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#myModal" data-bs-dismiss="modal" onclick="addlist();" formnovalidate>Add Partylist</button>
                    </div>
                    <div class="modal-body">
                        <p>Message Received</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>