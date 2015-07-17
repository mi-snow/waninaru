<?php echo $this->Html->css(array('user'), null, array('inline'=>false));?>
<!-- ここから編集してください！！！！  -->

<div id="main_container">
	<div id="users_container">

	<h2><span>ユーザ一覧</span></h2>

	<table class="userlist" cellpadding="0" cellspacing="0">
	<tbody><tr>
			<th><?php echo $this->Paginator->sort('id','ID'); ?></th>
			<th><?php echo $this->Paginator->sort('student_number','学籍番号'); ?></th>
			<th><?php echo $this->Paginator->sort('real_name','名前'); ?></th>
			<th><?php echo $this->Paginator->sort('modified','最終更新日'); ?></th>
			<th class="actions"> 表示,更新,削除 </th>
	</tr>
	
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?></td>
		<td><?php echo ne.$user['User']['student_number']; ?></td>
		<td><?php echo $user['User']['real_name']; ?></td>
		<td><?php echo $user['User']['modified']; ?></td>
		<td><?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('このユーザを削除しますか？ # %s', $user['User']['id'])); ?></td>
	</tr>
   <?php endforeach; ?>
	</tbody></table>
	<p class="userlist_text">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('{:count} 件中 、 {:start} 〜 {:end} 件目までを表示中')
	));
	?>
	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>


	</div><!-- end users_container -->
</div><!-- end main_container -->
<!-- 編集ここまで  -->