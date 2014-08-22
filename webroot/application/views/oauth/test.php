        <div class="page-header">
          <h1>DNA Membership</h1>
        </div>
        <p class="lead">Show DNA members</p>

    <iframe src="https://apis.daum.net/oauth2/authorize?client_id=28165690&redirect_uri=http://localhost/oauth/oauth/test2&response_type=code"></iframe>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <input type="button" value="click" id="btn" onclick="aa()">
    <script type="text/javascript">

        function aa()
        {  
            alert($('iframe').contents().find('#code').html());
        }

    </script>
