<?php echo $this->Html->css(array('message'), null, array('inline'=>false));?>
<!-- ここから編集してください！！！！  -->

<div id="main_container">
	<div id="users_container">

	<h2><span>管理者メッセージ一覧</span></h2>

	<table class="massagelist" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('user_id', '送信先'); ?></th>
			<th><?php echo $this->Paginator->sort('category', 'カテゴリ'); ?></th>
			<th><?php echo $this->Paginator->sort('created', '送信日時'); ?></th>
			<th><?php echo $this->Paginator->sort('text', '本文'); ?></th>
			<th class="actions"><?php echo __('表示'); ?></th>
	</tr>
	<?php foreach ($messages as $message): ?>
	<tr>
		<td class="to">
			<?php if($message['User']['student_number'] != null){ echo 'ne'.h($message['User']['student_number']);}else{echo h(全員);} ?>
		</td>
		<td><?php echo h($message['Message']['category']); ?></td>
		<td><?php echo h($message['Message']['created']); ?>&nbsp;</td>
		<td class="text"><?php 
		$text = strip_tags($message['Message']['text']);
		echo mb_substr($text, 0, 40, 'utf-8'); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $message['Message']['id'])); ?>
			<!-- ?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $message['Message']['id'])); ? -->
			<!-- ?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $message['Message']['id']), null, __('Are you sure you want to delete # %s?', $message['Message']['id'])); ? -->
		</td>
	</tr>
	<!-- ?php print_r($message['Message']['user_id']) ? -->
<?php endforeach; ?>
	</table>
	<p class="messagelist_text">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('{:count}件中、 {:start} 〜 {:end}件目までを表示中')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>

	</div><!-- end massage_container -->
</div><!-- end main_container -->
<!-- 編集ここまで  -->