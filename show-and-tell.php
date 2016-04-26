<?php
/*
	Plugin Name: Show and Tell - Gallery Plugin
	Plugin URI: https://github.com/Clark-Nikdel-Powell/Show-and-Tell
	Version: 0.1
	Description: A simple gallery plugin for WordPress that includes captions and slide count.
	Author: Josh Nederveld
	Author URI: http://www.clarknikdelpowell.com/agency/people/josh

	Copyright 2014  Josh Nederveld (email : wordpress@clarknikdelpowell.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

////////////////////////////////////////////////////////////////////////////////
// PLUGIN CONSTANT DEFINITIONS
////////////////////////////////////////////////////////////////////////////////

//FILESYSTEM CONSTANTS
define('SAT_PATH', plugin_dir_path(__FILE__));
define('SAT_URL', plugin_dir_url(__FILE__));

////////////////////////////////////////////////////////////////////////////////
// PLUGIN DEPENDENCIES
////////////////////////////////////////////////////////////////////////////////

// I'll build out the admin in the future.
//require_once SAT_PATH.'SAT-admin.php';
require_once SAT_PATH.'SAT-shortcode.php';
require_once SAT_PATH.'SAT-styles.php';
