<?php

/**
 * @brief Displays form to create a new lodging.
 */
function new_Lodging()
{
    //Logged user
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        //Trip id
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);
            
            //Check if the user created the requested trip id to add a lodging.
            $trip = select_Trip($_SESSION['id'],$id_Trip);
            if(isset($trip) && !empty($trip))
            {
                if($_POST)
                {
                    //Checking datas
                    $checking = check_Lodging_Data($_POST);
                    if($checking == "")
                    {
                        //Image verifications
                        if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) 
                        {
                            $image_Checker = false;
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
                                $image_Checker = true;
                            }
                            else
                            {
                                $error_Message = $checking;
                                $lodging_Types = select_Lodging_Type();
                                require "view/view_New_Lodging.php";
                            }
                        }   
                                    
                        //Create record into db
                        if(isset($image_Checker)) //prevent creation if image not valid
                        {
                            $id = insert_Lodging($_GET['id'],$_POST['address'],$_POST['date_Start'],$_POST['date_End'],$_POST['price'],$_POST['type'],$_POST['code'],$_POST['link'],$_POST['note'],$image_Checker);
                        }
                         
                        //Set the image file on server
                        if($image_Checker == true)
                        {
                            $file_Destination = "images/user".$_SESSION['id']."/".$id_Trip."/Lodging/".$file_Tmp_New_Name;
                            move_uploaded_file($file_Tmp_Name,$file_Destination);
                            rename($file_Destination,"images/user".$_SESSION['id']."/".$id_Trip."/Lodging/".$id['0']['idLodging'].".jpg");
                        }
                                    
                        header("Location: index.php?action=see_Trip&id=".$id_Trip."/#lodging");
                    }
                    else
                    {
                        $error_Message = $checking;
                        $lodging_Types = select_Lodging_Type();
                        require "view/view_New_Lodging.php";
                    }                          
                }
                else
                {
                    $lodging_Types = select_Lodging_Type();
                    require "view/view_New_Lodging.php";  
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
 * @brief Displays the edit form for loging or validates datas.
 */
function change_Lodging()
{
    //Logged user
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        //Lodging id
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Lodging = check_Number($_GET['id']);
            
            //Check if the user created the requested lodging.
            $lodging = select_Lodging($_SESSION['id'],$id_Lodging);
            if(isset($lodging) && !empty($lodging))
            {
                
                if($_POST)
                {
                    //Checking datas
                    $checking = check_Lodging_Data($_POST);
                    if($checking == "")
                    {
                        //Image verifications
                        if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) 
                        {
                            $image_Checker = false;
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
                                $image_Checker = true;
                            }
                            else
                            {
                                $error_Message = $checking;
                                $lodging_Types = select_Lodging_Type();
                                require "view/view_Change_Lodging.php";
                            }
                        }
                        
                        //Updates record
                        if(isset($image_Checker)) //prevent creation if image not valid
                        {
                            update_Lodging($lodging['idLodging'],$_POST['address'],$_POST['date_Start'],$_POST['date_End'],$_POST['price'],$_POST['type'],$_POST['code'],$_POST['link'],$_POST['note'],$image_Checker);
                        }            
                        
                        //Set image file on server
                        if($image_Checker == true)
                        {
                            $file_Destination = "images/user".$_SESSION['id']."/".$lodging['fkTrip']."/Lodging/".$file_Tmp_New_Name;
                            move_uploaded_file($file_Tmp_Name,$file_Destination);
                            rename($file_Destination,"images/user".$_SESSION['id']."/".$lodging['fkTrip']."/Lodging/".$lodging['idLodging'].".jpg");
                        }
                                    
                        header("Location: index.php?action=see_Trip&id=".$lodging['fkTrip']."/#lodging");
                    }
                    else
                    {
                        $error_Message = $checking;
                        $lodging_Types = select_Lodging_Type();
                        require "view/view_Change_Lodging.php";
                    }                       
                }
                else
                {
                    $lodging_Types = select_Lodging_Type();
                    require "view/view_Change_Lodging.php";
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
 * @brief Displays the confirm lodging removal form or deletes it.
 */
function delete_Lodging()
{
    //Logged user
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        //Lodging id
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Lodging = check_Number($_GET['id']);
        
            //Check if the user created the requested lodging.
            $lodging = select_Lodging($_SESSION['id'],$id_Lodging);
            if(isset($lodging) && !empty($lodging))
            {
                
                if($_POST)
                {
                    remove_Lodging($lodging['idLodging']);
                    
                    $target = "images/user".$_SESSION['id']."/".$lodging['fkTrip']."/Lodging/".$lodging['idLodging'].".jpg";
                    delete_files($target);
                    
                    header("Location: index.php?action=see_Trip&id=".$lodging['fkTrip']."/#lodging");
                }
                else
                {
                    require "view/view_Delete_Lodging.php";
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
 * @param $m_Datas [Array] Datas from $_POST.
 * @return Message: empty if OK else an error message.
 */
function check_Lodging_Data($m_Datas)
{
    $checking = "";
    
    //address
    if(isset($m_Datas['address']) && !empty($m_Datas['address']) && strlen($m_Datas['address'])<=45)
    {
        //Dates
        if(isset($m_Datas['date_Start']) && isset($m_Datas['date_End']) && strtotime($m_Datas['date_Start']) && strtotime($m_Datas['date_End']) && $m_Datas['date_Start'] <= $m_Datas['date_End'])
        {
            //Pricae
            if(isset($m_Datas['price']) && $m_Datas['price'] >= 0 && $m_Datas['price'] <= 900000)
            {   
                //checking id of lodging type
                $lodging_Types = select_Lodging_Type();
                if(isset($m_Datas['type']) && $m_Datas['type'] > 0 && $m_Datas['type'] <= count($lodging_Types))
                {
                    //Code
                    if(isset($m_Datas['code']) && strlen($m_Datas['code']) <= 45)
                    {
                        //Link
                        if(isset($m_Datas['link']) && strlen($m_Datas['link']) <= 255)
                        {
                            //Note
                            if(isset($m_Datas['note']) && strlen($m_Datas['note']) <= 280)
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
                        $checking = "Code non valide";
                        return $checking;
                    }
                }
                else
                {
                    $checking = "Type non valide";
                    return $checking;
                }
            }
            else
            {
                $checking = "Prix entre 0 et 90000000";
                return $checking;
            }
        }
        else
        {
            $checking = "Dates non valides";
            return $checking;
        }
    }
    else
    {
        $checking = "Adresse non valide";
        return $checking;        
     }
}