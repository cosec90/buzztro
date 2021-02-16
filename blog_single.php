<?php 
include 'Admin_config/connection.php';
include 'header.php';
include './Admin_controllers/blogs.php';

$id=$_GET['id'];
$fetch_blog=BLOG_FETCH($conn,$id);
$other_articles = RANDOM_ARTICLES($conn,$id);
?>

<div class="super_container">
	
	<?php include 'nav.php'; ?>

	<!-- Single Blog Post -->

	<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-10">
					<div class="single_image" style="background-image:url(admin/images/blog_images/<?php echo $fetch_blog['blog_img'];?>)"></div>
					<div class="single_post_title"><?php echo $fetch_blog['blog_title'];?></div>
					<div class="single_post_text"><a href="<?php echo $fetch_blog['blog_url'];?>" target="_blank"><?php echo $fetch_blog['blog_url'];?></a></div>
					<div class="single_post_text">
						<p><?php echo $fetch_blog['blog_desc'];?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Blog Posts -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<?php
				foreach ($other_articles as $key => $value) 
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