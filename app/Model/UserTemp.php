<?php
App::uses('AppModel', 'Model');
/**
 * UserTemp Model
 *
 */
class UserTemp extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'student_number' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'decimal'=>array(
				'rule'=>array('decimal'),
				'message' =>'学籍番号は数字で入力してください。',
			),
			'maxLength'=>array(
				'rule'=>array('maxLength',6),
				'message' =>'max学籍番号は６文字で入力してください。',
			),
			'minLength'=>array(
				'rule'=>array('minLength',6),
				'message' =>'min学籍番号は６文字で入力してください。',
			),
			'isUnique'=>array(
				'rule'=>array('isUnique'),
				'message'=>'その学籍番号はすでに登録されています。',
			),
		),
	);
}
