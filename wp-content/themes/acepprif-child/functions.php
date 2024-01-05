<?php
/* Chargement des feuilles de style du thème */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'Extra', get_template_directory_uri() . '/style.css' );
}

/* Filtre sur get_the_archive_title pour enlever 'Catégory' */
add_filter( 'get_the_archive_title', function ( $title ) {

    if( is_category() || is_archive() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
});

/*add_filter('um_user_profile_url', 'user_profile_link');
function user_profile_link($user_id){
    $url = bbp_get_user_profile_url( $user_id );
    return $url;
}*/


/*Masquer la version de Wordpress par sécurité*/
remove_action("wp_head", "wp_generator");

// intégrer la fonctionnalité de valorisation des compétences
$feature = trim(sprintf('%s/competences/register.php', get_stylesheet_directory()));

if( file_exists( $feature ) ) {
	require_once( $feature );
}
$class_act = trim(sprintf('%s/competences/acepprif_activite.php', get_stylesheet_directory()));

if( file_exists( $class_act ) ) {
	require_once( $class_act );
}
