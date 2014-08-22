<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Create VM</title>

        <!-- Our CSS stylesheet file -->
        <link rel="stylesheet" href="<?php echo asset_url();?>css/styles.css" />

		<!-- Font Awesome Stylesheet -->
		<link rel="stylesheet" href="<?php echo asset_url();?>font-awesome/css/font-awesome.css" />

		<!-- Including Open Sans Condensed from Google Fonts -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
  <script type="text/x-handlebars">
  <div id="main">

    	<nav id="colorNav">
			<ul>
				<li class="green">
					{{#link-to 'php' class="icon-php"}}{{/link-to}}
				
				</li> 
				<li class="red">
					{{#link-to 'Nodejs' class="icon-nodejs"}}{{/link-to}}
					
				</li>
				<li class="blue">
					{{#link-to 'jsp'  class="icon-jsp"}}{{/link-to}}
					
				</li>
				<li class="yellow">
					{{#link-to 'Django' class="icon-pythondjango"}}{{/link-to}}
					
				</li>
				<li class="purple">
					{{#link-to 'Ruby' class="icon-ruby"}}{{/link-to}}
					
				</li>
			</ul>
		


		 {{outlet}}
    			



    			</div>
</script>


  <script type="text/x-handlebars" id="php">
      <div id="specselection">
  		<h3> PHP server setup</h3>

                  	<div class="input-group input-group-lg" id="vmname">
 
  			<input type="text" class="form-control" placeholder="Virtual Machine name" id="nametxt">
			
	       	</div>

		<h4>CPU</h4>
		  <div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addcpu('500')">
		    <input type="radio" name="options" id="option1" > 500MHz
		  </label>
		  <label class="btn btn-primary"  onclick="addcpu('1')">
		    <input type="radio" name="options" id="option2"> 1Ghz
		  </label>
		  <label class="btn btn-primary"  onclick="addcpu('2')">
		    <input type="radio" name="options" id="option3"> 2Ghz
		  </label>
		</div>
		<br>
		<h4>Memory</h4>
		<div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addram('512')">
		    <input type="radio" name="options" id="option1" /> 512MB
		  </label>
		  <label class="btn btn-primary" onclick="addram('1024')">
		    <input type="radio" name="options" id="option2" /> 1GB
		  </label>
		  <label class="btn btn-primary" onclick="addram('2048')">
		    <input type="radio" name="options" id="option3" /> 2GB
		  </label>
		</div>
		<br>
		<h4>HDD</h4>
		<div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addhdd('5')">
		    <input type="radio" name="options" id="option1" /> 5GB
		  </label>
		  <label class="btn btn-primary" onclick="addhdd('10')">
		    <input type="radio" name="options" id="option2" /> 10GB
		  </label>
		  <label class="btn btn-primary"  onclick="addhdd('20')">
		    <input type="radio" name="options" id="option3"/> 20GB
		  </label>
		   <label class="btn btn-primary" onclick="addhdd('50')">
		    <input type="radio" name="options" id="option3" /> 50GB
		  </label>
		</div>
		<br>


	<div id="submit">
      		<input type="submit" class="btn btn-success btn-large active" value="CREATE" onclick="createvm('php')"/>
      	</div>

	</div>

      
  </script>


  <script type="text/x-handlebars" id="Nodejs">
      
 <div id="specselection">
  		<h3> Nodejs server setup</h3>

                  	<div class="input-group input-group-lg" id="vmname">
 
  			<input type="text" class="form-control" placeholder="Virtual Machine name" id="nametxt">
			
	       	</div>

		<h4>CPU</h4>
		  <div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addcpu('500')">
		    <input type="radio" name="options" id="option1" > 500MHz
		  </label>
		  <label class="btn btn-primary"  onclick="addcpu('1')">
		    <input type="radio" name="options" id="option2"> 1Ghz
		  </label>
		  <label class="btn btn-primary"  onclick="addcpu('2')">
		    <input type="radio" name="options" id="option3"> 2Ghz
		  </label>
		</div>
		<br>
		<h4>Memory</h4>
		<div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addram('512')">
		    <input type="radio" name="options" id="option1" /> 512MB
		  </label>
		  <label class="btn btn-primary" onclick="addram('1024')">
		    <input type="radio" name="options" id="option2" /> 1GB
		  </label>
		  <label class="btn btn-primary" onclick="addram('2048')">
		    <input type="radio" name="options" id="option3" /> 2GB
		  </label>
		</div>
		<br>
		<h4>HDD</h4>
		<div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addhdd('5')">
		    <input type="radio" name="options" id="option1" /> 5GB
		  </label>
		  <label class="btn btn-primary" onclick="addhdd('10')">
		    <input type="radio" name="options" id="option2" /> 10GB
		  </label>
		  <label class="btn btn-primary"  onclick="addhdd('20')">
		    <input type="radio" name="options" id="option3"/> 20GB
		  </label>
		   <label class="btn btn-primary" onclick="addhdd('50')">
		    <input type="radio" name="options" id="option3" /> 50GB
		  </label>
		</div>
		<br>


	<div id="submit">
      		<input type="submit" class="btn btn-success btn-large active" value="CREATE" onclick="createvm('node')"/>
      	</div>

	</div>
  </script>



  <script type="text/x-handlebars" id="jsp">
      
 <div id="specselection">
  		<h3> Java server setup</h3>

                  	<div class="input-group input-group-lg" id="vmname">
 
  			<input type="text" class="form-control" placeholder="Virtual Machine name" id="nametxt">
			
	       	</div>

		<h4>CPU</h4>
		  <div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addcpu('500')">
		    <input type="radio" name="options" id="option1" > 500MHz
		  </label>
		  <label class="btn btn-primary"  onclick="addcpu('1')">
		    <input type="radio" name="options" id="option2"> 1Ghz
		  </label>
		  <label class="btn btn-primary"  onclick="addcpu('2')">
		    <input type="radio" name="options" id="option3"> 2Ghz
		  </label>
		</div>
		<br>
		<h4>Memory</h4>
		<div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addram('512')">
		    <input type="radio" name="options" id="option1" /> 512MB
		  </label>
		  <label class="btn btn-primary" onclick="addram('1024')">
		    <input type="radio" name="options" id="option2" /> 1GB
		  </label>
		  <label class="btn btn-primary" onclick="addram('2048')">
		    <input type="radio" name="options" id="option3" /> 2GB
		  </label>
		</div>
		<br>
		<h4>HDD</h4>
		<div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addhdd('5')">
		    <input type="radio" name="options" id="option1" /> 5GB
		  </label>
		  <label class="btn btn-primary" onclick="addhdd('10')">
		    <input type="radio" name="options" id="option2" /> 10GB
		  </label>
		  <label class="btn btn-primary"  onclick="addhdd('20')">
		    <input type="radio" name="options" id="option3"/> 20GB
		  </label>
		   <label class="btn btn-primary" onclick="addhdd('50')">
		    <input type="radio" name="options" id="option3" /> 50GB
		  </label>
		</div>
		<br>


	<div id="submit">
      		<input type="submit" class="btn btn-success btn-large active" value="CREATE" onclick="createvm('java')"/>
      	</div>

	</div>
  </script>



  <script type="text/x-handlebars" id="Django">
      
 <div id="specselection">
  		<h3> Django server setup</h3>

                  	<div class="input-group input-group-lg" id="vmname">
 
  			<input type="text" class="form-control" placeholder="Virtual Machine name" id="nametxt">
			
	       	</div>

		<h4>CPU</h4>
		  <div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addcpu('500')">
		    <input type="radio" name="options" id="option1" > 500MHz
		  </label>
		  <label class="btn btn-primary"  onclick="addcpu('1')">
		    <input type="radio" name="options" id="option2"> 1Ghz
		  </label>
		  <label class="btn btn-primary"  onclick="addcpu('2')">
		    <input type="radio" name="options" id="option3"> 2Ghz
		  </label>
		</div>
		<br>
		<h4>Memory</h4>
		<div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addram('512')">
		    <input type="radio" name="options" id="option1" /> 512MB
		  </label>
		  <label class="btn btn-primary" onclick="addram('1024')">
		    <input type="radio" name="options" id="option2" /> 1GB
		  </label>
		  <label class="btn btn-primary" onclick="addram('2048')">
		    <input type="radio" name="options" id="option3" /> 2GB
		  </label>
		</div>
		<br>
		<h4>HDD</h4>
		<div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addhdd('5')">
		    <input type="radio" name="options" id="option1" /> 5GB
		  </label>
		  <label class="btn btn-primary" onclick="addhdd('10')">
		    <input type="radio" name="options" id="option2" /> 10GB
		  </label>
		  <label class="btn btn-primary"  onclick="addhdd('20')">
		    <input type="radio" name="options" id="option3"/> 20GB
		  </label>
		   <label class="btn btn-primary" onclick="addhdd('50')">
		    <input type="radio" name="options" id="option3" /> 50GB
		  </label>
		</div>
		<br>


	<div id="submit">
      		<input type="submit" class="btn btn-success btn-large active" value="CREATE" onclick="createvm('django')"/>
      	</div>

	</div>
  </script>



  <script type="text/x-handlebars" id="Ruby">
      
 <div id="specselection">
  		<h3> Ruby server setup</h3>

                  	<div class="input-group input-group-lg" id="vmname">
 
  			<input type="text" class="form-control" placeholder="Virtual Machine name" id="nametxt">
			
	       	</div>

		<h4>CPU</h4>
		  <div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addcpu('500')">
		    <input type="radio" name="options" id="option1" > 500MHz
		  </label>
		  <label class="btn btn-primary"  onclick="addcpu('1')">
		    <input type="radio" name="options" id="option2"> 1Ghz
		  </label>
		  <label class="btn btn-primary"  onclick="addcpu('2')">
		    <input type="radio" name="options" id="option3"> 2Ghz
		  </label>
		</div>
		<br>
		<h4>Memory</h4>
		<div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addram('512')">
		    <input type="radio" name="options" id="option1" /> 512MB
		  </label>
		  <label class="btn btn-primary" onclick="addram('1024')">
		    <input type="radio" name="options" id="option2" /> 1GB
		  </label>
		  <label class="btn btn-primary" onclick="addram('2048')">
		    <input type="radio" name="options" id="option3" /> 2GB
		  </label>
		</div>
		<br>
		<h4>HDD</h4>
		<div class="btn-group" data-toggle="buttons" id="specbutton">
		  <label class="btn btn-primary active" onclick="addhdd('5')">
		    <input type="radio" name="options" id="option1" /> 5GB
		  </label>
		  <label class="btn btn-primary" onclick="addhdd('10')">
		    <input type="radio" name="options" id="option2" /> 10GB
		  </label>
		  <label class="btn btn-primary"  onclick="addhdd('20')">
		    <input type="radio" name="options" id="option3"/> 20GB
		  </label>
		   <label class="btn btn-primary" onclick="addhdd('50')">
		    <input type="radio" name="options" id="option3" /> 50GB
		  </label>
		</div>
		<br>


	<div id="submit">
      		<input type="submit" class="btn btn-success btn-large active" value="CREATE" onclick="createvm('ruby')"/>
      	</div>

	</div>
  </script>




        <!-- BSA AdPacks code. Please ignore and remove.--> 
		<script src="<?php echo asset_url();?>js/jquery-1.8.2.min.js"></script>
		<script src="<?php echo asset_url();?>js/libs/jquery-1.9.1.js"></script>
  		<script src="<?php echo asset_url();?>js/libs/handlebars-1.0.0.js"></script>
  		<script src="<?php echo asset_url();?>js/libs/ember-1.0.0-rc.8.js"></script>
  		<script src="http://cdnjs.cloudflare.com/ajax/libs/showdown/0.3.1/showdown.min.js"></script>
  		<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.1.0/moment.min.js"></script>
  		<script src="<?php echo asset_url();?>js/app.js"></script>
  		<script src="<?php echo asset_url();?>js/createVMscript.js"></script>
  		<script src="<?php echo asset_url();?>js/bootstrap.js"></script>
    		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    </body>
</html>
