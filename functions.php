<?php

// cette fonction se charge d'intégrer les feuilles de style du thème
function my_theme_enqueue_styles() {
    // chargement de la feuille de style du thème parent
    wp_enqueue_style('parent-style', get_template_directory_uri().'/style.css');
    // chargement de la feuille de style du thème enfant
    wp_enqueue_style('child-style', get_stylesheet_directory_uri().'/style.css', ['parent-style']);//['parent-style'] faire cette condition uniquement si le theme parent a été chargé
}

// demande à Wordpress de lancer la fonction `my_theme_enqueue_styles` durant le démarrage de l'application
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function cd_pre_comment_text( $arg ) { //Cette fonction modifier le mini-texte du formulaire de commentaires

    unset($arg['comment_notes_before']);
    
    $arg['comment_notes_before'] = '
    <p class="comment-notes">Votre adresse de messagerie ne sera pas publié Les champs obligatoires sont indiqu&eacute;s avec *.
    <br />Les commentaires sont publi&eacute;s apr&egrave;s mod&eacute;ration.</p>
    ';
    return $arg;
    }
    add_filter( 'comment_form_defaults', 'cd_pre_comment_text' );


    
    // Supprimer le champ site web des commentaires
add_filter('comment_form_default_fields','wpm_delete_url');

function wpm_delete_url($fields) {
    unset($fields['url']);
    return $fields;
}
    

/* Retirer les préfixes sur les pages d'archives */
function wpc_remove_archive_title_prefix() {
	if (is_category()) {
			$title = single_cat_title('', false);
		} elseif (is_tag()) {
			$title = single_tag_title('', false);
		} elseif (is_author()) {
			$title = '<span class="vcard">' . get_the_author() . '</span>' ;
		} elseif (is_post_type_archive()) {
			 $title = post_type_archive_title('', false);
		}
	return $title;
}
add_filter('get_the_archive_title', 'wpc_remove_archive_title_prefix');
    
    