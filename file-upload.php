<?php
include('connection.php');
require 'PHPSpreadsheet/autoload.php';
$conn = mysqli_connect("localhost","root","","db_helpdesk");
 
use phpoffice\phpspreadsheet\Spreadsheet;
use phpoffice\phpspreadsheet\IOFactory;
if (isset($_POST['upload'])) {
 
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    
    if(isset($_FILES['uploadfile']['name']) && in_array($_FILES['uploadfile']['type'], $file_mimes)) {
     
        $arr_file = explode('.', $_FILES['uploadfile']['name']);
        $extension = end($arr_file);
     
        if('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
 
        $spreadsheet = $reader->load($_FILES['uploadfile']['tmp_name']);
 
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
         
        if (!empty($sheetData)) {
            for ($i=1; $i<count($sheetData); $i++) {
                $user_id = $sheetData[$i][0];
                $Lastname = $sheetData[$i][1];
                $Firstname = $sheetData[$i][2];
                $Middlename = $sheetData[$i][3];
                $Password = $sheetData[$i][4];
                $Email = $sheetData[$i][5];
                $User_Level = $sheetData[$i][6];
                $unhashedpassword = $sheetData[$i][7] ;
                $Status = $sheetData[$i][8] = '1';
                $hashpword = password_hash($Password, PASSWORD_DEFAULT);
$sql = "INSERT INTO tbl_login (user_id, Lastname, Firstname, Middlename, Password, Email, User_Level, unhashedpassword, Status) VALUES('$user_id', '$Lastname', '$Firstname','$Middlename', '$hashpword','$Email', '$User_Level', '$Password', '$Status') ORDER BY user_id DESC";

if (mysqli_query($conn, $sql)) {
 echo "<script>alert('New user added succesfully.'); window.location = 'Admin_page.php';</script>";
} else {
 echo "<script>alert('Duplicated Entry!'); window.location = 'Admin_page.php';</script>"; 
}
            }
        }
    }
}
?>