<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="../../../images/iiita_logo.png">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../css/style.css">
    <!-- Bootstrap CSS -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.min.js"></script>
    <title>Add Student</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        session_unset();
        session_destroy();
        echo "
        <script>
        function logout() {
            alert('You have been logged in for more than 30 minutes, Timeout!');
            window.location.replace('http://localhost/DBMS-Project/');
        };
        logout();
        </script>";
    }
    ?>
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'faculty') : echo "<script> alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
    endif; ?>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../../"><img src="../../../images/iiita_logo.png" alt="" width="100px" height="100px" class="d-inline-block align-text-middle"></a>
            <div class="new">
                <a class="navbar-text">
                    Welcome to Student Feedback Portal
                </a>
            </div>
            <a href="../../../php/logout.php"><button type="button" class="btn btn-primary" id="liveAlertn" style="margin-bottom: 1%;margin-left: -20%;">Logout</button></a>
        </div>
    </nav>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="text-decoration: none;"><a href="../../../">Home</a></li>
            <li class="breadcrumb-item" style="text-decoration: none;"><a href="../login.php">Log In</a></li>
            <li class="breadcrumb-item" style="text-decoration: none;"><a href="../"><?php echo ($_SESSION['id']) ?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Students</li>
        </ol>
    </nav>
    <div id="top" class='table-responsive' style="display:flow-root">
        <h2>Add student</h2>
        <form action="../../../php/faculty/add_student/add_student.php" method="POST" enctype="multipart/form-data" style="display:grid;width:100%;" id="FORM">
            <div class="mb-3">
                <br>
                <label for="ID" class="form-label">Enter the student to add:</label>
                <input type="text" id="ID" name="ID" required class="form-control" placeholder="ID Example: IIT2021155">
                <input type="text" id="sec" name="sec" required class="form-control" placeholder="SECTION Example: B">
                <input type="text" id="course" name="course" required class="form-control" placeholder="COURSE Example: DBMS">
                <input type="number" id="semes" name="semes" required class="form-control" placeholder="SEMESTER Example: 4" min="1" max="8">
                <input type="submit" name="submit_add_single" id='submit_add_single' value="Submit" class='btn btn-primary'>
            </div>
        </form>
        <br>
        <label for="csvfile" class="form-label">Or Upload CSV file for mass add:</label>
        <input type="file" id="csvfile" name="csvfile" required class="form-control" accept=".csv,.xlsx">
        <form action="../../../php/faculty/add_student/add_student.php" method="POST" enctype="multipart/form-data" style="display:grid;width:100%;" id="FORM">
            <div class="mb-3">
                <input type="text" id="sec" name="sec" required class="form-control" placeholder="SECTION Example: B">
                <input type="text" id="course" name="course" required class="form-control" placeholder="COURSE Example: DBMS">
                <input type="number" id="semes" name="semes" required class="form-control" placeholder="SEMESTER Example: 4" min="1" max="8">
                <input type='hidden' name='file_data' id='file_data'>
                <input type="submit" name="submit2" id='submit2' value="Submit" disabled='true' class='btn btn-primary'>
            </div>
        </form>
    </div>

    <script src='../../../js/faculty/add_student.js'></script>
    <!-- Optional JavaScript; choose one of the two! 
        -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>