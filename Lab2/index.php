
<?php
require_once('config.php');
require_once('MySQLHandler.php');

$handler = new MySQLHandler('products');
$connect = $handler->connect();
 //check for connection to db
if($connect){
  //get url of the current page
  $URL = $_SERVER['REQUEST_URI'];
  // echo $URL; //My url: localhost/Web_Service/Lab2/index.php/products
  $URL = explode("/", $URL); //convert string $URL into array
  //check for exist products parameter
  // die($URL[4]);
  if($URL[4] !== 'products'){
    http_response_code(404);
    echo json_encode(['error'=>"Resource dosn't exist"]);
    exit;//end excution
  }
    //isset to prevent warning in browser if #URL[5] not existed
  if(isset($URL[5])){
      $Product_ID = (int) $URL[5];
  }
  // echo $Product_ID;
  // var_dump($URL);
  // exit();
    //fetch request method of url
    $Requested_Method = $_SERVER['REQUEST_METHOD'];
    switch($Requested_Method){
      case 'GET':
        //check for setting ID
        if (isset($Product_ID)) {
        // $isExistedID = $handler->search('id',$Product_ID);//array if found id in table
        $res =  $handler->get_record_by_id($Product_ID);
        //reconnect to db
        $handler->connect();
        if(!empty($res)){
              echo json_encode($res);
        } else{
    //get all records
    echo json_encode(['error'=>"Resource dosn't exist"]);
      http_response_code(404);
    }
        }  else {
          $products = $handler->get_data();
          echo json_encode($products);
        }
       break;

      case 'POST':
        $new_data = json_decode(file_get_contents('php://input'), true);
        $handler->connect();
        $res = $handler->save($new_data);
        break;

      case 'PUT':
        if (isset($Product_ID)) {
          $isExistedID = $handler->search('id',$Product_ID);//array if found id in table
          //reconnect to db
          $handler->connect();
          if($isExistedID){
            $edited_data = json_decode(file_get_contents('php://input'), true);
            $res = $handler->update($edited_data, $Product_ID);
          }
          else{
            echo json_encode(['error'=>"Resource dosn't exist"]);
            http_response_code(404);
          }
        }  
        break;

        case 'DELETE':
          if (isset($Product_ID)) {
            $isExistedID = $handler->search('id',$Product_ID);//array if found id in table
            //reconnect to db
            $handler->connect();
            if($isExistedID){
              // $res =  $handler->get_record_by_id($Product_ID);
              $res = $handler->delete($Product_ID);
            }
            else{
              echo json_encode(['error'=>"Resource dosn't exist"]);
              http_response_code(404);
            }
          }  
          break;

        default:
              echo json_encode(["error"=>"method not allowed!"]);
              http_response_code(405);
    }
}//end connection
else{
  http_response_code(500);
  }


//$_SERVER is a PHP super global variable which holds information about headers, paths, and script locations.
// $products = $handler->get_data();
// echo '<body style="display:flex;
//         flex-direction:column;
//         justify-content:center;
//         align-items:center;padding:2%"> <div
//         style="             
//         width:45%;
//         background-color: white;
//         border-radius: 10px;" 
//         class="row border border-1 shadow-lg text-center p-2" >';
// foreach($products as $product){
//     echo "<div>";
//     foreach($product as $key => $value){
//         echo "<p> $key: $value</p>";
//     }
//     echo str_repeat("_", 50);
//     echo "</div>";
// }

?>