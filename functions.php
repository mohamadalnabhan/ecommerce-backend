<?php


define("MB", 1048576);

function filterRequest($requestname)
{
  if (isset($_POST[$requestname])) {
    return htmlspecialchars(strip_tags($_POST[$requestname]));
  } elseif (isset($_GET[$requestname])) {
    return htmlspecialchars(strip_tags($_GET[$requestname]));
  } else {
    return null; // or "" if you prefer
  }
}

function getAllData($table, $where = null, $values = null , $json = true)
{
    global $con;
    $data = array();
    if($where == null){
    $stmt = $con->prepare("SELECT  * FROM $table");
    }else{
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    }
   
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($json == true){
          if ($count > 0){
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    }else{
          if ($count > 0){
        return array("status" => "success"  , "data" =>$data);

    } else {
        array("status" => "failure");
    }
    }
    return $count;
}

function getData($table, $where = null, $values = null , $json = true)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
      if($json == true){
          if ($count > 0){
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    }else{
          if ($count > 0){
        return $data;

    } else {
        echo json_encode(array("status" => "failure"));
    }
    }
    return $count;
}
function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
  }
    return $count;
}


function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    }
    return $count;
}

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function imageUpload($imageRequest)
{
  global $msgError;
  $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
  $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
  $imagesize  = $_FILES[$imageRequest]['size'];
  $allowExt   = array("jpg", "png", "gif", "mp3", "pdf");
  $strToArray = explode(".", $imagename);
  $ext        = end($strToArray);
  $ext        = strtolower($ext);

  if (!empty($imagename) && !in_array($ext, $allowExt)) {
    $msgError = "EXT";
  }
  if ($imagesize > 2 * MB) {
    $msgError = "size";
  }
  if (empty($msgError)) {
    move_uploaded_file($imagetmp,  "../upload/" . $imagename);
    return $imagename;
  } else {
    return "fail";
  }
}



function deleteFile($dir, $imagename)
{
    if (file_exists($dir . "/" . $imagename)) {
        unlink($dir . "/" . $imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "wael" ||  $_SERVER['PHP_AUTH_PW'] != "wael12345") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }

    // End 
}
function printFailure($message = "none"){
    echo json_encode(array("status" => "failure","message" => $message));
}

function printSuccess($message = "none"){
    echo json_encode(array("status" => "success","message" => $message));
}
function result($count){
    if($count > 0){
        printSuccess();
    }else {
        printFailure(); 
    }
}


// function sendEmail($to, $subject, $message) {
//     $headers = "From: mhamadnabhan6@gmail.com\r\n";
//     $headers .= "CC: mohamadalnabhan000@gmail.com\r\n";

//     mail($to, $subject, $message, $headers);
//     echo " email sent succesfully 1";
// }