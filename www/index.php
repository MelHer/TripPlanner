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
            case 'home' :
                welcome();
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