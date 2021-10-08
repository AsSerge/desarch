<?php

//Считаем количество Файлов в каталоге новости и возвращаем массив имен файлов
function get_files_count($dir){
    $dir = opendir($dir);
    $dir_list = array();
        $count = 0;
        while($file = readdir($dir)){
            
            if($file == '.' || $file == '..' || is_dir($dir . $file)){
                continue;
            }
            $dir_list[] = $file;
            $count++;
        }
    
        return $dir_list;//Воозвращаем массив с файлами
}


//Преобразуем дату в правильный MySql формат
function date_to_mysql($date){
    $date_tmp = explode(".",$date);
    $dete_new = $date_tmp[2]."-".$date_tmp[1]."-".$date_tmp[0];                
    return $dete_new;
}
function mysql_to_date($date){
    $date_tmp = explode("-",$date);
    $dete_new = $date_tmp[2].".".$date_tmp[1].".".$date_tmp[0];                
    return $dete_new;
}
//Преобразуем MySQL дату в текстовый формат
function mysql_to_date_text($date){
    $date_tmp = explode("-", $date);
    $text_month = array("", "января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря");
    $date_new = (int)$date_tmp[2]." ".$text_month[(int)$date_tmp[1]]." ".$date_tmp[0];//Не забываем переводить строку в число - убираеи ведущий 0                
    return $date_new;
}

function mysql_to_date_text_eng($date){
    $date_tmp = explode("-", $date);
    $text_month = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $date_new = (int)$date_tmp[2]." ".$text_month[(int)$date_tmp[1]]." ".$date_tmp[0];//Не забываем переводить строку в число - убираеи ведущий 0                
    return $date_new;
}



//Загрузка документов тендера в ZIP файле (имя временного файла путь для загрузки, тип файла, ID для формирования имени)
function tender_write_zip($file, $dir, $type, $id){
    
    if(is_uploaded_file($file)){
        move_uploaded_file($file, $dir."doc".$id.".".$type);
    }else{
        echo("Ошибка загрузки файла");
    }
}

//Чистит кавычки в тексте
function del_quotes($text_data){
    $d_quotes = str_replace("'","\"",$text_data);
    return $d_quotes;            
}
//Определение выбранного направления
function directions_selected($dir){
    $dir_array[] = array("megapolis", "Мегаполис");
    $dir_array[] = array("dmtextile", "ДМ Текстиль");
    $dir_array[] = array("waterfall", "Вотерфол");
    $dir_array[] = array("fuel", "Эталон-МК");
    $dir_array[] = array("sgtpp", "ШГЭТС");
    $dir_array[] = array("golf", "Гольф клуб ДОН");
    $dir_array[] = array("sheraton", "Sheraton");
    echo '<select class="selectpicker form-control show-tick" title="Направление" name = "news_directions" id = "news_directions" required>';
    
    foreach ($dir_array as $dir_array){
        if ($dir_array[1]==$dir){
            $d_status = "selected='selected'";
        }else{
            $d_status = "";
        }
        echo "<option title = '{$dir_array[0]}' {$d_status}>{$dir_array[1]}</option>\n";
        
    }    
    echo '</select>';
}

//Определение выбранного заказчика тендера
function tender_selected($dir){
    $dir_array[] = array("megapolis", "Мегаполис");
    $dir_array[] = array("dmtextile", "ДМ Текстиль");
    $dir_array[] = array("waterfall", "Вотерфол");
    $dir_array[] = array("fuel", "Эталон-МК");
    $dir_array[] = array("sgtpp", "ШГЭТС");
    $dir_array[] = array("golf", "Гольф клуб ДОН");
    $dir_array[] = array("sheraton", "Sheraton");
    echo '<select class="selectpicker form-control show-tick" title="Направление" name = "tender_directions" id = "tender_directions" required>';
    
    foreach ($dir_array as $dir_array){
        if ($dir_array[1]==$dir){
            $d_status = "selected='selected'";
        }else{
            $d_status = "";
        }
        echo "<option title = '{$dir_array[0]}' {$d_status}>{$dir_array[1]}</option>\n";
        
    }    
    echo '</select>';
}
//Определения выбранного типа тендера
function tendertype_selected($dir){

    $dir_array[] = array("tender_open", "Открытый конкурс");
    $dir_array[] = array("tender_request", "Запрос предложений");    
    echo '<select class="selectpicker form-control show-tick" title="Направление" name = "tender_type" id = "tender_type" required>';    
    
    foreach ($dir_array as $dir_array){
        if ($dir_array[1]==$dir){
            $d_status = "selected='selected'";
        }else{
            $d_status = "";
        }
        echo "<option title = '{$dir_array[0]}' {$d_status}>{$dir_array[1]}</option>\n";
        
    }    
    echo '</select>';
}



//Сокращение информации в таблице новостей
function clear_output($text){
    //Убираем HTML теги + Обрезаем текст до 200 знаков, убираем лишние символы в конце, убираем последний пробел
    $text = strip_tags($text);
    $text = substr($text, 0, 200);
    $text = rtrim($text, "!,.-");
    $text = substr($text, 0, strrpos($text, ' '));
    return $text."...";
}
//Удаление каталога с файлами
function delFolder($dir){
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? delFolder("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}
            //Работа с изображениями
			function quest_image($source, $new_file, $size, $img_change){

					//Получаем размеры исходной картинки
					$size_source_pic = getimagesize($source);
						$p_width = $size_source_pic[0];//Ширина
						$p_height = $size_source_pic[1];//Высота

					// новая ширина (получаем из параметров)
						$width = $size;

					//Определяем коэффициент уменьшения
						$kresize = $width / $p_width;
						$height = round($p_height * $kresize); // новая высота
						$imge_edit_resize = false;

                    //Если новая высота картинки больше, чем заданная ширина, то ширину картинки уменьшаем с коэффициентом уменьшения.
//					Холст создаем квадратный заданный размер + 2px. Фон - белый.

						if($height > $size){
							$height = $size;
							$kresize = $height / $p_height;							
							$width = round($p_width * $kresize);
							$imge_edit_resize = true;
						}							
				
					// цвет заливки фона
						$rgb = 0xffffff;
					// создаем холст пропорциональное сжатой картинке + 2px
						if($imge_edit_resize == true OR $img_change == true){
								$img = imagecreatetruecolor($size, $size);
						}else{
								$img = imagecreatetruecolor($width, $height);
						}

					// заливаем холст цветом $rgb
						imagefill($img, 0, 0, $rgb);
					// загружаем исходную картинку
						$photo = imagecreatefromjpeg($source);
					// копируем на холст сжатую картинку с учетом расхождений
					// цель, иссходник, x-результат, y-результат, x-исходного, y-исходного, ширина-результат, высота-результат, ширина-исходного, высота-исходного
					//	imagecopyresampled($img, $photo, 0, 0, 0, 0, $width, $height, $p_width, $p_height);
						if($imge_edit_resize == true){
							imagecopyresampled($img, $photo, ($size - $width)/2, 0, 0, 0, $width, $height, $p_width, $p_height);
						}else if($img_change == true){
							imagecopyresampled($img, $photo, 0, ($size - $height)/2, 0, 0, $width, $height, $p_width, $p_height);
						}else{
							imagecopyresampled($img, $photo, 0, 0, 0, 0, $width, $height, $p_width, $p_height);
						}
				
					// сохраняем результат
						imagejpeg($img, $new_file);
					// очищаем память после выполнения скрипта
						imagedestroy($img);
						imagedestroy($photo);
			}

?>