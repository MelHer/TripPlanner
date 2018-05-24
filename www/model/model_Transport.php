<?php

/**
 * @brief Gets the types of lodging.
 * @return Returns an array containing all types
 */
function get_Transport_Type() 
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT * FROM Transport_Type ORDER BY Type");
    $req->execute();

    $transport_Types = $req->fetchAll(PDO::FETCH_ASSOC);
    
    return $transport_Types;
}

/**
 * @brief Create a new transport in the database for a given trip.
 * @param $m_Id_Trip Id of the trip to create transport for.
 * @param $m_Place_Start Transport start place. Got from new transport form.
 * @param $m_Place_End Transport end place. Got from new transport form.
 * @param $m_Date_Start Transport start date. Got from new transport form.
 * @param $m_Date_End Transport end date. Got from new transport form.
 * @param $m_Time_Start Transport start time. Got from new transport form.
 * @param $m_Time_End Transport end time. Got from new transport form.
 * @param $m_Price Transport cost. Got from new transport form.
 * @param $m_Type Type of transport. Got from new transport form.
 * @param $m_Code Reservation code. Got from new transport form.
 * @param $m_Link Web link to reservation.
 * @param $m_Note Commentary of the creator of the trip.
 * @param $m_Image Boolean telling if user uploaded an image or not.
 * @return Returns the id of the record.
 */
function create_Transport($m_Id_Trip,$m_Place_Start,$m_Place_End,$m_Date_Start,$m_Date_End,$m_Time_Start,$m_Time_End,$m_Price,$m_Type,$m_Code,$m_Link,$m_Note,$m_Image)
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
 * @brief Returns if the passed user id owns the passed transport id.
 * @param $m_Id_User Id of the user, got from $_SESSION['id'].
 * @param $m_Id_Transport Id of the transport to check if owned by the user.
 * @return Returns the transport infos if the user created this transport.
 */
function get_Transport($m_Id_User, $m_Id_Transport)
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
 * @param $m_Id_Transport Id of the transport to edit.
 * @param $m_Place_Start Transport start place. Got from change transport form.
 * @param $m_Place_End Transport end place. Got from change transport form.
 * @param $m_Date_Start Transport start date. Got from change transport form.
 * @param $m_Date_End Transport end date. Got from change transport form.
 * @param $m_Time_Start Transport start time. Got from change transport form.
 * @param $m_Time_End Transport end time. Got from change transport form.
 * @param $m_Price Transport cost. Got from change transport form.
 * @param $m_Type Type of transport. Got from change transport form.
 * @param $m_Code Reservation code. Got from change transport form.
 * @param $m_Link Web link to reservation. Got from change transport form.
 * @param $m_Note Commentary of the creator of the trip. Got from change transport form.
 * @param $m_Image Boolean telling if user uploaded an image or not.
 */
function update_Transport($m_Id_Transport,$m_Place_Start,$m_Place_End,$m_Date_Start,$m_Date_End,$m_Time_Start,$m_Time_End,$m_Price,$m_Type,$m_Code,$m_Link,$m_Note,$m_Image)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if($m_Image) //only change image if he uploaded one. In case a one has been previously uploaded, we dont want to remove it.
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
 * @brief Remove a given transport from database.
 * @param $m_Id_Transport Id of the transport to delete.
 */
function remove_Transport($m_Id_Transport)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("DELETE FROM Transport WHERE idTransport = ?");
    $req->bindParam(1,$m_Id_Transport,PDO::PARAM_INT);
    $req->execute();
}