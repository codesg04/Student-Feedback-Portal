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

    <title>Show Faculty</title>
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
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'student') {
        session_unset();
        session_destroy();
        echo "<script> alert('You are not authorised to this page'); window.location.replace('../../')</script>";
    }
    ?>
    <?php
    require('../../../php/connection.php');
    $sql = "select * from takes where ID='" . $_SESSION['id'] . "'";
    $result = mysqli_query($con, $sql);
    $arr = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        array_push($arr, $row);
    }
    $var = json_encode($arr);
    echo "<script>var data=$var</script>";
    ?>
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
            <li class="breadcrumb-item" style="text-decoration: none;"><a href="login_admin.html">Log In</a></li>
            <li class="breadcrumb-item" style="text-decoration: none;"><a href="../">Admin</a></li>
            <li class="breadcrumb-item" style="text-decoration: none;"" aria-current=" page"><a href="../view_faculty/">View Faculty</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Faculty</li>
        </ol>
    </nav>
    <div id="top" class='table-responsive'>
        <form action="../../../php/admin/view_faculty/add_faculty.php" method="POST" style="display:grid;width: 100%;" id="FORM">
            <h2 style="padding:3%;">Give Feedback</h2>
            <div class="mb-3">
                <div class="mb-3" style="padding:3%;">
                    <label for="ID" class="form-label">Your ID:</label>
                    <input type="text" id="ID" name="ID" required class="form-control-plaintext" readonly placeholder="<?php echo $_SESSION['username']; ?>" value='<?php echo $_SESSION['username']; ?>'>
                </div>
                <div>
                    <label for="course_id" class="form-label">Choose the Course</label>
                    <select class="form-select" aria-label="Default select example" id="course_id" required onfocus="this.selectedIndex = -1;empty(sec_id);empty(semester);"></select>
                </div>
                <div class="mb-3" style="padding:3%;">
                    <label for="sec_id" class="form-label">Choose the Sec_id</label>
                    <select class="form-select" aria-label="Default select example" id="sec_id" required onfocus="this.selectedIndex = -1;empty(semester);">
                    </select>
                </div>
                <div class="mb-3" style="padding:3%;">
                    <label for="semester" class="form-label">Choose the Semester</label>
                    <select class="form-select" aria-label="Default select example" id="semester" required onfocus="this.selectedIndex = -1;">
                    </select>
                </div>
                <div class="mb-3" style="padding:3%;">
                    <label for="comment" class="form-label">Comments</label>
                    <textarea class="form-control" id="comment" required></textarea>
                </div>
                <input type="submit" name="submit" value="Submit" class='btn btn-primary' style="padding:3%;">
            </div>
        </form>
    </div>
    <script>
        var course_id = document.getElementById('course_id');
        var sec_id = document.getElementById('sec_id');
        var semester = document.getElementById('semester');
        for (var key in data) {
            var temp_child = (document.createElement('option'));
            temp_child.setAttribute('value', data[key].course_id);
            temp_child.setAttribute('selected', false);
            temp_child.appendChild(document.createTextNode(data[key].course_id));
            course_id.appendChild(temp_child);
        }

        function empty(node) {
            while (node.firstChild) {
                node.removeChild(node.lastChild);
            }
        }
        course_id.addEventListener('change', () => {
            console.log(1);
            empty(sec_id);
            empty(semester);
            for (var key in data) {
                if (data[key].course_id == course_id.options[course_id.selectedIndex].text) {
                    var temp_child = (document.createElement('option'));
                    temp_child.setAttribute('value', data[key].sec_id);
                    temp_child.appendChild(document.createTextNode(data[key].sec_id));
                    sec_id.appendChild(temp_child);
                }
            }
        })
        sec_id.addEventListener('change', () => {
            empty(semester);
            for (var key in data) {
                if (data[key].course_id == course_id.options[course_id.selectedIndex].text &&
                    data[key].sec_id == sec_id.options[sec_id.selectedIndex].text) {
                    var temp_child = (document.createElement('option'));
                    temp_child.setAttribute('value', data[key].semester);
                    temp_child.appendChild(document.createTextNode(data[key].semester));
                    semester.appendChild(temp_child);
                }
            }
        })
    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>