<?php 
echo $this->Html->css(array('post'), null, array('inline'=>false));
echo $this->Html->script('send-check.js'); 
?>

<!-- メインコンテンツはここから編集してください！！！！  -->
<div id="post_container">
  <div id="post_top_container">
  
    <h2 id="post_top_title">ダイレクトメッセージ</h2>
    <p id="post_top_text">
    </p>

  </div><!-- end post_top_container -->
  <div id="form_container">
    <?php echo $this->Form->create('DirectMessage', array('enctype' => 'multipart/form-data', 'onsubmit'=>"return send_check()", 'inputDefaults' => array('label' => false, 'div' => false))); ?>
      <ul>
        <li><dl class="clearfix">
         
          <dt><span>宛先</span></dt>
          <dd>
    
    
  
       
 
<html>
<head>


</head>

</html>
     <?php if (!empty($project['JoinersProject'])): ?>
      <!-- <?php echo $producer_id ?> --!>
       <input type="hidden" name="select[]" value=<?php echo $producer_id3  ?> ><?php echo ($project_name . "　の"); ?>企画者さん<li></li>
       	
		<?php else: ?> 
			<ul id="member_list">
				<li>現在参加中のメンバーはいません。</li>
			</ul>
		<?php endif; ?>
		
<div>

            <span class="attention_area">
              <span class="attention_area_inner">
                送信先は企画者
                
              </span>
            </span>
          </dd>
        </dl></li>
        <li><dl class="clearfix">
     
          <dt><span>カテゴリー</span></dt>
          <dd>
            <span class="form_area">
          
            <?php echo $this->Form->input('category', array('type'=>'radio', 'class'=>'radio_button_area', 'options'=>array('持ち物　', '遅刻・早退　', '費用　', 'その他　'), 'wrap'=>'soft', 'legend'=>false, 'before'=>'<div class=radio_button_area>', 'after'=>'</div>', 'separator'=>'</div><div class=radio_button_area>')); ?></span>
      
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
        
              <?php echo $this->Form->textarea('text', array('wrap'=>'soft','class'=>'contents_area','default'=>'<書き方の例>
失礼いたします。
あなたの企画の参加者です。              
あなたの企画について質問があります。


')); ?>
 
            </span>
            <span class="attention_area">
              <span class="attention_area_inner">
                企画の詳細説明や延期、やむを得ず中止する場合の連絡など
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
