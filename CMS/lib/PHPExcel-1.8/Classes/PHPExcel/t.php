<?php require_once 'IOFactory.php';

$excelFile = "a.xls";

$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load($excelFile);

//Itrating through all the sheets in the excel workbook and storing the array data
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $arrayData[$worksheet->getTitle()] = $worksheet->toArray();
}

var_dump($arrayData);

?>