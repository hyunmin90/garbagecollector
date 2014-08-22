      <div class="container">
        <div class="page-header">
          <h1>DNA Cafe Board List</h1>
        </div>

      <form action="/dnaver/cafe/change_weight" method="get" name="">
	      <table class="table">
          <thead>
            <tr>
              
              <th>id</th>
              <th>weight</th>
              <th>boardid</th>
            </tr>
          </thead>
          <tbody>
            
           <?php
           		$num=1;
				foreach($data as $d){
				?>
				    <tr>				          
		              <td><?=$d['id']?></td>
                  <td><input type="text" value=<?=$d['weight']?> name=weight<?=$num?> id=weight<?=$num?> ></td>
                  <td><?=$d['boardid']?></td>
                  <? $num++ ?>
		        </tr>
				<?php
				}
			?>
            
          </tbody>
        </table>
        <input type="submit" value="save" />
            </form>
      </div>