<?php
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=recipe_genie";
   $credentials = "user=postgres password=qwerty";
    $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db){
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";
   }
   
   $sql=<<<EOF
   drop table if exists account cascade;
   create table account(user_name varchar(10), password varchar(7) not null, emailid varchar check (emailid ~* '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][A-Za-z]+$'), about text, admin_mode boolean, primary key(user_name));
  
   drop table if exists recipe cascade;
   create table recipe(r_ID varchar(10), r_name text, r_mins numeric(3,0) check(r_mins>0 and r_mins<300), r_cuisine varchar(25), r_complexity varchar(7) check(r_complexity in('Easy','Medium','Hard')),r_ratings_no numeric(5,0),no_of_servings integer, r_score numeric(1,0) check(r_score<5), r_genie boolean, user_name varchar(10),upload_time timestamp, primary key(r_ID), foreign key(user_name) references account);
   
    drop table if exists ingredients cascade;
   create table ingredients(i_ID varchar(10), i_name text, i_availability varchar(7) check(i_availability in('Common','Rare')), i_genie boolean, primary key(i_ID));
   
   drop table if exists appliances cascade;
   create table appliances(a_ID varchar(10), a_name text, a_genie boolean, primary key(a_ID));
	
   drop table if exists history cascade;
   create table history(r_ID varchar(10), user_name varchar(10), history_date timestamp,primary key(r_ID,user_name), foreign key(user_name) references account, foreign key(r_ID) references recipe);
   
   drop table if exists contains cascade;
   create table contains(r_ID varchar(10), i_ID varchar(10), quantity_gms_num numeric(5,2),primary key(r_ID,i_ID), foreign key(r_id) references recipe, foreign key(i_ID) references ingredients);
   
     drop table if exists steps cascade;
   create table steps(r_ID varchar(10), step_data text,primary key(r_ID), foreign key(r_id) references recipe);
   
     drop table if exists uses cascade;
   create table uses(r_ID varchar(10), a_ID varchar(10),primary key(r_ID,a_ID), foreign key(r_id) references recipe, foreign key(a_ID) references appliances);
   
      drop table if exists likes cascade;
   create table likes(r_ID varchar(10), user_name varchar(10), foreign key(user_name) references account, foreign key(r_ID) references recipe);
   
      drop table if exists comments cascade;
   create table comments(r_ID varchar(10), user_name varchar(10), foreign key(user_name) references account, foreign key(r_ID) references recipe);
   
   
EOF;
  
  $ret = pg_query($db, $sql);
   if(!$ret){
      echo pg_last_error($db);
      exit;
   } 
   else
	   echo "Table created :)";
   pg_close($db);
   ?>
   