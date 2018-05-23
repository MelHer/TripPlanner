<?php

/**
 * @brief Create a new prerequisite in the database.
 * @param $m_Id_Trip Id of the trip to create a prerequisite for.
 * @param $m_Name Name of the prerequisite.
 * @param $m_Quantity Quantity needed.
 * @param $m_Ready Boolean telling if it's done or not
 */
function create_Prerequisite($m_Id_Trip,$m_Name,$m_Quantity,$m_Ready = false)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("INSERT INTO Prerequisite (fkTrip,Name,Quantity,Ready) VALUES (?,?,?,?)");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->bindParam(2,$m_Name,PDO::PARAM_STR);
    $req->bindParam(3,$m_Quantity,PDO::PARAM_INT);
    $req->bindParam(4,$m_Ready,PDO::PARAM_BOOL);
    $req->execute();   
}

/**
 * @brief Returns if the passed user id owns the passed prerequisite id.
 * @param $m_Id_User Id of the user, got from $_SESSION['id'].
 * @param $m_Id_Prerequisite Id of the prerequisite to check if owned by the user.
 * @return Returns the prerequisite infos if the user created it.
 */
function get_Prerequisite($m_Id_User, $m_Id_Prerequisite)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT * FROM Prerequisite INNER JOIN Trip ON Prerequisite.fkTrip = Trip.idTrip WHERE Trip.fkUser_Organizer = ? AND Prerequisite.idPrerequisite = ?");
    $req->bindParam(1,$m_Id_User,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_Prerequisite,PDO::PARAM_INT);
    $req->execute();
    
    $result = $req->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}


/**
 * @brief Updates a prerequisite in the database.
 * @param $m_Id_Prerequisite Id of the prerequisite to update.
 * @param $m_Name Prerequisite name. Got from change prerequisite form.
 * @param $m_Quantity Prerequisite quantity to achieve. Got from change prerequisite form.
 * @param $m_Ready Is the prerequisite done? Got from change prerequisite form.
 */
function update_Prerequisite($m_Id_Prerequisite,$m_Name,$m_Quantity,$m_Ready=false)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
   
    $req = $connection->prepare("UPDATE Prerequisite SET Name= ?, Quantity= ?, Ready=? WHERE idPrerequisite = ?");
    $req->bindParam(1,$m_Name,PDO::PARAM_STR);
    $req->bindParam(2,$m_Quantity,PDO::PARAM_INT);
    $req->bindParam(3,$m_Ready,PDO::PARAM_BOOL);
    $req->bindParam(4,$m_Id_Prerequisite,PDO::PARAM_INT);
    $req->execute();
}

/**
 * @brief Remove a given prerequisite from database.
 * @param $m_Id_Prerequisite Id of the prerequisite to delete.
 */
function remove_Prerequisite($m_Id_Prerequisite)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("DELETE FROM Prerequisite WHERE idPrerequisite = ?");
    $req->bindParam(1,$m_Id_Prerequisite,PDO::PARAM_INT);
    $req->execute();
}