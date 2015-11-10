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
	 * 日付を比較するバリデーションルール.
	 * デフォルトでは、現在の日付と対象の日付を比較演算子の通りに比較する.
	 * 現在の日付との差分がある場合、その分だけずらした日付と対象の日付を比較する.
	 * 比較演算子は、Validation::comparisonと同じものが使える.
	 * 現在の日付との差分は、strtotime()でtimestampで変換可能な文字列.
	 * @param string $check1 比較対象の日付
	 * @param string $operator 比較演算子
	 * @param string $timestamp 現在の日付との差分
	 */
	

	
	
	function comparisonDate($active_time, $operator, $timestamp = null) {//開催日が現在日を超えているか
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
	
function comparisonDate2($recruit_time, $operator, $timestamp = null) {//開催日を締切日を超えちゃいけない
		$recruit_time = is_array($recruit_time) ? array_shift($recruit_time) : $recruit_time;
		$recruit_time = date("Y/m/d H:i:s", strtotime($recruit_time));
		global $mark;
		$active_time =  $mark;//markは開催日の日付
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