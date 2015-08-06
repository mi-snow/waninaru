<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('Waninaru', 'Waninaru - 学生同士がスキルを共有して、アイディアを実現できるサービス');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css(array('common'), null, array('inline'=>false)); echo $this->assign('title', 'Waninaru - 学生同士がスキルを共有して、アイディアを実現できるサービス ');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<meta name="description" content="スキルを共有して、自分がやりたい事・アイディアを実現する場を提供する、専修大学ネットワーク情報学部生同士向けのサービスです。" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximam-scale=1.0">

<link rel="shortcut icon" href="./favicon.ico" />

<title>Waninaru - 学生同士がスキルを共有して、アイディアを実現できるサービス</title>
<?php echo $this->Html->script('jquery'); ?>
<?php echo $this->Html->script('smoothScroll'); ?>

<script type="text/javascript">
$(function(){
     $('a img').hover(function(){
        $(this).attr('src', $(this).attr('src').replace('_off', '_on'));
          }, function(){
             if (!$(this).hasClass('currentPage')) {
             $(this).attr('src', $(this).attr('src').replace('_on', '_off'));
        }
   });
     $('ul#right_menu li').hover(function(){
        $('a img', this).attr('src', $('a img', this).attr('src').replace('_off', '_on'));
          }, function(){
             if (!$('a img', this).hasClass('currentPage')) {
             $('a img', this).attr('src', $('a img', this).attr('src').replace('_on', '_off'));
        }
   });
});

</script>

</head>
<body>
	<div id="container">
		<div id="header">
			<div id="main_wrapp">
			<div id="main_inner">
				<?php
					   if($userSession==null){
						echo $this->element('header_out');
					   }else{
						echo $this->element('header_in');
					   }
			?>
			</div><!-- end main_inner -->
			</div><!-- end main_wrapp -->
		</div>


		<div id="content">
			<div id="main_wrapp">
			<div id="main_inner">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
			</div>
		</div>


		<div id="footer">
			<div id="footer_top_wrapp">
				<div id="footer_top_inner">
					<p><a href="#main_wrapp" title="Page top"><?php echo $this->Html->image('common/pagetop_off.png',array('alt'=>'Page top'));?></a></p>
				</div><!-- end footer_top_inner -->
			</div><!-- end footer_top_wrapp -->

			<div id="footer_container_wrapp">
  				<div id="footer_container">
   					<p>
   					<?php
                if($userSession['id']!=null){
                  echo $this->Html->link($this->Html->image('common/footer_logo.png',array('alt'=>'Waninaru')) , array('controller'=>'projects' , 'action'=>'index'),array('escape'=>false,'title'=>'Waninaru'));
                }else{
                  echo $this->Html->link($this->Html->image('common/footer_logo.png',array('alt'=>'Waninaru')) , array('controller'=>'users' , 'action'=>'login'),array('escape'=>false,'title'=>'Waninaru'));
                }
            ?></p>
    				<ul class="clearfix">
      					<li>
      					<?php echo $this->Html->link('Waninaruとは' , array('controller'=>'abouts' , 'action'=>'index'),array('title'=>'Waninaruとは') ) ?>
      					</li>
      					<li class="f_line">|</li>
      					<li>
      					<?php echo $this->Html->link('Waninaruの使い方' , array('controller'=>'howtos' , 'action'=>'index'),array('title'=>'Waninaruの使い方') ) ?></li>
      					<li class="f_line">|</li>
      					<li>
      					<?php echo $this->Html->link('お問い合わせ' , array('controller'=>'contacts' , 'action'=>'index'),array('title'=>'お問い合わせ') ) ?></li>
      					<li class="f_line">|</li>
      					<li>
      					<?php echo $this->Html->link('利用規約' , array('controller'=>'rules' , 'action'=>'index'),array('title'=>'利用規約') ) ?></li>
      					<li class="f_line">|</li>
      					<li>
      					<?php echo $this->Html->link('よくあるご質問' , array('controller'=>'questions' , 'action'=>'index'),array('title'=>'よくあるご質問') ) ?></li>
    				</ul>

    				<?php if($userSession != null):?>
    				<ul class="clearfix">
      					<li>
      					<?php echo $this->Html->link('TOP' , array('controller'=>'projects' , 'action'=>'index'),array('title'=>'TOP') ) ?></li>
      					<li class="f_line">|</li>
      					<li>
      					<?php echo $this->Html->link('通知' , array('controller'=>'activities' , 'action'=>'index' , $userSession['id']),array('title'=>'通知') ) ?></li>
      					<li class="f_line">|</li>
      					<li>
      					<?php echo $this->Html->link('投稿する' , array('controller'=>'projects' , 'action'=>'add'),array('title'=>'投稿する') ) ?></li>
      					<li class="f_line">|</li>
      					<li>
      					<?php echo $this->Html->link('企画を検索する' , array('controller'=>'projects' , 'action'=>'search'),array('title'=>'企画を検索する') ) ?></li>
      					<li class="f_line">|</li>
      					<li>
      					<?php echo $this->Html->link('マイページ' , array('controller'=>'users' , 'action'=>'view' , $userSession['id']),array('title'=>'マイページ') ) ?></li>
      					<li class="f_line">|</li>
      					<li>
      					<?php echo $this->Html->link('名前・パスワードの変更' , array('controller'=>'users' , 'action'=>'edit' , $userSession['id']),array('title'=>'名前・パスワードの変更') ) ?></li>
      					<li class="f_line">|</li>
      					<li>
      					<?php echo $this->Html->link('ログアウト' , array('controller'=>'users' , 'action'=>'logout'),array('title'=>'ログアウト') ) ?></li>
    				</ul>
    				<?php endif;?>

    				<span class="cont_wrapp pt_15">
    					<ul class="clearfix">
      						<li><a href="http://www.senshu-u.ac.jp/" title="専修大学" target="_blank">専修大学</a></li>
      						<li class="f_line">|</li>
      						<li><a href="http://www.senshu-u.ac.jp/sc_grsc/network.html" title="ネットワーク情報学部" target="_blank">ネットワーク情報学部</a></li>
      						<li class="f_line">|</li>
      						<li><a href="https://sps.acc.senshu-u.ac.jp/ActiveCampus/index.html" title="専修大学ポータル" target="_blank">専修大学ポータル</a></li>
      						<li class="f_line">|</li>
      						<li><a href="https://cp.ss.senshu-u.ac.jp/lms/lginLgir/" title="CoursePower" target="_blank">CoursePower</a></li>
    					</ul>
    				</span>
    				<span class="cont_wrapp pt_25">Waninaruは、専修大学ネットワーク情報学部向けに作成されたコンテンツです。</span>
  				</div><!-- end footer_container -->
			</div><!-- end footer_container_wrapp -->

			<div id="copy_wrrap">
				<address>Copyright (c) Waninaru Project. All Rights Reserved.</address>
			</div><!-- end copy_wrrap -->

		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>

</body>
</html>
