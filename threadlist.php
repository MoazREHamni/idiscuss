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
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $id ";
    $result = mysqli_query($conn, $sql);




    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row["category_name"];
        $catdesc = $row["category_description"];
    }
    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        //insert into thread into DB
        $th_title = $_POST["title"];
        $th_desc = $_POST["desc"];
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added! wait for someone responed.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    ?>

    <div class="container my-4 p-0 ">
        <div class="p-5 mb-4 bg-light rounded-3">
            <h1 class="display-4 ">Welcome To <?php echo $catname; ?> Forums</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum.<br>
                "Respect others and stay on topic. No spam, hate speech, illegal stuff, or personal attacks."


            </p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <?php 
         if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
echo ' 
 <div class="container">
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible.</div>
            </div>
              <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Elaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary my-2">Submit</button>
        </form>
    </div>';}
    else{
        echo '<div class="container p-0">
    <p class="fs-2 p-3 bg-light ">You can only ask Question if you are logged in </p>
</div>';
    }
?>

    <div class="container">
        <h1 class="py-2">Browse Question</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id ";
        $result = mysqli_query($conn, $sql);
        $noResult = true;

        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row["thread_id"];
            $title = $row["thread_title"];
            $desc = $row["thread_desc"];
            $thread_time = $row["timestamp"];
            $thread_user_id = $row["thread_user_id"];
            $sql2 = "SELECT user_email FROM `users`WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '
            <div class="container">
                <div class="media d-flex align-items-start  my-3">
                    <img src="images/user.png" width="50px" class="mr-3 mx-2" alt="Image">
                    <div class="media-body">
                        <h5 class="mt-0"><a class="text-dark text-decoration-none" href="threads.php?threadid=' . $id . '">' . $title . '</a></h5>
                        <p>' . $desc . '.</p>
                        </div>
                        <p class="font-weight-bold mx-5 my-0"> Asked by ' . $row2['user_email'] . ' at ' . $thread_time . '</p>
                </div>
            </div>';
            
        }

        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid bg-light">
            <div class="container">
              <p class="display-4">No results found</p>
              

              <p class="lead">Be the first person to ask a question</p>
             </div>
            </div>
          
          ';
        }
        ?>
        </div>

        


    <!-- <div class="container">
            <div class="media d-flex align-items-start my-3">
                <img src="images/user.png" width="50px" class="mr-3 mx-2" alt="Image">
                <div class="media-body">
                    <h5 class="mt-0">Unable to install pyaudio error in windows</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis
                        dapibus posuere velit aliquet.</p>
                </div>
            </div>
        </div> -->


    <?php include 'partial/_footer.php'; ?>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>