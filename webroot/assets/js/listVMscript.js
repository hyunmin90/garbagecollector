var temp;


function listvm(){
 $.ajax({
                                url: "/index.php/whycle/api/vmlist",
                                dataType: "json",
                                async: true,
                                success: function(json) {
                                                                    
                                   count = json.listvmresponse.count; 
                                   for(i=0;i<count;i++){        
                                    $("#vm").append("<div id=vmcontainer"+i+"><div class =well id=vmname"+i+" onclick=toggling('"+i+"')>"+"<span id=name>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+json.listvmresponse.virtualmachine[i].name+
                                        "</span></div><div id='vmdetail"+i+"' class=details >"+"<ul><li>"+json.listvmresponse.virtualmachine[i].ipaddress+"</li>"+
                                        "<li>"+json.listvmresponse.virtualmachine[i].templatename+"</li>"+"<li id=status"+i+">"+
                                        json.listvmresponse.virtualmachine[i].state+"</li>"+"</ul><button type=button class='btn btn-default' id=stopvm onclick='stopvm("+'"'+json.listvmresponse.virtualmachine[i].id+'"'+","+i+")'>stopvm</button><button type=button class='btn btn-default' id=startvm onclick='startvm("+'"'+json.listvmresponse.virtualmachine[i].id+'"'+","+i+")'>startvm</button><button type=button class='btn btn-default' id=deletevm onclick='deletevm("+'"'+json.listvmresponse.virtualmachine[i].id+'"'+","+i+")'>deletevm</button><button type=button class='btn btn-default' id=deletevm onclick='connect("+'"'+json.listvmresponse.virtualmachine[i].ipaddress+'"'+","+i+")'>Connect</button></div>");                     

                                     if(json.listvmresponse.virtualmachine[i].state=="Running"){
                                        $( "#vmname"+i+" #name" ).addClass( "running" );
                                     }
                                     if(json.listvmresponse.virtualmachine[i].state=="Stopping"){
                                        $( "#vmname"+i+" #name" ).addClass( "stopping" );
                                     }
                                     if(json.listvmresponse.virtualmachine[i].state=="Stopped"){
                                        $( "#vmname"+i+" #name" ).addClass( "stopped" );
                                     }
                                      if(json.listvmresponse.virtualmachine[i].state=="Starting"){
                                        $( "#vmname"+i+" #name").addClass( "starting" );
                                        






                                     }

                                        if(json.listvmresponse.virtualmachine[i].state=="Error"){
                                        $( "#vmname"+i+" #name").addClass( "error" );
                                     }
                                    
                                   
                                   
                                    }




                             
                                }

                            
                            });
};

               function toggling(arg){
                                              $("#vmdetail"+arg).toggle('slow'); 
                                        };

function stopvm(arg,num){
    alert(num);
    var requireddata={
        vmid: arg}; 
$.ajax({
    url:"/index.php/whycle/api/vmstop",
    data:requireddata,
    dataType:"json",
    async:true,
    success:function(json){
        alert("stopping vm please wait");
        $("#status"+num).replaceWith("<li id=status>Stopping");
        $("#vmname"+num+" #name").toggleClass('stopping');
  
          jid=json.stopvmresponse.jobid;
          var requiredata1={
            jobid:jid
          };
       var refreshIntervalId=  setInterval(function() {
   
          $.ajax({ 
            url:"/index.php/whycle/api/vmstatus",
            data:requiredata1,
            success: function(json){
          
                var result = json.queryasyncjobresultresponse.jobstatus;

                if(result==0)
                {


                    
                    return; //Job is still pending
                }
                else{
                  
                    clearInterval(refreshIntervalId);
                     //$("#status"+num).replaceWith("<li id=status>Stopped");
                     $( "#vmname"+num+" #name" ).addClass( "stopped" );
                     $("#vmdetail"+num+" ul"+" #status").replaceWith("<li id=status>Stopped</li>");
                }

            }
           }); }, 3000);
        

    },
    error:function(json){
        alert("cant stop vm. error occured");
    }

});



};

function startvm(arg,num){


    var requireddata={
        vmid: arg,}; 
$.ajax({
    url:"/index.php/whycle/api/vmstart",
    data:requireddata,
    dataType:"json",
    async:true,
    success:function(json){
        alert("starting vm please wait");
         $( "#vmname"+num+" #name" ).addClass( "starting" );
        $("#vmdetail"+num+" ul"+" #status").replaceWith("<li id=status>Starting</li>");
        
        jid=json.startvmresponse.jobid;
          var requiredata1={
            jobid:jid
          };
       var refreshIntervalId=  setInterval(function() {
   
          $.ajax({ 
            url:"/index.php/whycle/api/vmstatus",
            data:requiredata1,
            success: function(json){
          
                var result = json.queryasyncjobresultresponse.jobstatus;

                if(result==0)
                {


                    
                    return; //Job is still pending
                }
                else{
                  
                    clearInterval(refreshIntervalId);
                     //$("#status"+num).replaceWith("<li id=status>Stopped");
                     $( "#vmname"+num+" #name" ).addClass( "running" );
                     $("#vmdetail"+num+" ul"+" #status").replaceWith("<li id=status>Running</li>");
                }

            }
           }); }, 3000);
















    },
    error:function(json){
        alert("cant start vm. error occured");
    }
    
});




};

function deletevm(arg,num)
{
    alert(arg);
 var requireddata=
 {
vmid:arg,
 };
$.ajax({
url:"/index.php/whycle/api/vmdestroy",
data:requireddata,
dataType:"json",
async:true,
success:function(json){
    alert("deleting vm. Please wait");

     

    
    $("#vmcontainer"+num).replaceWith("<div id=deleting"+num+"><img src=/assets/img/ajax-loader.gif> deleting...</div>");
    

    jid=json.destroyvmresponse.jobid;
          var requiredata1={
            jobid:jid
          };
       var refreshIntervalId=  setInterval(function() {
   
          $.ajax({ 
            url:"/index.php/whycle/api/vmstatus",
            data:requiredata1,
            success: function(json){
          
                var result = json.queryasyncjobresultresponse.jobstatus;

                if(result==0)
                {


                    
                    return; //Job is still pending
                }
                else{
                  
                    clearInterval(refreshIntervalId);
                     //$("#status"+num).replaceWith("<li id=status>Stopped");

                     $("#deleting"+num).remove();
                }

            }
           }); }, 3000);









    
    
},
error:function(json){
    alert("failed to delete vm");
}

});



};

function relocate()
{
    //$("#vmcontainer"+num).remove();
    window.location = '/index.php/whycle/main/listvm';
    
}

function connect(arg,num)
{

    var url="http://"+arg+":8000";

   window.open(url , true, '_blank');



}


