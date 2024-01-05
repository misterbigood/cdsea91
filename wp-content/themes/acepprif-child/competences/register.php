<?php
/**
* Fonctionnalité de valorisation des compétences
*/
class Acepprif_Comp {

	private static $instance;

	function __construct(){
		self::$instance = $this;
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action( 'wp_enqueue_scripts', array($this, 'comp_enqueue_styles_and_scripts'), 15 );
	}

	/**
	* Get the static instance
	* This allows access to the instance of this class without creating a global var.
	* Read more at http://hardcorewp.com/2012/enabling-action-and-filter-hook-removal-from-class-based-wordpress-plugins
	*/
	static function get_instance() {
		return self::$instance;
	}

	/**
	* Déclaration des types de contenu personnalisés
	*/
	function register_custom_post_type(){

		// Permet de lister les compétences valorisables
		register_post_type( 'competence', array(
			'label' => __( 'Competences', 'acepprif' ),
			'labels' => array(
				'name' => __( 'Compétences', 'acepprif' ),
				'singular_name' => __( 'Compétence', 'acepprif' ),
				'add_new_item' => __( 'Ajouter une compétence', 'acepprif' ),
				'edit_item' => __( 'Modifier la compétence', 'acepprif' ),
				'new_item' => __( 'Ajouter une nouvelle compétence', 'acepprif' ),
				'view_item' => __( 'Afficher la compétence', 'acepprif' ),
				'search_items' => __( 'Chercher dans les compétences', 'acepprif' ),
				'not_found' => __( 'Aucune compétence trouvée', 'acepprif' ),
				'not_found_in_trash' => __( 'Aucune compétence trouvée dans la poubelle', 'acepprif' ),
				'all_items' => __( 'Toutes les compétences', 'acepprif' ),
				'items_list' => __( 'Liste des compétences', 'acepprif' ),
				'items_list_navigation' => __( 'Navigation de la liste des compétences', 'acepprif' ),
			),
			'description' => __( 'Une compétence', 'acepprif' ),
			'public' => true,
			'show_ui' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'taxonomies' => array( 'activite' ),
		));

		// Activités permettant de valoriser une ou plusieurs compétences
		register_taxonomy( 'activite', 'competence', array(
			'labels' => array(
				'name' => __( 'thématiques et activités', 'taxonomy general name', 'acepprif' ),
				'singular_name' => __( 'Thématique - activité', 'taxonomy general name', 'acepprif' ),
				'all_items' => __( 'Toutes les thématiques et activités', 'acepprif' ),
				'edit_item' =>  __( 'Modifier l\'activité', 'acepprif' ),
				'view_item' => __( 'Afficher l\'activité', 'acepprif' ),
				'update_item' => __( 'Mettre à jour l\'activité', 'acepprif' ),
				'add_new_item' => __( 'Ajouter une nouvelle thématique ou activité', 'acepprif' ),
				'new_item_name' => __( 'Nom de la nouvelle thématique ou activité', 'acepprif' ),
				'not_found' => __( 'Aucune activité trouvée', 'acepprif' ),
			),
			'show_admin_column' => true,
			'hierarchical' => true,
		) );
	}

	function comp_enqueue_styles_and_scripts() {
		if (is_page_template(array('page-template-activites.php', 'page-template-activites-resultats.php'))) {
    		wp_enqueue_style( 'Competencescss', get_stylesheet_directory_uri() . '/competences/competences.css' );
			wp_enqueue_script('Competencesjs', get_stylesheet_directory_uri() . '/competences/competences.js');
		}
	}

	/**
	* Affiche la liste de toutes les activités
	*/
	function liste_activites(){
		$activite = new Acepprif_Activite();
		$terms = $activite->liste_thematiques();
		$page_resultats = $activite->get_results_page_name(); ?>

		
<div class="cadre_themes"><form method="post" action="<?php echo $page_resultats; ?>">
		
		<?php foreach ( $terms as $term ): ?>
		<fieldset class="cadre_activite">
			<h3><?php echo $term->name; ?></h3>

			<?php if (function_exists('get_wp_term_image')):
				$term_thumbnail = get_wp_term_image($term->term_id); ?>
				<img src="<?php echo $term_thumbnail; ?>" />
			<?php endif;
			$term_children = get_term_children($term->term_id, $term->taxonomy);

			foreach ($term_children as $childId):
				$child_term = get_term_by('id', $childId, $term->taxonomy); ?>
				<p>
					<label>
						<input type="checkbox" name="<?php echo $child_term->taxonomy.'-'.$childId; ?>"/> <?php echo $child_term->name; ?>
					</label>
				</p><?php
			endforeach; ?>
		</fieldset><?php
		endforeach; ?>
		<input type="submit" value="Valider les activités" class="bottom_form_btn"/>
		</form></div><?php
	}

	function affiche_competences($choix_activites) {
		$activite = new Acepprif_Activite();
		array_walk($choix_activites, array($activite,'retrieve_posts_ids'));
		$competences = $activite->liste_competences($choix_activites);
				
		foreach($competences as $post):
					
		$post_content = apply_filters('the_content', get_post_field('post_content', $post->ID)); ?>
		<div class="bloc_competence">
			<?php
			// Bout de code en commentaire car fait planter l'interface;
			// Souci dans acepprif_activite.php dans fonction get_tax_thumbnail ou sous fonction appelée
			/* 
			if (has_post_thumbnail($post->ID))
				echo get_the_post_thumbnail($post->ID, 'thumbnail');
			else
				echo $activite->get_tax_thumbnail($post->ID);	*/?>
			<div>
                <p class="titre_competence"><h3><?php echo get_the_title($post); ?></h3></p>
				<?php echo $post_content; ?>
			</div>
		</div>
		<div class="bloc_questionner">
			<p>
                        
				<button type="button" class="open-close" data-form-id="<?php echo $post->post_name; ?>">Questionner / Évaluer</button>
			</p>
		</div>
		<div id="<?php echo $post->post_name; ?>" class="bloc_questionner_form closed">
			<form method="post" action="#">
			<label for="exemple_situation-<?php echo $post->ID; ?>">Choisissez un exemple de situation vécue à la crèche qui a du sens pour votre projet, que vous voulez mettre en avant.</label>
				<textarea name="exemple_situation-<?php echo $post->ID; ?>"></textarea>

				<label for="competence_acquise-<?php echo $post->ID; ?>">Qu'est-ce que je ne savais pas faire, ou moins bien faire, en arrivant à la crèche, que j'estime avoir appris au cours de mon expérience ?</label>
				<textarea name="competence_acquise-<?php echo $post->ID; ?>"></textarea>

				<label for="moyens-<?php echo $post->ID; ?>">Quels moyens ai-je utilisé pour développer de nouvelles compétences ? Observation, échanges, lectures, expérimentation...</label>
				<textarea class="page-break" name="moyens-<?php echo $post->ID; ?>"></textarea>

				<label for="adaptation_competences-<?php echo $post->ID; ?>">Comment ai-je adapté des compétences antérieures au cadre de la crèche</label>
				<textarea name="adaptation_competences-<?php echo $post->ID; ?>"></textarea>

				<label for="connaissances_acquises-<?php echo $post->ID; ?>">Quelles connaissances ai-je acquises ?</label>
				<textarea name="connaissances_acquises-<?php echo $post->ID; ?>"></textarea>

				<label for="cadre_reutilisation-<?php echo $post->ID; ?>">Dans quel cadre ai-je eu l'occasion de réutiliser ces compétences et vérifier ainsi qu'elles étaient incorporées ?</label>
				<textarea name="cadre_reutilisation-<?php echo $post->ID; ?>"></textarea>
			</form>
		</div>
		 <?php endforeach;
	}
}
new Acepprif_Comp; ?>
