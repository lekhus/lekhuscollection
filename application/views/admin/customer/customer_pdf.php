<?php

$html = '
		<h3>Brands List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>Brand Name</th>
					<th>Created Date</th>
				</tr>
			</thead>
			<tbody>';

			foreach($all_brands as $row):
			$html .= '		
				<tr class="oddrow">
					<td>'.$row['Name'].'</td>
					<td>'.$row['created_at'].'</td>
				</tr>';
			endforeach;

			$html .=	'</tbody>
			</table>			
		 ';
				
		$mpdf = new mPDF('c');

		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle("Lekhu's Collection - Brands List");
		$mpdf->SetAuthor("Lekhus");
		$mpdf->watermark_font = 'Lekhus';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');		 
		 

		$mpdf->WriteHTML($html);

		$filename = 'brands_list1';

		ob_clean();

		$mpdf->Output($filename . '.pdf', 'D');

		exit();

?>