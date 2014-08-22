      <div class="container">
        <div class="page-header">
          <h1>Prize</h1>
        </div>
        <p class="lead">Insert prize</p>


	<form action="/dnaver/event/winnerinsert_model" method="get" name="">
            <label for="name">행사 이름&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" name="name" id="name" value=""/>
            <br>
		<label for="email">사용자 이메일</label>
            <input class="form-control" type="text" name="email" id="email" value="" />
            <br>
            <label for="prize">수상명</label>
            <input class="form-control" type="text" name="prize" id="prize" value="" />
            <br>
            <button type="submit" class="btn btn-default navbar-btn">save</button>
        </form>