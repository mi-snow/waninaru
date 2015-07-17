<?php echo $this->Html->css(array('user'), null, array('inline'=>false));?>
<!-- ここから編集してください！！！！ -->
<div id="main_container">
  <div id="user_container">
  	<?php echo $this->Form->create('User',array('inutDefaults' => array('label' => false,'div' => false))); ?>
        <h2><span>複数のユーザの登録</span></h2>

        <fieldset class="user_form">
          <dl class="user_form_dl clearfix">
            <dt><label for="UserMin">学籍番号の始まりの値</label></dt>
            <dd><?php echo $this->Form->input('min',array('id'=>'UserMin','label'=>''));?></dd>
          </dl>
          <dl class="user_form_dl clearfix">
            <dt><label for="UserMax">学籍番号の終わりの値</label></dt>
            <dd><?php echo $this->Form->input('max',array('id'=>'UserMax','label'=>''));?></dd>
          </dl>
        </fieldset>
        <?php echo $this->Form->submit('登録',array('label' => false,'div' => false,'class'=>'user_submit_btn')); ?>

    <?php echo $this->Form->end(); ?>


  </div><!-- end user_container -->
</div><!-- end main_container -->
<!-- 編集ここまで  -->