<?php

$html = '
		<h3>Sets List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>Set Name</th>
					<th>Created Date</th>
				</tr>
			</thead>
			<tbody>';

			foreach($all_sets as $row):
			$html .= '		
				<tr class="oddrow">
					<td>'.$row['Name'].'</td>
					<td>'.$row['created_at'].'</td>
				</tr>';
			endforeach;

			$html .=	'</tbody>
			</table>			
		 ';
			

		$mpdf = new mPDF('A4-L');
		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle("Lekhu's Collection - Sets List");
		$mpdf->SetAuthor("Lekhus");
		$mpdf->SetDisplayMode('fullpage');		 
		 

		$mpdf->WriteHTML($html);

		$filename = 'sets_list1';

		ob_clean();

		$mpdf->Output($filename . '.pdf', 'D');

		exit();

?>