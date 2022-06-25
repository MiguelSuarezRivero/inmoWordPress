<?php 

if(isset($_COOKIE['idioma'])){
        $idioma= get_bloginfo('template_directory') . '/lang/' . $_COOKIE['idioma'] . '.xml';
        $codigo_idioma=$_COOKIE['idioma'];
        
    }else{
        $idioma= get_bloginfo('template_directory') . '/lang/ES.xml';
        $codigo_idioma='ES';
    }
  
$xml = simplexml_load_file( $idioma);

//carga nuestros scripts
function cargar_css_js() {    
      wp_enqueue_style( 'sweet-style', get_template_directory_uri() . '/css/sweetalert2.css' );
      wp_enqueue_script( 'js_sweet', get_template_directory_uri() . '/js/sweetalert2.js', array( 'jquery' ), '', true );
      wp_enqueue_script( 'js_touch', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array( 'jquery' ), '', true ); 
       wp_enqueue_script( 'js_codigo', get_template_directory_uri() . '/js/codigo_global.js', array( 'jquery' ), '', true );   
}
add_action( 'wp_enqueue_scripts', 'cargar_css_js' );

// Sustituimos la versión de jQuery local por la del CDN de Google
add_action('wp_enqueue_scripts', 'mitema_enqueue_scripts');
function mitema_enqueue_scripts() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"), false, '3.2.1');
    wp_enqueue_script('jquery');
    }

//obliga a cargar los scripts en el footer
function footer_enqueue_scripts() {
 remove_action('wp_head', 'wp_print_scripts');
 remove_action('wp_head', 'wp_print_head_scripts', 9);
 remove_action('wp_head', 'wp_enqueue_scripts', 1);
 add_action('wp_footer', 'wp_print_scripts', 5);
 add_action('wp_footer', 'wp_enqueue_scripts', 5);
 add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action('after_setup_theme', 'footer_enqueue_scripts'); 

// Elimina link del head
function my_theme_remove_headlinks() {
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'start_post_rel_link' );
    remove_action( 'wp_head', 'index_rel_link' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    remove_action( 'wp_head', 'adjacent_posts_rel_link' );
    remove_action( 'wp_head', 'parent_post_rel_link' );
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'my_theme_remove_headlinks' );

//Añade la paginación
function pagination($pages = '', $range = 4){  
    global $xml;
    
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>" . $xml->pagina_blog->pagina . " " .$paged." ". $xml->pagina_blog->de . "  " .$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a >&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a  class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a>Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a >Last &raquo;</a>";
         echo "</div>\n";
     }
}

function pagination_bottom($pages = '', $range = 4){  
    global $xml;

     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination_bottom\"><span>" . $xml->pagina_blog->pagina . " " .$paged." ". $xml->pagina_blog->de . "  " .$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a>Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a>Last &raquo;</a>";
         echo "</div>\n";
     }
}

function pagination_blog($pages = '', $range = 4){  
    global $xml;

     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination_blog\"><span>" . $xml->pagina_blog->pagina . " " .$paged." ". $xml->pagina_blog->de . "  " .$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
     
}