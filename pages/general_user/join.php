<?php
session_start();
include '../sqlCommands/connectDb.php';
include 'main.php';
include 'room.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shuttle Service</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/shuttle.css">

    <!-- Bootstrap CSS links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="assets/img/Logo.png">


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>


    <!-- Custom Styles -->
    <style>
    /* Your custom styles here */

    /* Center the container */
    .shuttle-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Customize shuttle list styles */
    .shuttle-list {
        width: 80%;
        margin-top: 20px;
    }

    .shuttle-card {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
    }

    .shuttle-card h4 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .shuttle-card p {
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
    }

    .shuttle-card p.map-link {
        color: #007bff;
    }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg bg-light fixed-top shadow-sm p-3 bg-white">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="#">
                <img src="img/logo.png" alt="" width="100">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="mainPage.php"> <i class="fa-solid fa-home-user"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="club_forum.php"><i class="fa-solid fa-people-group"></i> Club/Forum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="join.php"> <i class="fa-solid fa-comment-dots"></i> Joined</a>
                    </li>
                
                    <li class="nav-item">
                        <div class="dropdown">
                            <?php if ($gender == "Female") {?>
                            <img class="dropdown-toggle pro" src="../../img/Female.png" alt="img"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php } ?>
                            <?php if ($gender == "Male") { ?>
                            <img class="dropdown-toggle pro" src="../../img/man.png" alt="img" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <?php } ?>
                            <?php if ($gender != "Male" && $gender != "Female") { ?>
                            <img class="dropdown-toggle pro"
                                src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" alt="img"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php } ?>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="profile.php"><i class="fa-solid fa-user"></i> My
                                        Profile</a></li>
                                <li><a class="dropdown-item"
                                        onclick="cpass('<?php echo $_SESSION['email']?>', '<?php echo $pass; ?>')"><i
                                            class="fa-solid fa-key"></i> Change Password</a></li>
                                <li><a class="dropdown-item" href="logout.php"><i
                                            class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Shuttle Container -->
    <div class="container py-5 shuttle-container" style = "margin : 100px" >
        <div class="shuttle-list">
            <!-- Shuttle Card - Replace with dynamic data -->

            <!-- <?php
            $r = "SELECT * FROM `shuttle_add` where capacity > 0 ";
            $result = mysqli_query($sql, $r);
            if (mysqli_num_rows($result) > 0) {
            while ($post_row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="shuttle-card">
                <h4>Shuttle Name : <?php echo $post_row['busname'] ?></h4>
                <p>Source : <?php echo $post_row['source'] ?> -> Destination : <?php echo $post_row['destination'] ?>  
                <br>Time : <?php echo $post_row['time'] ?>
                <br>Capacity : <?php echo $post_row['capacity'] ?> 
                </p>
                <p class="map-link"><i class="fas fa-map-marker-alt mr-1"></i><a href="viewMap.php">View Map</a></p>
            </div>
            <?php
             }
           }?> -->




            <!-- joined -->
            <?php if (mysqli_num_rows($joined_q) == 0) : ?>
                    <h2 class="text-center">Please join a forum discussion room first</h2>
                <?php else : ?>
                    <?php while ($a_row = mysqli_fetch_assoc($joined_q)) : ?>
                        <div class="card w-50 m-auto mt-3 pt-2">
                            <div class="card-title text-center text-uppercase fw-bold"><?php echo $a_row["forum_name"]; ?></div>
                            <div class="card-body">
                                <form action="chat.php" class="d-flex flex-column justify-content-center align-items-center" method="post">
                                    <input type="hidden" name="joined_room" <?php echo "value='{$a_row["id"]}'" ?>>
                                    <input type="hidden" name="forum" <?php echo "value='{$a_row["forum_name"]}'" ?>>
                                    <div>
                                        <button class="btn btn-uiu" type="submit">Go</button>
                                        <a <?php echo "href='leaveForum.php?delete_forum={$a_row["id"]}'" ?> class="btn btn-uiu text-uppercase">
                                            Leave
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endwhile ?>
                <?php endif ?>


            <!-- Add more shuttle cards here -->
        </div>
    </div>





    <!-- Include necessary scripts and libraries here -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/all.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>