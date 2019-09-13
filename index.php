<?php  

	$slug = " Miguel Senne Junior";


	$slug = preg_replace('/[^\w]+/', '_', $slug);
  $slug = preg_replace('/\s+/', '_', $slug);



	echo $slug

?>