<?php echo $this->Html->css(array('user'), null, array('inline'=>false));?>
<!-- ここから編集してください！！！！ -->
<div id="main_container">
  <div id="passwordinit_container">

    <?php echo $this->Form->create('User',array('novalidate' => true,'inutDefaults' => array('label' => false,'div' => false))); ?>

      <fieldset class="user_form">
      <h2><span>パスワードの初期化</span></h2>
      学籍番号を入力したユーザのパスワードを初期化し、「123456」に書き換えます。
      <dl class="user_form_dl clearfix">
        <dt><label for="UserStudentNumber">学籍番号</label></dt>
        <dd><?php echo $this->Form->input('student_number',array('label'=>''));?></dd>
      </dl>

      </fieldset>

     <?php echo $this->Form->submit('初期化',array('label' => false,'div' => false,'class'=>'user_submit_btn')); ?>

    <?php $this->Form->end(); ?>


  </div><!-- end passwordinit_container -->
</div><!-- end main_container -->
<!-- 編集ここまで  -->