<?php

/**
 * @brief Gets the types of transport.
 * @return Array containing all types.
 */
function select_Transport_Type() 
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT * FROM Transport_Type ORDER BY Type");
    $req->execute();

    $transport_Types = $req->fetchAll(PDO::FETCH_ASSOC);
    
    return $transport_Types;
}

/**
 * @brief Inserts a new transport in the database for a given trip.
 * @param $m_Id_Trip [Int] Id of the trip to create transport for.
 * @param $m_Place_Start [String] Transport start place. Got from new transport form.
 * @param $m_Place_End [String] Transport end place. Got from new transport form.
 * @param $m_Date_Start [String] Transport start date. Got from new transport form.
 * @param $m_Date_End [String] Transport end date. Got from new transport form.
 * @param $m_Time_Start [String] Transport start time. Got from new transport form.
 * @param $m_Time_End [String] Transport end time. Got from new transport form.
 * @param $m_Price [Float] Transport cost. Got from new transport form.
 * @param $m_Type [Int] Type of transport. Got from new transport form.
 * @param $m_Code [String] Reservation code. Got from new transport form.
 * @param $m_Link [String] Web link to reservation.
 * @param $m_Note [String] Commentary of the creator of the trip.
 * @param $m_Image [Boolean] Did user upload an image or not.
 * @return Id of the record.
 */
function insert_Transport($m_Id_Trip,$m_Place_Start,$m_Place_End,$m_Date_Start,$m_Date_End,$m_Time_Start,$m_Time_End,$m_Price,$m_Type,$m_Code,$m_Link,$m_Note,$m_Image)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    $req = $connection->prepare("INSERT INTO Transport (fkTransport_Type,fkTrip,Place_Start,Place_End,Day_Start,Day_End,Time_Start,Time_End,Price,Code,Link,Note,Image) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $req->bindParam(1,$m_Type,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_Trip,PDO::PARAM_INT);
    $req->bindParam(3,$m_Place_Start,PDO::PARAM_STR);
    $req->bindParam(4,$m_Place_End,PDO::PARAM_STR);
    $req->bindParam(5,$m_Date_Start,PDO::PARAM_STR);
    $req->bindParam(6,$m_Date_End,PDO::PARAM_STR);
    $req->bindParam(7,$m_Time_Start,PDO::PARAM_STR);
    $req->bindParam(8,$m_Time_End,PDO::PARAM_STR);
    $req->bindParam(9,$m_Price,PDO::PARAM_STR);
    $req->bindParam(10,$m_Code,PDO::PARAM_STR);
    $req->bindParam(11,$m_Link,PDO::PARAM_STR);
    $req->bindParam(12,$m_Note,PDO::PARAM_STR);
    $req->bindParam(13,$m_Image,PDO::PARAM_BOOL);
    $req->execute();
    
    //Getting the id of the last insert.
    $req = $connection->prepare("SELECT MAX(idTransport) as idTransport FROM Transport WHERE fkTrip = ?");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
    
    $id = $req->FetchAll(PDO::FETCH_ASSOC);
    
    return $id;

}

/**
 * @brief Gets a transport values for the given user.
 * @param $m_Id_User [Int] Id of the user, got from $_SESSION['id'].
 * @param $m_Id_Transport [Int] Id of the transport to get values.
 * @return Transport details if the user created this transport or nothing.
 */
function select_Transport($m_Id_User, $m_Id_Transport)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT Transport.* FROM Transport INNER JOIN Trip ON Transport.fkTrip = Trip.idTrip WHERE Trip.fkUser_Organizer = ? AND Transport.idTransport = ?");
    $req->bindParam(1,$m_Id_User,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_Transport,PDO::PARAM_INT);
    $req->execute();
    
    $result = $req->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}


/**
 * @brief Updates a transport.
 * @param $m_Id_Transport [Int] Id of the transport to edit.
 * @param $m_Place_Start [String] Transport start place. Got from change transport form.
 * @param $m_Place_End [String] Transport end place. Got from change transport form.
 * @param $m_Date_Start [String] Transport start date. Got from change transport form.
 * @param $m_Date_End [String] Transport end date. Got from change transport form.
 * @param $m_Time_Start [String] Transport start time. Got from change transport form.
 * @param $m_Time_End [String] Transport end time. Got from change transport form.
 * @param $m_Price [Float] Transport cost. Got from change transport form.
 * @param $m_Type [Int] Type of transport. Got from change transport form.
 * @param $m_Code [String] Reservation code. Got from change transport form.
 * @param $m_Link [String] Web link to reservation. Got from change transport form.
 * @param $m_Note [String] Commentary of the creator of the trip. Got from change transport form.
 * @param $m_Image [Boolean] Did the user upload an image or not.
 */
function update_Transport($m_Id_Transport,$m_Place_Start,$m_Place_End,$m_Date_Start,$m_Date_End,$m_Time_Start,$m_Time_End,$m_Price,$m_Type,$m_Code,$m_Link,$m_Note,$m_Image)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if($m_Image) //only change image if he uploaded one. In case one has been previously uploaded, we dont want to remove it.
    {
        $req = $connection->prepare("UPDATE Transport SET fkTransport_Type= ?, Place_Start=?, Place_End=?, Day_Start=?, Day_End=?, Time_Start=?, Time_End=?, Price=?, Code=?, Link=?, Note=?, Image=? WHERE idTransport = ?");
        $req->bindParam(1,$m_Type,PDO::PARAM_INT);
        $req->bindParam(2,$m_Place_Start,PDO::PARAM_STR);
        $req->bindParam(3,$m_Place_End,PDO::PARAM_STR);
        $req->bindParam(4,$m_Date_Start,PDO::PARAM_STR);
        $req->bindParam(5,$m_Date_End,PDO::PARAM_STR);
        $req->bindParam(6,$m_Time_Start,PDO::PARAM_STR);
        $req->bindParam(7,$m_Time_End,PDO::PARAM_STR);
        $req->bindParam(8,$m_Price,PDO::PARAM_STR);
        $req->bindParam(9,$m_Code,PDO::PARAM_STR);
        $req->bindParam(10,$m_Link,PDO::PARAM_STR);
        $req->bindParam(11,$m_Note,PDO::PARAM_STR);
        $req->bindParam(12,$m_Image,PDO::PARAM_BOOL);
        $req->bindParam(13,$m_Id_Transport,PDO::PARAM_INT);
        $req->execute();
    }
    else
    {
        $req = $connection->prepare("UPDATE Transport SET fkTransport_Type= ?, Place_Start=?, Place_End=?, Day_Start=?, Day_End=?, Time_Start=?, Time_End=?, Price=?, Code=?, Link=?, Note=? WHERE idTransport = ?");
        $req->bindParam(1,$m_Type,PDO::PARAM_INT);
        $req->bindParam(2,$m_Place_Start,PDO::PARAM_STR);
        $req->bindParam(3,$m_Place_End,PDO::PARAM_STR);
        $req->bindParam(4,$m_Date_Start,PDO::PARAM_STR);
        $req->bindParam(5,$m_Date_End,PDO::PARAM_STR);
        $req->bindParam(6,$m_Time_Start,PDO::PARAM_STR);
        $req->bindParam(7,$m_Time_End,PDO::PARAM_STR);
        $req->bindParam(8,$m_Price,PDO::PARAM_STR);
        $req->bindParam(9,$m_Code,PDO::PARAM_STR);
        $req->bindParam(10,$m_Link,PDO::PARAM_STR);
        $req->bindParam(11,$m_Note,PDO::PARAM_STR);
        $req->bindParam(12,$m_Id_Transport,PDO::PARAM_INT);
        $req->execute();
    }
}

/**
 * @brief Deletes a given transport from database.
 * @param $m_Id_Transport [Int] Id of the transport to delete.
 */
function remove_Transport($m_Id_Transport)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("DELETE FROM Transport WHERE idTransport = ?");
    $req->bindParam(1,$m_Id_Transport,PDO::PARAM_INT);
    $req->execute();
}