<?php echo $this->Html->css(array('user'), null, array('inline'=>false));?>
<div id="main_container">
<div id="user_container">
  <div id="user_top_container">
    <h2><span>新規登録</span></h2>
  </div>
  <div id="form_container">
  	<?php echo $this->Form->create('User',array('enctype' => 'multipart/form-data','inputDefaults' => array('label' => false,'div' => false))); ?>
      <ul>
        <li><dl class="clearfix">
          <dt><label for="UserStudentNumber"><span>学籍番号</span></label></dt>
          <dd>
            <span class="form_area">
            <span class="form_left">ne</span><span class="form_right"><?php echo $this->Form->input('student_number',array('id'=>'UserStudentNumber','label'=>'', 'class'=>'short_area tipped'));?></span>
			</span>
            <span class="attention_area">
              <span class="attention_area_inner">
                (例)260001 数字部分のみ ne,-,A は必要ありません
              </span>
            </span>
          </dd>
        </dl></li>
        <li><dl class="clearfix">
          <dt><label for="UserRealName"><span>本名</span></label></dt>
          <dd>
            <span class="form_area">
            <?php echo $this->Form->input('real_name',array('id'=>'UserRealName','label'=>'', 'class'=>'middle_area tipped'));?></span>
            <span class="attention_area">
              <span class="attention_area_inner">
                （例）専修太郎
              </span>
            </span>
          </dd>
        </dl></li>
        <li><dl class="clearfix">
          <dt><label for="UserNickName"><span>ニックネーム</span></label></dt>
          <dd>
            <span class="form_area">
            <?php echo $this->Form->input('nick_name',array('id'=>'UserNickName','label'=>'','class'=>'middle_area tipped'));?>
            </span>
            <span class="attention_area">
              <span class="attention_area_inner">
                好きなニックネームをつけましょう。
              </span>
            </span>
          </dd>
        </dl></li>
        <li><dl class="clearfix">
          <dt><span><label for="UserUserPassword">パスワード</label></span></dt>
          <dd>
            <span class="form_area">
              <?php echo $this->Form->input('user_password',array('id'=>'UserUserPassword','label'=>'', 'type' => 'password','maxLength'=>16,'class'=>'middle_area tipped'));?>
			</span>
            <span class="attention_area">
              <span class="attention_area_inner">
                半角英数字、6〜16文字
              </span>
            </span>
          </dd>
        </dl></li>
        <li><dl class="clearfix">
          <dt><span><label for="UserUserPassword2">確認用パスワード</label></span></dt>
          <dd>
            <span class="form_area">
              <?php echo $this->Form->input('user_password2',array('id'=>'UserUserPassword2','label'=>'', 'type' => 'password', 'maxLength'=>16,'class'=>'middle_area tipped'));?>
            </span>
            <span class="attention_area">
              <span class="attention_area_inner">
                上記のパスワードを再度入力
              </span>
            </span>
          </dd>
        </dl></li>
      </ul>
      <div id="submit_btn_container">
	    <?php echo $this->Form->hidden('ProducersProject.user_id', array('value' =>$producerid));?>
        <?php echo $this->Form->submit('../img/common/form02_submit.jpg',array('type'=>'submit','height'=>'90','name'=>'mode','value'=>'save'))?>
      </div><!-- end submit_btn_container -->

    <?php $this->Form->end(); ?>
    
    
    
  </div><!-- end form_container -->


</div><!-- end user_container -->
</div><!-- end main_container -->


<!-- ここから編集してください！！！！<?php echo $this->Form->submit('登録',array('label' => false,'div' => false,'class'=>'user_submit_btn')); ?> -->