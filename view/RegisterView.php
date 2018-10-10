<?php

namespace view;

class RegiterView {

  
	private const MIN_PASSWORD_LENGTH = 6;
  private const MIN_USERNAME_LENGTH = 3;
  
	public function checkValidPasswordLenght() : bool {
		return strlen($this->getRequestPassword()) > MIN_PASSWORD_LENGTH;
	}
	public function checkValidUsernameLenght() : bool {
		return strlen($this->getRequestUserName()) > MIN_USERNAME_LENGTH;
	}

}