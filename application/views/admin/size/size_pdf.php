<?php

$html = '
		<h3>Sizes List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>Size Name</th>
					<th>Created Date</th>
				</tr>
			</thead>
			<tbody>';

			foreach($all_categories as $row):
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
		$mpdf->SetTitle("Lekhu's Collection - Sizes List");
		$mpdf->SetAuthor("Lekhus");
		$mpdf->watermark_font = 'Lekhus';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');		 
		 

		$mpdf->WriteHTML($html);

		$filename = 'categories_list1';

		ob_clean();

		$mpdf->Output($filename . '.pdf', 'D');

		exit();

?>