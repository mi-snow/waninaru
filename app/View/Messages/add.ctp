<?php 
echo $this->Html->css(array('post'), null, array('inline'=>false));
echo $this->Html->script('send-check.js'); 
?>

<!-- メインコンテンツはここから編集してください！！！！  -->
<div id="post_container">
  <div id="post_top_container">
    <h2 id="post_top_title">管理者メッセージ</h2>
    <p id="post_top_text">
    </p>

  </div><!-- end post_top_container -->
  <div id="form_container">
    <?php echo $this->Form->create('Message', array('enctype' => 'multipart/form-data', 'onsubmit'=>"return send_check()", 'inputDefaults' => array('label' => false, 'div' => false))); ?>
      <ul>
        <li><dl class="clearfix">
          <dt><span>宛先</span></dt>
          <dd>
            <span class="form_area">
            <?php echo $this->Form->input('student_number', array('class'=>'small_area tipped', 'wrap'=>'soft')); ?></span>
            <span class="attention_area">
              <span class="attention_area_inner">
                neを除く学籍番号6桁で一人指定<br>空欄でユーザー全員へ送信
              </span>
            </span>
          </dd>
        </dl></li>
        <li><dl class="clearfix">
          <dt><span>カテゴリー</span></dt>
          <dd>
            <span class="form_area">
            <?php echo $this->Form->input('category', array('type'=>'radio', 'class'=>'radio_button_area', 'options'=>array('メンテ　', '警告　', '提案　', 'その他　'), 'wrap'=>'soft', 'legend'=>false, 'before'=>'<div class=radio_button_area>', 'after'=>'</div>', 'separator'=>'</div><div class=radio_button_area>')); ?></span>
            <span class="attention_area">
              <span class="attention_area_inner">
                いずれかを選択
              </span>
            </span>
          </dd>
        </dl></li>
        <li><dl class="clearfix">
          <dt><span>本文</span></dt>
          <dd>
            <span class="form_area">
              <?php echo $this->Form->textarea('text', array('wrap'=>'soft','class'=>'contents_area','default'=>'メンテ用
この度Waninaruはメンテナンスにより、しばらく利用できなくなります。
メンテナンス期間は○月○日から○月○日の予定です。
何かございましたら、お手数ですがこちらまでご連絡ください。
waninaru.2015@gmail.com

警告用
この度あなたが投稿された企画には不適切な部分が見つかりました。
よって、一度削除させていただきます。
詳しい理由や何かございましたらお手数ですがこちらまでご連絡ください。
waninaru.2015@gmail.com')); ?>
            </span>
            <span class="attention_area">
              <span class="attention_area_inner">
                メンテナンスの予告、アップロード内容など<br><br>注意内容など
              </span>
            </span>
          </dd>
        </dl></li>
      </ul>
      <div id="submit_btn_container">
        <?php echo $this->Form->submit('../img/common/form02_submit.jpg',array('type'=>'submit','height'=>'90','name'=>'mode','value'=>'save'))?>
      </div><!-- end submit_btn_container -->
  </div><!-- end form_container -->
</div><!-- end post_container -->
<!-- 編集ここまで  -->