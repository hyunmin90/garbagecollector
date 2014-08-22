      <div class="container">
        <div class="page-header">
          <h1>badge insert</h1>
        </div>
        <p class="lead">Insert badge</p>


	<form action="/dnaver/badge/insert_badge" method="get" name="">
            <label for="badge">배지 이름&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" name="badge" value=""/>
            <br>
		    <label for="description">설명일</label>
            <input class="form-control" type="text" name="description" value="" />
            <br>
            <label for="getprocess">코드&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" name="getprocess" value="" />
            <br>
            <button type="submit" class="btn btn-default navbar-btn">save</button>
        </form>