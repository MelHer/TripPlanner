/**
 * @brief Changes the end date to be later than the begin date.
 */
function set_Min_Date()
{     
    
    document.getElementById('end').setAttribute("min", document.getElementById('start').value);

   
    if(document.getElementById('start').value > document.getElementById('end').value)
    {
        document.getElementById('end').value = document.getElementById('start').value;
    }
}

/**
 * @brief Disable the passwords if the trip is private
 */
function lock_Password()
{
    document.getElementById('password').value=null;
    document.getElementById('password_Confirmation').value=null;

    document.getElementById("password").setAttribute("disabled",true);
    document.getElementById("password_Confirmation").setAttribute("disabled",true);
    
    document.getElementById("password").removeAttribute("required");
    document.getElementById("password_Confirmation").removeAttribute("required");
}

function unlock_Password()
{
    document.getElementById("password").setAttribute("required",true);
    document.getElementById("password_Confirmation").setAttribute("required",true);
    
    document.getElementById("password").removeAttribute("disabled");
    document.getElementById("password_Confirmation").removeAttribute("disabled");
}

/**
 * @brief Converts price field to number with 2 decimals.
 */
function two_Decimal()
{
    var price = parseFloat(document.getElementById('price').value).toFixed(2);
    document.getElementById('price').value = Math.abs(price);
}

/**
 * @brief Converts quantity field to integer.
 */
function no_Decimal()
{
    var price = parseInt(document.getElementById('quantity').value)
    document.getElementById('quantity').value = Math.abs(price);
}