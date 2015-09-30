<!-- ここから編集してください！！！！  -->
<div id="login_container_wrapp">

    	<div id="login_container">
        <div id="login_inner">
       			<ul class="login_form">
       			<?php echo $this->Form->create('User',array('novalidate' => true));?>
       				<li class="sub_title">学籍番号（メールアドレス）</li>
       				<li class="clearfix">
       					<span class="login_left clearfix">
       						<span class="login_user_left">ne</span>
       						<span class="login_user_right"><?php echo $this->Form->input('student_number', array('label'=>false, 'type' => 'number','maxLength'=>6,'class'=>'user')); ?></span>
       					</span>
       					<span class="login_right text">@senshu-u.jp</span>
       				</li>
       				<li class="sub_title">パスワード</li>
       				<li class="clearfix">
       					<span class="login_left"><?php echo $this->Form->input('user_password', array('label'=>false, 'type' => 'password','class'=>'password')); ?></span>
    						<span class="login_right"><?php echo $this->Form->submit('ログイン',array('type'=>'submit','class'=>'login'));?></span>
     					</li>
     				</ul>
         	</form>
          <p class="detail_text">
          	Waninaruは、専修大学ネットワーク情報学部生を繋げる企画支援サービスです。
            パスワードを忘れた場合は、<?php echo $this->Html->link('お問い合わせ' , array('controller'=>'contacts' , 'action'=>'index' , $userSession['id']),array('title'=>'お問い合わせ') ) ?>ください。
          </p>
          <div id="new_account"> 
            <?php echo $this->Html->image('common/login_make_off.jpg' , array('url'=>array('controller'=>'UserTemps' , 'action'=>'add' , $userSession['id']), 'alt'=>'新規登録', 'title'=>'新規登録') ) ?>
          </div>
       	</div><!-- end login_inner -->
    	</div><!-- end login_container -->

    </div><!-- end login_container_wrapp -->

<!-- 編集ここまで  -->