<!-- about.css を使用してください！ -->
<?php echo $this->Html->css(array('about'), null, array('inline'=>false));?>

<div class="main_container">

  <div class="about_container">
    <p><?php echo $this->Html->image('/app/webroot/img/about/key_logo.png',array()); ?></p>
    <p class="key_catch">とは、ネットワーク情報学部生を繋げる<br />企画支援サービスです。</p>
  </div><!-- end about_container01 -->

  <div class="about_container">
    <p>このサービスでは、お互いのスキルを共有したり、繋がりの輪を広げたり、<br />
      一人ではできないことを、 ネットワーク情報学部生同士が協力して実現できるよう手助けをします。<br />
      例えば、スポーツ大会に参加、スマホ向けゲームを開発、気軽に勉強会を開催することなどができます。</p>
    <div id="about_btn" class="clearfix">
      <?php if($userSession != null):?>
      <span><span><?php echo $this->Html->link('企画を投稿する' , array('controller'=>'projects' , 'action'=>'add'),array('title'=>'企画を投稿する') ) ?></span></span>
      <?php else: ?>
      <span><span>企画を投稿する</span></span>
      <?php endif; ?>
      <span><span><?php echo $this->Html->link('Waninaruの使い方' , array('controller'=>'howtos' , 'action'=>'index'),array('title'=>'Waninaruの使い方') ) ?></span></span>
    </div><!-- end about_btn -->
    <p class="developed"><a href="http://www.ne.senshu-u.ac.jp/~proj25-10/" title="Developed by Kurishiba Project 2013" target="_blank">Developed by Kurishiba Project 2013</a></p>
  </div><!-- end about_container -->
  
</div><!-- end main_container -->