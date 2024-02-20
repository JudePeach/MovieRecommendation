

<!DOCTYPE html>

<?php 
    include(__DIR__ ."/dbTest.php");
    echo ($_SESSION['loggedin']);
    if  ($_SESSION['loggedin'] == true){
        header('Location: /groupProject/MVP.php');
        exit;
    }

    ?>

<html lang="en">
<head>
   

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="MovieStyle.css"> -->
    <title>Login Page</title>
    

    <script type="text/javascript">
        function login(){
            alert("LoggedIn");
            var email = document.getElementById("email").value;
            var password = document.getElementById("psw").value;

                //once connected to db change this to a db statement
            var formData = new FormData();
            formData.append('emailLogin', email);
            formData.append('passwordLogin', email);
            // Send data to PHP script using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'dbTest.php', true);
            xhr.send(formData);
             
        }

        function register(){
            alert("entered");
            var email = document.getElementById("email").value;
            var password = document.getElementById("psw").value;
            document.getElementById("status").innerText = "registered";
            document.cookie = "register = true"

            var formData = new FormData();
            formData.append('emailRegister', email);
            formData.append('passwordRegister', email);
            // Send data to PHP script using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'dbTest.php', true);
            // xhr.onload = function() {
            //     if (xhr.status == 200) {
            //         alert(xhr.responseText); // Display response from PHP script
            //     }
            // };
            xhr.send(formData);

            
            
        }
    </script>
</head>

<body>
    <div class="header-container">
        <header>
            <h1>Movie Mingle</h1>
            <nav>
                <ul>
                    <li><a  href="login.html">Login to access : </a></li>
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

</body>


<main>
   
    <form method="post">
        <h2>Login</h2>
        <p id = 'status'>this is status</p>
        <div>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="psw" required>

            <button type="button" onclick = 'login()'>Login</button>
            <button type="button" onclick = 'register()'>Register / Sign-up</button>
        </div>
        
    </form>
</main>

<footer>
    <p> Team Members = Jude, Sam, Alex, Layan, Samanta</p>
</footer>


