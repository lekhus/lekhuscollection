<?php

$html = '
		<h3>Stock items List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>Stock item Name</th>
					<th>Created Date</th>
				</tr>
			</thead>
			<tbody>';

			foreach($all_items as $row):
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
		$mpdf->SetTitle("Lekhu's Collection - Stock items List");
		$mpdf->SetAuthor("Lekhus");
		$mpdf->watermark_font = 'Lekhus';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');		 
		 

		$mpdf->WriteHTML($html);

		$filename = 'items_list1';

		ob_clean();

		$mpdf->Output($filename . '.pdf', 'D');

		exit();

?>