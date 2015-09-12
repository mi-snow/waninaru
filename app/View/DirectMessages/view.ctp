<!-- メインコンテンツはここから編集してください！！！！  -->
<?php
echo $this->assign('title', 'Waninaru - 学生同士がスキルを共有して、アイディアを実現できるサービス ');
echo $this->Html->css(array('common','directmessage'), null, array('inline'=>false));
echo $this->assign('title', 'Waninaru - '.$project['Project']['project_name']);
?>

<div id="directmessage_container">
  <div id="directmessage_top_container">
    <p id="directmessage_top_text">
    	以下の内容でメッセージを送信しました。
    </p>
  </div><!-- end directmessage_top_container -->
  
      <ul>
        <li><dl class="clearfix">
          <dt><span>宛先</span></dt>
          <dd>
			
			<?php if ($directmessage['DirectMessage']['send_mode'] == 1): ?>
			  <?php echo h($directmessage['Project']['project_name'].'の企画者さん');?>
			  <?php else: ?> 
			  <?php echo 'ne'.h($joinerAll);?>
			  <?php endif; ?>
			 
          </dd>
        </dl></li>
        <li><dl class="clearfix">
          <dt><span>カテゴリー</span></dt>
          <dd>
 			<?php echo h($directmessage['DirectMessage']['category']); ?>
          </dd>
        </dl></li>
        <li><dl class="clearfix">
          <dt><span>本文</span></dt>
          <dd>
			<?php 
				$text = nl2br(strip_tags($directmessage['DirectMessage']['text']));
				echo $text; ?>
          </dd>
        </dl></li>
      </ul>

</div><!-- end directmessage_container -->
<!-- 編集ここまで  -->