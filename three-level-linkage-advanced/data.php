<?php

header("Content-type: text/html; charset=utf-8");
$db_host = 'localhost'; //主机地址
$db_user = 'root';		//数据库用户名
$db_pwd = '';		//数据库密码
$db_name = 'newliandong';		//数据库名称
$mysqli = new mysqli($db_host,$db_user,$db_pwd,$db_name);

mysqli_query($mysqli,"SET NAMES utf8");

/*省数据查询*/
$query_province = "SELECT id,province FROM province";
$result_province=$mysqli->query($query_province);
while($row_province =$result_province->fetch_array() ){   
  $array_province[] = array(id=>(int)$row_province[id],name=>$row_province[province]);
}  

/*市数据查询*/
$query_city = "SELECT id,city,province_id FROM city";
$result_city=$mysqli->query($query_city);
while($row_city =$result_city->fetch_array() ){   
  $array_city[$row_city[province_id]][] = array(id=>(int)$row_city[id],name=>$row_city[city]);
}  

/*区数据查询*/
$query_district = "SELECT id,district,city_id FROM district";
$result_district = $mysqli->query($query_district);
while($row_district =$result_district->fetch_array() ){   
  $array_district[$row_district[city_id]][] = array(id=>(int)$row_district[id],name=>$row_district[district]);
}  

$result_province->free();
$result_city->free();
$result_district->free();
$mysqli->close();

$array = array(province=>$array_province,city=>$array_city,district=>$array_district);
$json = json_encode($array);

//echo urldecode($json);

//为了方便查看，将unicode编码转成汉字
echo preg_replace("#\\\u([0-9a-f]+)#ie","iconv('UCS-2','UTF-8', pack('H4', '\\1'))",$json);


?>