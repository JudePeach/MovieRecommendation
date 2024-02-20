<!DOCTYPE html>

<?php include(__DIR__ ."/dbTest.php");
if(!isset($_SESSION['loggedin'])){
    header("Location:/groupProject/login.php'");
 }?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="MovieStyle.css"> -->
    <title>Movie Recommendation Site Using Machine Learning</title>


    

   
</head>
<body>
    <div class="header-container">
        <header>
            <h1>Movie Mingle</h1>
            <nav>
                <ul>
                    <li><a href="login.html">Login to access : </a></li>
                    <li><a href="#">Home</a></li>
                    <li class="dropdown">
                        <a href="#">Movies</a>
                        <div class="dropdown-content">
                            <a href="#">Action</a>
                            <a href="#">Drama</a>
                            <a href="#">Comedy</a>
                            <a href="#">Thriller</a>
                        </div>
                    </li>
                    <li><a href="#">Reviews</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
        </header>
    </div>

    <!-- Other content goes here -->

</body>


<!-- Navigation bar -->


<main>
    <!-- Login form -->
   
   <!-- <section class="movie">
        <h2>Movie Name</h2>
        <p>Release year:</p>
        <p>Genre:</p>
        <p>Number of ratings .... </p>
        <p>User seen? ..., Matches user's movie interests?...</p>
    </section>

    <section class="movie">
        <h2>Movie Name</h2>
        <p>Release year:</p>
        <p>Genre:</p>
        <p>Number of ratings .... </p>
        <p>User seen? ..., Matches user's movie interests?...</p>
    </section>

    <section class="movie">
        <h2>Movie Name</h2>
        <p>Release year:</p>
        <p>Genre:</p>
        <p>Number of ratings .... </p>
        <p>User seen? ..., Matches user's movie interests?...</p>
    </section>-->
</main>

<footer>
    <p> Team Members = Jude, Sam, Alex, Layan, Samanta</p>
</footer>
</body
