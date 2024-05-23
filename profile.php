<?php
//Pobierz sobie z url ID profilu 
if(isset($_GET['profileID'])) {
    //Jeśli istnieje profile id w url (w linku) to podstaw
    $id = $_GET['profileID'];
} else {
    //Jeśli nie istnieje w linku (nie podano) to ustaw 1
    $id = 1;
}


//Kwerenda pobiera jeden profil z tabeli po jego id
$sql = "SELECT * FROM profile 
        LEFT JOIN photo ON profile.profilePhotoID = photo.ID
        WHERE profile.ID=? 
        LIMIT 1";

//Połącz się z bazą danych
$db = new mysqli('localhost', 'root', '', 'profile');

//Przygotuj kwerendę do wysłania
$query = $db->prepare($sql);

//Podstaw ID
$query->bind_param('i', $id);

//Wykonujemy kwerendę
$query->execute();

//Odbierz wynik
$result = $query->get_result()->fetch_assoc();

//Result jest jednowierszową tabelą
//Echo "<pre>";
//Print_r($result);

$firstName = $result['firstName'];
$lastName = $result['lastName'];
$description = $result['description'];
$profilePhotoUrl = $result['url']
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil użytkownika</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <header>
        <img src="banner kociak.jpg" alt="">
        <h1>Leonardo</h1>
    </header>

    <nav>
        <ul> 
            <li><a href="html.html">Strona Główna</a></li>
    <div id="profileContent">
        <span id="name">
            <?php echo $firstName." ".$lastName; ?>
        </span>
        <img src="<?php echo $profilePhotoUrl; ?>" 
            alt="" id="profilePhoto">
        <p id="profileDescription">
            <?php echo $description; ?>
        </p>
    </div>
</body>
</html>