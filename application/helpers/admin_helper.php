<?php

if(!function_exists('getRoleRating'))
{
	function getRoleRating($role)
	{
			if($role == 'staff')
			{
				return 0;
			}
			else if($role == 'admin')
			{
				return 1;
			}
			else if($role == 'superadmin')
			{
				return 2;
			}
	}
}