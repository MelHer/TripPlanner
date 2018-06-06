<?php

/**
 * @brief Create a new activity in the database.
 * @param $m_Id_Trip [Int] Id of the trip to create activity for.
 * @param $m_Description [String] Activity description. Got from new activity form.
 * @param $m_Date [String] Activity date. Got from new activity form.
 * @param $m_Price [Float] Activity cost. Got from new activity form.
 * @param $m_Link [String] Web link to the activity.
 * @param $m_Note [String] Commentary of the creator of the trip.
 * @param $m_Image [Boolean]Did the user upload an image or not.
 * @return Id of the record.
 */
function insert_Activity($m_Id_Trip,$m_Description,$m_Date,$m_Price,$m_Link,$m_Note,$m_Image)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if($m_Date == null)
    {
        $req = $connection->prepare("INSERT INTO Activity (fkTrip,Description,Date,Price,Link,Note,Image) VALUES (?,?,null,?,?,?,?)");
        $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
        $req->bindParam(2,$m_Description,PDO::PARAM_STR);
        $req->bindParam(3,$m_Price,PDO::PARAM_STR);
        $req->bindParam(4,$m_Link,PDO::PARAM_STR);
        $req->bindParam(5,$m_Note,PDO::PARAM_STR);
        $req->bindParam(6,$m_Image,PDO::PARAM_BOOL);
        $req->execute();   
    }
    else
    {
        $req = $connection->prepare("INSERT INTO Activity (fkTrip,Description,Date,Price,Link,Note,Image) VALUES (?,?,?,?,?,?,?)");
        $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
        $req->bindParam(2,$m_Description,PDO::PARAM_STR);
        $req->bindParam(3,$m_Date,PDO::PARAM_STR);
        $req->bindParam(4,$m_Price,PDO::PARAM_STR);
        $req->bindParam(5,$m_Link,PDO::PARAM_STR);
        $req->bindParam(6,$m_Note,PDO::PARAM_STR);
        $req->bindParam(7,$m_Image,PDO::PARAM_BOOL);
        $req->execute();   
    }
    
    //Getting the id of the last insert.
    $req = $connection->prepare("SELECT MAX(idActivity) as idActivity FROM Activity WHERE fkTrip = ?");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
    
    $id = $req->FetchAll(PDO::FETCH_ASSOC);
    
    return $id;

}

/**
 * @brief Gets an activity values for the given user.
 * @param $m_Id_User [Int] Id of the user, got from $_SESSION['id'].
 * @param $m_Id_Activity [Int] Id of the activity.
 * @return Activity details if the user created this activity or nothing.
 */
function select_Activity($m_Id_User, $m_Id_Activity)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT Activity.* FROM Activity INNER JOIN Trip ON Activity.fkTrip = Trip.idTrip WHERE Trip.fkUser_Organizer = ? AND Activity.idActivity = ?");
    $req->bindParam(1,$m_Id_User,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_Activity,PDO::PARAM_INT);
    $req->execute();
    
    $result = $req->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}


/**
 * @brief Updates an activity.
 * @param $m_Id_Activity [Int] Id of the activity to update.
 * @param $m_Description [String] Activity description. Got from change activity form.
 * @param $m_Date [String] Activity date. Got from change activity form.
 * @param $m_Price [Float] Activity cost. Got from change activity form.
 * @param $m_Link [String] Web link to reservation. Got from change activity form.
 * @param $m_Note [String] Commentary of the creator of the trip. Got from change activity form.
 * @param $m_Image [Boolean] Did the user upload an image. Got from change activity datas validation.
 */
function update_Activity($m_Id_Activity,$m_Description,$m_Date,$m_Price,$m_Link,$m_Note,$m_Image)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if($m_Image) //only change image if he uploaded one. In case a one has been previously uploaded, we dont want to remove it.
    {
        //Passing null date either with PARAM_BOOL or PARAM_STR gives back an error so we create a request for case in which $m_Date is null.
        if($m_Date != null)
        {
            $req = $connection->prepare("UPDATE Activity SET Description= ?, Date= ?, Price=? , Link=?, Note=?, Image=? WHERE idActivity = ?");
            $req->bindParam(1,$m_Description,PDO::PARAM_STR);
            $req->bindParam(2,$m_Date,PDO::PARAM_STR);
            $req->bindParam(3,$m_Price,PDO::PARAM_STR);
            $req->bindParam(4,$m_Link,PDO::PARAM_STR);
            $req->bindParam(5,$m_Note,PDO::PARAM_STR);
            $req->bindParam(6,$m_Image,PDO::PARAM_BOOL);
            $req->bindParam(7,$m_Id_Activity,PDO::PARAM_STR);
        }
        else
        {
            $req = $connection->prepare("UPDATE Activity SET Description= ?, Date = null, Price=? , Link=?, Note=?, Image=? WHERE idActivity = ?");
            $req->bindParam(1,$m_Description,PDO::PARAM_STR);
            $req->bindParam(2,$m_Price,PDO::PARAM_STR);
            $req->bindParam(3,$m_Link,PDO::PARAM_STR);
            $req->bindParam(4,$m_Note,PDO::PARAM_STR);
            $req->bindParam(5,$m_Image,PDO::PARAM_BOOL);
            $req->bindParam(6,$m_Id_Activity,PDO::PARAM_STR);
        }
    }
    else
    {
        if($m_Date != null)
        {
            $req = $connection->prepare("UPDATE Activity SET Description= ?, Date= ?, Price=? , Link=?, Note=? WHERE idActivity = ?");
            $req->bindParam(1,$m_Description,PDO::PARAM_STR);
            $req->bindParam(2,$m_Date,PDO::PARAM_STR);
            $req->bindParam(3,$m_Price,PDO::PARAM_STR);
            $req->bindParam(4,$m_Link,PDO::PARAM_STR);
            $req->bindParam(5,$m_Note,PDO::PARAM_STR);
            $req->bindParam(6,$m_Id_Activity,PDO::PARAM_STR);
        }
        else
        {
            $req = $connection->prepare("UPDATE Activity SET Description= ?, Date = null, Price=? , Link=?, Note=? WHERE idActivity = ?");
            $req->bindParam(1,$m_Description,PDO::PARAM_STR);
            $req->bindParam(2,$m_Price,PDO::PARAM_STR);
            $req->bindParam(3,$m_Link,PDO::PARAM_STR);
            $req->bindParam(4,$m_Note,PDO::PARAM_STR);
            $req->bindParam(5,$m_Id_Activity,PDO::PARAM_STR);
        }
    }
    
    $req->execute();
}

/**
 * @brief Deletes a given activity.
 * @param $m_Id_Activity [Int] Id of the activity to delete.
 */
function remove_Activity($m_Id_Activity)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("DELETE FROM Activity WHERE idActivity = ?");
    $req->bindParam(1,$m_Id_Activity,PDO::PARAM_INT);
    $req->execute();
}