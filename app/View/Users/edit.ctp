<?php echo $this->Html->css(array('mypage'), null, array('inline'=>false));?>
   
    <!-- ここから編集してください！！！！  -->
    <div id="main_container">

      <h2><span>名前の変更</span></h2>

      <?php echo $this->Form->create('User',array('novalidate' => true,'url'=>array('controller'=>'users','action'=>'nameedit'))); ?>
      <div class="myprof_container">
        <ul>
          <li><dl class="clearfix">
            <dt><span>名前</span></dt>
            <dd>
              <?php echo $this->Form->input('real_name', array('label'=>false,'class'=>'middle', 'value'=>$user['User']['real_name'])); ?>
              <?php echo $this->Form->hidden('id', array('value'=>$user['User']['id'])); ?>
            </dd>
          </dl></li>
        </ul>
      </div><!-- end myprof_container -->
      
      <div class="edit_container clearfix">
        <p><a href="javascript:history.go(-1)" title="戻る">戻る</a></p>
        <p><?php echo $this->Form->submit("変更",array('class'=>'edit_submit_btn')); ?></p>
      </div><!-- end edit_container -->
      <?php echo $this->Form->end(); ?>
      
      <h2><span>ニックネームの変更</span></h2>

      <?php echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'nicknameedit'))); ?>
      <div class="myprof_container">
        <ul>
          <li><dl class="clearfix">
          	<dt><span>ニックネーム</span></dt>
          	<dd>
          	 <?php echo $this->Form->input('nick_name', array('label'=>false,'class'=>'middle', 'value'=>$user['User']['nick_name'])); ?>
          	 <?php echo $this->Form->hidden('id', array('value'=>$user['User']['id'])); ?>
          	</dd>
          </dl></li>
        </ul>
      </div><!-- end myprof_container -->
      
      <div class="edit_container clearfix">
        <p><a href="javascript:history.go(-1)" title="戻る">戻る</a></p>
        <p><?php echo $this->Form->submit("変更",array('class'=>'edit_submit_btn')); ?></p>
      </div><!-- end edit_container -->
      <?php echo $this->Form->end(); ?>


      <h2><span>パスワードの変更</span></h2>
      
      <div id="pass_container">
        <p><span>パスワードを変更する時には、まず既存のパスワードを入力し、新しいパスワードを2度入力して下さい。<br />パスワードは、英字・数字を含む6文字以上16文字以上で入力して下さい。</span></p>
      </div><!-- end pass_container -->
	  <?php echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'passwordedit'))); ?>
      <?php echo $this->Form->hidden('id', array('value'=>$user['User']['id'])); ?>
      <div class="myprof_container">
        <ul>
          <li><dl class="clearfix">
            <dt><span>古いパスワード</span></dt>
            <dd>
              <?php echo $this->Form->input('old_password',array('label'=>false, 'class'=>'middle','type'=>'password')); ?>
            </dd>
          </dl></li>
          <li><dl class="clearfix">
            <dt><span>新しいパスワード</span></dt>
            <dd>
              <?php echo $this->Form->input('new_password',array('label'=>false,'id'=>'UserNewPassword','maxLength'=>16, 'class'=>'middle','type'=>'password')); ?>
            </dd>
          </dl></li>
          <li><dl class="clearfix">
            <dt><span>新しいパスワード<br />（再入力）</span></dt>
            <dd>
              <?php echo $this->Form->input('new_password_second',array('label'=>false,'maxLength'=>16, 'class'=>'middle','type'=>'password')); ?>
            </dd>
          </dl></li>
        </ul>
      </div><!-- end myprof_container -->
     
      <div class="edit_container clearfix">
        <p><a href="javascript:history.go(-1)" title="戻る">戻る</a></p>
        <p><?php echo $this->Form->submit("変更",array('class'=>'edit_submit_btn')); ?></p>
      </div><!-- end edit_container -->
      <?php echo $this->Form->end(); ?>
      
    </div><!-- end main_container -->
    <!-- 編集ここまで  -->