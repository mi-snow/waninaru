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
		echo $this->Html->css(array('bace'), null, array('inline'=>false)); echo $this->assign('title', 'Waninaru - 学生同士がスキルを共有して、アイディアを実現できるサービス ');


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
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<link rel="shortcut icon" href="./favicon.ico" />

<title>Waninaru - 学生同士がスキルを共有して、アイディアを実現できるサービス</title>
<?php echo $this->Html->script('jquery'); ?>
<?php echo $this->Html->script('smoothScroll'); ?>
<?php echo $this->Html->script( 'jqfloat.js'); ?>
<?php echo $this->Html->script( 'movebg.js'); ?>


</head>

<body>
	<div id="container">


		<div id="header">
			<div id="main_wrapp">
				<?php echo $this->element('teaser_header_title'); ?>
			</div><!-- end main_wrapp -->
		</div>


		<div id="content">
			<div id="main_wrapp">

				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>

			</div>
		</div>


		<div id="footer">
			<div id="footer_top_wrapp">
				<div id="footer_top_inner">
		          <p>
        		    <a href="http://twitter.com/share?url=http://waninaru.net/&text=Waninaru - ネ学生同士がスキルを共有して、アイディアを実現できるWebサービス。&related=ne_Waninaru&hashtags=waninaru">
            			<?php echo $this->Html->image("teaser/about_wani.png"); ?>
           			</a>
            		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        		  </p>
				</div><!-- end footer_top_inner -->
			</div><!-- end footer_top_wrapp -->

			<div id="footer_container_wrapp">
  				<div id="footer_container">
        		  <div id="about_message">
   					<p id="about_footer">
        		      <?php echo $this->Html->image("teaser/about_coming.png"); ?>
         		    </p>

          			</div><!-- end about_message -->
  				</div><!-- end footer_container -->
			</div><!-- end footer_container_wrapp -->

			<div id="copy_wrrap">
				<address>Copyright (c) わに育成委員会. All Rights Reserved.</address>
			</div><!-- end copy_wrrap -->

		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>

</body>
</html>
