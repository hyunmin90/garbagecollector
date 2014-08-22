
var spec =[];

function  createvm(arg)
{	
	if (spec[0]==null)
	{	
		spec[0]=512;
	}
	if (spec[1]==null)
	{	
		spec[1]=5;
	}
	if (spec[2]==null)
	{	
		spec[2]=500;
	}
	

	
	spec[3]=$("#nametxt").val();

	if(arg=='php'){
	spec[4]="f7beef90-b30c-482d-9e85-487da0b36438";  //Uses Daum IaaS Template
	}
	else if(arg=='java'){
	spec[4]="15679c95-12e1-4dbd-9653-a58a951922e1";
	}
	else if(arg=='django'){
	spec[4]="abaa65ae-ce60-4478-9ccd-7c61066fe3b9";
	}
	else
	{
	spec[4]="f2dbe6c8-9624-4370-a510-c7d6bb09a295";
	}


	alert(spec[3]);
	var requireddata={
	ram:spec[0],
	hdd:spec[1],
	cpu:spec[2],
	name:spec[3],	
	templateid:spec[4],
	};
	  $.ajax({
                                url: "/index.php/whycle/api/vmdeploy",
                                data:requireddata,
                                dataType: "json",
                                async: true,
                                success: function(json) {
                            
                                	if(json.deployvmresponse.errortext==null){

                                	$("#main").html('<div id=loading><img src=/assets/img/ajax-loader.gif> 생성중 입니다..</div>');
                                	//setTimeout("window.location = '/index.php/whycle/main/listvm'" , 4);
                                	
                                	 jid=json.deployvmresponse.jobid;
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
			                    window.location = '/index.php/whycle/main/listvm';
			                }

			            }
			           }); }, 3000);



                                	

                               	}
                               	else{
                               		alert(json.deployvmresponse.errortext);

                               	}

                                },
                                  error: function(json){
                                  	//window.location = "/index.php/whycle/main/listvm"
                                  alert("sent failed");
                                }
                            });




	

} 
function addram(size)
{	
	spec[0]=size;

}
function addhdd(hdd){
	spec[1]=hdd;
}
function addcpu(cpu){
	spec[2]=cpu;

}
