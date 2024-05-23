<?php
class User {
    // Klasa User zawiera wszystkie informacje i czynności związane z użytkownikiem portalu
    // Modelem w bazie danych jest tabela user

    static function Register(string $email, string $password) : bool {
        // Funkcja odpowiada za dodanie użytkownika do właściwej tabeli w bazie danych
        // user{id INT, email VARCHAR(128), password VARCHAR(128)}

        // Skonwertuj hasło do hasha
        $passwordHash = password_hash($password, PASSWORD_ARGON2I);

        // Połączenie do bazy danych
        $db = new mysqli('localhost', 'root', '', 'profile');
        if ($db->connect_error) {
            die('Błąd połączenia: ' . $db->connect_error);
        }

        // Kwerenda do bazy danych
        $sql = "INSERT INTO user (email, password) VALUES (?, ?)";
        // Zapytanie
        $q = $db->prepare($sql);
        // Podstaw dane
        $q->bind_param("ss", $email, $passwordHash);

        // Wyślij zapytanie
        $result = $q->execute();
        // Zwróć wynik rejestracji
        return $result;
    }

    static function Login(string $email, string $password) {
        // Funkcja odpowiada za logowanie użytkownika
        // Połączenie do bazy danych
        $db = new mysqli('localhost', 'root', '', 'profile');
        if ($db->connect_error) {
            die('Błąd połączenia: ' . $db->connect_error);
        }

        // Kwerenda do bazy danych
        $sql = "SELECT id, email, password FROM user WHERE email = ?";
        // Zapytanie
        $q = $db->prepare($sql);
        // Podstaw dane
        $q->bind_param("s", $email);
        // Wykonaj zapytanie
        $q->execute();
        // Pobierz wynik
        $result = $q->get_result();
        $user = $result->fetch_assoc();

        // Sprawdź hasło
        if ($user && password_verify($password, $user['password'])) {
            // Zaloguj użytkownika (możesz tu ustawić sesję lub inne mechanizmy logowania)
            return $user;
        } else {
            // Błędne dane logowania
            return false;
        }
    }
}
?>