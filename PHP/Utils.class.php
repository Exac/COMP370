<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/10/16
 * Time: 1:43
 */

class Utils {
	public static function getNavigationMenu() {
		return '<ul>'.
				'<li><a href="/manager">manager</a></li>'.
				'<li><a href="/operator">operator</a></li>'.
				'<li><a href="/provider">provider</a></li>'.
				'</ul>';
	}
}