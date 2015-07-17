<!-- メインコンテンツはここから編集してください！！！！  -->
<?php
echo $this->assign('title', 'Waninaru - 学生同士がスキルを共有して、アイディアを実現できるサービス ');
echo $this->Html->css(array('common','message'), null, array('inline'=>false));
echo $this->assign('title', 'Waninaru - '.$project['Project']['project_name']);
?>

<div id="message_container">
  <div id="message_top_container">
    <p id="message_top_text">
    	以下の内容でメッセージを送信しました。
    </p>
  </div><!-- end message_top_container -->
  
      <ul>
        <li><dl class="clearfix">
          <dt><span>宛先</span></dt>
          <dd>
			<?php if($message['User']['student_number'] != null){ echo 'ne'.h($message['User']['student_number']);}else{echo h(全員);} ?>
          </dd>
        </dl></li>
        <li><dl class="clearfix">
          <dt><span>カテゴリー</span></dt>
          <dd>
 			<?php echo h($message['Message']['category']); ?>
          </dd>
        </dl></li>
        <li><dl class="clearfix">
          <dt><span>本文</span></dt>
          <dd>
			<?php 
				$text = nl2br(strip_tags($message['Message']['text']));
				echo $text; ?>
          </dd>
        </dl></li>
      </ul>

</div><!-- end message_container -->
<!-- 編集ここまで  -->