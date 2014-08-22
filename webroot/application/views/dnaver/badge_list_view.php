      <div class="container">
        <div class="page-header">
          <h1>DNA Membership</h1>
        </div>
        <p class="lead">Show DNA members</p>


	      <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>배지 이름</th>
              <th>배지 코드</th>
              <th>배지설명</th>
              <th>사용여부</th>
              <th>희소성</th>
            </tr>
          </thead>
          <tbody>

           <?php
           		$num=1;
				foreach($data as $d){
				?>
				    <tr>
				      <td><?=$num++?></td>
		              <td><?=$d['name']?></td>
		              <td><?=$d['getprocess']?></td>
                  <td><?=$d['description']?></td>
                  <td><?=$d['status']?></td>
                  <td><?=$d['scarcity']?></td>
		            </tr>
				<?php
				}
			?>

          </tbody>
        </table>
      </div>


