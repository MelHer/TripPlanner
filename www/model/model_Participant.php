<?php

/**
 * @brief Check if a user is participating to a trip.
 * @param $m_Id_Trip Id of the trip to check for participation.
 * @param $m_Id_Participant Id of the user to check for participation.
 * @return Returns the record or nothing if no match.
 */
function get_Participant($m_Id_Trip,$m_Id_Participant)
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
 * @brief Remove a participant form a trip.
 * @param $m_Id_Trip Id of the trip to remove participant.
 * @param $m_Id_Participant Id of the user to remove.
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