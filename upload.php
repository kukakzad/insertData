<?php
	// include 'connectsql.php';
	$fileName = $_FILES["file"]["name"]; // The file name
	$fileTmpLoc = $_FILES["file"]["tmp_name"]; // File in the PHP tmp folder
	$fileType = $_FILES["file"]["type"]; // The type of file it is
	$fileSize = $_FILES["file"]["size"]; // File size in bytes
	$fileErrorMsg = $_FILES["file"]["error"]; // 0 for false... and 1 for true
	if (!$fileTmpLoc) { // if file not chosen
	    echo "ERROR: Please browse for a file before clicking the upload button.";
	    exit();
	}
	if(move_uploaded_file($fileTmpLoc, "uploads/$fileName")){
		echo '<script type="text/javascript">';
    echo 'alert("$fileName upload is complete.");';
    echo '</script>';
    require_once 'PHPExcel/IOFactory.php';
    $objPHPExcel = PHPExcel_IOFactory::load("./uploads/".$fileName);
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		  	$worksheetTitle     = $worksheet->getTitle();
		  	$highestRow         = $worksheet->getHighestRow(); // e.g. 10
		  	$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
		  	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		  	$nrColumns = ord($highestColumn) - 64;
		  	for ($row = 0; $row <= $highestRow; ++ $row) {
		   		for ($col = 0; $col < $highestColumnIndex; ++ $col) {
		      		$cell = $worksheet->getCellByColumnAndRow($col, $row);
		      		$val = $cell->getValue();
		      		$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
			    	$datas[$col] = $val;
	   			}
	   			$strSQL="INSERT INTO countryData(countryName, countryCode, countryID) VALUES('";
	   			
				for ($i=0;$i<3;$i++){
			   		if($i == 2){
				   		$strSQL .= $datas[$i]."') ";  
			   		}
			    	else
			     		$strSQL .= $datas[$i]."','";
				}
				echo $strSQL."<br>";
      			mysql_query($strSQL);
     		}
   		}
	} else {
	    echo "move_uploaded_file function failed";
	}
?>