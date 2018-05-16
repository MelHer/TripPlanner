<?php

require "model/model.php";

/**
 * @brief Call the home view. This view uses a diffrent template.
 */
function welcome()
{
    require "view/view_Home.php";
}

/**
 * @brief Call the registration view.
 */
function register()
{
    try
    {
        if(isset($_POST['nickname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_Confirmation']))
        {
            if(preg_match('#^([a-zA-Z0-9-_]{2,36})$#', $_POST['nickname']))
            {
                $nickname_Used = check_Nickname($_POST['nickname']);
                if(!isset($nickname_Used))
                {
                    if(preg_match( "#^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$#",$_POST['email']))
                    {
                        $email_Used = check_Mail($_POST['email']);
                        if(!isset($email_Used))
                        {
                            if($_POST['password'] == $_POST['password_Confirmation'] && !empty($_POST['password']))
                            {   
                                create_User($_POST['nickname'], $_POST['email'], $_POST['password']);
                                $_SESSION['user'] = $_POST['email'];
                                $_SESSION['nickname'] = $_POST['nickname'];

                                require "view/view_Home.php";
                            }
                            else
                            {   
                                $error_Message = "Les mots de passe ne correspondent pas ou ne peuvent être laissés vides";
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

/*
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
                require "view/view_Home.php";
            }
            else
            {
                $error_Message = "Mot de passe incorrecte";
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
 * @brief Changes the user's password or displays the changing password form.
 */
function change_Password()
{
    if(isset($_POST['old_Password']) && isset($_POST['new_Password']) && isset($_POST['new_Password_Confirmation']) && !empty($_POST['old_Password']) && !empty($_POST['new_Password']) && !empty($_POST['new_Password_Confirmation']))
    {
        $password_DB = get_Password($_SESSION['user']);

        if(password_verify($_POST['old_Password'],$password_DB))
        {
            if($_POST['new_Password']===$_POST['new_Password_Confirmation'])
            {
                update_Password($_SESSION['user'],$_POST['new_Password']);
                $info_Message = "Le mot de passe a été mis à jour";
            }
            else
            {
                $error_Message = "Les nouveaux mots de passe ne correspondent pas";
            }
        }
        else
        {
            $error_Message = "Ancien mot de passe incorrecte";
        }
    }
    require "view/view_Change_Password.php";

}