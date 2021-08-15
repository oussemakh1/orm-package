# orm-package
This a native php orm package that works with mysql it's main objectif is to facilitate the crud process in your application, contains all crud opreations like (insert, edit, update, delete, soft_delete) as well search operation

# setup
1- composer require oussemakhlifi/orm-package <br>
2- setup your .env file with following varibales<br>
- <b>db_host</b> = "host" <br>
- <b>db_username</b> = "database username" <br>
- <b>db_password</b> = "database password" <br>
- <b>db_name</b> = "database name"  <br>

# usage 
<b>insert example</b>: <br>
      
     $db = new \MysqlDB\MysqlDB(); 
     
     $table_name = "products"; 
     
     $columns = ["name", "category", "price"];
     
     $values = ["samsung a21", "phone", "1500"];
     
     $insert = $db->insert($table_name, $columns, $values);


<b>select example</b>: <br>
      
     $db = new \MysqlDB\MysqlDB(); 
     
     $table_name = "products"; 
     
     $where = "id";
     
     $value = 1;
     
     $orderby = "id";
     
     $option = "desc";
     
     $select = $db->select($table_name, $where, $value, $orderby, $option);    


<b>select by operator example</b>: <br>
      
     $db = new \MysqlDB\MysqlDB(); 
     
     $table_name = "products"; 
     
     $column = "price";
     
     $operation = "=";
     
     $value = 1500;
     
     $orderby = "id";
     
     $option = "desc";
     
     $select = $db->selectByOperator($table_name, $column, $operation, $value, $orderby, $option);
     


<b>update example</b>: <br>
      
     $db = new \MysqlDB\MysqlDB(); 
     
     $table_name = "products"; 
     
     $where = "id";
     
     $where_value = "1";
     
     $columns = ["name", "category", "price"];
     
     $values = ["samsung a22", "phone", "1000"];
     
     $update = $db->update($table_name, $columns,$where, $where_value, $values);
     
     
<b>delete example</b>: <br>
      
     $db = new \MysqlDB\MysqlDB(); 
     
     $table_name = "products"; 
     
     $column = "id";
     
     $value = "1";
     
     $delete = $db->delete($table_name, $colum, $value);
     


<b>soft delete example</b>: <br>
      
     $db = new \MysqlDB\MysqlDB(); 
     
     $table_name = "products"; 
     
     $column = "id";
     
     $value = "1";
     
     $soft_delete = $db->soft_delete($table_name, $colum, $value);
     
     
<b>search example</b>: <br>
      
     $db = new \MysqlDB\MysqlDB(); 
     
     $table_name = "products"; 
     
     $column = "category";
     
     $value = "phone";
     
     $search = $db->search($table_name, $column, $value); 

