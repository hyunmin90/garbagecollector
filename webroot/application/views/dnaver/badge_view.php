      <div class="container">
        <div class="page-header">
          <h1>DNA Membership</h1>
        </div>
        <p class="lead">Show DNA members</p>


	      <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>userid</th>
              <th>joinpath</th>
              <th>email</th>
              <th>getbadgedate</th>
              <th>badge</th>
              <th>description</th>
            </tr>
          </thead>
          <tbody>

           <?php
           		$num=1;
				foreach($data as $d){
				?>
				    <tr>
				      <td><?=$num++?></td>
		              <td><?=$d['userid']?></td>
		              <td><?=$d['joinpath']?></td>
		              <td><?=$d['email']?></td>
		              <td><?=$d['grantdate']?></td>
                  <td><?=$d['name']?></td>
                  <td><?=$d['description']?></td>
		            </tr>
				<?php
				}
			?>

          </tbody>
        </table>
      </div>


