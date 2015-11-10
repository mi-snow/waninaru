<?php

/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	/**
	 * ���t���r����o���f�[�V�������[��.
	 * �f�t�H���g�ł́A���݂̓��t�ƑΏۂ̓��t���r���Z�q�̒ʂ�ɔ�r����.
	 * ���݂̓��t�Ƃ̍���������ꍇ�A���̕��������炵�����t�ƑΏۂ̓��t���r����.
	 * ��r���Z�q�́AValidation::comparison�Ɠ������̂��g����.
	 * ���݂̓��t�Ƃ̍����́Astrtotime()��timestamp�ŕϊ��\�ȕ�����.
	 * @param string $check1 ��r�Ώۂ̓��t
	 * @param string $operator ��r���Z�q
	 * @param string $timestamp ���݂̓��t�Ƃ̍���
	 */
	

	
	
	function comparisonDate($active_time, $operator, $timestamp = null) {//�J�Ó������ݓ��𒴂��Ă��邩
		$active_time = is_array($active_time) ? array_shift($active_time) : $active_time;
		$active_time = date("Y/m/d H:i:s", strtotime($active_time));
		$now_time = !empty($timestamp) ? date("Y/m/d H:i:s") : $date("Y/m/d H:i:s", strtotime($timestamp));
		$operator = str_replace(array(' ', "\t", "\n", "\r", "\0", "\x0B"), '', strtolower($operator));
	    global $mark;
	    $mark = $active_time;
		switch ($operator) {
			case 'isgreater':
			case '>':
				if ($active_time > $now_time) {
					return true;
				}
				break;
			case 'isless':
			case '<':
				if ($active_time < $now_time) {
					return true;
				}
				break;
			case 'greaterorequal':
			case '>=':
				if ($active_time >= $now_time) {
					return true;
				}
				break;
			case 'lessorequal':
			case '<=':
				if ($active_time <= $now_time) {
					return true;
				}
				break;
			case 'equalto':
			case '==':
				if ($active_time == $now_time) {
					return true;
				}
				break;
			case 'notequal':
			case '!=':
				if ($active_time != $now_time) {
					return true;
				}
				break;
			default:
				$_this =& Validation::getInstance();
				$_this->errors[] = __('You must define the $operator parameter for AppModel::comparisonDate()', true);
				break;
		}	
		return false;
	}
	
function comparisonDate2($recruit_time, $operator, $timestamp = null) {//�J�Ó�����ؓ��𒴂����Ⴂ���Ȃ�
		$recruit_time = is_array($recruit_time) ? array_shift($recruit_time) : $recruit_time;
		$recruit_time = date("Y/m/d H:i:s", strtotime($recruit_time));
		global $mark;
		$active_time =  $mark;//mark�͊J�Ó��̓��t
		$now_time = !empty($timestamp) ? date("Y/m/d H:i:s") : $date("Y/m/d H:i:s", strtotime($timestamp));
		//print_r($recruit_time.$active_time);
		$operator = str_replace(array(' ', "\t", "\n", "\r", "\0", "\x0B"), '', strtolower($operator));
		switch ($operator) {
			case 'isgreater':
			case '>':
				if ($active_time > $recruit_time&&$recruit_time>$now_time) {
					return true;
				}
				break;
			case 'isless':
			case '<':
				if ($active_time < $recruit_time&&$recruit_time>$now_time) {
					return true;
				}
				break;
			case 'greaterorequal':
			case '>=':
				if ($active_time >= $recruit_time&&$recruit_time>$now_time) {
					return true;
				}
				break;
			case 'lessorequal':
			case '<=':
				if ($active_time <= $recruit_time&&$recruit_time>$now_time) {
					return true;
				}
				break;
			case 'equalto':
			case '==':
				if ($active_time == $recruit_time&&$recruit_time>$now_time) {
					return true;
				}
				break;
			case 'notequal':
			case '!=':
				if ($active_time != $recruit_time) {
					return true;
				}
				break;
			default:
				$_this =& Validation::getInstance();
				$_this->errors[] = __('You must define the $operator parameter for AppModel::comparisonDate()', true);
				break;
		}		
		return false;
	}
}