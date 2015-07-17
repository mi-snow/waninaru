<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $uses = array('Comment','Joiner','JoinersProject','Producer','ProducersProject','Project','User','Activity', 'Message');
	
	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'projects' , 'action'=>'index'),
			'logoutRedirect' => array('controller' => 'teasers' , 'action' => 'index'),
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'User',
					'fields' => array('username'=>'student_number','password'=>'user_password')
				)
			)
		)
	);
	
	function updata(){
		$userSession = $this->Auth->user();
		$today = Date("Y-m-d");
		$unreadCount = 0;
	
		$date = $this->Activity->find('first', array('fields'=>array('Activity.id', 'Activity.user_id'), 'conditions'=>array('Activity.user_id'=>$userSession['id']), 'recursive' => -1));

		$message = $this->Message->find('all', array('fields'=>array('Message.unread_flag'), 'conditions'=>array('Message.user_id'=>$date['Activity']['user_id']), 'recursive' => -1));
		
		foreach($message as $activity){
			if($activity['Message']['unread_flag'] == 1){
				$unreadCount++;
			}
		}
	
		$user = $this->User->find('first', array('fields'=>array('User.info_flag'), 'conditions'=>array('User.id'=>$userSession['id']), 'recursive' => -1));
		$user = $user['User']['info_flag'];
//		print_r($user);
		
		if($user == 1){
				$unreadCount++;
		}
		
		$producer = $this->Producer->find('first',array('fields'=>array('Producer.id'), 'conditions'=>array('Producer.user_id'=>$date['Activity']['user_id']), 'recursive' => -1));
		$producers_project = $this->ProducersProject->find('list', array('fields'=>array('ProducersProject.id', 'ProducersProject.project_id'), 'conditions'=>array('ProducersProject.producer_id'=>$producer['Producer']['id']), 'recursive' => -1));
	
		$comment = $this->Comment->find('all', array('fields'=>array('Comment.unread_flag'), 'conditions'=>array('Comment.project_id'=>$producers_project), 'recursive' => -1));
	
		foreach($comment as $activity){
			if($activity['Comment']['unread_flag'] == 1){
				$unreadCount++;
			}
		}
		
		$joiners_project = $this->JoinersProject->find('all', array('fields'=>('JoinersProject.unread_flag'), 'conditions'=>array('JoinersProject.project_id'=>$producers_project), 'recursive' => -1));
	
		foreach($joiners_project as $activity){
			if($activity['JoinersProject']['unread_flag'] == 1){
				$unreadCount++;
			}
		}
		
		$producers_project = $this->ProducersProject->find('all', array('conditions'=>array('ProducersProject.producer_id'=>$producer['Producer']['id']), 'recursive' => 0));
//		print_r($producers_project);
		foreach($producers_project as $activity){
			$orderDate = strtotime($activity['Project']['active_date']);
			$orderDate = date('Y-m-d', $orderDate);
			if(strtotime($today) >= strtotime($orderDate)){
				if($activity['ProducersProject']['appointed_day_flag'] == 1){
					$unreadCount++;
				}
			}
		}
//		print_r($unreadCount);
		
		foreach($producers_project as $activity){
			$orderDate = strtotime($activity['Project']['active_date']);
			$orderDate = strtotime("-3days", $orderDate);
			$orderDate = date('Y-m-d', $orderDate);
			if(strtotime($today) >= strtotime($orderDate)){
				if($activity['ProducersProject']['before_three_day_flag'] == 1){
					$unreadCount++;
				}
			}
		}
//		print_r($unreadCount);
		
		$joiner = $this->Joiner->find('first',array('fields'=>array('Joiner.id'), 'conditions'=>array('Joiner.user_id'=>$date['Activity']['user_id']), 'recursive' => -1));
		$joiners_project = $this->JoinersProject->find('all', array('conditions'=>array('JoinersProject.joiner_id'=>$joiner['Joiner']['id']), 'recursive' => 0));
		$orderDate = strtotime($activity['Project']['active_date']);
	
		foreach($joiners_project as $activity){
			$orderDate = strtotime($activity['Project']['active_date']);
			$orderDate = strtotime("-3days", $orderDate);
			$orderDate = date('Y-m-d', $orderDate);
			if(strtotime($today) >= strtotime($orderDate)){
				if($activity['JoinersProject']['before_three_day_flag'] == 1){
					$unreadCount++;
				}
			}
		}
//		print_r($unreadCount);
		
		foreach($joiners_project as $activity){
			$orderDate = strtotime($activity['Project']['active_date']);
			$orderDate = date('Y-m-d', $orderDate);
			if(strtotime($today) >= strtotime($orderDate)){
				if($activity['JoinerrsProject']['appointed_day_flag'] == 1){
					$unreadCount++;
				}
			}
		}
//		print_r($unreadCount);
		$this->Activity->id = $date['Activity']['id'];
		$this->Activity->saveField('unread_flag', $unreadCount);
		$this->User->id = $userSession['id'];
		if($unreadCount >= 1){
			$this->User->saveField('unread_flag', '1');
		}else{
			$this->User->saveField('unread_flag', '0');
		}
		$this->set('user', $this->User->find('first', $options));
		
		$user = $this->User->find('first', array('conditions' => array('id' => $this->Auth->user('id')), 'recursive' => -1));
		unset($user['User']['password']); // 念のためパスワードは除外。どうでもよければ消してもOK
		$this->Session->write('Auth', $user);
		$userSession = $this->Auth->user();
		$this->set('userSession',$this->Auth->user());
//		print_r($userSession);
	}
	
	public function beforeFilter(){
		$this->Auth->allow('index');
		$userSession = $this->Auth->user();
		$today = Date("Y-m-d");
		$this->set('userSession',$this->Auth->user());
		$this->Auth->loginError = 'ユーザ名もしくはパスワードに誤りがある、あるいは存在しないアカウントです';
		if($userSession != NULL){
			$this->updata();
		}
	}
	
}
