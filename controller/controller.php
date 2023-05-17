<?php

/**
 * write down your own custom functions here like
 * include_once root . "/templates/xxx.php"
 */

function home()
{
	include_once root . "/templates/home.php";
}

function panel()
{
	include_once root . "/templates/panel.php";
}

function login()
{
	include_once root . "/logic/users/login.php";
}

function logout()
{
	include_once root . "/logic/users/logout.php";
}

function users()
{
	include_once root . "/templates/users.php";
}

function beacon()
{
	include_once root . "/logic/beacons/beacon.php";
}

function manage()
{
	include_once root . "/logic/beacons/manage.php";
}

function register()
{
	include_once root . "/logic/users/register.php";
}

function userdel()
{
	include_once root . "/logic/users/userdel.php";
}

function changepass()
{
	include_once root . "/logic/users/changepass.php";
}

function changerole()
{
	include_once root . "/logic/users/changerole.php";
}

function install()
{
	include_once root. "/logic/native/install.php";
}
