      <div class="container">
        <div class="page-header">
          <h1>Event</h1>
        </div>
        <p class="lead">Insert event</p>

		<form action="/dnaver/event/eventinsert_to_db" method="get" name="">
		<label for="id">행사ID:</label>
            <input type="text" name="id" id="id" value="" />
            <br>
            <label for="name">행사 이름:</label>
            <input type="text" name="name" id="name" value="" />
            <br>
            <label for="type">행사 종류:</label>
            <input type="text" name="type" id="type" value="" />
            <br>
            <label for="eventdate">행사일자:</label>
            <input type="text" name="eventdate" id="eventdate" value="" />
            <br>
            <label for="url">링크:</label>
            <input type="text" name="url" id="url" value="" />
            <br>
            <input type="submit" value="save" />
            </form>
