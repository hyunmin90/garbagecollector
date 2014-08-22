<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-wip/css/bootstrap.min.css">

		 <!-- Bootstrap core CSS -->
    	<link href="//bootstrapk.com/BS3/dist/css/bootstrap.css" rel="stylesheet">

    	<!-- Custom styles for this template -->
    	<link href="//bootstrapk.com/BS3/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">
    </head>
    <body>

    	    <!-- Wrap all page content here -->
      <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/main">DNA Membership</a>
          </div>

          <!--dropdown-->
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">사용자 관리<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/member/show_member">사용자 보기</a></li>
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/member/insert_from_DNA">insert_from_DNAcafe</a></li>
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/member/insert_from_api">insert_from_api</a></li>
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/member/insert_from_event">insert_from_event</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/member/calcul_point_grade">calcul_point_grade</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">행사관리<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/event/eventinsert">행사 추가</a></li>
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/event/winnerinsert">수상자 추가</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">뱃지 관리<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/badge/grant_badge">뱃지 갱신</a></li>
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/badge/show_member_badge">뱃지 회원 보기</a></li>
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/badge/show_badgelist">뱃지 리스트</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/badge/insert_badge_form">배지 추가하기</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">게시판 관리<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/cafe/cafepost_boardlist">게시판 목록 및 가중치 변경</a></li>
                  <li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>/dnaver/cafe/cafepost_newpostlist">오늘의 새로운 글 목록</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">환경설정 <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>

            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
