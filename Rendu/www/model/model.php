<?php

/**
 * @brief Connects to the Trip Planner database on SwissCenter server.
 * @return The connection to the database.
 */
function connect() 
{
    //$connexion = new PDO('mysql:host=localhost;dbname=tripplanne_db;charset=utf8', 'root', ''); //Local test
    $connexion = new PDO('mysql:host=localhost;dbname=tripplanne_db;charset=utf8', 'tripplanne_db', 'P@$$w0rd'); //Production (SwissCenter)
   
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connexion;
}

/**
 * @brief Creates a new user.
 * @param $m_Nickname [String] User's nickname from registration form.
 * @param $m_Email [String] User's email  from registration form.
 * @param $m_Password [String] User's password from registration form.
 */
function insert_User($m_Nickname, $m_Email, $m_Password)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $hash = password_hash($m_Password, PASSWORD_DEFAULT);

    $req = $connection->prepare("INSERT INTO User (Nickname,Email, Password) VALUES (?,?,?)");
    $req->execute(array($m_Nickname,$m_Email,$hash));
}

/**
 * @brief Gets user id for a given nickname.
 * @param $m_Nickname [String] Nickname of user to get id.
 * @return The user id.
 */
function select_Nickname($m_Nickname)
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
 * @brief Gets user id for a given email.
 * @param $m_Email [String] Email of user to get id.
 * @return The user id.
 */
function select_Mail($m_Email)
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
 * @brief Gets the password hash for a given account.
 * @param $m_Email [String] Account login to get password hash.
 * @return If the account exists, hash of the password else nothing.
 */
function select_Password($m_Mail)
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
 * @brief Deletes the given account.
 * @param $m_Email [String] Mail of the user to delete. Obtained with $_SESSION['user'].
 */
function delete_User($m_Mail)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req = $connection->prepare("DELETE FROM User WHERE email = ?");
    $req->execute(array($m_Mail));
}

/**
 * @brief Updates the user password
 * @param $m_Email [String] Mail of the account to update password. Obtained with $_SESSION['user'].
 * @param $m_New_Password [String] Raw new password. Obtained from the changing password form.
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
 * @brief Get the account nickname for a given account.
 * @param $m_Email [String] Account email from login form.
 * @return Nickname of the user to set $_SESSION['nickname'].
 */
function select_Nickname_From_User($m_Mail)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req = $connection->prepare("SELECT Nickname FROM User WHERE email = ?");
    $req->execute(array($m_Mail));

    $result = $req->fetch(PDO::FETCH_ASSOC);
    $nickname = $result['Nickname'];

    return $nickname;
}
