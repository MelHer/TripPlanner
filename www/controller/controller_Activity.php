<?php

/**
 * @brief Displays form to create a new activity.
 */
function new_Activity()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);
            
            //Check if the user created the requested trip id to add an activity
            $trip = get_Trip($_SESSION['id'],$id_Trip);
            if(isset($trip) && !empty($trip))
            {
                if($_POST)
                {
                    //Checking datas
                    $checking = check_Activity_Data($_POST);
                    if($checking == "")
                    {
                        //Image verifications
                        if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) 
                        {
                            $image = false;
                        }
                        else
                        {
                            $image = $_FILES['image'];
               
                            $file_Name = $_FILES['image']['name'];
                            $file_Tmp_Name = $_FILES['image']['tmp_name'];
                            $file_Size = $_FILES['image']['size'];
                            $file_Error = $_FILES['image']['error'];
                            $file_Type = $_FILES['image']['type'];
               
                            $file_Ext = explode('.',$file_Name);
                            $file_Actual_Ext = strtolower(end($file_Ext));
               
                            $checking = check_Image($file_Actual_Ext, $file_Error, $file_Size);
                            if($checking == "")
                            {
                                $file_Tmp_New_Name = 'img'.$_SESSION['id'].'.jpg';
                                $image = true;
                            }
                            else
                            {
                                $error_Message = $checking;
                                require "view/view_New_Activity.php";
                            }
                        }   
                                    
                        //Create record into db
                        $id = create_Activity($_GET['id'],$_POST['description'],$_POST['date_Activity'],$_POST['price'],$_POST['link'],$_POST['note'],$image);
                                    
                        if($image == true)
                        {
                            $file_Destination = "images/user".$_SESSION['id']."/".$id_Trip."/Activity/".$file_Tmp_New_Name;
                            move_uploaded_file($file_Tmp_Name,$file_Destination);
                            rename($file_Destination,"images/user".$_SESSION['id']."/".$id_Trip."/Activity/".$id['0']['idActivity'].".jpg");
                        }
                                    
                        header("Location: index.php?action=see_Trip&id=".$id_Trip."/#activity");
                    }
                    else
                    {
                        $error_Message = $checking;
                        require "view/view_New_Activity.php";
                    }   
                }
                else
                {
                    require "view/view_New_Activity.php";
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
 * @brief Displays the edit form for activity or validates datas.
 */
function change_Activity()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Activity = check_Number($_GET['id']);
            
            //Check if the user created the requested lodging.
            $activity = get_Activity($_SESSION['id'],$id_Activity);
            if(isset($activity) && !empty($activity))
            {
                
                if($_POST)
                {
                    //Checking datas
                    $checking = check_Activity_Data($_POST);
                    if($checking == "")
                    {
                        //Image verifications
                        if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) 
                        {
                            $image = false;
                        }
                        else
                        {
                            $image = $_FILES['image'];
               
                            $file_Name = $_FILES['image']['name'];
                            $file_Tmp_Name = $_FILES['image']['tmp_name'];
                            $file_Size = $_FILES['image']['size'];
                            $file_Error = $_FILES['image']['error'];
                            $file_Type = $_FILES['image']['type'];
               
                            $file_Ext = explode('.',$file_Name);
                            $file_Actual_Ext = strtolower(end($file_Ext));
               
                            $checking = check_Image($file_Actual_Ext, $file_Error, $file_Size);
                            if($checking == "")
                            {
                                $file_Tmp_New_Name = $_SESSION['id'].'.jpg';
                                $image = true;
                            }
                            else
                            {
                                $error_Message = $checking;
                                require "view/view_Change_Activity.php";
                            }
                        }
                        
                        //Updates record
                        update_Activity($activity['idActivity'],$_POST['description'],$_POST['date_Activity'],$_POST['price'],$_POST['link'],$_POST['note'],$image);
                                    
                                    
                        if($image == true)
                        {
                            $file_Destination = "images/user".$_SESSION['id']."/".$activity['fkTrip']."/Activity/".$file_Tmp_New_Name;
                            move_uploaded_file($file_Tmp_Name,$file_Destination);
                            rename($file_Destination,"images/user".$_SESSION['id']."/".$activity['fkTrip']."/Activity/".$activity['idActivity'].".jpg");
                        }
                                    
                        header("Location: index.php?action=see_Trip&id=".$activity['fkTrip']."/#activity");
                    }
                    else
                    {
                        $error_Message = $checking;
                        require "view/view_Change_Activity.php";
                    }                 
                }
                else
                {
                    require "view/view_Change_Activity.php";
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
 * @brief Displays the confirm activity removal form or deletes it.
 */
function delete_Activity()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Activity = check_Number($_GET['id']);
            
            //Check if the user created the requested lodging.
            $activity = get_Activity($_SESSION['id'],$id_Activity);
            if(isset($activity) && !empty($activity))
            {
                
                if($_POST)
                {
                    remove_Activity($activity['idActivity']);
                    
                    $target = "images/user".$_SESSION['id']."/".$activity['fkTrip']."/Activity/".$activity['idActivity'].".jpg";
                    delete_files($target);
                    
                    header("Location: index.php?action=see_Trip&id=".$activity['fkTrip']."/#activity");
                }
                else
                {
                    require "view/view_Delete_Activity.php";
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
 * @brief Checks if the datas from the lodging are allowed.
 * @param $m_Datas Data from $_POST
 * @return Returns a message: empty if OK else an error message.
 */
function check_Activity_Data($m_Datas)
{
    $checking = "";
    
    if(isset($m_Datas['description']) && !empty($m_Datas['description']) && strlen($m_Datas['description'])<=45)
    {
        if(isset($m_Datas['date_Activity']) && (strtotime($m_Datas['date_Activity']) || $m_Datas['date_Activity']== null ))
        {
            $price = floatval($m_Datas['price']);
            if($price >= 0 && $price <= 90000000)
            {    
                if(isset($m_Datas['link']) && strlen($m_Datas['link']) <= 255)
                {
                    if(isset($m_Datas['note']) && strlen($m_Datas['note']) < 280)
                    {
                        return $checking;
                    }
                    else
                    {
                        $checking = "Remarque non valide";
                        return $checking;
                    }
                                    
                }
                else
                {
                    $checking = "Lien non valide";
                    return $checking;
                }
            }
            else
            {
                $checking = "Prix non valide";
                return $checking;
            }
        }
        else
        {
            $checking = "Date non valide";
            return $checking;
        }
    }
    else
    {
        $checking = "Description non valide";
        return $checking;        
     }
}