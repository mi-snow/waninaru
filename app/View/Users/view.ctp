<?php echo $this->Html->css(array('mypage'), null, array('inline'=>false));?>

<!-- ここから編集してください！！！！  -->
    <div id="main_container">

      <h2><span>マイページ</span></h2>
      <?php $us=$this->params['pass']['0'] ?>
      <!-- 編集完了時に表示
      <p class="done_edit">登録が完了しました。</p>
      -->

      <div class="myprof_container">
        <ul>
          <li><dl class="clearfix">
            <dt><span>名前</span></dt>
            <dd><?php echo($user['User']['real_name']); ?></dd>
          </dl></li>
          <li><dl class="clearfix">
          	<dt><span>ニックネーム</span></dt>
          	<dd><?php echo($user['User']['nick_name']); ?></dd>
          </dl></li>
          <li><dl class="clearfix">
            <dt><span>学籍番号</span></dt>
            <dd><?php echo('NE'. $user['User']['student_number']); ?></dd>
          </dl></li>
          <li><dl class="clearfix">
            <dt><span>メールアドレス</span></dt>
            <dd><?php echo('ne'. $user['User']['student_number'] .'@senshu-u.jp'); ?></dd>
          </dl></li>

          <li><dl class="clearfix">
            <dt><span>参加中の企画</span></dt>
            <dd id="up_prof" class="clearfix m_margin_20">
            <?php foreach ($joindata as $project) : ?>
				<div class="prof_p_wrapp">
                	<p class="prof_p_left"><span><?php echo $this->Html->image('../files/'.$project['Project']['image_file_name'],array('url'=>array('controller'=>'projects','action'=>'view' , $project['Project']['id']),'alt'=>'企画イメージ','title'=>'詳しく見る'));?></span></p>
                	<p class="prof_p_right">
                  		<span class="prof_p_title"><?php echo h($project['Project']['project_name']); ?></span>
                  		<span class="prof_p_date"><?php list($year, $month, $day, $hour, $minute, $second) = preg_split('/[-: ]/', $project['Project']['active_date']);
                  				echo h($year.'年'.$month.'月'.$day.'日 開催!!'); ?></span>
                  		<span class="prof_p_detail"><?php echo $this->Html->link('詳しく見る' , array('controller'=>'projects' , 'action'=>'view' , $project['Project']['id']),array('title'=>'詳しく見る') ) ?></span>
               		 </p>
              	<div class="project_edit_menu clearfix">
                		
               				<p><?php echo $this->Html->link('企画者に連絡する' , array('controller'=>'DirectMessages' , 'action'=>'add' , $project['Project']['id'],'1'),array('title'=>'企画者に連絡する') ) ?></p>
                		
                			
              			</div><!-- end prof_p_wrapp -->
			<?php endforeach; ?>
              
          </dd>
          </dl>

          <div id="under_prof" class="clearfix m_margin_20">
            <?php foreach ($joindata as $project) : ?>
        <div class="prof_p_wrapp">
                  <p class="prof_p_left"><span><?php echo $this->Html->image('../files/'.$project['Project']['image_file_name'],array('url'=>array('controller'=>'projects','action'=>'view' , $project['Project']['id']),'alt'=>'企画イメージ','title'=>'詳しく見る'));?></span></p>
                  <p class="prof_p_right">
                      <span class="prof_p_title"><?php echo h($project['Project']['project_name']); ?></span>
                      <span class="prof_p_date"><?php list($year, $month, $day, $hour, $minute, $second) = preg_split('/[-: ]/', $project['Project']['active_date']);
                          echo h($year.'年'.$month.'月'.$day.'日 開催!!'); ?></span>
                      <span class="prof_p_detail"><?php echo $this->Html->link('詳しく見る' , array('controller'=>'projects' , 'action'=>'view' , $project['Project']['id']),array('title'=>'詳しく見る') ) ?></span>
                   </p>
                <div class="project_edit_menu clearfix">
                		
               				<p><?php echo $this->Html->link('企画者に連絡する' , array('controller'=>'DirectMessages' , 'action'=>'add' , $project['Project']['id'],'1'),array('title'=>'企画者に連絡する') ) ?></p>
                		
                			
              			</div><!-- end prof_p_wrapp -->
      <?php endforeach; ?>
              
          </div>
          </li>
          
          
          <li><dl class="clearfix">
            <dt ><span>投稿した企画</span></dt>
            <dd id="up_prof" class="clearfix m_margin_20">
 				<?php foreach ($producedata as $project) : ?>
				 	<div class="prof_p_wrapp">
              			<p class="prof_p_left"><span><?php echo $this->Html->image('../files/'.$project['Project']['image_file_name'],array('url'=>array('controller'=>'projects','action'=>'view' , $project['Project']['id']),'alt'=>'企画イメージ','title'=>'詳しく見る'));?></span></p>
              			<p class="prof_p_right">
                			<span class="prof_p_title"><?php echo h($project['Project']['project_name']); ?></span>
                			<span class="prof_p_date"><?php list($year, $month, $day, $hour, $minute, $second) = preg_split('/[-: ]/', $project['Project']['active_date']);
                  				echo h($year.'年'.$month.'月'.$day.'日 開催!!'); ?></span>
                			<span class="prof_p_detail"><?php echo $this->Html->link('詳しく見る' , array('controller'=>'projects' , 'action'=>'view' , $project['Project']['id']),array('title'=>'詳しく見る') ) ?></span>
              			</p>    
              			<div class="project_edit_menu clearfix">
                			<p><?php echo $this->Html->link('参加メンバー' , array('controller'=>'projects' , 'action'=>'joinlist' , $project['Project']['id']),array('title'=>'参加メンバー') ) ?></p>
               				<p><?php echo $this->Html->link('企画を編集する' , array('controller'=>'projects' , 'action'=>'edit' , $project['Project']['id']),array('title'=>'企画を編集する') ) ?></p>
                            <p><?php echo $this->Html->link('参加者に連絡する' , array('controller'=>'DirectMessages' , 'action'=>'add' , $project['Project']['id'],'2'),array('title'=>'参加者に連絡する') ) ?></p>
                			<p><?php echo $this->Form->postLink('企画を削除する' , array('controller'=>'projects' , 'action'=>'delete' , $project['Project']['id']),array('title'=>'企画を削除する','confirm'=>'本当に企画を削除しますか？','class'=>'delete')); ?></p>
              			</div><!-- end project_edit_menu -->
            		</div><!-- end prof_p_wrapp -->
				<?php endforeach; ?>
            </dd>
          </dl>
          <div id="under_prof" class="clearfix m_margin_20">
        <?php foreach ($producedata as $project) : ?>
          <div class="prof_p_wrapp">
                    <p class="prof_p_left"><span><?php echo $this->Html->image('../files/'.$project['Project']['image_file_name'],array('url'=>array('controller'=>'projects','action'=>'view' , $project['Project']['id']),'alt'=>'企画イメージ','title'=>'詳しく見る'));?></span></p>
                    <p class="prof_p_right">
                      <span class="prof_p_title"><?php echo h($project['Project']['project_name']); ?></span>
                      <span class="prof_p_date"><?php list($year, $month, $day, $hour, $minute, $second) = preg_split('/[-: ]/', $project['Project']['active_date']);
                          echo h($year.'年'.$month.'月'.$day.'日 開催!!'); ?></span>
                      <span class="prof_p_detail"><?php echo $this->Html->link('詳しく見る' , array('controller'=>'projects' , 'action'=>'view' , $project['Project']['id']),array('title'=>'詳しく見る') ) ?></span>
                    </p>    
                    <div class="project_edit_menu clearfix">
                      <p><?php echo $this->Html->link('参加メンバー' , array('controller'=>'projects' , 'action'=>'joinlist' , $project['Project']['id']),array('title'=>'参加メンバー') ) ?></p>
                      <p><?php echo $this->Html->link('企画を編集する' , array('controller'=>'projects' , 'action'=>'edit' , $project['Project']['id']),array('title'=>'企画を編集する') ) ?></p>
                      <p><?php echo $this->Html->link('参加者に連絡する' , array('controller'=>'DirectMessages' , 'action'=>'add' , $project['Project']['id'],'2'),array('title'=>'参加者に連絡する') ) ?></p>
                      <p><?php echo $this->Form->postLink('企画を削除する' , array('controller'=>'projects' , 'action'=>'delete' , $project['Project']['id']),array('title'=>'企画を削除する','confirm'=>'本当に企画を削除しますか？','class'=>'delete')); ?></p>
                    </div><!-- end project_edit_menu -->
                </div><!-- end prof_p_wrapp -->
        <?php endforeach; ?>
            </div>
            </li>
        </ul>
      </div><!-- end myprof_container -->
      
      <div id="profedit_area" class="clearfix">
        <p>
          <?php if($us==$userSession['id']){echo $this->Html->link('名前・パスワード変更' , array('controller'=>'users' , 'action'=>'edit' , $userSession['id']),array('title'=>'名前・パスワード変更') );} 
				else{echo $this->Html->link('名前・パスワード変更' , array('controller'=>'users' , 'action'=>'edit' , $us),array('title'=>'名前・パスワード変更') );} ?>
        </p>
        
        <?php if($us==$userSession['id'] && $userSession['mode']==1){echo "<br><br><p>"; echo $this->Html->link('管理者設定' , array('controller'=>'users' , 'action'=>'config' , $userSession['id']),array('title'=>'管理者設定') ); echo "</p>";} ?>
      </div><!-- end profedit_area -->
      

    </div><!-- end main_container -->



    
    <script type="text/javascript">
    $(function(){
      $('.delete').click(function() {
        if (!confirm('企画を削除します\nよろしいですか？')) {
          return false;
        }
      });
    });
    </script>
    <!-- ポップアップしか導入してません。(削除の処理は不明・・・) -->
    
<!-- 編集ここまで  -->
