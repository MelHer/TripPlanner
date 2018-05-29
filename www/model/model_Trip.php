<?php

/**
 * @brief Get 5 trip for the given user.
 * @param $m_User_Id id from the user to get trip from.
 * @param $m_Index Offset.
 * @return Returns 5 user's trips from the offset, ordered by creation date.
 */
function get_User_Trip($m_User_Id,$m_Index) 
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //changing offset whith page num
    if($m_Index!=1)
    {
        $m_Index = ($m_Index-1)*5;
    }
    else
    {
        $m_Index = 0;
    }
    
    $req = $connection->prepare("SELECT DISTINCT Trip.* FROM Trip LEFT JOIN Participant ON Trip.idTrip = Participant.fkTrip WHERE fkUser_Organizer = ? OR (fkUser = ? AND Waiting = false) ORDER BY Creation DESC LIMIT ?,5");
    $req->bindParam(1,$m_User_Id,PDO::PARAM_INT);
    $req->bindParam(2,$m_User_Id,PDO::PARAM_STR);
    $req->bindParam(3,$m_Index,PDO::PARAM_INT);
    $req->execute();

    $trips = $req->fetchAll();
    
    return $trips;
}

/**
 * @brief Create a new trip in the database
 * @param $m_Id_Organizer Id of the creator of the trip. Got from SESSION.
 * @param $m_Title Trip's name. Got from new trip form.
 * @param $m_Destination Trip's destination. Got from new trip form.
 * @param $m_Privacy Trip's privacy. Got from new trip form radio choice.
 * @param $m_Creation Trip's creation date. Got from time now.
 * @param $m_Date_Start Trip's begin date. Got from form new trip form.
 * @param $m_Date_End Trip's end date. Got from form new trip form.
 * @param $m_Password Trip's password. Got from time now. Set only if privacy is false.
 * @param $m_Image Bool telling if the users uploaded an image or not.
 */
function create_Trip($m_Id_Organizer,$m_Title,$m_Destination,$m_Privacy,$m_Creation,$m_Date_Start,$m_Date_End,$m_Password,$m_Image)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if($m_Password !== NULL)
    {
        $hash = password_hash($m_Password, PASSWORD_DEFAULT);   
    }
    
    $req = $connection->prepare("INSERT INTO Trip (fkUser_Organizer,Title,Destination,Private,Password,Image,Creation,Date_Start,Date_End) VALUES (?,?,?,?,?,?,?,?,?)");
    $req->bindParam(1,$m_Id_Organizer,PDO::PARAM_INT);
    $req->bindParam(2,$m_Title,PDO::PARAM_STR);
    $req->bindParam(3,$m_Destination,PDO::PARAM_STR);
    $req->bindParam(4,$m_Privacy,PDO::PARAM_BOOL);
    if($m_Password !== NULL)
    {
        $req->bindParam(5,$hash,PDO::PARAM_STR);
    }
    else
    {
        $req->bindParam(5,$m_Password,PDO::PARAM_NULL);
    }
    $req->bindParam(6,$m_Image,PDO::PARAM_BOOL);
    $req->bindParam(7,$m_Creation,PDO::PARAM_STR);
    $req->bindParam(8,$m_Date_Start,PDO::PARAM_STR);
    $req->bindParam(9,$m_Date_End,PDO::PARAM_STR);
    $req->execute();

}

/**
 * @brief Gets id from last trip added from the user in parameter.
 * @param $m_Id_User Id of the user.
 * @return Return the id of the last trip from this user.
 */
function get_Last_Trip($m_Id_User)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT MAX(idTrip) FROM Trip WHERE fkUser_Organizer = ?");
    $req->bindParam(1,$m_Id_User,PDO::PARAM_INT);
    $req->execute();
    
    $id = $req->fetchAll();
    
    return $id;
}

/**
 * @brief Returns a value if the user has a trip with the id passed.
 * @param $m_Id_User Id of the user.
 * @param $m_Id_Trip Id of the trip to check if owned by the user.
 * @return Returns the id if the user has such an id in his trips or nothing.
 */
function get_Trip($m_Id_User, $m_Id_Trip)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT * FROM Trip WHERE fkUser_Organizer = ? AND idTrip = ?");
    $req->bindParam(1,$m_Id_User,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
    
    $results = $req->fetch(PDO::FETCH_ASSOC);
    
    return $results;
}

/**
 * @brief Updates the trip
 * @param $m_Id_Trip The id of the trip to update.
 * @param $m_Title Trip's name. Got from change trip form.
 * @param $m_Destination Trip's destination. Got from change trip form.
 * @param $m_Date_Start Trip's begin date. Got from form change trip form.
 * @param $m_Date_End Trip's end date. Got from form change trip form.
 * @param $m_Image Bool telling if the users uploaded an image or not.
 */
function update_Trip($m_Id_Trip,$m_Title,$m_Destination,$m_Date_Start,$m_Date_End,$m_Image)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if($m_Image) //only change image if he uploaded one. In case a one has been previously uploaded, we dont want to remove it.
    {
        $req = $connection->prepare("UPDATE Trip SET Title=?, Destination=?, Date_Start=?, Date_End=?, Image=? WHERE idTrip=?");
        $req->bindParam(1,$m_Title,PDO::PARAM_STR);
        $req->bindParam(2,$m_Destination,PDO::PARAM_STR);
        $req->bindParam(3,$m_Date_Start,PDO::PARAM_STR);
        $req->bindParam(4,$m_Date_End,PDO::PARAM_STR);
        $req->bindParam(5,$m_Image,PDO::PARAM_BOOL);
        $req->bindParam(6,$m_Id_Trip,PDO::PARAM_INT);  
    }
    else
    {
        $req = $connection->prepare("UPDATE Trip SET Title=?, Destination=?, Date_Start=?, Date_End=? WHERE idTrip=?");
        $req->bindParam(1,$m_Title,PDO::PARAM_STR);
        $req->bindParam(2,$m_Destination,PDO::PARAM_STR);
        $req->bindParam(3,$m_Date_Start,PDO::PARAM_STR);
        $req->bindParam(4,$m_Date_End,PDO::PARAM_STR);
        $req->bindParam(5,$m_Id_Trip,PDO::PARAM_INT);  
    }
    
    $req->execute(); 

}

/**
 * @brief Remove a given trip from database. Deletes also his activites, transports and so...
 * @param $m_Id_Trip Id of the trip to delete.
 */
function remove_Trip($m_Id_Trip)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("DELETE FROM Trip WHERE idTrip = ?");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
}

/**
 * @brief Get the list of all lodgings for a given trip.
 * @param $m_Id_Trip The id of the trip to look for lodgings.
 * @return Returns an array with all lodgings details.
 */
function get_Lodging_From_Trip($m_Id_Trip)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT idLodging, Type, Address,Day_Start, Day_End, Price, Code, Link, Note, Image FROM Lodging INNER JOIN Lodging_Type ON Lodging.fkLodging_Type = Lodging_Type.idLodging_Type WHERE fkTrip = ? ORDER BY Day_Start ASC");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
    
    $lodgings = $req->fetchAll(PDO::FETCH_ASSOC);
    
    return $lodgings;
}

/**
 * @brief Get the list of all transports for a given trip.
 * @param $m_Id_Trip The id of the trip to look for transports.
 * @return Returns an array with all transports details.
 */
function get_Transport_From_Trip($m_Id_Trip)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT idTransport, Type, Place_Start, Place_End, Day_Start, Day_End, Time_Start, Time_End, Price, Link, Code, Note, Image FROM Transport INNER JOIN Transport_Type ON Transport.fkTransport_Type = Transport_Type.idTransport_Type WHERE fkTrip = ? ORDER BY Day_Start ASC");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
    
    $transports = $req->fetchAll(PDO::FETCH_ASSOC);
    
    return $transports;
}

/**
 * @brief Get the list of all activities for a given trip.
 * @param $m_Id_Trip The id of the trip to look for transports.
 * @return Returns an array with all transports details.
 */
function get_Activity_From_Trip($m_Id_Trip)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT * FROM Activity WHERE fkTrip = ? ORDER BY Date ASC");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
    
    $transports = $req->fetchAll(PDO::FETCH_ASSOC);
    
    return $transports;
}

/**
 * @brief Get the list of all prerequisites for a given trip.
 * @param $m_Id_Trip The id of the trip to look for transports.
 * @return Returns an array with all prerequisites details.
 */
function get_Prerequisite_From_Trip($m_Id_Trip)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT * FROM Prerequisite WHERE fkTrip = ? ORDER BY idPrerequisite ASC");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
    
    $prerequisites = $req->fetchAll(PDO::FETCH_ASSOC);
    
    return $prerequisites;
}

/**
 * @brief Get the list of all accepted participants for a given trip.
 * @param $m_Id_Trip The id of the trip to look for participants.
 * @return Returns an array with all accepted participants details.
 */
function get_Participants_From_Trip($m_Id_Trip)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT fkUser, Nickname FROM Participant INNER JOIN User ON Participant.fkUser = User.idUser WHERE fkTrip = ? AND Waiting = 0 ORDER BY Nickname ASC");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
    
    $participants = $req->fetchAll(PDO::FETCH_ASSOC);
    
    return $participants;
}

/**
 * @brief Get 5 public trip. 
 * @param $m_Index Offset.
 * @return Returns 5 public trips from the offset, ordered by creation date.
 */
function get_Public_Trip($m_Index) 
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //changing offset whith page num
    if($m_Index!=1)
    {
        $m_Index = ($m_Index-1)*5;
    }
    else
    {
        $m_Index = 0;
    }
    
    $req = $connection->prepare("SELECT fkUser_Organizer,Nickname,Title,Destination,Date_Start,Date_End,Creation,Image,idTrip FROM Trip INNER JOIN User ON Trip.fkUser_Organizer = User.idUser WHERE Private = false  ORDER BY Creation DESC LIMIT ?,5");
    $req->bindParam(1,$m_Index,PDO::PARAM_INT);
    $req->execute();

    $trips = $req->fetchAll();
    
    return $trips;
}

/**
 * @brief Get a public trip infos. 
 * @param $m_Id_Trip Id of the trip to get infos.
 * @return Returns the trip infos in an array.
 */
function get_Public_Trip_Info($m_Id_Trip)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("SELECT * FROM Trip WHERE idTrip = ? AND Private = false");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
    
    $result = $req->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}

/**
 * @brief Change the privacy of a trip to private
 * @param $m_Id_Trip Id of the trip to change.
 */
function change_Privacy_Private($m_Id_Trip)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("UPDATE Trip SET Private = true, Password = NULL WHERE idTrip = ?");
    $req->bindParam(1,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
}

/**
 * @brief Change the privacy of a trip to public
 * @param $m_Id_Trip Id of the trip to change.
 * @param $m_Password_Hasg Hash of the password.
 */
function change_Privacy_Public($m_Id_Trip, $m_Password_Hash)
{
    $connection = connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $connection->prepare("UPDATE Trip SET Private = false, Password = ? WHERE idTrip = ?");
    $req->bindParam(1,$m_Password_Hash,PDO::PARAM_INT);
    $req->bindParam(2,$m_Id_Trip,PDO::PARAM_INT);
    $req->execute();
}
