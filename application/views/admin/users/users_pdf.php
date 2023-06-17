<?php

$html = '
		<h3>Users List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow">
				<th>User Id</th>
					<th>Username</th>
					<th>Created Date</th>
				</tr>
			</thead>
			<tbody>';

			foreach($all_users as $row):
			$html .= '		
				<tr class="oddrow">
					<td>'.$row['admin_id'].'</td>
					<td>'.$row['username'].'</td>
					<td>'.$row['created_at'].'</td>
				</tr>';
			endforeach;

			$html .=	'</tbody>
			</table>			
		 ';
				
		$mpdf = new mPDF('c');

		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle("Light Admin - Users List");
		$mpdf->SetAuthor("Shikidum");
		$mpdf->watermark_font = 'Sikidum';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');		 
		 

		$mpdf->WriteHTML($html);

		$filename = 'users_list1';

		ob_clean();

		$mpdf->Output($filename . '.pdf', 'D');

		exit();

?>