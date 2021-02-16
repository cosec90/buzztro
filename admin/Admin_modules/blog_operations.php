<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/blogs.php';

$blogs = BLOG_FETCH_ALL();

if (isset($_POST['view_story']))
{
	$id = $_GET['id'];
	$blog = BLOG_FETCH($id);
}

$single_blog = BLOG_FETCH($getBlogid)

?>