<?php
class Acepprif_Activite {
	private $tax_name;
	private $post_type_name;

	public function __construct() {
		$this->tax_name = 'activite';
		$this->post_type_name = 'competence';
	}
	/*
	 * Les activités sont regroupées par thématiques
	 */
	public function liste_thematiques() {
		$terms = get_terms(array(
			'taxonomy'=>$this->tax_name,
			'parent'=>0,
			'hide_empty'=>false
		));
		return $terms;
	}

	/*
	 * Récupère la liste des compétences
	 * en fonction des activités choisies 
	 */
	public function liste_competences($term_ids) {
		$competences = get_posts(array(
			'post_type'=>$this->post_type_name,
			'numberposts'=>100,
			'tax_query'=>array(array(
				'taxonomy'=>$this->tax_name,
				'field'=>'term_id',
				'terms'=>$term_ids
			))));
			
		return $competences;
	}
	public function get_tax_thumbnail($post_id) {
		echo $term_id = $this->id_activite($post_id);
		if (!$term_id):
			echo "1";
			//return false;
		endif;

		$thumbnail_link = get_wp_term_image($term_id);
		if (!$thumbnail_link):
			echo "2";
			//return false;
		endif;

		$thumbnail_id = $this->tax_thumbnail_id($thumbnail_link);
		return wp_get_attachment_image($thumbnail_id);
	}
	private function id_activite($post_id) {
		$terms = get_the_terms($post_id, $this->tax_name);

		if (count($terms) == 0)
			return false;
		$term = $terms[0];
		return ($term->parent == 0) ? $term->term_id : $term->parent;
	}
	private function tax_thumbnail_id($link) {
		global $wpdb;
		$thumbnail_name = str_replace('/', '',strrchr($link, '/'));
		$thumbnail_name = preg_replace('#(-\d+x\d+)?\.(jpg|jpeg|png|gif)#i','', $thumbnail_name);
		$matches = get_posts(array('title'=>$thumbnail_name, 'post_type'=>'attachment', 'post_status'=>'inherit'));

		return $matches[0]->ID;
		
	}

	public function retrieve_posts_ids(&$item, $key) {
		$item = str_replace('-','', strstr($item,'-'));
	}
	
	//Quel est le nom de la page d'affichage des résultats ?
	public function get_results_page_name() {
		$pages = get_pages(array('meta_key'=>'_wp_page_template', 'meta_value'=>'page-template-activites-resultats.php'));

		if (count($pages) == 0 || count($pages) > 1)
			return '#';

		$results_page = $pages[0];
		return get_permalink($results_page);
	}
		
}
?>
