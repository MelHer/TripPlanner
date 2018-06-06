<?php

/**
 * @brief Gets user participation for a given trip.
 * @param $m_Id_Trip [Int] Id of the trip to get participation.
 * @param $m_Id_Participant [Int] Id of the user to check for participation.
 * @return The record or nothing if the user is not a participant.
 */
function select_Participant($m_Id_Trip,$m_Id_Participant)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
     //Getting the id of the last insert.
     $req = $connection->prepare("SELECT fkUser, Nickname, fkTrip FROM Participant INNER JOIN User ON Participant.fkUser = User.idUser WHERE fkTrip = ? AND fkUser = ?");
     $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
     $req->bindParam(2,$m_Id_Participant,PDO::PARAM_INT);
     $req->execute();
     
     $result = $req->Fetch(PDO::FETCH_ASSOC);
     
     return $result;

}

/**
 * @brief Deletes a participant from a trip.
 * @param $m_Id_Trip [Int] Id of the trip.
 * @param $m_Id_Participant [Int] Id of the user to remove.
 */
function remove_Participant($m_Id_Trip,$m_Id_Participant)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("DELETE FROM Participant WHERE fkTrip = ?  AND fkUser = ?");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_Participant,PDO::PARAM_INT);
    $req->execute();
}

/**
 * @brief Gets a user registration.
 * @param $m_Id_Trip [Int] Id of the trip to get a registration.
 * @param $m_Id_User [Int] Id of the user to get a registration.
 * @return The registration.
 */
function select_Registration($m_Id_Trip, $m_Id_User)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT * FROM Participant WHERE fkTrip = ? AND fkUser = ?");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_User,PDO::PARAM_INT);
    $req->execute();
    
    $result = $req->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}

/**
 * @brief Insert a new registration.
 * @param $m_Id_Trip [Int] Id of the trip to create a registration.
 * @param $m_Id_User [Int] Id of the user to create a registration.
 */
function insert_Registration($m_Id_Trip, $m_Id_User)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("INSERT INTO Participant (fkTrip,fkUser,Waiting) VALUES(?,?,true)");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_User,PDO::PARAM_INT);
    $req->execute();
}

/**
 * @brief Gets all requests for a user.
 * @param $m_Id_User [Int] Id of the user to get requests.
 * @return The requests informations (Sender, Trip wanted).
 */
function select_Request($m_Id_User)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT fkUser, Nickname, fkTrip, Title FROM Participant INNER JOIN User ON Participant.fkUser = User.idUser INNER JOIN Trip ON Participant.fkTrip = Trip.idTrip WHERE fkUser_Organizer = ? AND Waiting = true ORDER BY Nickname ASC");
    $req->bindParam(1,$m_Id_User,PDO::PARAM_INT);
    $req->execute();
    
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    
    return $results;
}

/**
 * @brief Accepts a participation request.
 * @param $m_Id_Trip [Int] Id of the trip to accept the applicant.
 * @param $m_Id_Applicant [Int] User id of the applicant.
 */
function update_Request($m_Id_Trip,$m_Id_Applicant)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("UPDATE Participant SET Waiting = false WHERE fkTrip = ? AND fkUser = ?");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_Applicant,PDO::PARAM_INT);
    $req->execute();
}


/**
 * @brief Checks if a user is an accepted participant for a trip
 * @param $m_Id_Trip [Int] Id of the trip to get the registration.
 * @param $m_Id_User [Int] Id of the user to get the registration.
 * @return The registration if the user is allowed or nothing.
 */
function select_Accepted_Registration($m_Id_User, $m_Id_Trip)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT * FROM Participant INNER JOIN Trip ON Participant.fkTrip = Trip.idTrip WHERE fkTrip = ? AND fkUser = ? AND Waiting = false");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_User,PDO::PARAM_INT);
    $req->execute();
    
    $result = $req->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}

/**
 * @brief Removes a self request for a trip participation.
 * @param $m_Id_Trip [Int] Id of the trip to remove the registration.
 * @param $m_Id_User [Int] Id of the user to remove the registration.
 */
function remove_Self($m_Id_User, $m_Id_Trip)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("DELETE FROM Participant WHERE fkTrip = ? AND fkUser = ?");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_User,PDO::PARAM_INT);
    $req->execute();
}