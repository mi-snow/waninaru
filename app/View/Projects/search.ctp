<?php echo $this->Html->css(array('search'), null, array('inline'=>false));?>
<!-- ここから編集してください！！！！  -->

    <div id="main_container">
    
    <!--  table cellpadding="0" cellspacing="0"><tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('project_name'); ?></th>
			<th><?php echo $this->Paginator->sort('active_date'); ?></th>
			<th><?php echo $this->Paginator->sort('recrouit_date'); ?></th>
			<th><?php echo $this->Paginator->sort('active_place'); ?></th>
			<th><?php echo $this->Paginator->sort('detail_text'); ?></th>
			<th><?php echo $this->Paginator->sort('image_file_name'); ?></th>
			<th><?php echo $this->Paginator->sort('people_maxnum'); ?></th>
			<th><?php echo $this->Paginator->sort('category'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr></table -->

      <div id="search_container"><h2><span>企画名・内容で検索する</span></h2>
      	<?php echo $this->Form->create('keyword',array('method'=> 'POST','inputDefaults' => array('label' => false,'div' => false),'url'=>array('controller'=>'Projects','action'=>'tempkey'))); ?>
        <div id="search_area" class="clearfix">
          <?php echo $this->Form->input('search', array('label' => false, 'class' => 'search', 'required' => false,'value'=>'')); ?>
          <?php echo $this->Form->submit('検索', array('class' => 'submit')); ?>
        </form></div><!-- end search_area -->
      </div><!-- end search_container -->

	  <!-- start class_search_container -->
      <!-- <div id="class_search_container"><h2><span>クラスで検索する</span></h2>
        <ul class="clearfix">
          <li class="list01"><?php echo $this->Html->link('1組',array('controller'=>'projects' , 'action'=>'search',1)); ?></li>
          <li class="list01"><?php echo $this->Html->link('2組',array('controller'=>'projects' , 'action'=>'search',2)); ?></li>
          <li class="list01"><?php echo $this->Html->link('3組',array('controller'=>'projects' , 'action'=>'search',3)); ?></li>
          <li class="list01"><?php echo $this->Html->link('4組',array('controller'=>'projects' , 'action'=>'search',4)); ?></li>
          <li class="list02"><?php echo $this->Html->link('5組',array('controller'=>'projects' , 'action'=>'search',5)); ?></li>
          <li class="list02"><?php echo $this->Html->link('6組',array('controller'=>'projects' , 'action'=>'search',6)); ?></li>
          <li class="list02"><?php echo $this->Html->link('7組',array('controller'=>'projects' , 'action'=>'search',7)); ?></li>
          <li class="list02"><?php echo $this->Html->link('8組',array('controller'=>'projects' , 'action'=>'search',8)); ?></li>
          <li class="list03"><?php echo $this->Html->link('9組',array('controller'=>'projects' , 'action'=>'search',9)); ?></li>
          <li class="list03"><?php echo $this->Html->link('10組',array('controller'=>'projects' , 'action'=>'search',0)); ?></li>
        </ul>
      </div>-->
      <!-- end class_search_container -->

      <?php foreach ($projects as $project): ?>
      <ul id="project_container">
        <li><dl class="clearfix">
          <dt><span><?php echo $this->Html->image('../files/'.$project['Project']['image_file_name'],array('url'=>array('controller'=>'projects','action'=>'view' , $project['Project']['id']),'alt'=>'企画イメージ','title'=>'詳しく見る'));?></span></dt>
          <dd class="clearfix">
            <p class="p_title"><span><?php echo h($project['Project']['project_name']); ?></span></p>
            <p class="p_date"><?php list($year, $month, $day, $hour, $minute, $second) = preg_split('/[-: ]/', $project['Project']['active_date']);
                  	echo h($year.'年 '.$month.'月 '.$day.'日   '.$hour.':'.$minute.'   開催!!');?></p>
            <span class="detail_btn"><?php echo $this->Html->link('詳しく見る',array('controller'=>'projects','action' => 'view',$project['Project']['id']),array('escape'=>false)); ?></span>
          </dd>
        </dl></li>
      </ul>
      <?php endforeach; ?>
      
      
    <!--  p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p -->
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>

    </div><!-- end main_container -->

    <!-- 編集ここまで  -->