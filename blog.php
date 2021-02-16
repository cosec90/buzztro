<?php
include 'Admin_config/connection.php';
include 'header.php';

include './Admin_controllers/blogs.php';
?>

<div class="super_container">
	
	<?php include 'nav.php'; ?>


	<div class="blog">
		<div class="container">
			<div class="row">
				<?php
				include './Admin_modules/fetch_blogs.php';

				foreach ($all_blogs as $key => $value) 
				{ ?>
					<div class="blog_posts col-md-4">
						<div class="blog_post">
							<div class="blog_image" style="background-image:url(admin/images/blog_images/<?php echo $value['blog_img'];?>)"></div>
							<div class="blog_text"><?php echo $value['blog_title'];?>
								<a href="blog_single.php?id=<?php echo $value['blog_id'];?>">Continue Reading</a>
							</div>
						</div>
					</div>
				<?php
				}
				?>
				
			</div>
		</div>
	</div>


<?php include 'footer.php';?>