<?php

/**
 * @brief Displays the user trip list.
 */
function my_Trip()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['page'])&& !empty($_GET['page']))
        {
            $page_Num = check_Number($_GET['page']);
            
            $trips = select_User_Trip($_SESSION['id'],$page_Num);
            
            if(empty($trips))
            {
                $info_Message = "Il n'y a plus de voyages à montrer.";
            }

            require "view/view_My_Trip.php";
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
 * @brief Displays the new trip form or create the trip.
 */
function new_Trip()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if($_POST)
        {
            $checking = check_Trip_Data($_POST);
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
                        $file_Tmp_New_Name = 'img'.$_SESSION['id'].'.'.$file_Actual_Ext;
                        $image_Checker = true;
                    }
                    else
                    {
                        $error_Message = $checking;
                        require "view/view_New_Trip.php"; 
                    }
                }
            
                //Privacy verifications
                if(isset($_POST['privacy']) && !empty($_POST['privacy']))
                {
                    if($_POST['privacy'] == 'private')
                    {
                        $privacy = true;
                        $password = NULL;
                    } 
                    else
                    {
                        if(isset($_POST['password'])&& !empty($_POST['password']) && isset($_POST['password_Confirmation']) && !empty($_POST['password_Confirmation']) && strlen($_POST['password'])>=6 && strlen($_POST['password']) <= 50)
                        {
                            if($_POST['password'] == $_POST['password_Confirmation'])
                            {
                                $privacy = false;
                                $password = $_POST['password'];
                            }
                            else
                            {
                                $error_Message = "Les mots de passent ne sont pas identiques";
                                require "view/view_New_Trip.php"; 
                            }
                        }
                        else
                        {
                            $error_Message = "Les mots doivent faire entre 6 et 50 caractères.";
                            require "view/view_New_Trip.php"; 
                        }
                    }
                }
            
                //Request execution
                if(isset($image_Checker) && isset($privacy))
                {
                    
                    insert_Trip($_SESSION['id'],$_POST['title'],$_POST['destination'],$privacy,date('Y-m-d'),$_POST['date_Start'],$_POST['date_End'],$password,$image_Checker); 
                
                    //Creating trip folder
                    $id_Trip = select_Last_User_Trip($_SESSION['id']);
                    $path = "images/user".$_SESSION['id']."/".$id_Trip['0']['0'];
                    mkdir($path, 0755);
                    mkdir($path.'/Activity', 0755);
                    mkdir($path.'/Lodging', 0755);
                    mkdir($path.'/Transport', 0755);
                
                    //Renaming the image with the id of the trip
                    if($image_Checker == true)
                    {
                        $file_Destination = $path.'/'.$file_Tmp_New_Name;
                        move_uploaded_file($file_Tmp_Name,$file_Destination);
                        rename($file_Destination,$path."/".$id_Trip['0']['0'].".jpg");
                    }
                
                    header('Location: index.php?action=my_Trip&page=1');
                }
                else
                {
                    require "view/view_New_Trip.php"; 
                }  
            }
            else
            {
                $error_Message = $checking;
                require "view/view_New_Trip.php";
            }    
        }
        else
        {
            require "view/view_New_Trip.php";   
        }
    }
    else
    {
         header('Location: index.php?action=login');
    }
}


/**
 * @brief Displays the trip details page.
 */
function see_Trip()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);
            
            //Check if the user created the requested trip id.
            $trip = select_Trip($_SESSION['id'],$id_Trip);
            //If he is a participant
            $participant_Trip = select_Accepted_Registration($_SESSION['id'],$id_Trip);
            if((isset($trip) && !empty($trip)) ||  (isset($participant_Trip) && !empty($participant_Trip)))
            {

                $lodgings = select_Lodging_From_Trip($id_Trip);
                $transports = select_Transport_From_Trip($id_Trip);
                $activities = select_Activity_From_Trip($id_Trip);
                $prerequisites = select_Prerequisite_From_Trip($id_Trip);
                $participants = select_Participants_From_Trip($id_Trip);

                if($trip)
                {
                    require "view/view_Detailed_Trip.php";  
                }
                
                if($participant_Trip)
                {
                    $registred = select_Registration($participant_Trip['idTrip'],$_SESSION['id']); //if already in registration doesn't display "Registration button"
                    require "view/view_Detailed_Public_Trip.php";
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
 * @brief Displays form to change trip infos.
 */
function change_Trip()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);
            
            //Check if the user created the requested trip id.
            $trip = select_Trip($_SESSION['id'],$id_Trip);
            if(isset($trip) && !empty($trip))
            {
                if($_POST)
                {
                    //data validation
                    $checking = check_Trip_Data($_POST);
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
                                $file_Tmp_New_Name = $_SESSION['id'].'.'.$file_Actual_Ext;
                                $image_Checker = true;
                            }
                            else
                            {
                                $error_Message = $checking;
                                require "view/view_Change_Trip.php"; 
                            }
                        }
                        
                        //If an error with image prevents execution.
                        if(isset($image_Checker))
                        {
                            update_Trip($trip['idTrip'],$_POST['title'],$_POST['destination'],$_POST['date_Start'],$_POST['date_End'],$image_Checker);
                        }
                        
                        if($image_Checker == true)
                        {
                            $file_Destination = "images/user".$_SESSION['id']."/".$id_Trip."/".$file_Tmp_New_Name;
                            move_uploaded_file($file_Tmp_Name,$file_Destination);
                            rename($file_Destination,"images/user".$_SESSION['id']."/".$trip['idTrip']."/".$trip['idTrip'].".jpg");
                        }
                
                        header("Location: index.php?action=see_Trip&id=".$trip['idTrip']);
                    }
                    else
                    {
                        $error_Message = $checking;
                        require "view/view_Change_Trip";
                    }
                }
                else
                {
                    require "view/view_Change_Trip.php";
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
 * @brief Displays form to confirm trip removal or deletes it.
 */
function delete_Trip()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);
            
            //Check if the user created the requested trip id.
            $trip = select_Trip($_SESSION['id'],$id_Trip);
            if(isset($trip) && !empty($trip))
            {
                if($_POST)
                {
                    remove_Trip($trip['idTrip']);
                    
                    $target = "images/user".$_SESSION['id']."/".$trip['idTrip'];
                    delete_files($target);
                    
                    header('Location: index.php?action=my_Trip&page=1');
                }
                else
                {
                    require "view/view_Delete_Trip.php";     
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
 * @brief Check if the datas from the trip are allowed.
 * @param $m_Datas Datas from $_POST
 * @return Returns a message: empty if OK else an error message.
 */
function check_Trip_Data($m_Datas)
{
    $checking = "";
    
    //Data validation
    if(isset($m_Datas['title']) && !empty($m_Datas['title']) && strlen($m_Datas['title'])<=45)
    {
        if(isset($m_Datas['destination']) && !empty($m_Datas['destination']) && strlen($m_Datas['destination'])<=45)
        {
            if(isset($m_Datas['date_Start']) && isset($m_Datas['date_End']) && !empty($m_Datas['date_Start']) && !empty($m_Datas['date_End']) && strtotime($m_Datas['date_Start']) && strtotime($m_Datas['date_End']) && $m_Datas['date_Start'] <= $m_Datas['date_End'])
            {
                return $checking;
            }
            else
            {
                $checking = "Dates invalides";
                return $checking;
            }
        }
        else
        {
             $checking = "Destination invalide";
             return $checking;
        }
    }
    else
    {
        $checking = "Titre invalide";
        return $checking;
    }
}

/**
 * @brief Displays the public trips
 */
function public_Trip()
{
    if(isset($_GET['page'])&& !empty($_GET['page']))
    {
        $page_Num = check_Number($_GET['page']);
            
        $trips = select_Public_Trip($page_Num);
        
        if(empty($trips))
        {
            $info_Message = "Il n'y a plus de voyages à montrer.";
        }

        require "view/view_Public_Trip.php";
    }
    else
    {
        header('Location: index.php?action=public_Trip&page=1');
    }
    
}

/**
 * @brief Displays the public trip details page.
 */
function see_Public_Trip()
{
    //Logged user
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        //Trip id
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            if($_POST)
            {
                $id_Trip = check_Number($_GET['id']);

                //Getting trip infos
                $participant_Trip = select_Public_Trip_Info($id_Trip);
                if(isset($participant_Trip) && !empty($participant_Trip))
                {
                    //Password check
                    if(password_verify($_POST['password'],$participant_Trip['Password']))
                    {

                        $lodgings = select_Lodging_From_Trip($id_Trip);
                        $transports = select_Transport_From_Trip($id_Trip);
                        $activities = select_Activity_From_Trip($id_Trip);
                        $prerequisites = select_Prerequisite_From_Trip($id_Trip);
                        $participants = select_Participants_From_Trip($id_Trip);

                        //If not set the user wont be able to register for trip
                        $_SESSION['public'] = $participant_Trip['idTrip'];

                        $registred = select_Registration($participant_Trip['idTrip'],$_SESSION['id']); //if already in registration doesn't display "Registration button"
                        require "view/view_Detailed_Public_Trip.php";
                    }
                    else
                    {
                        $error_Message = "Mot de passe du voyage incorrect";
                        require "view/view_Login_Trip.php";
                    }
                }
                else
                {
                    $error_Message = "Ce voyage n'est pas public ou n'existe pas";
                    require "view/view_Login_Trip.php";
                }
            }
            else
            {
                require "view/view_Login_Trip.php";
            }
        }
        else
        {
            header('Location: index.php?action=public_Trip&page=1');
        }
    }
    else
    {
        header('Location: index.php?action=login');
    }
}

/**
 * @brief Checks if a user can register for a trip
 */
function registration_Trip()
{
    //Logged user
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        //Trip id
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);

            //Getting trip infos
            $participant_Trip = select_Public_Trip_Info($id_Trip);
            if($_SESSION['id'] != $participant_Trip['fkUser_Organizer'])
            {
                //has the user connected to the trip to register ? 
                if(isset($_SESSION['public']) && $_SESSION['public'] == $participant_Trip['idTrip'])
                {
                    $lodgings = select_Lodging_From_Trip($id_Trip);
                    $transports = select_Transport_From_Trip($id_Trip);
                    $activities = select_Activity_From_Trip($id_Trip);
                    $prerequisites = select_Prerequisite_From_Trip($id_Trip);
                    $participants = select_Participants_From_Trip($id_Trip);

                    //checking if not already registred
                    $registred = select_Registration($participant_Trip['idTrip'],$_SESSION['id']);
                    if(isset($registred) && empty($registred))
                    {
                        //Creating participation in database
                        insert_Registration($participant_Trip['idTrip'],$_SESSION['id']);
                        $info_Message = "Votre demande a été envoyée.";
                        $registred = select_Registration($participant_Trip['idTrip'],$_SESSION['id']);//Update to don't display "Registration button"
                        require "view/view_Detailed_Public_Trip.php";
                    }
                    else
                    {
                        if($registred['Waiting'] == 1)
                        {
                            $error_Message = "Votre demande a déjà été envoyée.";
                            require "view/view_Detailed_Public_Trip.php";
                        }
                        else
                        {
                            $info_Message = "Vos avez déjà été accepté.";
                            require "view/view_Detailed_Public_Trip.php";
                        }
                            
                    }

                }
                else
                {
                    require "view/view_Login_Trip.php";
                }
            }
            else
            {
                $error_Message = "Vous êtes le créateur du voyage. Vous ne pouvez pas vous y inscrire.";
                $trip = select_Trip($_SESSION['id'],$id_Trip);
                $lodgings = select_Lodging_From_Trip($id_Trip);
                $transports = select_Transport_From_Trip($id_Trip);
                $activities = select_Activity_From_Trip($id_Trip);
                $prerequisites = select_Prerequisite_From_Trip($id_Trip);
                $participants = select_Participants_From_Trip($id_Trip);
                require "view/view_Detailed_Trip.php";
            }
        }
        else
        {
            header('Location: index.php?action=public_Trip&page=1');
        }
    }
    else
    {
        header('Location: index.php?action=login');
    }
}

/**
 * @brief Changes the trip privacy to false or true.
 */
function  change_Trip_Privacy()
{
    //Logged user
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        //Trip id
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);
            
            //Check if the user created the requested trip id.
            $trip = select_Trip($_SESSION['id'],$id_Trip);
            if(isset($trip) && !empty($trip))
            {
                if($_POST && isset($_POST['privacy']))
                {
                    $lodgings = select_Lodging_From_Trip($id_Trip);
                    $transports = select_Transport_From_Trip($id_Trip);
                    $activities = select_Activity_From_Trip($id_Trip);
                    $prerequisites = select_Prerequisite_From_Trip($id_Trip);
                    $participants = select_Participants_From_Trip($id_Trip);

                    //If private
                    if($_POST['privacy'] == 'private')
                    {
                        update_Privacy_Private($trip['idTrip']);
                        header('Location: index.php?action=see_Trip&id='.$trip['idTrip'].'&result=ok/#privacy');
                    } 
                    else //Else public
                    {
                        //Password checkings
                        if(isset($_POST['password'])&& !empty($_POST['password']) && isset($_POST['password_Confirmation']) && !empty($_POST['password_Confirmation']) && strlen($_POST['password'])>=6 && strlen($_POST['password']) <= 50)
                        {
                            if($_POST['password'] == $_POST['password_Confirmation'])
                            {
                                $hash = password_hash($_POST['password'],PASSWORD_DEFAULT);
                                update_Privacy_Public($trip['idTrip'],$hash);
                                
                                header('Location: index.php?action=see_Trip&id='.$trip['idTrip'].'&result=ok/#privacy');
                            }
                            else
                            {
                                header('Location: index.php?action=see_Trip&id='.$trip['idTrip'].'&result=error/#privacy');
                            }
                        }
                        else
                        {
                            header('Location: index.php?action=see_Trip&id='.$trip['idTrip'].'&result=error/#privacy');
                        }
                    }
                }
                else
                {
                    header('Location: index.php?action=see_Trip&id='.$trip['idTrip'].'/#privacy');
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