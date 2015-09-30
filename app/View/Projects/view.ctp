<!-- メインコンテンツはここから編集してください！！！！  -->
<?php
echo $this->assign('title', 'Waninaru - 学生同士がスキルを共有して、アイディアを実現できるサービス ');
echo $this->Html->css(array('common','detail'), null, array('inline'=>false));
echo $this->Html->script('send-check.js');
echo $this->assign('title', 'Waninaru - '.$project['Project']['project_name']);
?>


<div id="top_detail_container" class="clearfix">
	<ul id="number_area" class="clearfix">

		<li class="clearfix">
			<span class="t_d_img"><?php echo $this->Html->image('common/project/top_comment.png'); ?></span>
			<span class="t_d_number">コメント数：
			<?php echo h($commentnum);
			?></span>
		</li>
		<li class="clearfix">
			<span class="t_d_img"><?php echo $this->Html->image('common/project/top_seat.png') ?></span>
			<span class="t_d_number">残り席：
			<?php $rest = $project['Project']['people_maxnum']-$joinernum;?>
			<?php echo h($rest); ?> / <?php echo h($project['Project']['people_maxnum']); ?></span>
		</li>
	</ul>
	<div id="sns_area">
			<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php
					echo '「'.$project['Project']['project_name'].'」&#10;'.mb_substr(str_replace(array("\r\n", "\r", "\n"), "", $project['Project']['detail_text']), 0, 50, 'utf-8').'...&#10;' ;
				?>" data-hashtags="waninaru">Tweet</a>
			<script>!function(d,s,id){
				var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
				if(!d.getElementById(id)){
					js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
					fjs.parentNode.insertBefore(js,fjs);
				}}
				(document, 'script', 'twitter-wjs');</script>

	</div>
</div><!-- end top_detail_container -->

<div id="main_detail_container" class="clearfix">
	<div id="left_container">

		<div id="image_area">
			<?php echo $this->Html->image('../files/'.$project['Project']['image_file_name'],array('height'=>'350'));?>
		</div><!-- end image_area -->

		<div id="join_container">
			<?php
			$check = 0; //ボタン表示・非表示チェック
			$today = date("Y-m-d H:i:00"); //現在時刻

			if($project['Project']['recrouit_date'] >= $today){
				if($project['JoinersProject']!=null){
					foreach($project['JoinersProject'] as $joiner){
						if($joiner['Joiner']['User']['id']==$userSession['id']){
							if($check == 0){
								$check = 1;
								$msg = __('参加をやめますか？', true);
								echo $this->Html->image('common/project/join_out_btn.jpg',array('url'=>array('controller'=>'joiners_projects','action'=>'delete',$project['Project']['id']),'alt'=>'参加をやめる','width'=>'350','onClick'=>"return confirm('$msg')"));
							}
						}
					}
				}
				if($project['Project']['people_maxnum']>count($project['JoinersProject'])){
					if($check == 0){
							$check = 1;
							$msg = __('参加しますか？', true);
							echo $this->Html->image('common/project/join_btn.jpg',array('url'=>array('controller'=>'joiners_projects','action'=>'add',$project['Project']['id']),'alt'=>'参加する','width'=>'350','onClick'=>"return confirm('$msg')"));
					}
				}
			}else{
				echo h("この企画の参加登録は締め切りました");
			}
			?>

			<p id="j_seat"><?php $rest = $project['Project']['people_maxnum']-$joinernum;
			echo h($rest);
			?><p>
			<p id="j_date"><?php echo h($project['Project']['recrouit_date']); ?>まで<br />全<?php echo h($project['Project']['people_maxnum']); ?>席<p>
		</div><!-- end join_container -->

		<div id="planning_container">
			<p>企画者：
			<?php
				echo h($project['ProducersProject']['0']['Producer']['User']['nick_name']);
			?> </p>
			<p id="sub_fold"> <br />
		</div><!-- end planning_container -->

	</div><!-- end left_container -->

	<div id="right_container">

		<div id="ivent_name_area">
			<p><?php echo h($project['Project']['project_name']); ?></p>
		</div><!-- end ivent_name_area -->

		<div id="ivent_date_area">
			<p><?php list($year, $month, $day, $hour, $minute, $second) = preg_split('/[-: ]/', $project['Project']['active_date']);
                  	echo h($year.'年 '.$month.'月 '.$day.'日  '.'('.$week.')'.$hour.':'.$minute); ?>～</p>
		</div><!-- end ivent_date_area -->

		<div id="ivent_place_area">
			<p><?php echo h($project['Project']['active_place']); ?></p>
		</div><!-- end ivent_place_area -->

		<div id="about_area">
			<p>
			<?php
				$detailtext = nl2br($project['Project']['detail_text']);
				echo $detailtext; ?>
		</p>
		</div><!-- end about_area -->

	</div><!-- end right_container -->



</div><!-- end main_detail_container -->






<div id="comment_container">
	<div id="comment_top_title">
		<span>コメント</span>
	</div><!-- comment_top_title -->
<?php if(!empty($com)): ?>
	<?php foreach($com as $comment): ?>
	<!-- ?php print_r($comment); ? -->
		<div class="comment_view_area">
			<div class="comment_wrrap">
				<p>No.<?php echo $comment['Comment']['comment_num']; ?></p>
				<p><?php echo $comment['Comment']['comment_text']; ?></p>
				<dl class="clearfix">
					<dt></dt>
					<dd>
					<?php
						if($comment['Comment']['user_id']==$project['ProducersProject']['0']['Producer']['User']['id']){
							echo h('企画者 ');
						}
						echo pr($comment['User']['nick_name']);
					?></dd>
				</dl>
				<dl class="clearfix">
					<dt></dt>
					<dd>
					<?php
						if($userSession!=null){
							foreach($project['ProducersProject'] as $producer){
								if($userSession['id']==$producer['Producer']['user_id']){
									echo $this->Form->button('削除',array('onclick' => "location.href = '" . $this->Html->url("/comments/delete/{$comment['Comment']['id']}/{$comment['Comment']['project_id']}") . "'"));
									break;
								}else if($userSession['id']==$comment['User']['id']){
									echo $this->Form->button('削除',array('onclick' => "location.href = '" . $this->Html->url("/comments/delete/{$comment['Comment']['id']}/{$comment['Comment']['project_id']}") . "'"));
									break;
								}
							}
						}
					?></dd>
				</dl>
			</div><!-- comment_wrapp  -->
		</div><!-- end comment_view_area -->
	<?php endforeach; ?>
<?php endif;?>
<div id="comment_contribute_container">
	<?php echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'add'), 'onsubmit'=>"return send_check()", 'inputDefaults' => array('label' => false,'div' => false))); ?>
	<?php echo $this->Form->textarea('Comment.comment_text',array('class'=>'comment_width','wrap'=>'hard')); ?>
	<?php echo $this->Form->hidden('Comment.project_id', array('value' => $project['Project']['id'])); ?>
	<?php echo $this->Form->hidden('Comment.user_id', array('value' =>$userSession[id])); ?>
	<span id="submit_btn"><?php echo $this->Form->submit('idea/submit_btn.jpg',array("div"=>false,"escape"=>false,'type'=>'submit')); ?></span>
<?php echo $this->Form->end() ?>
</div><!-- end comment_contribute_container -->


</div><!-- end comment_container -->

<!-- 編集ここまで  -->
