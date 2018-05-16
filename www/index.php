<?php
session_set_cookie_params(1200);
session_start();

require  'controller/controller.php';

try
{
    if (isset($_GET['action']))
    {
        $action = $_GET['action'];

        switch ($action)
        {
            //Home page
            case 'home' :
                welcome(); 
                break;
                
            //Registration page
            case 'register' :
                register();
                break;

            //Logout page
            case 'logout' :
                logout();
                break;
           
            //Login page
            case 'login' :
                login();
                break;

            //Deleting account
            case 'delete_Account' :
                delete_Account();
                break;

            //Change the account password
            case 'change_Password';
                change_Password();
                break;
                
            default :
                throw new Exception();
        }
    }
    else
    {
        welcome();
    }

}
catch (Exception $e)
{
   //TODO: Call error page.
}