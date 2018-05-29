<?php

/**
 * @brief Displays form to create a new transport or validates datas.
 */
function new_Transport()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);
            
            //Check if the user created the requested trip id to add a transport.
            $trip = get_Trip($_SESSION['id'],$id_Trip);
            if(isset($trip) && !empty($trip))
            {
                if($_POST)
                {
                    //Datas validation
                    $checking = check_Transport_Data($_POST);
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
                                $transport_Types = get_Transport_Type();
                                require "view/view_New_Transport.php";
                            }
                        }
                                    
                        //Create record into db
                        $id =   create_Transport($_GET['id'],$_POST['place_Start'],$_POST['place_End'],$_POST['date_Start'],$_POST['date_End'],$_POST['time_Start'],$_POST['time_End'],$_POST['price'],$_POST['type'],$_POST['code'],$_POST['link'],$_POST['note'],$image);
                                    
                        if($image == true)
                        {
                            $file_Destination = "images/user".$_SESSION['id']."/".$id_Trip."/Transport/".$file_Tmp_New_Name;
                            move_uploaded_file($file_Tmp_Name,$file_Destination);
                            rename($file_Destination,"images/user".$_SESSION['id']."/".$id_Trip."/Transport/".$id['0']['idTransport'].".jpg");
                        }
                        
                        header("Location: index.php?action=see_Trip&id=".$id_Trip."/#transport");   
                    }
                    else
                    {
                        $error_Message = $checking;
                        $transport_Types = get_Transport_Type();
                        require "view/view_New_Transport.php";
                    }
                }
                else
                {
                    $transport_Types = get_Transport_Type();
                    require "view/view_New_Transport.php";
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
 * @brief Displays the edit form for transport or validates datas.
 */
function change_Transport()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Transport = check_Number($_GET['id']);
            
            //Check if the user created the requested transport.
            $transport = get_Transport($_SESSION['id'],$id_Transport);
            if(isset($transport) && !empty($transport))
            {
                
                if($_POST)
                {
                    //Datas validation
                    $checking = check_Transport_Data($_POST);
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
                                $transport_Types = get_Transport_Type();
                                require "view/view_Change_Transport.php";
                            }
                        }
                                    
                        //Updates record into db
                        update_Transport($transport['idTransport'],$_POST['place_Start'],$_POST['place_End'],$_POST['date_Start'],$_POST['date_End'],$_POST['time_Start'],$_POST['time_End'],$_POST['price'],$_POST['type'],$_POST['code'],$_POST['link'],$_POST['note'],$image);
                                    
                        if($image == true)
                        {
                            $file_Destination = "images/user".$_SESSION['id']."/".$transport['fkTrip']."/Transport/".$file_Tmp_New_Name;
                            move_uploaded_file($file_Tmp_Name,$file_Destination);
                            rename($file_Destination,"images/user".$_SESSION['id']."/".$transport['fkTrip']."/Transport/".$transport['idTransport'].".jpg");
                        }
                        
                        header("Location: index.php?action=see_Trip&id=".$transport['fkTrip']."/#transport");
                    }
                    else
                    {
                        $error_Message = $checking;
                        $transport_Types = get_Transport_Type();
                        require "view/view_Change_Transport.php";
                    }                           
                }
                else
                {
                    $transport_Types = get_Transport_Type();
                    require "view/view_Change_Transport.php";
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
 * @brief Displays the confirm transport removal form or deletes it.
 */
function delete_Transport()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Transport = check_Number($_GET['id']);
            
            //Check if the user created the requested lodging.
            $transport = get_Transport($_SESSION['id'],$id_Transport);
            if(isset($transport) && !empty($transport))
            {
                
                if($_POST)
                {
                    remove_Transport($transport['idTransport']);
                    
                    $target = "images/user".$_SESSION['id']."/".$transport['fkTrip']."/Transport/".$transport['idTransport'].".jpg";
                    delete_files($target);
                    
                    header("Location: index.php?action=see_Trip&id=".$transport['fkTrip']."/#transport");
                }
                else
                {
                    require "view/view_Delete_Transport.php";
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
 * @brief Check if the datas from the transport are allowed.
 * @param $m_Datas Datas from $_POST
 * @return Returns a message: empty if OK else an error message.
 */
function check_Transport_Data($m_Datas)
{
    $checking = "";
    
    //Place
    if(isset($m_Datas['place_Start']) && !empty($m_Datas['place_Start']) && strlen($m_Datas['place_Start'])<=45 && isset($m_Datas['place_End']) && !empty($m_Datas['place_End']) && strlen($m_Datas['place_End'])<=45)
    {
        //Date
        if(isset($m_Datas['date_Start']) && isset($m_Datas['date_End']) && strtotime($m_Datas['date_Start']) && strtotime($m_Datas['date_End']) && $m_Datas['date_Start'] <= $m_Datas['date_End'])
        {
            //Time
            if(isset($m_Datas['time_Start']) && isset($m_Datas['time_End']) && (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $m_Datas['time_Start']) || $m_Datas['time_Start'] == null) && (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $m_Datas['time_End'])|| $m_Datas['time_End'] == null ))
            {
                //Price
                $price = floatval($m_Datas['price']);
                if($price >= 0 && $price <= 90000000)
                {   
                    //checking id of lodging type
                    $transport_Types = get_Transport_Type();
                    if($m_Datas['type'] > 0 && $m_Datas['type'] <= count($transport_Types))
                    {
                        //Reservation code
                        if(isset($m_Datas['code']) && strlen($m_Datas['code']) <= 45)
                        {
                            //Web link
                            if(isset($m_Datas['link']) && strlen($m_Datas['link']) <= 255)
                            {
                                //Note
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
                $checking = "Temps non valide";
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
        $checking = "Lieux non valides";
        return $checking;   
    }
}