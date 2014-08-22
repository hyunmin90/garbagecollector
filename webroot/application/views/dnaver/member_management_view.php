      <div class="container">
        <div class="page-header">
          <h1>DNA Membership</h1>
        </div>
        <p class="lead">Show DNA members RANK</p>


	      <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>userid</th>
              <th>nickname</th>
              <th>joinpath</th>
              <th>email</th>
              <th>createday</th>
              <th>point</th>
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
                  <td><?=$d['nickname']?></td>
		              <td><?=$d['joinpath']?></td>
		              <td><?=$d['email']?></td>
		              <td><?=$d['createdate']?></td>
                  <td><?=$d['point']?></td>
		            </tr>
				<?php
				}
			?>

          </tbody>
        </table>
      </div>


