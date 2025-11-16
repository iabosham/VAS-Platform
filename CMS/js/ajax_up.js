function getSubServicesByServiceId(serviceId,divId)
{
    var xmlHttp = getXMLHttp();
   

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
           // alert(xmlHttp.responseText);
            document.getElementById(divId).innerHTML = xmlHttp.responseText;

        }
    }
    xmlHttp.open("GET", "../Ajax/GetSubServicesByServiceId.php?serviceId=" + serviceId, true);
    xmlHttp.send();
}

function getSubServicesByServiceId2()
{
    
    var selectList = $('select#contentId');
    var serviceId = $('option:selected', selectList).val();

    var xmlHttp = getXMLHttp();
   

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
           // alert(xmlHttp.responseText);
            document.getElementById('subServiceDiv').innerHTML = xmlHttp.responseText;

        }
    }
    xmlHttp.open("GET", "../Ajax/GetSubServicesByServiceId2.php?serviceId=" + serviceId, true);
    xmlHttp.send();
}

function getMessageOrders()
{
    
    var selectList = $('select#subServiceDiv');
    var count = $('option:selected', selectList).attr('co');
    
    var xmlHttp = getXMLHttp();
   //alert(count);

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
             document.getElementById('countDiv').innerHTML = xmlHttp.responseText;

        }
    }
    xmlHttp.open("GET", "../Ajax/GetMessageOrders.php?count=" + count, true);
    xmlHttp.send();
}

function getServicePermissionsByProviderId(providerId)
{
    var xmlHttp = getXMLHttp();
   

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
           // alert(xmlHttp.responseText);
            document.getElementById("providerServices").innerHTML = xmlHttp.responseText;

        }
    }
    xmlHttp.open("GET", "../Ajax/GetServicePermissionsByProviderId.php?providerId=" + providerId, true);
    xmlHttp.send();
}

function getUnitsByProcessId(processId,divId)
{
    var xmlHttp = getXMLHttp();
   

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
            // alert(xmlHttp.responseText);
            document.getElementById(divId).innerHTML = xmlHttp.responseText;

        }
    }
    xmlHttp.open("GET", "../Ajax/GetUnitsByProcessId.php?processId=" + processId, true);
    xmlHttp.send();
}

function getExtraFormFieldsByAction(formId,actionId)
{
    var xmlHttp = getXMLHttp();
   

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
            // alert(xmlHttp.responseText);
            document.getElementById("extraFormFieldsDiv").innerHTML = xmlHttp.responseText;

        }
    }
    xmlHttp.open("GET", "../Ajax/GeFormFieldsByFormAndAction.php?formId=" + formId+"&actionId="+actionId, true);
    xmlHttp.send();
}

function getNotificationServiceTestResult(nType)
{
    var xmlHttp = getXMLHttp();
   

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
            // alert(xmlHttp.responseText);
            document.getElementById("extraFormFieldsDiv").innerHTML = xmlHttp.responseText;

        }
    }
    xmlHttp.open("GET", "../Ajax/GeFormFieldsByFormAndAction.php?formId=" + formId+"&actionId="+actionId, true);
    xmlHttp.send();
}



function GetProcessGroupsForward(processActionId,actionExtraId,actionCode,formId) {
    var xmlHttp = getXMLHttp();
   
     xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
            //alert(xmlHttp.responseText);
            document.getElementById("toGroupDiv").innerHTML = xmlHttp.responseText;
            document.getElementById("toUserDiv").innerHTML = "";
            
            getExtraFormFieldsByAction(formId,actionExtraId);

        }
    }
    xmlHttp.open("GET", "../Ajax/GetProcessGroupsForward.php?processActionId=" + processActionId+"&actionExtraId="+actionExtraId+"&actionCode="+actionCode, true);
    xmlHttp.send();
}

function getProcessGroupUsers(groupId) {
    var xmlHttp = getXMLHttp();
   

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
            //alert(xmlHttp.responseText);
            document.getElementById("toUserDiv").innerHTML = xmlHttp.responseText;

        }
    }
    xmlHttp.open("GET", "../Ajax/GetProcessGroupUsers.php?groupId="+groupId, true);
    xmlHttp.send();
}

function getListOptions(fieldId,childName,conditionValue)
{
   
    var xmlHttp = getXMLHttp();
   

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
             
             document.getElementById(childName).innerHTML = xmlHttp.responseText;

        }
    }
    xmlHttp.open("GET", "../Ajax/getListOptions.php?fieldId=" + fieldId+"&conditionValue="+conditionValue, true);
    xmlHttp.send();
}


function getColumnsByPMTableId(tableId,divId,divId2)
{
     var xmlHttp = getXMLHttp();
   

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
            //alert(xmlHttp.responseText);
            document.getElementById(divId).innerHTML = xmlHttp.responseText;
            
            if(divId2 !== null){
             document.getElementById(divId2).innerHTML = xmlHttp.responseText;
                 
            }

        }
    }
    xmlHttp.open("GET", "../Ajax/GetColumnsByPMTableId.php?tableId=" + tableId, true);
    xmlHttp.send();
}

function checkStatus()
{
    
     if (document.getElementById('hasP').checked) {
         document.getElementById("parentInfo").style.visibility="visible";  
        document.getElementById("parentInfo").style.display="block";  
      }else{
        document.getElementById("parentInfo").style.visibility="hidden";  
        document.getElementById("parentInfo").style.display="none";   
        
     }
}

function hasActionJs(pid,checkId,divId)
{
    
     if (document.getElementById(checkId).checked) {
         document.getElementById(divId).style.visibility="visible";  
        document.getElementById(divId).style.display="block";  
        getProcessActions(pid,divId);
        
      }else{
        document.getElementById(divId).style.visibility="hidden";  
        document.getElementById(divId).style.display="none";   
        
     }
}

function getProcessActions(pid,divId)
{
    var xmlHttp = getXMLHttp();
   

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
            // alert(xmlHttp.responseText);
            document.getElementById(divId).innerHTML = xmlHttp.responseText;

        }
    }
    xmlHttp.open("GET", "../Ajax/GeProcessActions.php?pid=" + pid, true);
    xmlHttp.send();
}


function contentTypeCheck()
{
   
    
    var selectList = $('select#contentType');
    var id = $('option:selected', selectList).val();
    
     
     if (id  === '1' ) {
         
         document.getElementById("singleDiv").style.visibility="visible";  
         document.getElementById("singleDiv").style.display="block"; 
         
         document.getElementById("bulkDiv").style.visibility="hidden";  
         document.getElementById("bulkDiv").style.display="none";  
         
         document.getElementById("orderDiv").style.visibility="visible";  
         document.getElementById("orderDiv").style.display="block"; 
         
         document.getElementById("wapDiv").style.visibility="hidden";  
         document.getElementById("wapDiv").style.display="none";  
         
     
        }else if (id  == 2){
           
         document.getElementById("bulkDiv").style.visibility="visible";  
         document.getElementById("bulkDiv").style.display="block"; 
          
         document.getElementById("orderDiv").style.visibility="hidden";  
         document.getElementById("orderDiv").style.display="none";  
         
         document.getElementById("singleDiv").style.visibility="hidden";  
         document.getElementById("singleDiv").style.display="none";
         
         document.getElementById("wapDiv").style.visibility="hidden";  
         document.getElementById("wapDiv").style.display="none";  
          
  
        } else if (id  == 3){
         
         document.getElementById("singleDiv").style.visibility="visible";  
         document.getElementById("singleDiv").style.display="block"; 
         
         document.getElementById("wapDiv").style.visibility="visible";  
         document.getElementById("wapDiv").style.display="block"; 
         
         document.getElementById("orderDiv").style.visibility="visible";  
         document.getElementById("orderDiv").style.display="block"; 
        
         document.getElementById("bulkDiv").style.visibility="hidden";  
         document.getElementById("bulkDiv").style.display="none";
       
         
         
         
      }
}
 
function getXMLHttp()
{
    var xmlHttp

    try
    {
        //Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    }
    catch (e)
    {
        //Internet Explorer
        try
        {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            try
            {
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e)
            {
                alert("Your browser does not support AJAX!")
                return false;
            }
        }
    }
    return xmlHttp;
}

   function changeUserGroupLevel(id)
    {
    var level =  document.getElementById("levels"+id).value ;
     // alert(level);
   var xmlHttp = getXMLHttp();
  
    xmlHttp.onreadystatechange = function()
     { 
      if(xmlHttp.readyState == 4)
     {
  	 document.getElementById("list"+id).innerHTML = xmlHttp.responseText;
       
     }  
     } 
   xmlHttp.open("GET", "../Ajax/UpdateUserGroupLevel.php?id="+id+"&level="+level, true); 
   xmlHttp.send();
 }
 
 
 function getPMTables() {
    var xmlHttp = getXMLHttp();
   

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
           
            document.getElementById('pmtDivData').innerHTML = xmlHttp.responseText;

        }
    }
    xmlHttp.open("GET", "../Ajax/GetPMTables.php", true);
    xmlHttp.send();
}

 function hasPMTableParent()
     {
       
    
        if (document.getElementById('hasPMTableParentCheck').checked) {
            
            document.getElementById('hasPMTableDiv').style.visibility="visible";  
            document.getElementById('hasPMTableDiv').style.display="block";  
            getPMTables();
         }else{
            document.getElementById('hasPMTableDiv').style.visibility="hidden";  
            document.getElementById('hasPMTableDiv').style.display="none";   
        }
     
     
     }
     
     function getFieldsByPMTableId(pmtId,divId)
{
    var xmlHttp = getXMLHttp();
   

    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
            // alert(xmlHttp.responseText);
            document.getElementById(divId).innerHTML = xmlHttp.responseText;

        }
    }
    xmlHttp.open("GET", "../Ajax/GetFieldsByPMTableId.php?pmtId=" + pmtId, true);
    xmlHttp.send();
}

     function getExternalFieldData(input,fieldId,fieldName,divId)
    {
    var xmlHttp = getXMLHttp();
    
    if(input === null){
        input = document.getElementById(fieldName).value ;
    }
    
   
    xmlHttp.onreadystatechange = function ()
    {
        if (xmlHttp.readyState === 4)
        {
             //alert(xmlHttp.responseText);
            document.getElementById(divId).innerHTML = xmlHttp.responseText;

        }
     }
        xmlHttp.open("GET", "../Ajax/GetExternalFieldData.php?input=" + input+"&fieldId="+fieldId, true);
        xmlHttp.send();
   }
   
   
   function addNewFields(div,count,name1){
    var number = document.getElementById(count).value;
     var container = document.getElementById(div);
     
     
     if(number <= 5){
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    
      for (i=0;i<number;i++){
        
         var input1 = document.createElement("input");
               input1.type = "file";
              // input1.placeholder = holder1 ;
               input1.name = name1+(i+1);
               container.appendChild(input1);

       }
 }
}
   
