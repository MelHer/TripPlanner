<?php
session_start();

date_default_timezone_set('Europe/Zurich');

//About users/home/login and general function like picture validation, error display.
require  'controller/controller.php';
//About trips displaying/editing/creating/deleting.
require 'controller/controller_Trip.php';
//About lodging displaying/editing/creating/deleting.
require 'controller/controller_Lodging.php';
//About transport displaying/editing/creating/deleting.
require 'controller/controller_Transport.php';
//About transport displaying/editing/creating/deleting.
require 'controller/controller_Activity.php';
//About prerequisite displaying/editing/creating/deleting.
require 'controller/controller_Prerequisite.php';
//About prerequisite displaying/editing/creating/deleting.
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

            //Changes the account password
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
            
            //Shows trip details, loding, transport and creation menu for lodgin, transport...
            case 'see_Trip';
                see_Trip();
                break;
                
            //Changes trip infos
            case 'change_Trip';
                change_Trip();
                break;
            
            //Confirms a trip removal
            case 'delete_Trip';
                delete_Trip();
                break;
                
            //Adds new lodging for the trip
            case 'new_Lodging';
                new_Lodging();
                break;
                
            //Changes a lodging
            case 'change_Lodging';
                change_Lodging();
                break;
                
            //Confirms a lodging removal
            case 'delete_Lodging';
                delete_Lodging();
                break;
                
            //Adds new lodging for the trip
            case 'new_Transport';
                new_Transport();
                break;
                
            //Changes a transport
            case 'change_Transport';
                change_Transport();
                break;
                
            //Confirms a transport removal
            case 'delete_Transport';
                delete_Transport();
                break;
                
            //Adds a new activity to a trip
            case 'new_Activity';
                new_Activity();
                break;
                
            //Changes an activity
            case 'change_Activity';
                change_Activity();
                break;
                
            //Confirms an activity removal
            case 'delete_Activity';
                delete_Activity();
                break;

            //Adds a new prerequisite to a trip
            case 'new_Prerequisite';
                new_Prerequisite();
                break;

            //Changes a prerequisite
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

            //Displays public trips
            case 'public_Trip';
                public_Trip();
                break;

            //Shows trip password form and display trip details if password is correct
            case 'see_Public_Trip';
                see_Public_Trip();
                break;

            //Creates a trip registration for a user
            case 'registration_Trip';
                registration_Trip();
                break;

            //Displays all requests
            case 'see_Request';
                see_Request();
                break;

            //Accepts a request
            case 'accept_Request';
                accept_Request();
                break;

            //Removes a request
            case 'delete_Request';
                delete_Request();
                break;

            //Changes trip visibility
            case 'change_Trip_Privacy';
                change_Trip_Privacy();
                break;
                
            //Cancels a processing request or an accetpted request
            case 'cancel_Participation';
                cancel_Participation();
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
   //Error page
   error();
}