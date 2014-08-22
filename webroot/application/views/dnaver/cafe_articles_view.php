      <div class="container">
        <div class="page-header">
          <h1>DNA Cafe Articles List</h1>
          <h2><?=$data['boardId']?></h2>
        </div>


	      <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>boardid</th>
              <th>nickname</th>
              <th>writedate</th>
              <th>userid</th>
              <th>type</th>
            </tr>
          </thead>
          <tbody>

           <?php
     		   $num = 1;
				foreach($data['page'.$num][0] as $d)
        {  
          $num++;
          foreach($d['articles'][0] as $t)
          {

				?>  
				    <tr>
              <td><?=$t['id']?></td>
              <td><?=$t['boardid']?></td>
              <td><?=$t['nickname']?></td>
              <td><?=$t['writedate']?></td>
              <td><?=$t['userid']?></td>            
              <td><?=$t['type']?></td>
            </tr>
				<?php
          
          }
				}
			?>

          </tbody>
        </table>
      </div>