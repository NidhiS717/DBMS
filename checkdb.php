<?php
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=try";
   $credentials = "user=postgres password=qwerty";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db){
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";
   }
 $sql =<<<EOF
      SELECT ID FROM COMPANY WHERE SALARY IN (SELECT SALARY FROM COMPANY WHERE ID=3);
EOF;
  

  $ret = pg_query($db, $sql);
   if(!$ret){
      echo pg_last_error($db);
      exit;
   } 
   while($row = pg_fetch_row($ret)){
      echo "ID = ". $row[0] . "<br/>";
    
   }
   echo "Operation done successfully<br/>";
   pg_close($db);
?>