<?php echo $this->Html->css(array('projects_common'), null, array('inline'=>false)); ?>

<!-- ここから編集してください！！！！  -->
<div id="main_container">

	<h2><span>参加メンバー</span></h2>

	<!-- ?php print_r($joiner_project); ? -->
		<?php if (!empty($project['JoinersProject'])): ?>
			<ul id="member_list">
			<?php foreach ($joiner_project as $joinersProject): ?>
					<li><?php echo ("NE". $joinersProject['Joiner']['User']['student_number'] . "　　" .$joinersProject['Joiner']['User']['real_name']. "　"); ?>さん</li>
				<?php endforeach; ?>
			</ul>
		<?php else: ?> 
			<ul id="member_list">
				<li>現在参加中のメンバーはいません。</li>
			</ul>
		<?php endif; ?>

	<p id="back_foot"><a href="javascript:history.go(-1)" title="マイページに戻る">&gt;&gt; マイページに戻る</a></p>
      
</div><!-- end main_container -->
<!-- 編集ここまで  -->
