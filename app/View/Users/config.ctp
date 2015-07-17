<?php echo $this->Html->css(array('config'), null, array('inline'=>false));?>

<!-- ここから編集してください！！！！  -->
    <div id="main_container">

      <h2><span>管理者設定</span></h2>

      <ul class="config_container">
            <!-- li><?php echo $this->Html->link('名前・パスワードの変更' , array('controller'=>'users' , 'action'=>'edit' , $userSession['id']),array('title'=>'名前・パスワードの変更') ) ?></li -->
        	<li><?php echo $this->Html->link('管理者メッセージ登録' , array('controller'=>'messages' , 'action'=>'add'), array('title'=>'管理者メッセージ登録') ); ?></li>
        	<li><?php echo $this->Html->link('管理者メッセージ一覧' , array('controller'=>'messages' , 'action'=>'index'), array('title'=>'管理者メッセージ一覧') ); ?></li>
        	<li><?php echo $this->Html->link('企画の一覧' , array('controller'=>'projects' , 'action'=>'projectlist'),array('title'=>'ユーザの一覧') ); ?></li>
        	<li><?php echo $this->Html->link('ユーザの一覧' , array('controller'=>'users' , 'action'=>'index'),array('title'=>'ユーザの一覧') ); ?></li>
        	<li><?php echo $this->Html->link('一人のユーザを登録' , array('controller'=>'users' , 'action'=>'add'),array('title'=>'一人のユーザを登録') ); ?></li>
        	<li><?php echo $this->Html->link('複数のユーザを登録' , array('controller'=>'users' , 'action'=>'superadd'),array('title'=>'複数のユーザを登録') ); ?></li>
            <!-- li><?php echo $this->Html->link('ログアウト' , array('controller'=>'users' , 'action'=>'logout'),array('title'=>'ログアウト') ) ?></li -->
      </ul>

    </div><!-- end main_container -->
<!-- 編集ここまで  -->