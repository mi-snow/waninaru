<!-- メインコンテンツはここから編集してください！！！！  -->
	<div id="main_container" class="projects index">
	
    <h2><span><?php echo __('新着企画'); ?></span></h2> 

        <ul id="project_container">
      	<?php foreach ($projects as $project): ?>
            <li><dl class="clearfix">
              <dt><span><?php echo $this->Html->image('../files/'.$project['Project']['image_file_name'],array('url'=>array('controller'=>'projects','action'=>'view' , $project['Project']['id']),'alt'=>'企画イメージ','title'=>'詳しく見る'));?></span></a></dt>
              <dd class="clearfix">
                  <p class="p_title"><span><?php echo h($project['Project']['project_name']); ?></span></p>
                  <p class="p_date"><?php 
                  	list($year, $month, $day, $hour, $minute, $second) = preg_split('/[-: ]/', $project['Project']['active_date']);
                  	echo h($year.'年 '.$month.'月 '.$day.'日   '.$hour.':'.$minute.'   開催!!'); ?></p>
                  <span class="detail_btn"><?php echo $this->Html->link('詳しく見る',array('controller'=>'projects','action' => 'view',$project['Project']['id']),array('escape'=>false)); ?></span>
              </dd>
            </dl></li>
        <?php endforeach; ?>
        </ul>
      	</div><!-- end main_container -->

<!-- 編集ここまで  -->
