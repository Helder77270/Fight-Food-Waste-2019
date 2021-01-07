/* This function permits to the form to dynamically display the right field for the different customer types.
*
* If nothing is selected not even the "Register button" is displayed.
* The attribute .check means true if it's checked and false if not.
*
* For adding this function to a button I added a "onClick" attribute which calls the function everytime we click on one of the radio button.
*
* If you have any questions I remain available at 07.60.41.47.61 (Helder)
*
*/


function showHide() {
    individualButt=document.getElementById("individual");
    volunteerButt=document.getElementById("volunteer");
    businessButt=document.getElementById("business");

    if (individualButt.checked){

// Display = 'block' part
        document.getElementById("registerbutton").style.display = 'block';
        document.getElementById("formStatus").style.display = 'block';
        document.getElementById("firstname").style.display = 'block'; // block could have been inline or inline-block.
        document.getElementById("lastname").style.display = 'block';  // While the property isn't 'none' the field will be displayed

// Display = 'none' part
        document.getElementById("lob").style.display='none';
        document.getElementById("siret").style.display='none';
        document.getElementById("skill1").style.display='none';
        document.getElementById("skill2").style.display='none';
        document.getElementById("skill3").style.display='none';

// Value = '' part
        document.getElementById("lob").value = "";
        document.getElementById("siret").value = "";
        document.getElementById("skill1").value = "";
        document.getElementById("skill2").value = "";
        document.getElementById("skill3").value = "";


    }else if (volunteerButt.checked) {

// Display = 'block' part
        document.getElementById("firstname").style.display='block';
        document.getElementById("lastname").style.display='block';
        document.getElementById("skill1").style.display='block';
        document.getElementById("skill2").style.display='block';
        document.getElementById("skill3").style.display='block';
        document.getElementById("registerbutton").style.display='block';
        document.getElementById("formStatus").style.display='block';

// Display = 'none' part
        document.getElementById("siret").style.display = 'none';
        document.getElementById("lob").style.display = 'none';

// Value = '' part
        document.getElementById("siret").value = "";
        document.getElementById("lob").value = "";


    }else if (businessButt.checked){

// Display = 'block' part
        document.getElementById("siret").style.display = 'block';
        document.getElementById("lob").style.display = 'block';
        document.getElementById("registerbutton").style.display = 'block';
        document.getElementById("formStatus").style.display = 'block';

// Display = 'none' part
        document.getElementById("firstname").style.display='none';
        document.getElementById("lastname").style.display='none';
        document.getElementById("skill1").style.display='none';
        document.getElementById("skill2").style.display='none';
        document.getElementById("skill3").style.display='none';

// Value = '' part
        document.getElementById("firstname").value = "";
        document.getElementById("lastname").value = "";
        document.getElementById("skill1").value = "";
        document.getElementById("skill2").value = "";
        document.getElementById("skill3").value = "";

    }

}