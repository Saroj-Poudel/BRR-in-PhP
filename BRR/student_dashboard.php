<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRR</title>
    <link rel="stylesheet" href="index_styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Menu Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="images\BRR_logo.jpg" alt="Company Logo"> Bansbari Reading Room</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                        <a class="nav-link" href="student_seatbook.php">Book Package</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="your_package.php">Your Package</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Re-new Package</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Holiday</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                   <a href="index.php"><button class="btn btn-outline-success my-2 my-sm-0" type="button" id="logoutBtn">Logout</button></a> 
                </form>
            </div>
        </div>
    </nav>

    <!-- Image Slider -->
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images\study_room_image1.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images\study_room_image2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images\study_room_image3.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mt-4">
        <h2>About Us</h2>
        <p>Bansbari reading room (BRR) is the organization which is established to provide the free space for those who need the suitable environment for their academic related activities</p>
        <h2>Features</h2>
        <ul>
            <li>Free Wifi</li>
            <li>Free Parking Space</li>
            <li>Exotic Study Environment</li>
        </ul>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container text-center">
            <p>Location: Bansbari,Budhanilkantha,Nepal | Phone: 01-506070 | Email: bansbarireadingroom@gmail.com</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="index_script.js"></script>
</body>
</html>
