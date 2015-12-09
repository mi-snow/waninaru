<?php echo $this->Html->css(array('user'), null, array('inline'=>false));?>
<!-- ここから編集してください！！！！  -->

<div id="main_container">
	<div id="users_container">

	<h2><span>企画一覧</span></h2>
<?php echo $this->Form->create('projectlist',array('method'=> 'POST','inputDefaults' => array('label' => false,'div' => false),'url'=>array('controller'=>'Projects','action'=>'projectlist'))); ?>
        <div id="search_area" class="clearfix">
          <?php echo $this->Form->input('search', array('label' => false, 'class' => 'search', 'required' => false,'value'=>$keyword )); ?>
          <?php echo $this->Form->submit('検索', array('class' => 'submit')); ?>
	<table class="userlist" cellpadding="0" cellspacing="0">
	<tbody><tr>
			<th><?php echo $this->Paginator->sort('id','ID'); ?></th>
			<th><?php echo $this->Paginator->sort('project_name','企画名'); ?></th>
			<th><?php echo $this->Paginator->sort('producer_id','企画者名(ニックネーム)'); ?></th>
			<th><?php echo $this->Paginator->sort('active_date','開催日'); ?></th>
			<th><?php echo $this->Paginator->sort('modified','最終更新日'); ?></th>
			<th class="actions"> 表示,更新,削除 </th>
	</tr>
<!--	<?php print_r($projects['0']['ProducersProject']['0']['producer_id']); ?>  -->
	<?php foreach ($projects as $project): ?>
	<tr>
		<td><?php echo h($project['Project']['id']); ?></td>
		<td><?php echo $project['Project']['project_name']; ?></td>
		<td><?php echo $P2[$P[$project['Project']['id']]]; ?></td>
		<td><?php echo $project['Project']['active_date']; ?></td>
		<td><?php echo $project['Project']['modified']; ?></td>
		<td><?php echo $this->Html->link(__('View'), array('action' => 'view', $project['Project']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $project['Project']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $project['Project']['id']), null, __('この企画を削除しますか？ # %s', $project['Project']['id'])); ?></td>
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