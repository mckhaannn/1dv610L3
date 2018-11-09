<?php

namespace view;

class Messages {

  const USERNAME_TO_SHORT_MESSAGE = 'Username has too few characters, at least 3 characters.';
  const PASSWORD_TO_SHORT_MESSAGE = 'Password has too few characters, at least 6 characters.';
  const USERNAME_CONTAINS_INVALID_CHARACTERS = 'Username contains invalid characters.';
  const PASSWORDS_NOT_EQUAL = 'Passwords do not match.';
  const BREAK_ROW = '<br>';
  const EMPTY_STRING = '';
  const LOGIN_WITH_COOKIES_MESSAGE = 'Welcome back with cookie';
	const KEPT_LOGGEDIN_MESSAGE = 'Welcome and you will be remembered';
	const USERNAME_MISSING = 'Username is missing';
	const PASSWORD_MISSING = 'Password is missing';
	const FAILED_TO_LOGIN = 'Wrong name or password';
	const LOGOUT_MESSAGE = 'Bye bye!';
  const LOGIN_MESSAGE = 'Welcome';
  const SUCCESS_LOGIN = 'Registered new user.';
  const USERNAME_EXISTS = 'User exists, pick another username.';
  const POST_TO_SHORT = 'Post is to short minimum 1 character.';
  const POST_TO_LONG = 'Post is to long maximum 50 characters.';
  const POST_CONTAINS_INVALID_CHARACTERS = 'Post contains invalid characters.';
  const POST_WAS_ADDED = 'Post was added to statusboard.';
  const POST_DELETED = '<b><h3>Your post was deleted</h3></b>';
  const NOT_VALID_AUTHOR = '<b><h3>You can only delete your own posts</h3></b>';
  const NO_POSTS = "<h2>There are no posts created</h2>";

}