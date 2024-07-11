<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
    include 'partial/_header.php'; // Include the header file
    ?>
    <?php
    include 'partial/_dbconnected.php'; // Include the data base file
    ?>

    <div class="container-fluid m-0 p-0">
        <!-- slider -->
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/bg-1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/bg-2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/bg-3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- category container start here -->
        <div class="container my-3">
            <h2 class="text-center my-3">iDiscuss - Browse Categories</h2>

            <!-- use a for loop to iterate the categories -->

            <div class="row my-3">
                <!-- fetch all the categories -->
                <?php
                $sql = "SELECT * FROM `categories`";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    //echo $row['category_id'];
                    $id = $row['category_id'];
                    $cat = $row['category_name'];
                    $desc = $row['category_description'];
                    echo '  <div class="col-md-4">
                    <div class="card my-2" style="width: 18rem;">
                        <img src="images/bg-1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href = "threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                            <p class="card-text">'.substr($desc,0,90).'...</p>
                            <a href = "threadlist.php?catid='.$id.'"     class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';

                }
                ?>

            </div>
        </div>

    </div>
    <?php include 'partial/_footer.php'; ?>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>