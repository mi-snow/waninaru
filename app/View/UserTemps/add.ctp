<?php echo $this->Html->css(array('usertemp'), null, array('inline'=>false));?>
<!-- ここから編集してください！！！！ -->
<div id="main_container">
<div id="form_container_wrapp">

    <div id="form_container">
    	<div id="form_inner">
    		<h2 class="form_style"><span>仮登録</span></h2>
    		<ul class="form">
        	<?php echo $this->Form->create('UserTemp',array('inutDefaults' => array('label' => false,'div' => false))); ?>
        		<li class="sub_title"><label for="UserStudentNumber" class="sub_title">学籍番号(メールアドレス)</label></li>
        		<li class="clearfix">
        			<span class="form_left clearfix">
        				<span class="form_user_left">ne</span>
        				<span class="form_user_right"><?php echo $this->Form->input('student_number',array('id'=>'UserTempStudentNumber','label'=>false, 'class'=>'user'));?></span>
        			</span>
        			<span class="form_user_right text">@senshu-u.jp</span>
      			</li>
      			<p class="detail_text_form">学籍番号を入力してください。-は入れないでください。<br>
      			 入力されたアドレス宛に、新規登録用メールが送信されます。</p>
      		
      		<span class="button"><?php echo $this->Form->submit('送信',array('label' => false,'div' => false,'class'=>'usertemp_submit_btn')); ?></span>
      		<?php $this->Form->end(); ?>
      	</div><!-- end form_inner -->
  	</div><!-- end form_container -->
  	
</div><!-- end form_container_wrapp -->
</div>
<!-- 編集ここまで  -->