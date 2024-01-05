<?php
/*
Template Name: Liste des activités
*/

get_header();
the_post(); ?>
<div id="main-content">
	<div class="container">
		<div id="content-area" class="<?php extra_sidebar_class(); ?> clearfix">
			<div class="et_pb_extra_column_main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="post-wrap">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="post-content entry-content">
							<?php the_content(); ?>
							<?php Acepprif_Comp::get_instance()->liste_activites(); ?>
						</div>
					</div>
				</article>
			</div>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer();
