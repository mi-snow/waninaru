<?php
class ActivitiesController extends AppController{
	public $helpers = array('Html' , 'Form');
	public $uses = array('Comment','Joiner','JoinersProject','Producer','ProducersProject','Project','User','Activity', 'Message');
		
	public function beforeFilter(){
		parent::beforeFilter();
	}
		
	public function index(){
		$actives = array();
		$temps = array();
		
		/**
		* 使用する定数
		* $userSession : ログインしているユーザ情報
		* $today : アクセス時の日付情報
		 */
		$userSession = $this->Auth->user();
		$today = Date("Y-m-d");
		
		$date = $this->Activity->find('first', array('fields'=>array('Activity.id', 'Activity.user_id'), 'conditions'=>array('Activity.user_id'=>$userSession['id']), 'recursive' => -1));
//		print_r($date);

		//管理者メッセージ
		
		//個人
		$message = $this->Message->find('all', array('conditions'=>array('Message.user_id'=>$date['Activity']['user_id']), 'recursive' => -1));
//		print_r($message);
		foreach($message as $activity){
			$detail = '管理者からメッセージがあります。
		
〈'.$activity['Message']['category'].'〉
'.$activity['Message']['text'];
			$ditail = nl2br($detail);
//			print_r($detail);
			$temps = array(
					'unread_flag'=>$activity['Message']['unread_flag'],
					'message'=>$detail,
					'image_url'=>'/app/webroot/files/noimage1.png',
					'created'=>$activity['Message']['created']
			);
			array_push($actives, $temps);
				
			$this->Message->id = $activity['Message']['id'];
			$this->Message->saveField('unread_flag', '0');
		}
		
		//一斉送信
		$message = $this->Message->find('all', array('conditions'=>array('Message.user_id'=>-1), 'recursive' => -1));
		foreach($message as $activity){
			$detail = '管理者からメッセージがあります。
このメッセージはユーザ全員に送信しています。

〈'.$activity['Message']['category'].'〉
'.$activity['Message']['text'];
			$ditail = nl2br($detail);
//			print_r($detail);
			$temps = array(
					'unread_flag'=>$activity['Message']['unread_flag'],
					'message'=>$detail,
					'image_url'=>'/app/webroot/files/noimage1.png',
					'created'=>$activity['Message']['created']
			);
			array_push($actives, $temps);
			
		}
		
		//企画者
		
		$producer = $this->Producer->find('first',array('fields'=>array('Producer.id'), 'conditions'=>array('Producer.user_id'=>$date['Activity']['user_id']), 'recursive' => -1));
//		print_r($producer);
		$producers_project = $this->ProducersProject->find('list', array('fields'=>array('ProducersProject.id', 'ProducersProject.project_id'), 'conditions'=>array('ProducersProject.producer_id'=>$producer['Producer']['id']), 'recursive' => -1));
//		print_r($producers_project);
		
		//自分の企画にコメントされた
		$comment = $this->Comment->find('all', array('conditions'=>array('Comment.project_id'=>$producers_project), 'recursive' => 1));
//		print_r($comment);
		
		foreach($comment as $activity){
			$temps = array(
				'url'=>'/projects/view/',
				'id'=>$activity['Project']['id'],
				'unread_flag'=>$activity['Comment']['unread_flag'],
				'message'=>'あなたが企画した '.$activity['Project']['project_name'].' にコメントがありました。',
				'image'=>$activity['Project']['image_file_name'],
				'image_url'=>'/app/webroot/files/',
				'created'=>$activity['Comment']['created']
			);
			array_push($actives, $temps);
			
			$this->Comment->id = $activity['Comment']['id'];
			$this->Comment->saveField('unread_flag', '0');
		}
		
		
		//自分の企画に参加者が現れました
		$joiners_project = $this->JoinersProject->find('all', array('conditions'=>array('JoinersProject.project_id'=>$producers_project), 'recursive' => 1));
//		print_r($joiners_project);
		
		foreach($joiners_project as $activity){
			$temps = array(
				'url'=>'/projects/view/',
				'id'=>$activity['Project']['id'],
				'unread_flag'=>$activity['JoinersProject']['unread_flag'],
				'message'=>'あなたが企画した '.$activity['Project']['project_name'].' に参加者が現れました。',
				'image'=>$activity['Project']['image_file_name'],
				'image_url'=>'/app/webroot/files/',
				'created'=>$activity['JoinersProject']['created']
			);
			array_push($actives, $temps);

			$this->JoinersProject->id = $activity['JoinersProject']['id'];
			$this->JoinersProject->saveField('unread_flag', '0');
		}		
		
		$producers_project = $this->ProducersProject->find('all', array('conditions'=>array('ProducersProject.producer_id'=>$producer['Producer']['id']), 'recursive' => 0));
//		print_r($producers_project);
		
		//自分が企画した企画が開始した
		foreach($producers_project as $activity){
			$orderDate = strtotime($activity['Project']['active_date']);
			$orderDate = date('Y-m-d', $orderDate);

			if(strtotime($today) >= strtotime($orderDate)){
				$temps = array(
					'url'=>'/projects/view/',
					'id'=>$activity['Project']['id'],
					'unread_flag'=>$activity['ProducersProject']['appointed_day_flag'],
					'message'=>'あなたが企画した '.$activity['Project']['project_name'].' が本日開催されます。',
					'image'=>$activity['Project']['image_file_name'],
					'image_url'=>'/app/webroot/files/',
					'created'=>date("Y-m-d H:i:s", strtotime($orderDate))
				);
				array_push($actives,$temps);

				$this->ProducersProject->id = $activity['ProducersProject']['id'];
				$this->ProducersProject->saveField('appointed_day_flag', '0');
			}
		}
		
		
		//自分が企画した企画が3日後に開催される
//		print_r($project);

		foreach($producers_project as $activity){
			$orderDate = strtotime($activity['Project']['active_date']);
			$orderDate = strtotime("-3days", $orderDate);
			$orderDate = date('Y-m-d', $orderDate);
//			print_r($activity);
//			print_r($orderDate);
			if(strtotime($today) >= strtotime($orderDate)){
				$temps = array(
					'url'=>'/projects/view/',
					'id'=>$activity['Project']['id'],
					'unread_flag'=>$activity['ProducersProject']['before_three_day_flag'],
					'message'=>'あなたが企画した '.$activity['Project']['project_name'].' が3日後開催されます。',
					'image'=>$activity['Project']['image_file_name'],
					'image_url'=>'/app/webroot/files/',
					'created'=>date("Y-m-d H:i:s", strtotime($orderDate))
				);
				array_push($actives,$temps);
				
				$this->ProducersProject->id = $activity['ProducersProject']['id'];
				$this->ProducersProject->saveField('before_three_day_flag', '0');
			}
		}
		
		//参加者
		
		$joiner = $this->Joiner->find('first',array('fields'=>array('Joiner.id'), 'conditions'=>array('Joiner.user_id'=>$date['Activity']['user_id']), 'recursive' => -1));
//		print_r($joiner);
		$joiners_project = $this->JoinersProject->find('all', array('conditions'=>array('JoinersProject.joiner_id'=>$joiner['Joiner']['id']), 'recursive' => 0));
//		print_r($joiners_project);

		//自分が参加した企画が開始した
		foreach($joiners_project as $activity){
			$orderDate = strtotime($activity['Project']['active_date']);
			$orderDate = date('Y-m-d', $orderDate);
//			print_r($orderDate);
			if(strtotime($today) >= strtotime($orderDate)){
//				print_r($activity);
				$temps = array(
					'url'=>'/projects/view/',
					'id'=>$activity['Project']['id'],
					'unread_flag'=>$activity['JoinersProject']['appointed_day_flag'],
					'message'=>'あなたが参加した '.$activity['Project']['project_name'].' が本日開催されます。',
					'image'=>$activity['Project']['image_file_name'],
					'image_url'=>'/app/webroot/files/',
					'created'=>date("Y-m-d H:i:s", strtotime($orderDate))
				);
				array_push($actives,$temps);
				
				$this->JoinersProject->id = $activity['JoinersProject']['id'];
				$this->JoinersProject->saveField('appointed_day_flag', '0');
			}
		}
		
		//自分が参加した企画が3日後に開催される
		foreach($joiners_project as $activity){
			$orderDate = strtotime($activity['Project']['active_date']);
			$orderDate = strtotime("-3days", $orderDate);
			$orderDate = date('Y-m-d', $orderDate);
//			print_r($orderDate);
			if(strtotime($today) >= strtotime($orderDate)){
//				print_r($activity);
					$temps = array(
					'url'=>'/projects/view/',
					'id'=>$activity['Project']['id'],
					'unread_flag'=>$activity['JoinersProject']['before_three_day_flag'],
					'message'=>'あなたが参加した '.$activity['Project']['project_name'].' が3日後開催されます。',
					'image'=>$activity['Project']['image_file_name'],
					'image_url'=>'/app/webroot/files/',
					'created'=>date("Y-m-d H:i:s", strtotime($orderDate))
				);
				array_push($actives,$temps);

				$this->JoinersProject->id = $activity['JoinersProject']['id'];
				$this->JoinersProject->saveField('before_three_day_flag', '0');
			}
		}
		
		//ソート
		if(count($actives)>0){
			foreach ($actives as $key => $row){
				$created[$key] = $row['created'];
			}
			array_multisort($created,SORT_DESC,$actives);
		}
//		print_r($UnreadCount);
		$this->Activity->id = $date['Activity']['id'];
		$this->Activity->saveField('unread_flag', '0');
		$this->User->id = $userSession['id'];
		$this->User->saveField('info_flag', '0');
		$this->User->saveField('unread_flag', '0');
		$user = $this->User->find('first', array('conditions' => array('id' => $this->Auth->user('id')), 'recursive' => -1));
		$this->Session->write('Auth', $user);
		
		//試験出力
		$this->set('activities',$actives);
	}
			
}
?>