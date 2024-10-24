<!DOCTYPE html>

<html lang="en">
  
  <head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Blog Using PHP And MySQL</title>

    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: rgb(255 83 30) !important;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="logoshivsen.jpg" alt="" width="50"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Blog</a>
        </li>
      
      </ul>
      <div class="d-flex">
      <?php echo '<a class="btn btn-outline-warning text-white" stle type="submit" href="index.html">Add Blog</a>'; ?>
        
      </div>
    </div>
  </div>
</nav>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./images/WhatsApp Image 2024-10-24 at 17.35.22_df2027d1.jpg" height="auto" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./images/WhatsApp Image 2024-10-24 at 17.35.22_df2027d1.jpg" height="auto" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./images/WhatsApp Image 2024-10-24 at 17.35.22_df2027d1.jpg" height="auto" class="d-block w-100" alt="...">
    </div>
  </div>
</div>

    <div class="all-posts-container">

    <?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "blog_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
$imagePath = "../images/logoshivsen.jpg";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT topic_title, topic_date, image_filename, topic_para FROM blog_table;";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    echo "<center><span>There was an error with the query: " . $conn->error . "</span></center>";
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='container mt-5 mb-5'>";
          echo "<div class='row'>"; // Start row

          // Loop to display each blog post in a card
          while($row = $result->fetch_assoc()) {
          
              echo "<div class='col-lg-4 col-md-6 mb-4'>"; // Column for 3 cards in large screens, 2 cards on medium screens
          
                  echo "<div class='card h-100'>"; // Bootstrap Card
          
                      // Card Image
                      echo "<img class='card-img-top img-fluid' style='width: 100%; height: auto;' id='displayImage' src='images/" . $row["image_filename"] . "' alt='Blog Image'>";
          
                      // Card Body
                      echo "<div class='card-body'>";
          
                          // Title
                          echo "<h5 class='card-title' id='displayTitle'>" . $row["topic_title"] . "</h5>";
          
                          // Date
                          echo "<p class='card-text'><small class='text-muted' id='displayDate'>" . $row["topic_date"] . "</small></p>";
          
                          // Description (Paragraph) with text clamping for long content
                          echo "<p class='card-text' style='overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;' id='displayPara'>" . $row["topic_para"] . "</p>";
          
                          // Read More or Additional Actions (Optional)
                          echo "<a href='#' class='btn btn-primary'>Read More</a>";
          
                      echo "</div>"; // Close card body
          
                  echo "</div>"; // Close card
          
              echo "</div>"; // Close column
          }
          
          echo "</div>"; // Close row
          echo "</div>"; // Close container
        }
    } else {
        echo "<center><span>No Blog Posts Found</span></center>";
    }
}

// Close the connection
$conn->close();

?>



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
    <p class="mt-4 mb-0">&copy; 2024 shivsena. All Rights Reserved.</p>
  </div>
</footer>

    <!-- <?php echo "<br><center><a style='color: dodgerblue; text-decoration: none; background: dodgerblue; padding: 5px 25px; color: #fff; border-radius: 50px;' href='index.html'>Write a New Post</a></center><br>"; ?> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  
</html>