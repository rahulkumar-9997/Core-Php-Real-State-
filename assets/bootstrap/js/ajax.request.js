/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var request4;
        function fetchDetail(){
            //alert("Called Select Assess !!!");
            var sid = document.getElementById('memberId').value;
            //alert("Called Select Assess "+sid);
                var url="ajaxGetMemberAndPinList.php?q="+sid;
                if(sid === ''){
                    document.getElementById('memberName').innerHTML = 'Id not found !';
                }
                else{
                if(window.XMLHttpRequest)
                {
                    request4=new XMLHttpRequest();
                }
                else if(window.ActiveXObject)
                {
                    request4=new ActiveXObject("Microsoft.XMLHTTP");
                }

                try
                {
                    request4.onreadystatechange=getAssess;
                    request4.open("GET",url,true);
                    request4.send();
                }
                catch(e){
                    alert("Unable to connect to server");
                }
        }
        }

        function getAssess(){
            //alert("getAsses function called");
            if(request4.readyState===4){
                    //ajaxindicatorstop();
                    var val= JSON.parse(request4.responseText);
                    //alert(val.sponserName);
                    if(val.sponserName==="Id does not exist !"){
                        document.getElementById('submit').disabled = true; 
                        document.getElementById('memberId').focus = true; 
                        document.getElementById('memberName').innerHTML = val.sponserName;
                    }
                    else{
                        document.getElementById('submit').disabled = false; 
                        document.getElementById('memberName').innerHTML = val.sponserName;
                        //document.getElementById('pinTable').innerHTML = val.table;
                    }
                }

        }
