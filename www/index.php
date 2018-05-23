<?php
session_start();

date_default_timezone_set('Europe/Zurich');

//About users/home/login
require  'controller/controller.php';
//About trips displaying/editing/creating/deleting
require 'controller/controller_Trip.php';
//About lodging displaying/editing/creating/deleting
require 'controller/controller_Lodging.php';
//About transport displaying/editing/creating/deleting
require 'controller/controller_Transport.php';
//About transport displaying/editing/creating/deleting
require 'controller/controller_Activity.php';
//About prerequisite displaying/editing/creating/deleting
require 'controller/controller_Prerequisite.php';
//About prerequisite displaying/editing/creating/deleting
require 'controller/controller_Participant.php';

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
                
            //Home page
            case 'credit_Icon' :
                credit_Icon(); 
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
            
            //User trips
            case 'my_Trip';
                my_Trip();
                break;
            
            //New trip creation
            case 'new_Trip';
                new_Trip();
                break;
            
            //Show trip details, loding, transport and creation menu for lodgin, transport...
            case 'see_Trip';
                see_Trip();
                break;
                
            //Change trip infos
            case 'change_Trip';
                change_Trip();
                break;
            
            //Confirms a trip removal
            case 'delete_Trip';
                delete_Trip();
                break;
                
            //Add new lodging for the trip
            case 'new_Lodging';
                new_Lodging();
                break;
                
            //Change a lodging
            case 'change_Lodging';
                change_Lodging();
                break;
                
            //Confirms a lodging removal
            case 'delete_Lodging';
                delete_Lodging();
                break;
                
            //Add new lodging for the trip
            case 'new_Transport';
                new_Transport();
                break;
                
            //Change a transport
            case 'change_Transport';
                change_Transport();
                break;
                
            //Confirms a transport removal
            case 'delete_Transport';
                delete_Transport();
                break;
                
            //Add a new activity to a trip
            case 'new_Activity';
                new_Activity();
                break;
                
            //Change an activity
            case 'change_Activity';
                change_Activity();
                break;
                
            //Confirms an activity removal
            case 'delete_Activity';
                delete_Activity();
                break;

            //Add a new prerequisite to a trip
            case 'new_Prerequisite';
                new_Prerequisite();
                break;

            //Change a prerequisite
            case 'change_Prerequisite';
                change_Prerequisite();
                break;

            //Confirms a prerequisite removal
            case 'delete_Prerequisite';
                delete_Prerequisite();
                break;

            //Confirms a participant removal
            case 'delete_Participant';
                delete_Participant();
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
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
}