<?php

/**
 * @brief Displays form to create a new lodging.
 */
function new_Lodging()
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
            
            //Check if the user created the requested trip id to add a lodging.
            $trip = get_Trip($_SESSION['id'],$id_Trip);
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
                                $lodging_Types = get_Lodging_Type();
                                require "view/view_New_Lodging.php";
                            }
                        }   
                                    
                        //Create record into db
                        $id = create_Lodging($_GET['id'],$_POST['address'],$_POST['date_Start'],$_POST['date_End'],$_POST['price'],$_POST['type'],$_POST['code'],$_POST['link'],$_POST['note'],$image);
                                    
                        if($image == true)
                        {
                            $file_Destination = "images/user".$_SESSION['id']."/".$id_Trip."/Lodging/".$file_Tmp_New_Name;
                            move_uploaded_file($file_Tmp_Name,$file_Destination);
                            rename($file_Destination,"images/user".$_SESSION['id']."/".$id_Trip."/Lodging/".$id['0']['idLodging'].".jpg");
                        }
                                    
                        header("Location: index.php?action=see_Trip&id=".$id_Trip);
                    }
                    else
                    {
                        $error_Message = $checking;
                        $lodging_Types = get_Lodging_Type();
                        require "view/view_New_Lodging.php";
                    }                          
                }
                else
                {
                    $lodging_Types = get_Lodging_Type();
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
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Lodging = intval($_GET['id']);
            $id_Lodging = abs($id_Lodging);
            
            if($id_Lodging==0)
            {
                $id_Lodging=1;
            }
            
            //Check if the user created the requested lodging.
            $lodging = get_Lodging($_SESSION['id'],$id_Lodging);
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
                                $lodging_Types = get_Lodging_Type();
                                require "view/view_Change_Lodging.php";
                            }
                        }
                        
                        //Updates record
                        update_Lodging($lodging['idLodging'],$_POST['address'],$_POST['date_Start'],$_POST['date_End'],$_POST['price'],$_POST['type'],$_POST['code'],$_POST['link'],$_POST['note'],$image);
                                    
                                    
                        if($image == true)
                        {
                            $file_Destination = "images/user".$_SESSION['id']."/".$lodging['fkTrip']."/Lodging/".$file_Tmp_New_Name;
                            move_uploaded_file($file_Tmp_Name,$file_Destination);
                            rename($file_Destination,"images/user".$_SESSION['id']."/".$lodging['fkTrip']."/Lodging/".$lodging['idLodging'].".jpg");
                        }
                                    
                        header("Location: index.php?action=see_Trip&id=".$lodging['fkTrip']);
                    }
                    else
                    {
                        $error_Message = $checking;
                        $lodging_Types = get_Lodging_Type();
                        require "view/view_Change_Lodging.php";
                    }                       
                }
                else
                {
                    $lodging_Types = get_Lodging_Type();
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
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Lodging = intval($_GET['id']);
            $id_Lodging = abs($id_Lodging);
            
            if($id_Lodging==0)
            {
                $id_Lodging=1;
            }
            
            //Check if the user created the requested lodging.
            $lodging = get_Lodging($_SESSION['id'],$id_Lodging);
            if(isset($lodging) && !empty($lodging))
            {
                
                if($_POST)
                {
                    remove_Lodging($lodging['idLodging']);
                    
                    $target = "images/user".$_SESSION['id']."/".$lodging['fkTrip']."/Lodging/".$lodging['idLodging'].".jpg";
                    delete_files($target);
                    
                    header("Location: index.php?action=see_Trip&id=".$lodging['fkTrip']);
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
 * @param $m_Datas Data from $_POST
 * @return Returns a message: empty if OK else an error message.
 */
function check_Lodging_Data($m_Datas)
{
    $checking = "";
    
    if(isset($m_Datas['address']) && !empty($m_Datas['address']) && strlen($m_Datas['address'])<=45)
    {
        if(isset($m_Datas['date_Start']) && isset($m_Datas['date_End']) && strtotime($m_Datas['date_Start']) && strtotime($m_Datas['date_End']) && $m_Datas['date_Start'] <= $m_Datas['date_End'])
        {
            $price = floatval($m_Datas['price']);
            if($price >= 0 && $price <= 90000000)
            {   
                //checking id of lodging type
                $lodging_Types = get_Lodging_Type();
                if($m_Datas['type'] > 0 && $m_Datas['type'] <= count($lodging_Types))
                {
                    if(isset($m_Datas['code']) && strlen($m_Datas['code']) <= 45)
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
                $checking = "Prix non valide";
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