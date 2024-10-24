<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "blog_db";

$blogTitle = $_POST["blogtitle"];
$blogDate = $_POST["blogdate"];
$blogPara = $_POST["blogpara"];

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}

// Escape the user inputs to prevent SQL injection
$blogTitle = $conn->real_escape_string($blogTitle);
$blogDate = $conn->real_escape_string($blogDate);
$blogPara = $conn->real_escape_string($blogPara);

$filename = "NONE";

if (isset($_FILES['uploadimage'])) {
    $filename = $_FILES['uploadimage']['name'];
    $tempname = $_FILES['uploadimage']['tmp_name'];

    // Check if the images directory exists
    if (!is_dir('images')) {
        mkdir('images', 0777, true); // Create the directory if it doesn't exist
    }

    // Move the uploaded file
    if (move_uploaded_file($tempname, "images/" . $filename)) {
        echo "File uploaded successfully.";
    } else {
        echo "Failed to upload file.";
    }
}

// Insert data into the database
$sql = "INSERT INTO blog_table (topic_title, topic_date, image_filename, topic_para) 
        VALUES ('$blogTitle', '$blogDate', '$filename', '$blogPara')";

if ($conn->query($sql) === TRUE) {
    echo "Post saved successfully.";
} else {
    echo "Error saving post: " . $conn->error;
}

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Saved</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

    <div class="container my-5">
        <h1 class="text-center mb-4">Post Saved</h1>
        
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title" id="showTitle"><?php echo $blogTitle; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted" id="showDate"><?php echo $blogDate; ?></h6>
                <img src="images/<?php echo $filename; ?>" id="showImage" class="img-fluid mb-3" alt="Post Image">
                <p class="card-text" id="showPara"><?php echo $blogPara; ?></p>
                <a href="index.php" class="btn btn-primary">Go to Home Page</a>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-light text-center py-4">
        <div class="container">
            <h5 class="mb-3">Quick Links</h5>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="index.php" class="text-light">Home</a>
                </li>
                <li class="list-inline-item">
                    <a href="blog.php" class="text-light">Blog</a>
                </li>
            </ul>
            <p class="mt-4 mb-0">&copy; 2024 Your Website Name. All Rights Reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

