<?php

/**
 * @brief Displays form to create a new prerequisite or validates datas.
 */
function new_Prerequisite()
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
            
            //Check if the user created the requested trip id to add a prerequisite
            $trip = get_Trip($_SESSION['id'],$id_Trip);
            if(isset($trip) && !empty($trip))
            {
                if($_POST)
                {
                    //Checking datas
                    $checking = check_Prerequisite_Data($_POST);
                    if($checking == "")
                    {          
                        
                        //Create record into db
                        if(isset($_POST['ready']))
                        {
                            create_Prerequisite($_GET['id'],$_POST['name'],$_POST['quantity'],true);  
                        }
                        else
                        {
                            create_Prerequisite($_GET['id'],$_POST['name'],$_POST['quantity']);  
                        }     
                        header("Location: index.php?action=see_Trip&id=".$id_Trip."/#prerequisite");

                    }
                    else
                    {
                        $error_Message = $checking;
                        require "view/view_New_Prerequisite.php";
                    }
                }
                else
                {
                    require "view/view_New_Prerequisite.php";
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
 * @brief Displays the edit form for prerequisite or validates datas
 */
function change_Prerequisite()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Prerequisite = intval($_GET['id']);
            $id_Prerequisite = abs($id_Prerequisite);
            
            if($id_Prerequisite==0)
            {
                $id_Prerequisite=1;
            }
            
            //Check if the user created the requested lodging.
            $prerequisite = get_Prerequisite($_SESSION['id'],$id_Prerequisite);
            if(isset($prerequisite) && !empty($prerequisite))
            {
                
                if($_POST)
                {
                    //Checking datas
                    $checking = check_Prerequisite_Data($_POST);
                    if($checking == "")
                    {
                        //Updates record
                        if(isset($_POST['ready']))
                        {
                            update_Prerequisite($prerequisite['idPrerequisite'],$_POST['name'],$_POST['quantity'],true);
                        }
                        else
                        {
                            update_Prerequisite($prerequisite['idPrerequisite'],$_POST['name'],$_POST['quantity']);
                        }
                                    
                        header("Location: index.php?action=see_Trip&id=".$prerequisite['fkTrip']."/#prerequisite");
                    }
                    else
                    {
                        $error_Message = $checking;
                        require "view/view_Change_Prerequisite.php";
                    }                 
                }
                else
                {
                    require "view/view_Change_Prerequisite.php";
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
 * @brief Displays the confirm prerequisite removal form or deletes it.
 */
function delete_Prerequisite()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Prerequisite = intval($_GET['id']);
            $id_Prerequisite = abs($id_Prerequisite);
            
            if($id_Prerequisite==0)
            {
                $id_Prerequisite=1;
            }
            
            //Check if the user created the requested lodging.
            $prerequisite = get_Prerequisite($_SESSION['id'],$id_Prerequisite);
            if(isset($prerequisite) && !empty($prerequisite))
            {
                
                if($_POST)
                {
                    remove_Prerequisite($prerequisite['idPrerequisite']);
                    header("Location: index.php?action=see_Trip&id=".$prerequisite['fkTrip']."/#prerequisite");
                }
                else
                {
                    require "view/view_Delete_Prerequisite.php";
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
 * @brief Checks if the datas from the prerequisite are allowed.
 * @param $m_Datas Data from $_POST
 * @return Returns a message: empty if OK else an error message.
 */
function check_Prerequisite_Data($m_Datas)
{
    $checking = "";
    
    if(isset($m_Datas['name']) && !empty($m_Datas['name']) && strlen($m_Datas['name'])<=45)
    {
        $quantity = intval($m_Datas['quantity']);
        if($quantity >= 0 && $quantity<=9999)
        {    
            if(isset($m_Datas['ready']) && $m_Datas['ready'] == 'on' ||!isset($m_Datas['ready']))
            { 
                return $checking;        
            }
            else
            {
                $checking = "Etat non valide";
                return $checking;
            }
        }
        else
        {
            $checking = "Quantité non valide";
            return $checking;
        }
    }
    else
    {
        $checking = "Nom non valide";
        return $checking;        
     }
}