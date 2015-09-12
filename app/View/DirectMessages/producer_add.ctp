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
<title>チェックボックスのチェック すべて選択／すべて解除</title>
<script language="Javascript">

flag =false;
var index;
function allChange(){
　flag = !flag; // trueとfalseの切り替え ! 否定演算子
　var elem = document.getElementsByName("select[]");
　　　　for(index = 0; index < elem.length; index++){
　　　　　elem[index].checked = flag;
　　　　　}
　}

</script>
</head>

</html>

    
    
      
     
  <?php	$cnt = 0;?>
     <?php foreach ($joiner_project as $joinersProject ): ?>
      <?php	$cnt = $cnt + 1;?>
     <?php endforeach; ?>  
 <?php if ($cnt >1): ?>
 <body>
<input type="button" name="all" value="すべて選択／すべて解除" onClick="allChange();"/><br/>
</body>
<?php endif; ?>

		<?php if (!empty($project['JoinersProject'])): ?>
			<ul id="member_list">
		
        <?php if ($cnt ==1): ?>
            <input type="hidden" name="select[]" value=<?php echo $joinersProject['Joiner']['User']['student_number']  ?> ><?php echo ("NE". $joinersProject['Joiner']['User']['student_number'] . "　　" .$joinersProject['Joiner']['User']['real_name']. "　"); ?>さん<li></li>
		<?php else: ?>	
			<?php foreach ($joiner_project as $joinersProject ): ?>
			<input type="checkbox" name="select[]" value=<?php echo $joinersProject['Joiner']['User']['student_number']  ?> ><?php echo ("NE". $joinersProject['Joiner']['User']['student_number'] . "　　" .$joinersProject['Joiner']['User']['real_name']. "　"); ?>さん<li></li>
			<?php endforeach; ?>
	   <?php endif; ?>		
			</ul>
			
		<?php else: ?> 
			<ul id="member_list">
				<li>現在参加中のメンバーはいません。</li>
			</ul>
		<?php endif; ?>
	
     
<div>

            <span class="attention_area">
              <span class="attention_area_inner">
                送信先指定(1人の場合指定不可）
                
              </span>
            </span>
          </dd>
        </dl></li>
        <li><dl class="clearfix">
     
          <dt><span>カテゴリー</span></dt>
          <dd>
            <span class="form_area">

            <?php echo $this->Form->input('category', array('type'=>'radio', 'class'=>'radio_button_area', 'options'=>array('補足　', '日時変更　', '中止　', 'その他　'), 'wrap'=>'soft', 'legend'=>false, 'before'=>'<div class=radio_button_area>', 'after'=>'</div>', 'separator'=>'</div><div class=radio_button_area>')); ?></span>
           
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
ご参加ありがとうございます。
企画者より連絡することがあります。

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