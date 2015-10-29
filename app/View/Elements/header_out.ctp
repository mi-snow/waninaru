			<div id="header_container" class="clearfix">
				<div id="header_left" class="clearfix">
					<?php echo $this->Html->image('common/header_logo_off.png',array('url'=>array('controller'=>'projects','action'=>'index'),'alt'=>'Waninaru','title'=>'Waninaru'));?>
				</div><!-- end header_right -->
				<div id="header_right">
					<ul id="right_menu" class="clearfix">
<!--      				<li><?php echo $this->Html->image('common/header_alert_off.png',array('url'=>array('controller'=>'activities','action'=>'index' , $userSession['id']),'alt'=>'通知','title'=>'通知'));?>
     					<?php echo $this->Html->link('  通知' , array('controller'=>'activities' , 'action'=>'index' , $userSession['id']),array('title'=>'通知') ) ?></li>-->
      					<li><?php echo $this->Html->image('common/header_post_off.png',array('url'=>array('controller'=>'projects','action'=>'add'),'alt'=>'投稿','title'=>'投稿'));?>
      					<?php echo $this->Html->link('  投稿' , array('controller'=>'projects' , 'action'=>'add'),array('title'=>'投稿') ) ?></li>
      					<li><?php echo $this->Html->image('common/header_search_off.png',array('url'=>array('controller'=>'projects','action'=>'search'),'alt'=>'検索','title'=>'検索'));?>
      					<?php echo $this->Html->link('  検索' , array('controller'=>'projects' , 'action'=>'search'),array('title'=>'検索') ) ?></li>
<!--      				<!--<li><?php echo $this->Html->image('common/header_cog_off.png',array('url'=>array('controller'=>'users','action'=>'config' , $userSession['id']),'alt'=>'設定','title'=>'設定'));?>
      					<?php echo $this->Html->link('  設定' , array('controller'=>'users' , 'action'=>'config' , $userSession['id']),array('title'=>'設定') ) ?></li> -->
      					<li class="log"><?php echo $this->Html->image('common/login_off.png',array('url'=>array('controller'=>'users','action'=>'login'),'alt'=>'ログインする'));?>
      					<?php echo $this->Html->link('  ログイン',array('controller'=>'users','action' => 'login'),array('title'=>'ログインする')); ?></li>
    				</ul>
  				</div><!-- end header_right -->
			</div><!-- end header_container -->


      <div id="sp_header">
        <div id="sp_menubar" class="clearfix">
          <div id="sp_space">&nbsp;</div>
          <div id="sp_logo"><?php echo $this->Html->image('common/sp_header_logo.png',array('url'=>array('controller'=>'projects','action'=>'index'),'alt'=>'Waninaru','title'=>'Waninaru'));?></div>
          <div id="sp_hum"><a href="#" id="open_menu"><?php echo $this->Html->image('common/sp_menu_hum.png');?></a></div>
        </div>
        <div id="sp_menu">
          <ul>
            <li>
              <?php echo $this->Html->link('  投稿' , array('controller'=>'projects' , 'action'=>'add'),array('title'=>'投稿', 'class'=>'add') ) ?></li>
            <li>
             <?php echo $this->Html->link('  検索' , array('controller'=>'projects' , 'action'=>'search'),array('title'=>'検索', 'class'=>'search') ) ?></li>
            <li class="log">
              <?php echo $this->Html->link('  ログイン' , array('controller'=>'users' , 'action'=>'login'),array('title'=>'ログインする', 'class'=>'login') ) ?></li>
            <li>
              <a href="#sp_menu" id="close_menu">メニューを閉じる</a>
            </li>
          </ul>
        </div>
      </div>
