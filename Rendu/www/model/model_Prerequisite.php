<?php

/**
 * @brief Create a new prerequisite.
 * @param $m_Id_Trip [Int] Id of the trip to create a prerequisite for.
 * @param $m_Name [String] Name of the prerequisite.
 * @param $m_Quantity [Int] Quantity needed.
 * @param $m_Ready [Boolean] Is it done ? 
 */
function insert_Prerequisite($m_Id_Trip,$m_Name,$m_Quantity,$m_Ready = false)
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
 * @brief Gets prerequisite values for the given user.
 * @param $m_Id_User [Int] Id of the user, got from $_SESSION['id'].
 * @param $m_Id_Prerequisite [Int] Id of the prerequisite to check if owned by the user.
 * @return The prerequisite infos if the user created it or nothing.
 */
function select_Prerequisite($m_Id_User, $m_Id_Prerequisite)
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
 * @param $m_Id_Prerequisite [Int] Id of the prerequisite to update.
 * @param $m_Name [String] Prerequisite name. Got from change prerequisite form.
 * @param $m_Quantity [Int] Prerequisite quantity to achieve. Got from change prerequisite form.
 * @param $m_Ready [Boolean] Is the prerequisite done? Got from change prerequisite form.
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
 * @brief Deletes a given prerequisite from database.
 * @param $m_Id_Prerequisite [Int] Id of the prerequisite to delete.
 */
function remove_Prerequisite($m_Id_Prerequisite)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("DELETE FROM Prerequisite WHERE idPrerequisite = ?");
    $req->bindParam(1,$m_Id_Prerequisite,PDO::PARAM_INT);
    $req->execute();
}