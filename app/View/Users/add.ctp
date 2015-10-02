<?php echo $this->Html->css(array('user'), null, array('inline'=>false));?>
<!-- ここから編集してください！！！！ -->
<div id="main_container">
  <div id="user_container">

    <?php echo $this->Form->create('User',array('novalidate' => true,'inutDefaults' => array('label' => false,'div' => false))); ?>

      <fieldset class="user_form">
      <h2><span>ユーザの登録</span></h2>
      <dl class="user_form_dl clearfix">
        <dt><label for="UserStudentNumber">学籍番号</label></dt>
        <dd><?php echo $this->Form->input('student_number',array('id'=>'UserStudentNumber','label'=>''));?></dd>
      </dl>
      <dl class="user_form_dl clearfix">
        <dt><label for="UserRealName">名前</label></dt>
        <dd><?php echo $this->Form->input('real_name',array('id'=>'UserRealName','label'=>''));?></dd>
      </dl>
      <dl class="user_form_dl clearfix">
      	<dt><label for="UserNickName">ニックネーム</label></dt>
      	<dd><?php echo $this->Form->input('nick_name',array('id'=>'UserNickName','label'=>''));?></dd>
      </dl>
      <dl class="user_form_dl clearfix">
        <dt><label for="UserUserPassword">パスワード</label></dt>
        <dd><?php echo $this->Form->input('user_password',array('id'=>'UserUserPassword','label'=>''));?></dd>
      </dl>
      </fieldset>

     <?php echo $this->Form->submit('登録',array('label' => false,'div' => false,'class'=>'user_submit_btn')); ?>

    <?php $this->Form->end(); ?>


  </div><!-- end user_container -->
</div><!-- end main_container -->
<!-- 編集ここまで  -->