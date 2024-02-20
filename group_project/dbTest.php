_<?php
$host = '127.0.0.1';
$username = 'root';
$password = '';
try
{
$conn = new PDO("mysql:host=$host", $username, $password);
echo "Connected to $host successfully.";

}
catch (PDOException $pe)
{
die("Could not connect to $host :" . $pe->getMessage());
}

function showDatabases()
{
$sql = "SHOW DATABASES";
$pdo = new pdo('mysql:host=127.0.0.1;',
'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE,
PDO::ERRMODE_WARNING);
$stmt = $pdo->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch())
{
print("<h3>" . $row['Database'] . "</h3>");
}
}

function createDatabase($databaseName)
{
$sql = "CREATE DATABASE IF NOT EXISTS $databaseName";
$pdo = new pdo('mysql:host=127.0.0.1;','root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE,
PDO::ERRMODE_WARNING);
$pdo->query($sql);
// showDatabases();
}
function createUserTable($dbName)
{
$sql = "CREATE TABLE user (
userId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(30) NOT NULL UNIQUE,
password VARCHAR(128) NOT NULL)";
$pdo = new pdo('mysql:host=127.0.0.1;dbname=' . $dbName . '',
'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$pdo->query($sql);
}
function createUserReviewTable($dbName)
{
$sql = "CREATE TABLE review (
reviewId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
userId INT UNSIGNED NOT NULL,
movie INT NOT NULL,
review INT NOT NULL,
FOREIGN KEY (userId) REFERENCES user(userId)
)";
$pdo = new pdo('mysql:host=127.0.0.1;dbname=' . $dbName . '',
'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$pdo->query($sql);
}

function addReview($userId, $movie, $review)
{
$sql = "INSERT INTO review (userId,movie,review)
VALUES (:userId, :movie, :review)";
$pdo = new pdo('mysql:host=127.0.0.1;dbname=mydb',
'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$stmt = $pdo->prepare($sql);
$stmt->execute([
'userId' => $userId,
'movie' => $movie,
'review' => $review
]);
} 

function addUser( $email, $password)
{
$sql = "INSERT INTO user (email, password)
VALUES (:email, :password)";
$pdo = new pdo('mysql:host=127.0.0.1;dbname=mydb',
'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$password = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare($sql);
$stmt->execute([
'email' => $email,
'password' => $password
]);
}

function getUser($id)
{
$sql = "SELECT email, password
FROM user
WHERE userId = :id";
$pdo = new pdo('mysql:host=127.0.0.1;dbname=mydb',
'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$stmt = $pdo->prepare($sql);
$stmt->execute([
'id' => $id
]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch())
{
echo("<br>" .$row['email'] . " " . $row['password']);
}
}
function getReview($id)
{
$sql = "SELECT movie,review
FROM review
WHERE userId = :id";
$pdo = new pdo('mysql:host=127.0.0.1;dbname=mydb',
'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$stmt = $pdo->prepare($sql);
$stmt->execute([
'id' => $id
]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch())
{
echo("<br>" . $row['movie'] .$row['review']);
}


}
function authenticateUser($email, $password)
{
$sql = "SELECT password
FROM user
WHERE email = :email";
$pdo = new pdo('mysql:host=127.0.0.1;dbname=mydb',
'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$stmt = $pdo->prepare($sql);
$stmt->execute([
'email' => $email
]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$row = $stmt->fetch();
if (password_verify($password, $row['password'])){
    $_SESSION['loggedin'] = true;
    header('Location: /groupProject/MVP.php');
    echo("entered");
    
}
else{
    echo ("not log in");
}

}

function dropTable($name) 
{
$sql = "DROP TABLE $name";
$pdo = new pdo('mysql:host=127.0.0.1;dbname=mydb',
'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$pdo->query($sql);
}

session_start();

if(isset($_POST['emailLogin']) && isset($_POST['passwordLogin']) ) {
    // Data has been provided
    echo("recieved login info");
    $email = $_POST['emailLogin'];
    $password = $_POST['passwordLogin'];
    authenticateUser($email,$password);
    
} 
if(isset($_POST['emailRegister']) && isset($_POST['passwordRegister']) ) {
    // Data has been provided
    $email = $_POST['emailRegister'];
    $password = $_POST['passwordRegister'];
    addUser($email,$password);
    
}
//createDatabase("mydb");
//createTables("mydb");
//dropTable("user");

//createUserTable("mydb");
// createUserReviewTable("mydb");
//addUser("Samanta", "Razbadauskaite", "Samanta.gmail.com", "pineapple");
//addReview(1,"kung fu panda",10);
//getReview(1);
// addUser("Kathryn", "Janeway", "janeway.k@sf.com","voyager");
// addUser("Patrick", "Stewart", "stewart.p@sf.com","enterprise");
// getUser(1);
// getUser(3);
// authenticateUser("stewart.p@sf.com" ,"enterprise");
// dropTable("user");

?>