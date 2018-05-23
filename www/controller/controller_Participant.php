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
            $id_Trip = intval($_GET['id']);
            $id_Trip = abs($id_Trip);
            
            if($id_Trip==0)
            {
                $id_Trip=1;
            }
            
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





