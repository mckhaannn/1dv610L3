<?php

namespace view;

require_once('login/model/time.php');


class DateTimeView {

	public function showTime() {

		$currentTime = new \model\Time();
		return '<p>' .  $currentTime->getTime() . '</p>';
	}
}