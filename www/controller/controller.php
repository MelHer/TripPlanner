<?php

require "model/model.php";
require "model/model_Trip.php";
require "model/model_Lodging.php";
require "model/model_Transport.php";
require "model/model_Activity.php";
require "model/model_Prerequisite.php";
require "model/model_Participant.php";

/**
 * @brief Calls the home view. This view uses a diffrent template.
 */
function welcome()
{
    require "view/view_Home.php";
}

/**
 * @brief Calls the icons credit view.
 */
function credit_Icon()
{
    require "view/view_Credit_Icon.php";
}

/**
 * @brief Calls the registration view or validates datas from the registration.
 */
function register()
{
    try
    {
        if(isset($_POST['nickname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_Confirmation']))
        {
            //Username and usage
            if(preg_match('#^([a-zA-Z0-9-_]{2,36})$#', $_POST['nickname']))
            {
                $nickname_Used = check_Nickname($_POST['nickname']);
                if(!isset($nickname_Used))
                {
                    //Check mail syntax and usage
                    if(preg_match( "#^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$#",$_POST['email']))
                    {
                        $email_Used = check_Mail($_POST['email']);
                        if(!isset($email_Used))
                        {
                            //Password 
                            if($_POST['password'] == $_POST['password_Confirmation'] && !empty($_POST['password']) && strlen($_POST['password'])>= 6 && strlen($_POST['password'])<= 50)
                            {   
                                create_User($_POST['nickname'], $_POST['email'], $_POST['password']);
                                $_SESSION['user'] = $_POST['email'];
                                $_SESSION['nickname'] = $_POST['nickname'];
                                $_SESSION['id'] = check_Nickname($_POST['nickname']);

                                //Creating user folder
                                $id = $_SESSION['id'];
                                mkdir("images/user$id", 0755);

                                require "view/view_Home.php";
                            }
                            else
                            {   
                                $error_Message = "Les mots de passe ne correspondent pas ou ne peuvent être laissés vides. Ils doivent être longs entre 6 et 50 caractères";
                                require "view/view_Registration.php";
                            }
                        }
                        else
                        {
                            $error_Message = "Email déjà utilisé";
                            require "view/view_Registration.php";
                        }
                    }
                    else
                    {
                        $error_Message = "Adresse mail invalide";
                        require "view/view_Registration.php";
                    }
                }
                else
                {
                    $error_Message = "Pseudo déjà utilisé";
                    require "view/view_Registration.php";
                }
            }
            else
            {
                $error_Message = "Votre pseudo doit contenir entre 2 et 36 caractères faits de lettres, de chiffres, _ ou -";
                require "view/view_Registration.php";
            }
        }
        else
        {
            require "view/view_Registration.php";
        }
    }
    catch(Exception $e)
    {
        $error_Message = $e->GetMessage();
    }
}

/**
 * @brief Disconnects the user.
 */
function logout()
{
    session_destroy();
    header('Location: index.php');
}

/**
 * @brief Connects the user or displays login form.
 */
function login()
{
    if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
    {
        //gets password for the given account
        $password_DB = get_Password($_POST['email']);

        if(isset($password_DB) && !empty($password_DB))
        {
            if(password_verify($_POST['password'],$password_DB))
            {
                $_SESSION['user'] = $_POST['email'];
                $_SESSION['nickname'] = get_Nickname($_POST['email']);
                $_SESSION['id'] = check_Nickname($_SESSION['nickname']);
                require "view/view_Home.php";
            }
            else
            {
                $error_Message = "Mot de passe incorrect";
                require "view/view_Login.php";
            }
        }
        else
        {
            $error_Message = "Email introuvable";
            require "view/view_Login.php";
        }
    }
    else
    {
        require "view/view_Login.php";
    }
}

/**
 * @brief Deletes the logged account or displays the deleting form.
 */
function delete_Account()
{
    if(isset($_POST['password']) && !empty($_POST['password']))
    {
        $password_DB = get_Password($_SESSION['user']);
        
        if(password_verify($_POST['password'],$password_DB))
        {
            //Delete user folder
            $id = $_SESSION['id'];
            $target = "images/user$id";
            delete_files($target);

            remove_User($_SESSION['user']);
            session_destroy();
            header('Location: index.php');
        }
        else
        {
            $error_Message = "Mot de passe incorrecte";
            require "view/view_Delete_Account.php";
        }
    }
    else
    {
        require "view/view_Delete_Account.php";
    }
}

/**
 * @brief Deletes the folders of the users when deleting account.
 * @param Takes the path of the source folder to begin.
 */
function delete_files($target) {
    if(is_dir($target))
    {
        $files = glob( $target . '*', GLOB_MARK );

        foreach( $files as $file )
        {
            delete_files( $file );      
        }
        rmdir( $target );
    }
    elseif(is_file($target))
    {
        unlink( $target );  
    }
}

/**
 * @brief Changes the user's password or displays the changing password form.
 */
function change_Password()
{
    if(isset($_POST['old_Password']) && isset($_POST['new_Password']) && isset($_POST['new_Password_Confirmation']) && !empty($_POST['old_Password']) && !empty($_POST['new_Password']) && !empty($_POST['new_Password_Confirmation']))
    {
        $password_DB = get_Password($_SESSION['user']);

        if(password_verify($_POST['old_Password'],$password_DB))
        {
            if($_POST['new_Password']===$_POST['new_Password_Confirmation'] && strlen($_POST['new_Password'])>= 6 && strlen($_POST['new_Password'])<= 50)
            {
                update_Password($_SESSION['user'],$_POST['new_Password']);
                $info_Message = "Le mot de passe a été mis à jour";
            }
            else
            {
                $error_Message = "Les nouveaux mots de passe ne correspondent pas où sont invalides (entre 6 et 50 caractères).";
            }
        }
        else
        {
            $error_Message = "Ancien mot de passe incorrecte";
        }
    }
    require "view/view_Change_Password.php";
}

/**
 * @brief Displays error page.
 */
function error()
{
    require "view/view_Error.php";
}

/**
 * @brief Check if the parameter is a valid number > 0;
 * @param INT variable to transform into valid number.
 */
function check_Number($m_Number)
{
    $number = intval($m_Number);
    $number = abs($number);
            
    if($number==0)
    {
        $number=1;
    }

    return $number;
}
