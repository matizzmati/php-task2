<?php 
    $csv = array_map('str_getcsv', file('file.csv'));
?>

<!DOCTYPE html>
<html lang="pl">

	<head>
		<meta charset="utf-8">
        <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0;}
            .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
            overflow:hidden;padding:10px 5px;word-break:normal;}
            .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
            font-weight:bold;overflow:hidden;padding:10px 5px;word-break:normal;}
            .tg .tg-0lax{text-align:left;vertical-align:top}
        </style>
	</head>

	<body>
        <table class="tg">
            <?php
                $header = array_shift($csv);
                echo 
                '<thead>
                    <tr>
                        <th class="tg-0lax">' . $header[0] . '</th>
                        <th class="tg-0lax">' . $header[1] . '</th>
                        <th class="tg-0lax">' . $header[2] . '</th>
                        <th class="tg-0lax">' . $header[3] . '</th>
                        <th class="tg-0lax">' . $header[4] . '</th>
                        <th class="tg-0lax">' . $header[5] . '</th>
                    </tr>
                </thead>
                <tbody>';

                foreach ($csv as $key=>$value)
                {
                    echo 
                    '<tr>
                        <td class="tg-0lax"><a href="/task2a.php?product_url=' . $value[1] . '">' . $value[0] . '</a></td>
                        <td class="tg-0lax"><a target="_blank" href="' . $value[1] . '">' . $value[1] . '</td>
                        <td class="tg-0lax"><a target="_blank" href="' . $value[2] . '">' . $value[2] . '</td>
                        <td class="tg-0lax">' . $value[3] . '</td>
                        <td class="tg-0lax">' . $value[4] . '</td>
                        <td class="tg-0lax">' . $value[5] . '</td>
                    </tr>';
                }
                echo '</tbody>';
            ?>
        </table>
	</body>

</html>