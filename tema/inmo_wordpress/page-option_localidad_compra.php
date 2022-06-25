<?php 
$args=array(
	  'post_type'  => 'inmueble',
	  'posts_per_page' =>-1,
	  'parent' =>  0,
	  'hide_empty' =>  false,
	  'hierarchical' =>  false,
	  'meta_query' => array(  
				            (array(
				              'key' => 'id_transaccion',
				              'value'   => 'venta',
				              'operator' => 'IN'
				            ) 
	            	)
	   )
);

$loop=New WP_Query( $args );
$select_comprar=array();

while ( $loop->have_posts() ) : $loop->the_post(); 

  array_push($select_comprar, strip_tags (get_the_term_list( get_the_ID(), 'localidad', "",", " ))) ;
  
 
 endwhile; // end of the loop. 
$sin_dupli=array_unique($select_comprar);
$slug_localidades=str_replace(' ', '-', $sin_dupli);
sort($slug_localidades);

$localidades_hijas=array();

foreach ($slug_localidades as $key) {
	$tag = get_term_by('slug', $key . '-' . $key, 'localidad');
	if(!empty($tag)){
		$localidades_hijas[$tag->slug]=$tag->term_id;
	}else{
		$tag = get_term_by('slug', $key, 'localidad');
		$localidades_hijas[$tag->slug]=$tag->term_id;
	}
	
}
ksort($localidades_hijas);

$localidades_padres=array();
foreach ($localidades_hijas as $key) {
	 $term = get_term_by('id',$key , 'localidad');
	 $term2 = get_term_by('id',$term->parent , 'localidad');
	 if(isset($term2->term_id)){
	    $localidades_padres[$term2->name]=$term2->term_id;
	  }else{
	    $localidades_padres[$term->name]=$term->term_id;
	  }
}

$sin_dupli_padres=array_unique($localidades_padres);
ksort($sin_dupli_padres);

foreach ($sin_dupli_padres as $key => $value) {
	
	if(isset($localidades_comprar)){
 		if(strcasecmp($localidades_comprar, $value)==0){
 		 	echo '<option value="' . $value . '" selected>' . $key . '</option>';
 		}else{
 			echo '<option value="' . $value . '">' . $key . '</option>';
 		}		 
 	}else{
 		echo '<option value="' . $value . '">' . $key . '</option>';
 	}

   foreach ($localidades_hijas as $key2 => $value2) {

    $term3 = get_term_by('slug',$key2 , 'localidad');
    $term4 = get_term_by('id',$term3->parent , 'localidad');
   
    if(isset($term4->name)){
    	if(strcmp($term4->name, $key)==0){
    		if(isset($localidades_comprar)){
		 		if(strcasecmp($localidades_comprar, $value2)==0){
		 		 	echo '<option value="' . $value2 . '" selected>&nbsp;&nbsp;&nbsp;&nbsp;' . $term3->name . '</option>';
		 		}else{
		 			echo '<option value="' . $value2 . '">&nbsp;&nbsp;&nbsp;&nbsp;' . $term3->name . '</option>';
		 		}		 
			 	}else{
			 		echo '<option value="' . $value2 . '">&nbsp;&nbsp;&nbsp;&nbsp;' . $term3->name . '</option>';
			 }
     
    	 }
    }    
  }
}
?>