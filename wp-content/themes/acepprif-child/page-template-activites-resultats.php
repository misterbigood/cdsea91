<?php
/*
 Template Name: Résultats choix activités.
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
						<button class="button btn_print">imprimer / sauvegarder</button>
						<div class="post-content entry-content">
							<div class="content-before-result">
							<?php the_content(); ?>
							</div>
							<?php 
							$competences = Acepprif_Comp::get_instance()->affiche_competences(array_keys($_POST)); ?>
						</div>
						<button class="button btn_print">imprimer / sauvegarder</button>
					</div>
				</article>
			</div>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>
