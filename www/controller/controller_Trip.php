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
            
            $trips = get_User_Trip($_SESSION['id'],$page_Num);

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
                        $file_Tmp_New_Name = $_SESSION['id'].'.'.$file_Actual_Ext;
                        $image = true;
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
                            $error_Message = "Les mots doivent faire entre 6 et .";
                            require "view/view_New_Trip.php"; 
                        }
                    }
                }
            
                //Request execution
                if(isset($image) && isset($privacy))
                {
                    
                    create_Trip($_SESSION['id'],$_POST['title'],$_POST['destination'],$privacy,date('Y-m-d'),$_POST['date_Start'],$_POST['date_End'],$password,$image); 
                
                    //Creating trip folder
                    $id_Trip = get_Last_Trip($_SESSION['id']);
                    $path = "images/user".$_SESSION['id']."/".$id_Trip['0']['0'];
                    mkdir($path, 0755);
                    mkdir($path.'/Activity', 0755);
                    mkdir($path.'/Lodging', 0755);
                    mkdir($path.'/Transport', 0755);
                
                    //Renaming the image with the id of the trip
                    if($image == true)
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
            
            //Check if the user creater the requested trip id.
            $trip = get_Trip($_SESSION['id'],$id_Trip);
            //If he is a participant
            $registred_Trip = accepted_Registration($_SESSION['id'],$id_Trip);
            if((isset($trip) && !empty($trip)) ||  (isset($registred_Trip) && !empty($registred_Trip)))
            {

                $lodgings = get_Lodging_From_Trip($id_Trip);
                $transports = get_Transport_From_Trip($id_Trip);
                $activities = get_Activity_From_Trip($id_Trip);
                $prerequisites = get_Prerequisite_From_Trip($id_Trip);
                $participants = get_Participants_From_Trip($id_Trip);

                if($trip)
                {
                    require "view/view_Detailed_Trip.php";  
                }
                
                if($registred_Trip)
                {
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
            $trip = get_Trip($_SESSION['id'],$id_Trip);
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
                                $file_Tmp_New_Name = $_SESSION['id'].'.'.$file_Actual_Ext;
                                $image = true;
                            }
                            else
                            {
                                $error_Message = $checking;
                                require "view/view_Change_Trip.php"; 
                            }
                        }
                        
                        update_Trip($trip['idTrip'],$_POST['title'],$_POST['destination'],$_POST['date_Start'],$_POST['date_End'],$image);
                        
                        if($image == true)
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


function delete_Trip()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);
            
            //Check if the user created the requested trip id.
            $trip = get_Trip($_SESSION['id'],$id_Trip);
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
    if(isset($m_Datas['title']) && strlen($m_Datas['title'])<=45)
    {
        if(isset($m_Datas['destination']) && strlen($m_Datas['destination'])<=45)
        {
            if(isset($m_Datas['date_Start']) && isset($m_Datas['date_End']) && strtotime($m_Datas['date_Start']) && strtotime($m_Datas['date_End']) && $m_Datas['date_Start'] <= $m_Datas['date_End'])
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
 * @brief Check if the uploaded image is allowed.
 * @param $m_Extension Extension of the uploaded file.
 * @param $m_Error The error state of the uploaded file.
 * @param $m_Size The size of the uploaded file.
 * @return Returns a message: empty if OK else an error message.
 */
function check_Image($m_Extension,$m_Error,$m_Size)
{
    $checking = "";
    
    $allowed = array('jpg','jpeg','png');
               
    if(in_array($m_Extension,$allowed))
    {
        if($m_Error === 0)
        {        
            if($m_Size < 1000000)
            {
               return $checking;       
            }
            else
            {
                $checking = "Votre image est trop lourde ( >1mb )";
                return $checking; 
            }
        }
        else
        {   
            $checking = "Erreur de chargement du fichier";
            return $checking;
        }
    }
    else
    {
        $checking = "Images .png .jpg ou .jpeg acceptées";
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
            
        $trips = get_Public_Trip($page_Num);

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
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            if($_POST)
            {
                $id_Trip = check_Number($_GET['id']);

                //Getting trip infos
                $trip = get_Public_Trip_Info($id_Trip);
                if(isset($trip) && !empty($trip))
                {
                    //Password check
                    if(password_verify($_POST['password'],$trip['Password']))
                    {

                        $lodgings = get_Lodging_From_Trip($id_Trip);
                        $transports = get_Transport_From_Trip($id_Trip);
                        $activities = get_Activity_From_Trip($id_Trip);
                        $prerequisites = get_Prerequisite_From_Trip($id_Trip);
                        $participants = get_Participants_From_Trip($id_Trip);

                        //If not set the user wont be able to register for trip
                        $_SESSION['public'] = $trip['idTrip'];

                        $registred = get_Registration($trip['idTrip'],$_SESSION['id']); //if already in registration doesn't display "Registration button"
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
 * @brief Check if a user can register for a trip
 */
function registration_Trip()
{
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);

            //Getting trip infos
            $trip = get_Public_Trip_Info($id_Trip);
            if($_SESSION['id'] != $trip['fkUser_Organizer'])
            {
                //has the user connected to the trip to register ? 
                if(isset($_SESSION['public']) && $_SESSION['public'] == $trip['idTrip'])
                {
                    $lodgings = get_Lodging_From_Trip($id_Trip);
                    $transports = get_Transport_From_Trip($id_Trip);
                    $activities = get_Activity_From_Trip($id_Trip);
                    $prerequisites = get_Prerequisite_From_Trip($id_Trip);
                    $participants = get_Participants_From_Trip($id_Trip);

                    //checking if not already registred
                    $registred = get_Registration($trip['idTrip'],$_SESSION['id']);
                    if(isset($registred) && empty($registred))
                    {
                        //Creating participation in database
                        create_Registration($trip['idTrip'],$_SESSION['id']);
                        $info_Message = "Votre demande a été envoyée.";
                        $registred = get_Registration($trip['idTrip'],$_SESSION['id']);//Update to don't display "Registration button"
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
                $lodgings = get_Lodging_From_Trip($id_Trip);
                $transports = get_Transport_From_Trip($id_Trip);
                $activities = get_Activity_From_Trip($id_Trip);
                $prerequisites = get_Prerequisite_From_Trip($id_Trip);
                $participants = get_Participants_From_Trip($id_Trip);
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
    if(isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id_Trip = check_Number($_GET['id']);
            
            //Check if the user created the requested trip id.
            $trip = get_Trip($_SESSION['id'],$id_Trip);
            if(isset($trip) && !empty($trip))
            {
                if($_POST && isset($_POST['privacy']))
                {
                    $lodgings = get_Lodging_From_Trip($id_Trip);
                    $transports = get_Transport_From_Trip($id_Trip);
                    $activities = get_Activity_From_Trip($id_Trip);
                    $prerequisites = get_Prerequisite_From_Trip($id_Trip);
                    $participants = get_Participants_From_Trip($id_Trip);

                    if($_POST['privacy'] == 'private')
                    {
                        //Update request
                    } 
                    else
                    {
                        if(isset($_POST['password'])&& !empty($_POST['password']) && isset($_POST['password_Confirmation']) && !empty($_POST['password_Confirmation']) && strlen($_POST['password'])>=6 && strlen($_POST['password']) <= 50)
                        {
                            if($_POST['password'] == $_POST['password_Confirmation'])
                            {
                                $password = $_POST['password'];
                                //update request
                            }
                            else
                            {
                                $error_Message = "Les mots de passent ne sont pas identiques";
                                require "view/view_see_Trip.php"; 
                            }
                        }
                        else
                        {
                            $error_Message = "Les mots doivent faire entre 6 et .";
                            require "view/view_See_Trip.php"; 
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