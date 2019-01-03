<?php
/*
Plugin Name: HS Library Management
Plugin URI: https://www.spidyhost.com/
Description: WordPress plugin to maintain all books in Library.
Version: 1.0
Author: Sufyan
Author URI: https://sufyan.in
License: GPLv2 or later
*/

function hs_books_list(){
    include (dirname(__FILE__).'/book_list.php');
}

function hs_years_list(){
    include (dirname(__FILE__).'/year_list.php');
}

function hs_branches_list(){
    include (dirname(__FILE__).'/branch_list.php');
}

function hs_subjects_list(){
    include (dirname(__FILE__).'/subject_list.php');
}

function hs_add_subject(){
    include (dirname(__FILE__).'/subject_add.php');
}

function hs_add_book(){
    include (dirname(__FILE__).'/book_add.php');
}

function hs_add_year(){
    include (dirname(__FILE__).'/year_add.php');
}

function hs_add_branch(){
    include (dirname(__FILE__).'/brach_add.php');
}
add_shortcode('hs_add_branch','hs_add_branch');

function hs_library_admin_menu(){
    add_menu_page('Library Books','Library Books','manage_options','hs_books_list','hs_books_list','dashicons-book','2');
    add_submenu_page('hs_books_list','Add New Book','Add New Book','manage_options','hs_add_book','hs_add_book');
    add_submenu_page('hs_books_list','Branch','Branch','manage_options','hs_branches_list','hs_branches_list');
    add_submenu_page('hs_books_list','Subject','Subject','manage_options','hs_subjects_list','hs_subjects_list');
    add_submenu_page('hs_books_list','Academic Years','Academic Years','manage_options','hs_years_list','hs_years_list');
}
add_action('admin_menu' , 'hs_library_admin_menu');

function hs_librery_activate() {
	include (dirname(__FILE__).'/database.php');
}
register_activation_hook( __FILE__, 'hs_librery_activate' );