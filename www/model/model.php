<?php

/**
 * @brief Connects to the Trip Planner database.
 * @return Returns the connection.
 */
function connect() 
{
    $connexion = new PDO('mysql:host=localhost;dbname=tripplanne_db;charset=utf8', 'root', '');
    //$connexion = new PDO('mysql:host=localhost;dbname=tripplanne_db;charset=utf8', 'tripplanne_db', 'P@$$w0rd');
   
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connexion;
}

/**
 * @brief Creates a new user and connects the user.
 * @param $m_Nickname, user nickname from registration form.
 * @param $m_Email, user nickname from registration form.
 * @param $m_Password, user nickname from registration form.
 */
function create_User($m_Nickname, $m_Email, $m_Password)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $hash = password_hash($m_Password, PASSWORD_DEFAULT);

    $req = $connection->prepare("INSERT INTO User (Nickname,Email, Password) VALUES (?,?,?)");
    $req->execute(array($m_Nickname,$m_Email,$hash));
}

/**
 * @brief Checks if the nickname is already used.
 * @param $m_Nickname, nickname to check, from registration form.
 * @return The account with the nickname that already uses it.
 */
function check_Nickname($m_Nickname)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req = $connection->prepare("SELECT idUser FROM User WHERE nickname = ?");
    $req->execute(array($m_Nickname));

    $result = $req->fetch(PDO::FETCH_ASSOC);
    $id = $result['idUser'];

    return $id;
}

/**
 * @brief Checks if the mail is already used.
 * @param $m_Email, mail to check, from registration form.
 * @return The account with the mail that already uses it.
 */
function check_Mail($m_Email)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req = $connection->prepare("SELECT idUser FROM User WHERE email = ?");
    $req->execute(array($m_Email));

    $result = $req->fetch(PDO::FETCH_ASSOC);
    $id = $result['idUser'];

    return $id;
}

/**
 * @brief Get the password for the given account
 * @param $m_Email, account login to check from login form.
 * @return Hash of the password if the account exists else nothing.
 */
function get_Password($m_Mail)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req = $connection->prepare("SELECT Password FROM User WHERE email = ?");
    $req->execute(array($m_Mail));

    if($result = $req->fetch(PDO::FETCH_ASSOC))
    {
        return $result['Password'];
    }
    else
    {
        return '';
    }
}

/**
 * @brief Deletes the selected account.
 * @param $m_Email. Obtained with $_SESSION['user'].
 */
function remove_User($m_Mail)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req = $connection->prepare("DELETE FROM User WHERE email = ?");
    $req->execute(array($m_Mail));
}

/**
 * @brief Deletes the selected account.
 * @param $m_Email. Identifies the account to update. Obtained with $_SESSION['user'].
 * @param $m_New_Password. Raw new password. Obtained from the changing password form.
 */
function update_Password($m_Mail,$m_New_Password)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $hash = password_hash($m_New_Password, PASSWORD_DEFAULT);
    
    $req = $connection->prepare("UPDATE User SET password = ? WHERE email = ?");
    $req->execute(array($hash,$m_Mail));
}

/**
 * @brief Get the account nickname for the given mail.
 * @param $m_Email, user login from login form.
 * @return Returns user nickname to set $_SESSION['nickname'].
 */
function get_Nickname($m_Mail)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req = $connection->prepare("SELECT Nickname FROM User WHERE email = ?");
    $req->execute(array($m_Mail));

    $result = $req->fetch(PDO::FETCH_ASSOC);
    $nickname = $result['Nickname'];

    return $nickname;
}
