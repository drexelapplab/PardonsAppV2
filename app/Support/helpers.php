<?php

function set_active($path, $active = 'active')
{
	return Request::is($path) ? $active : '';
}

function set_level($path, $level = 'level-active')
{
	return Request::is($path) ? $level : '';
}

?>