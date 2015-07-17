<?php echo $this->Html->css(array('usertemp'), null, array('inline'=>false));?>
<!-- ここから編集してください！！！！ -->
<div id="main_container">
<div id="form_container_wrapp">

    <div id="form_container">
    	<div id="form_inner">
    		<h2 class="form_style"><span>仮登録完了</span></h2>
      			<p class="detail_text"><!-- [ <?php echo('ne'. $UserTemp['student_number'] .'@senshu-u.jp'); ?> ]宛に、<br> -->
				  新規登録用メールを送信しました。メール内URLをクリックし、新規登録画面へ移動してください。</p>
      		
      	</div><!-- end form_inner -->
  	</div><!-- end form_container -->
  	
</div><!-- end form_container_wrapp -->
</div><!-- end main_container -->
<!-- 編集ここまで  -->