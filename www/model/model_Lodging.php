<?php

/**
 * @brief Gets the types of lodging.
 * @return Returns an array containing all types
 */
function get_Lodging_Type() 
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT * FROM Lodging_Type ORDER BY Type");
    $req->execute();

    $lodging_Types = $req->fetchAll(PDO::FETCH_ASSOC);
    
    return $lodging_Types;
}

/**
 * @brief Create a new Lodging in the database.
 * @param $m_Id_Trip Id of the trip to create lodging for.
 * @param $m_Address Lodging address. Got from new lodging form.
 * @param $m_Date_Start Lodging arrival. Got from new lodging form.
 * @param $m_Date_End Lodging Departure. Got from new lodging form.
 * @param $m_Price Lodging cost. Got from new lodging form.
 * @param $m_Type Type of lodging. Got from new lodging form.
 * @param $m_Code Reservation code. Got from new lodging form.
 * @param $m_Link Web link to reservation.
 * @param $m_Note Commentary of the creator of the trip.
 * @param $m_Image Boolean telling if user uploaded an image or not.
 * @return Returns the id of the record.
 */
function create_Lodging($m_Id_Trip,$m_Address,$m_Date_Start,$m_Date_End,$m_Price,$m_Type,$m_Code,$m_Link,$m_Note,$m_Image)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    $req = $connection->prepare("INSERT INTO Lodging (fkLodging_Type,fkTrip,Address,Day_Start,Day_End,Price,Code,Link,Note,Image) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $req->bindParam(1,$m_Type,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_Trip,PDO::PARAM_INT);
    $req->bindParam(3,$m_Address,PDO::PARAM_STR);
    $req->bindParam(4,$m_Date_Start,PDO::PARAM_STR);
    $req->bindParam(5,$m_Date_End,PDO::PARAM_STR);
    $req->bindParam(6,$m_Price,PDO::PARAM_STR);
    $req->bindParam(7,$m_Code,PDO::PARAM_STR);
    $req->bindParam(8,$m_Link,PDO::PARAM_STR);
    $req->bindParam(9,$m_Note,PDO::PARAM_STR);
    $req->bindParam(10,$m_Image,PDO::PARAM_BOOL);
    $req->execute();
    
    //Getting the id of the last insert.
    $req = $connection->prepare("SELECT MAX(idLodging) as idLodging FROM Lodging WHERE fkTrip = ?");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
    
    $id = $req->FetchAll(PDO::FETCH_ASSOC);
    
    return $id;

}

/**
 * @brief Returns if the passed user id owns the passed lodging id.
 * @param $m_Id_User Id of the user, got from $_SESSION['id'].
 * @param $m_Id_Lodging Id of the lodging to check if owned by the user.
 * @return Returns the id if the user created this lodging.
 */
function get_Lodging($m_Id_User, $m_Id_Lodging)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT Lodging.* FROM Lodging INNER JOIN Trip ON Lodging.fkTrip = Trip.idTrip WHERE Trip.fkUser_Organizer = ? AND Lodging.idLodging = ?");
    $req->bindParam(1,$m_Id_User,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_Lodging,PDO::PARAM_INT);
    $req->execute();
    
    $id = $req->fetch(PDO::FETCH_ASSOC);
    
    return $id;
}


/**
 * @brief Updates a lodging in the database
 * @param $m_Id_Lodging Id of the lodging to update.
 * @param $m_Address Lodging address. Got from change lodging form.
 * @param $m_Date_Start Lodging arrival. Got from change lodging form.
 * @param $m_Date_End Lodging Departure. Got from change lodging form.
 * @param $m_Price Lodging cost. Got from change lodging form.
 * @param $m_Type Type of lodging. Got from change lodging form.
 * @param $m_Code Reservation code. Got from change lodging form.
 * @param $m_Link Web link to reservation. Got from change lodging form.
 * @param $m_Note Commentary of the creator of the trip. Got from change lodging form.
 * @param $m_Image Boolean telling if user uploaded an image or not. Got from change lodging datas validation.
 */
function update_Lodging($m_Id_Lodging,$m_Address,$m_Date_Start,$m_Date_End,$m_Price,$m_Type,$m_Code,$m_Link,$m_Note,$m_Image)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if($m_Image) //only change image if he uploaded one. In case a one has been previously uploaded, we dont want to remove it.
    {
        $req = $connection->prepare("UPDATE Lodging SET Address= ?, Day_Start= ?, Day_End=? , Price=?, Code=?, Link=?, Note=?, Image=?, fkLodging_Type=? WHERE idLodging = ?");
        $req->bindParam(1,$m_Address,PDO::PARAM_STR);
        $req->bindParam(2,$m_Date_Start,PDO::PARAM_STR);
        $req->bindParam(3,$m_Date_End,PDO::PARAM_STR);
        $req->bindParam(4,$m_Price,PDO::PARAM_STR);
        $req->bindParam(5,$m_Code,PDO::PARAM_STR);
        $req->bindParam(6,$m_Link,PDO::PARAM_STR);
        $req->bindParam(7,$m_Note,PDO::PARAM_STR);
        $req->bindParam(8,$m_Image,PDO::PARAM_BOOL);
        $req->bindParam(9,$m_Type,PDO::PARAM_INT);
        $req->bindParam(10,$m_Id_Lodging,PDO::PARAM_INT);
        $req->execute();
    }
    else
    {
        $req = $connection->prepare("UPDATE Lodging SET Address= ?, Day_Start= ?, Day_End=? , Price=?, Code=?, Link=?, Note=?, fkLodging_Type=? WHERE idLodging = ?");
        $req->bindParam(1,$m_Address,PDO::PARAM_STR);
        $req->bindParam(2,$m_Date_Start,PDO::PARAM_STR);
        $req->bindParam(3,$m_Date_End,PDO::PARAM_STR);
        $req->bindParam(4,$m_Price,PDO::PARAM_STR);
        $req->bindParam(5,$m_Code,PDO::PARAM_STR);
        $req->bindParam(6,$m_Link,PDO::PARAM_STR);
        $req->bindParam(7,$m_Note,PDO::PARAM_STR);
        $req->bindParam(8,$m_Type,PDO::PARAM_INT);
        $req->bindParam(9,$m_Id_Lodging,PDO::PARAM_INT);
        $req->execute();
    }
}

/**
 * @brief Remove a given lodging from database.
 * @param $m_Id_Lodging Id of the lodging to delete.
 */
function remove_Lodging($m_Id_Lodging)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("DELETE FROM Lodging WHERE idLodging = ?");
    $req->bindParam(1,$m_Id_Lodging,PDO::PARAM_INT);
    $req->execute();
}