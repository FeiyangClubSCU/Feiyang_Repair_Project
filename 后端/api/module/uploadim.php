<?php
/*----------------------------------------------------------------------------------

                                      *接收图片*
                                  Code By Pikachu
                                     OCT01/2020
                                     
                             功能：接收小程序上传的图片
----------------------------------------------------------------------------------*/
    $name = $_FILES['file']['name'];
    $path = 'imagesup.png/';
    if(move_uploaded_file($_FILES["file"]["tmp_name"],$path.$name))
         echo $_FILES['file']['name'];
    else echo 'fail_to_upload_images';
?>
