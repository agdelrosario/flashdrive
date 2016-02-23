//di pa xa refactored :)
function disablefield(){
  // initialize form with empty fields
	
	document.forms[0].spouse_sname.disabled=false;
	//document.forms[0].spouse_sname.value="";

	document.forms[0].spouse_fname.disabled=false;
	//document.forms[0].spouse_fname.value="";
	
	document.forms[0].spouse_mname.disabled=false;
	//document.forms[0].spouse_mname.value="";
	
	document.forms[0].spouse_occupation.disabled=false;
	//document.forms[0].spouse_occupation.value="";
	
	document.forms[0].spouse_cnum.disabled=false;
	//document.forms[0].spouse_cnum.value="";
	
	document.forms[0].spouse_childno.disabled=false;
	//document.forms[0].spouse_childno.value="";
	
	document.forms[0].rel_sname.disabled=false;
	//document.forms[0].rel_sname.value="";

	document.forms[0].rel_fname.disabled=false;
	//document.forms[0].rel_fname.value="";
	
	document.forms[0].rel_mname.disabled=false;
	//document.forms[0].rel_mname.value="";
	
	document.forms[0].rel_address.disabled=false;
	//document.forms[0].rel_address.value="";
  
	document.forms[0].rel_cnum.disabled=false;
	//document.forms[0].rel_cnum.value="";
	
  document.forms[0].nopfname.disabled=false;
  //document.forms[0].nopfname.value="";
  
  document.forms[0].nopsname.disabled=false;
  //document.forms[0].nopsname.value="";
  
  document.forms[0].nstickerno.disabled=false;
  //document.forms[0].nstickerno.value="";
  
  document.forms[0].nplateno.disabled=false;
  //document.forms[0].nplateno.value="";
  
  document.forms[0].nexpirefranmonth.disabled=false;
  //document.forms[0].nexpirefranmonth.value="";
  
  document.forms[0].nexpirefranday.disabled=false;
  //document.forms[0].nexpirefranday.value="";
  
  document.forms[0].nexpirefranyear.disabled=false;
  //document.forms[0].nexpirefranyear.value="";
  
  document.forms[0].ncnum2.disabled=false;
  //document.forms[0].ncnum2.value="";
  
  document.forms[0].stickerno.disabled=false;
  //document.forms[0].stickerno.value="";
  
  document.forms[0].plateno.disabled=false;
  //document.forms[0].plateno.value="";
  
  document.forms[0].expirefranmonth.disabled=false;
  //document.forms[0].expirefranmonth.value="";
  
  document.forms[0].expirefranday.disabled=false;
  //document.forms[0].expirefranday.value="";
  
  document.forms[0].expirefranyear.disabled=false;
  //document.forms[0].expirefranyear.value="";
  
  document.forms[0].cnum2.disabled=false;
  //document.forms[0].cnum2.value="";

  document.forms[0].submit.disabled=true;
  
  for(var i=0;i<document.forms[0].elements.length;i++){
    if(document.forms[0].elements[i].name=="yesno"){
     if(document.forms[0].elements[i].value=="yes"){
       if(document.forms[0].elements[i].checked==true){
    	   document.forms[0].nopfname.disabled=true;
           document.forms[0].nopsname.disabled=true;
           document.forms[0].nstickerno.disabled=true;
           document.forms[0].nplateno.disabled=true;
           document.forms[0].nexpirefranmonth.disabled=true;
           document.forms[0].nexpirefranday.disabled=true;
           document.forms[0].nexpirefranyear.disabled=true;
           document.forms[0].ncnum2.disabled=true;
           document.forms[0].stickerno.disabled=false;
           document.forms[0].plateno.disabled=false;
           document.forms[0].expirefranmonth.disabled=false;
           document.forms[0].expirefranday.disabled=false;
           document.forms[0].expirefranyear.disabled=false;
           document.forms[0].cnum2.disabled=false;
       }
     }
     else if(document.forms[0].elements[i].value=="no"){
       if(document.forms[0].elements[i].checked==true){
           document.forms[0].stickerno.disabled=true;
           document.forms[0].plateno.disabled=true;
           document.forms[0].expirefranmonth.disabled=true;
           document.forms[0].expirefranday.disabled=true;
           document.forms[0].expirefranyear.disabled=true;
           document.forms[0].cnum2.disabled=true;
           document.forms[0].nopfname.disabled=false;
           document.forms[0].nopsname.disabled=false;
           document.forms[0].nstickerno.disabled=false;
           document.forms[0].nplateno.disabled=false;
           document.forms[0].nexpirefranmonth.disabled=false;
           document.forms[0].nexpirefranday.disabled=false;
           document.forms[0].nexpirefranyear.disabled=false;
           document.forms[0].ncnum2.disabled=false;
       }
     }
    }
  }
    
    for(var i=0;i<document.forms[0].elements.length;i++){
        if(document.forms[0].elements[i].name=="civil"){
         if(document.forms[0].elements[i].value=="married"){
           if(document.forms[0].elements[i].checked==true){
        	   document.forms[0].rel_sname.disabled=true;
               document.forms[0].rel_fname.disabled=true;
               document.forms[0].rel_mname.disabled=true;
               document.forms[0].rel_address.disabled=true;
               document.forms[0].rel_cnum.disabled=true;
               document.forms[0].spouse_sname.disabled=false;
               document.forms[0].spouse_fname.disabled=false;
               document.forms[0].spouse_mname.disabled=false;
               document.forms[0].spouse_cnum.disabled=false;
               document.forms[0].spouse_occupation.disabled=false;
               document.forms[0].spouse_childno.disabled=false;
           }
         }
         else if(document.forms[0].elements[i].value=="single" || document.forms[0].elements[i].value=="widowed" || document.forms[0].elements[i].value=="separated"){
             if(document.forms[0].elements[i].checked==true){
            	 document.forms[0].rel_sname.disabled=false;
                 document.forms[0].rel_fname.disabled=false;
                 document.forms[0].rel_mname.disabled=false;
                 document.forms[0].rel_address.disabled=false;
                 document.forms[0].rel_cnum.disabled=false;
                 document.forms[0].spouse_sname.disabled=true;
                 document.forms[0].spouse_fname.disabled=true;
                 document.forms[0].spouse_mname.disabled=true;
                 document.forms[0].spouse_cnum.disabled=true;
                 document.forms[0].spouse_occupation.disabled=true;
                 document.forms[0].spouse_childno.disabled=true;
             }
        }
      }
    }
	
    
    /*for(var i=0;i<document.forms[0].elements.length;i++){
        if(document.forms[0].elements[i].name=="idnumb"){
         if(document.forms[0].elements[i].value==""){
        	   //document.forms[0].submit.disabled=true;
         }
      }
    }*/
 }