<?php
session_start();
	include('config.php');	
   session_destroy();
   header('Location:registration.php');