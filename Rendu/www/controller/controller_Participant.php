<?php

/**
 * @brief Displays form to confirm participant removal or remove him.
 */
function delete_Participant()
{
    //Logged user
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        //Trip id
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);
            
            //Check if the user created the requested trip id to delete a participant from it.
            $trip = select_Trip($_SESSION['id'],$id_Trip);
            if(isset($trip) && !empty($trip))
            {
                //Check if the user participant is really participating.
                $participation = select_Participant($_GET['id'],$_GET['participant']);
                if(isset($participation) && !empty($participation))
                {
                    if($_POST)
                    {
                        remove_Participant($participation['fkTrip'],$participation['fkUser']);
                        header("Location: index.php?action=see_Trip&id=".$participation['fkTrip']."/#participant");
                    }
                    else
                    {
                        require "view/view_Delete_Participant.php";
                    } 
                }
                else
                {
                    $error_Message = "Cet utilisateur ne participe pas à votre voyage";
                    require "view/view_Delete_Participant.php";
                }
            }
            else
            {
                header('Location: index.php?action=new_Trip');
            }
        }
        else
        {
            header('Location: index.php?action=my_Trip&page=1');
        }
    }
    else
    {
        header('Location: index.php?action=login');
    }
}

/** 
 * @brief Displays all the requests to join the trips from the user.
 */
function see_Request()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        $requests = select_Request($_SESSION['id']);
        require "view/view_Request.php";
    }
    else
    {
        header('Location: index.php?action=login');
    }
}

/**
 * @brief Accepts a request. User who made it become participant to the trip.
 */
function accept_Request()
{
    //Logged user
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        $id_Trip = check_Number($_GET['trip']);

        //Check if the user created the requested trip id.
        $trip = select_Trip($_SESSION['id'],$id_Trip);
        if(isset($trip) && !empty($trip))
        {
            $id_User = check_Number($_GET['user']);

            update_Request($id_Trip,$id_User);

            $requests = select_Request($_SESSION['id']);
            $info_Message = "Utilisateur accepté avec succès";
            require "view/view_Request.php";

        }
        else
        {
            $error_Message = "Ce voyage ne vous appartient pas";
            require "view/view_Request.php";
        }
    }
    else
    {
        header('Location: index.php?action=login');
    }
}

/**
 * @brief Removes a request. Deletes the record in the database.
 */
function delete_Request()
{
    //Logged user
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        $id_Trip = check_Number($_GET['trip']);

        //Check if the user created the requested trip id.
        $trip = select_Trip($_SESSION['id'],$id_Trip);
        if(isset($trip) && !empty($trip))
        {
            $id_User = check_Number($_GET['user']);

            remove_Participant($id_Trip,$_GET['user']);

            $requests = select_Request($_SESSION['id']);
            $info_Message = "Utilisateur refusé avec succès";
            require "view/view_Request.php";
        }
        else
        {
            $error_Message = "Ce voyage ne vous appartient pas";
            require "view/view_Request.php";
        }
    }
    else
    {
        header('Location: index.php?action=login');
    }
}

/**
 * @brief Cancels a processing request or removes a participant on his demand.
 */
function cancel_Participation()
{
    //Logged user
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        $id_Trip = check_Number($_GET['trip']);
        
        $registred = select_Registration($id_Trip,$_SESSION['id']); //getting registration info, is it accepted or in progress
        
        if(isset($registred) && !empty($registred))
        {
            remove_Self($_SESSION['id'], $registred['fkTrip']);
            
            
            $info_Message = "Vous ne participez plus au voyage";
            
            //Getting public trip infos
            $participant_Trip = select_Public_Trip_Info($id_Trip);
            
            //Still public
            if(isset($participant_Trip) && !empty($participant_Trip))
            {
                $lodgings = select_Lodging_From_Trip($id_Trip);
                $transports = select_Transport_From_Trip($id_Trip);
                $activities = select_Activity_From_Trip($id_Trip);
                $prerequisites = select_Prerequisite_From_Trip($id_Trip);
                $participants = select_Participants_From_Trip($id_Trip);

                //If not set the user won't be able to register for trip
                $_SESSION['public'] = $registred['fkTrip'];

                $registred = select_Registration($participant_Trip['idTrip'],$_SESSION['id']); //updates the registration control on top of the trip.
                require "view/view_Detailed_Public_Trip.php";
            }
            else
            {
                header('Location: index.php?action=public_Trip&page=1');
            }
        }
        else
        {
            require "view/view_Home.php";
        }
    }
    else
    {
        header('Location: index.php?action=login');
    }
}


