    <!-- ここから編集してください！！！！  -->

<?php echo $this->Html->css(array('activities'),null,array('inline'=>false)); ?>
<?php echo $this->assign('title','Waninaru - アクティビティ'); ?>

    <div id="main_container">

      <h2><span>新着通知</span></h2>

      <ul id="activities_container">
      <?php foreach($activities as $active) : ?>
        <li><dl>
          <dt><span>
          <?php echo h($active['created']); ?>
          </span></dt>
          <dd class="clearfix">
            <p><?php 
//            		print_r($active);
            		$message = nl2br(strip_tags($active['message']));
					echo $message; 
					if($active['button'] == 'true'){
						$msg = __('申請を許可しますか？', true);
						echo $this->Html->Link('許可する', array('controller'=>'producers', 'action'=>'sub_add', $active['id'], $active['send_id'], true), array("onClick" => "result = confirm('$msg')"));
						echo '　';
						$msg = __('申請を許可しませんか？', true);
						echo $this->Html->Link('許可しない', array('controller'=>'producers', 'action'=>'sub_add', $active['id'], $active['send_id'], false), array("onClick" => "result = confirm('$msg')"));						
					}
					?></p>
            <span>
            <?php echo $this->Html->link($this->Html->image($active['image_url'].$active['image']),$active['url'].$active['id'],array('escape'=>false));
            ?>
            </span>
          </dd>
        </dl></li>
      <?php endforeach; ?>
      </ul>
      
	<!-- div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div -->

    </div><!-- end main_container -->
    <!-- 編集ここまで  -->