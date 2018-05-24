<?php

/**
 * @brief Displays form to confirm participant removal or execute it.
 */
function delete_Participant()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);
            
            //Check if the user created the requested trip id to delete a participant
            $trip = get_Trip($_SESSION['id'],$id_Trip);
            if(isset($trip) && !empty($trip))
            {
                //Check if the user is participating
                $participation = get_Participant($_GET['id'],$_GET['participant']);
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

/*
 * @brief Display all the request to join user's trips.
 */
function see_Request()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        $requests = get_Request($_SESSION['id']);
        require "view/view_Request.php";
    }
    else
    {
        header('Location: index.php?action=login');
    }
}

/*
 * @brief Accept a request. User who made it become participant to the trip.
 */
function accept_Request()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        $id_Trip = check_Number($_GET['trip']);

        //Check if the user created the requested trip id.
        $trip = get_Trip($_SESSION['id'],$id_Trip);
        if(isset($trip) && !empty($trip))
        {
            $id_User = intval($_GET['user']);
            $id_User = abs($id_User);
            
            if($id_User==0)
            {
                $id_User=1;
            }

            update_Request($id_Trip,$id_User);

            $requests = get_Request($_SESSION['id']);
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

/*
 * @brief Remove a request. Delete the record in the database
 */
function delete_Request()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        $id_Trip = check_Number($_GET['trip']);

        //Check if the user created the requested trip id.
        $trip = get_Trip($_SESSION['id'],$id_Trip);
        if(isset($trip) && !empty($trip))
        {
            $id_User = check_Number($_GET['user']);

            remove_Participant($_GET['trip'],$_GET['user']);

            $requests = get_Request($_SESSION['id']);
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



