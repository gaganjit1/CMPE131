<?php

$filename = "smartmajordata".date("-d-M-Y-hiA");

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=".$filename.".csv");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

function outputCSV($data) {
    $output = fopen("php://output", "w");
    $keys = array_keys($data[0]);
    unset($keys[0]); // remove User_Response_ID
    foreach ($keys as $k => $v) {
        // assume Q1, Q2 format
        if (preg_match('/^Q\d+$/', $v)) {
            $new_keys[$k] = str_replace("Q", "Question ", $v);
        }
        else {
            $new_keys[$k] = str_replace("_", " ", $v);
        }
    }
    fputcsv($output, $new_keys);
    foreach ($data as $row) {
        unset($row['User_Response_ID']);
        fputcsv($output, $row);
    }
    fclose($output);
}

if (isset($_POST["data"])) {
	$data = json_decode($_POST['data'], true);
	$data = json_decode($data, true);
	outputCSV($data);
}

?>