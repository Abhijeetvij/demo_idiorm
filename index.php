<?php



/*
 * Connect Your Database
 * start
 * */

include_once 'db.php';

/*
 * Close
 * */

if(isset($_GET['delete'])){
    $deletePhoneId= base64_decode($_GET['delete']);
    $phoneToDeleteObj = ORM::for_table('phone')->find_one($deletePhoneId);
    if($phoneToDeleteObj){
        $phoneToDeleteObj->delete();
        header("Location: index.php?SuccessDelete=true");
    } else {
        header("Location: index.php");
    }

}

$tab = "\t";
$fp = fopen('mydata.txt', 'r');
while (!feof($fp)) {
    $line = fgets($fp, 2048);

    $data_txt = str_getcsv($line, $tab);


    //Get First Line of Data over here
    $getPhone = explode(',', $data_txt[0]);
    $phone = $getPhone[1];
    if ($phone != "PHONE") { // Not Need to insert fist line of Header Text "PHONE"
        $person = ORM::for_table('phone')->create();
        $person->set('phone', $phone);
        $person->save();
    }

}
fclose($fp); //Close File


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demo Document From Hope</title>
</head>
<body>
<h1>Phone Data [Hope Demo]</h1>
<div>
    (Note : Every Time scritp insert data from txt file on Page Load)
</div>
<?php
if(isset($_GET['SuccessDelete'])){
echo "<span style='color : green; padding: 100px;'>Delete Success</span>";
}
?>

<table>
    <tr>
        <th>Phone</th>
        <th>Delete</th>
    </tr>
    <?php
    $allPhone = ORM::for_table('phone')->find_many();
    if (count($allPhone) > 0) {
        foreach ($allPhone as $phoneData) {
            echo '<tr>';
            echo '<td>';
            echo $phoneData->phone;
            echo '</td>';

            echo '<td>';
            echo '<a href="index.php?delete=' . base64_encode($phoneData->id) . '"  onclick="return confirm(\'Are you sure want to Delete ?\')">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
    }

    ?>
</table>
</body>
</html>