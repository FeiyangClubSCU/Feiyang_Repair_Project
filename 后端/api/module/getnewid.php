<?php
/*----------------------------------------------------------------------------------

                                *检索并生成新的编号*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                功能：为新会员新用户新技工新订单新管理新问题新反馈等生成编号
----------------------------------------------------------------------------------*/
$get_verify_path = dirname(dirname(__FILE__));
include $get_verify_path.'/module/database.php';
function id_new_users(){
    if(db_getc("fy_stack","name","id_user","data")!=""){
        $id_new_users_now=db_getc("fy_stack","name","id_user","data");
        $id_sql_command_t="DELETE FROM fy_stack WHERE name='id_user' AND data='".$id_new_users_now."'";
        db_exec($id_sql_command_t);
    }
    else{
        $id_new_users_las=db_getc("fy_datas","name","id_user","data");
        $id_new_users_now=db_getc("fy_confs","name","Global_Year","data")*1000000+intval($id_new_users_las)+1;
        db_putc("fy_datas","name","id_user","data",strval(intval($id_new_users_las)+1));
    }
    return $id_new_users_now;
}

function id_new_order(){
    if(db_getc("fy_stack","name","id_orde","data")!=""){
        $id_new_users_now=db_getc("fy_stack","name","id_orde","data");
        $id_sql_command_t="DELETE FROM fy_stack WHERE name='id_orde' AND data='".$id_new_users_now."'";
        db_exec($id_sql_command_t);
    }
    else{
        $id_new_users_las=db_getc("fy_datas","name","id_orde","data");
        $id_new_users_now=db_getc("fy_confs","name","Global_Year","data")*1000000+intval($id_new_users_las)+1;
        db_putc("fy_datas","name","id_orde","data",strval(intval($id_new_users_las)+1));
    }
    return $id_new_users_now;
}

function id_new_infos(){
    if(db_getc("fy_stack","name","id_info","data")!=""){
        $id_new_users_now=db_getc("fy_stack","name","id_info","data");
        $id_sql_command_t="DELETE FROM fy_stack WHERE name='id_info' AND data='".$id_new_users_now."'";
        db_exec($id_sql_command_t);
    }
    else{
        $id_new_users_las=db_getc("fy_datas","name","id_info","data");
        $id_new_users_now=db_getc("fy_confs","name","Global_Year","data")*1000000+intval($id_new_users_las)+1;
        db_putc("fy_datas","name","id_info","data",strval(intval($id_new_users_las)+1));
    }
    return $id_new_users_now;
}

function id_new_staff(){
    if(db_getc("fy_stack","name","id_staf","data")!=""){
        $id_new_users_now=db_getc("fy_stack","name","id_staf","data");
        $id_sql_command_t="DELETE FROM fy_stack WHERE name='id_staf' AND data='".$id_new_users_now."'";
        db_exec($id_sql_command_t);
    }
    else{
        $id_new_users_las=db_getc("fy_datas","name","id_staf","data");
        $id_new_users_now=db_getc("fy_confs","name","Global_Year","data")*1000000+intval($id_new_users_las)+1;
        db_putc("fy_datas","name","id_staf","data",strval(intval($id_new_users_las)+1));
    }
    return $id_new_users_now;
}

function id_new_viper(){
    if(db_getc("fy_stack","name","id_vips","data")!=""){
        $id_new_users_now=db_getc("fy_stack","name","id_vips","data");
        $id_sql_command_t="DELETE FROM fy_stack WHERE name='id_vips' AND data='".$id_new_users_now."'";
        db_exec($id_sql_command_t);
    }
    else{
        $id_new_users_las=db_getc("fy_datas","name","id_vips","data");
        $id_new_users_now=db_getc("fy_confs","name","Global_Year","data")*1000000+intval($id_new_users_las)+1;
        db_putc("fy_datas","name","id_vips","data",strval(intval($id_new_users_las)+1));
    }
    return $id_new_users_now;
}

function id_new_feeds(){
    if(db_getc("fy_stack","name","id_feed","data")!=""){
        $id_new_users_now=db_getc("fy_stack","name","id_feed","data");
        $id_sql_command_t="DELETE FROM fy_stack WHERE name='id_feed' AND data='".$id_new_users_now."'";
        db_exec($id_sql_command_t);
    }
    else{
        $id_new_users_las=db_getc("fy_datas","name","id_feed","data");
        $id_new_users_now=db_getc("fy_confs","name","Global_Year","data")*1000000+intval($id_new_users_las)+1;
        db_putc("fy_datas","name","id_feed","data",strval(intval($id_new_users_las)+1));
    }
    return $id_new_users_now;
}

function id_new_admin(){
    if(db_getc("fy_stack","name","id_admi","data")!=""){
        $id_new_users_now=db_getc("fy_stack","name","id_admi","data");
        $id_sql_command_t="DELETE FROM fy_stack WHERE name='id_admi' AND data='".$id_new_users_now."'";
        db_exec($id_sql_command_t);
    }
    else{
        $id_new_users_las=db_getc("fy_datas","name","id_admi","data");
        $id_new_users_now=db_getc("fy_confs","name","Global_Year","data")*1000000+intval($id_new_users_las)+1;
        db_putc("fy_datas","name","id_admi","data",strval(intval($id_new_users_las)+1));
    }
    return $id_new_users_now;
}
/*--------------------------------------------回收老旧的编号---------------------------------------------*/
function id_push_nums($push_name,$push_data){
    $exc_minute_data=db_alls('fy_stack'); 
    $exc_minute_flag=0;
    while($exc_minute_row1=$exc_minute_data->fetch_assoc())
        if($exc_minute_row1["name"]==$push_name&&$exc_minute_row1["data"]==$push_data)
        $exc_minute_flag=1;
    if($exc_minute_flag==0){
        echo "INSERT INTO `fy_stack` (`name`, `data`) VALUES (".$push_name.",".$push_data.")";
        return db_exec("INSERT INTO `fy_stack` (`name`, `data`) VALUES (".$push_name.",".$push_data.")");
    }
    return -1;
}
?>