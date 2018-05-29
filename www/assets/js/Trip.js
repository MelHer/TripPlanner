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

/**
 * @brief Create a pdf document of the page content.
 */
function make_PDF()
{  
    html2canvas(document.getElementById('pdf'), {
        onrendered: function(canvas){
            var image_Data = canvas.toDataURL("image/png");
            
            var image_Width = 210;
            var page_Height = 295;
            var image_Height = canvas.height * image_Width / canvas.width;
            var height_Left = image_Height;


            var doc = new jsPDF('p', 'mm');
            var position = 0;

            doc.addImage(image_Data, 'PNG', 0, position, image_Width, image_Height);
            height_Left -= page_Height;

            while (height_Left >= 0) {
                position = height_Left - image_Height;
                doc.addPage();
                doc.addImage(image_Data, 'PNG', 0, position, image_Width, image_Height);
                height_Left -= page_Height;
            }
            doc.save( 'trip.pdf');
        } 
    });
}