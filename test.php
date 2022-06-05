<?php
	$no_of_records_per_page = 7;
	$total_records = 25;
	
	$total_pages = ceil($total_records / $no_of_records_per_page);

	for ($i=1; $i <= $total_pages; $i++) { 
		echo $i.''; 
	};
 ?>