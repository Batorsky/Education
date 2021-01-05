<?php
session_start();
include('if-login-ok.php');
include('config.php');
include('css_charset.inc');
fast_conect_to_bd();


 $var_end = 'news';
 if (isset($_POST['Submit_Filter']))
 {
   $_SESSION['s_date_from_news'.$var_end]          = $_POST['date_from']  ;
   $_SESSION['s_date_to_news'.$var_end]            = $_POST['date_to']  ;
   $_SESSION['s_where_filter'.$var_end] = ' WHERE `date_time_news`>='.str_replace('-','',$_SESSION['s_date_from_news'.$var_end]).'000000 AND `date_time_news`<='.str_replace('-','',$_SESSION['s_date_to_news'.$var_end]).'235959 ';
 }
 // создание ограничений для запроса


// параметры  begin
 $name_page_add_edit_main_table = 'add_edit_news.php';
 $form_main_table               = 'forms/form_news.php';
 $name_main_table = 'news';

 $name_category_table = 'notice_category';
// параметры    end
 echo '<link rel=stylesheet href="css.css"  type=text/css>';

 include('forms/form_filter_news.php');


 echo '<div align="left"><a href="'.$name_page_add_edit_main_table.'?action=add">Добавить новость</a></div> <br>';




  // Для картинки
  $main_index = 0;
  $flied_main_table = array
  (
 //             0-кол. поле       ; 1- кол значение          ; 2 - Подпись
    0  => array('id_news'         , $_POST['id'             ] , 'id'             ),
    1  => array('id_region_news'  , $_POST['id_region_news' ] , 'Регион'  ),
    2  => array('id_category_news', $_POST['id_category_news'], 'Рубрика'         ),
    3  => array('top_news'        , $_POST['top_news'       ] , 'Топ'             ),
    4  => array('date_time_news'  , $_POST['date_news' ].' '.$_POST['time_news'].':00', 'Дата время'      ),
    5  => array('name_news'       , $_POST['name_news' ]      , 'Название новости'),
    9  => array('foto_top'        , $_POST['foto_top'       ] , 'Фото для топ'    ),
   10  => array('foto_1'          , $_POST['foto_1'         ] , 'Фото 1'          ),
   11  => array('foto_2'          , $_POST['foto_2'         ] , 'Фото 2'   ),
   12  => array('foto_3'          , $_POST['foto_3'         ] , 'Фото 3'   ),
   13  => array('foto_4'          , $_POST['foto_4'         ] , 'Фото 4'   ),
   14  => array('caption_foto_1'  , $_POST['caption_foto_1' ] , 'Подпись Фото 1'   ),
   15  => array('caption_foto_2'  , $_POST['caption_foto_2' ] , 'Подпись Фото 2'   ),
   16  => array('caption_foto_3'  , $_POST['caption_foto_3' ] , 'Подпись Фото 3'   ),
   17  => array('caption_foto_4'  , $_POST['caption_foto_4' ] , 'Подпись Фото 4'   ),
   18  => array('top_desc_news'   , $_POST['top_desc_news'  ] , 'Текст Топ'   ),
   19  => array('full_desc_news'  , $_POST['full_desc_news' ] , 'Текст Статьи'   ),
   20  => array('keywords_news'   , $_POST['keywords_news'  ] , 'Ключевые слова через пробел' ),
   21  => array('caption_news'    , $_POST['caption_news'   ] , 'Подпись статьи'   ),
   22  => array('url_news'        , $_POST['url_news'       ] , 'URL новости'   ),
   23  => array('name_url_news'   , $_POST['name_url_news'  ] , 'Подпись URL'   )

       )   ;
   $flied_image = array(9,10,11,12,13);
 // print_r($flied_image);
//------------------------------------------------------------------------------
 for($i=0; $i<count($flied_image); $i++)
 {

   if (isset($_POST['action_send'])  and $_POST['action_send']=="add")
   {
        $image1 = upload_pic2($_FILES[$flied_main_table[$flied_image[$i]][0]]);
        $flied_main_table[$flied_image[$i]][1] = $image1[4];
   }
   if (isset($_POST['action_send'])  and $_POST['action_send']=="edit")
   {
        $flied_main_table[$flied_image[$i]][1]= upload_or_not(@$_FILES[$flied_main_table[$flied_image[$i]][0]],@$upload_path,@$_POST['del_'.$flied_main_table[$flied_image[$i]][0]],@$_POST['old_'.$flied_main_table[$flied_image[$i]][0]]);
   }
 }
 //------------------------------------------------------------------------------
   if(isset($_GET['action']) and $_GET['action']=='add')
   {
     include($form_main_table);
   }

   if(isset($_GET['action']) and $_GET['action']=='edit')
   {
      $query_select_from_main_table_one = 'SELECT * FROM '.$name_main_table.' WHERE `'.$flied_main_table[$main_index][0].'`='.$_GET['id'];
      $result =  @mysql_query($query_select_from_main_table_one) or die( mysql_error());
      $line   =  mysql_fetch_assoc($result);
      include($form_main_table);
   }
   if(isset($_GET['action']) and $_GET['action']=='del')
   {
     $query_select_from_main_table_one = 'DELETE  FROM '.$name_main_table.' WHERE `'.$flied_main_table[$main_index][0].'`='.$_GET['id'];
      @mysql_query($query_select_from_main_table_one) or die( mysql_error());
      fast_conect_to_bd2();
      @mysql_query($query_select_from_main_table_one) or die( mysql_error());
      fast_conect_to_bd();
      @unlink($upload_path."/".$_GET['old_image_1']);
      @unlink($upload_path."/".$_GET['old_image']);
  }

    if(isset($_POST['action_send']) and $_POST['action_send']=='add'){
      @mysql_query(make_sql_insert($name_main_table, $flied_main_table)) or die( mysql_error());
      fast_conect_to_bd2();
      @mysql_query(make_sql_insert($name_main_table, $flied_main_table)) or die( mysql_error());
      fast_conect_to_bd();
    }

    if(isset($_POST['action_send']) and $_POST['action_send']=='edit')
    {
      @mysql_query(make_sql_update($name_main_table,$flied_main_table,$main_index)) or die( mysql_error());
      fast_conect_to_bd2();
      @mysql_query(make_sql_update($name_main_table,$flied_main_table,$main_index)) or die( mysql_error());
      fast_conect_to_bd();
    }

if (isset($_SESSION['s_where_filter'.$var_end]))
{
     echo '<table class="table_2" border="0" cellspacing="0" cellpadding="4" align="center">
     <tr>
       <td ><b></b></td>

       <td ><b></b></td>

       <td class="table_1"><b>'.$flied_main_table[5][2].'</b></td>
       <td width="80" class="table_1"><b>'.$flied_main_table[4][2].'</b></td>
       <td class="table_1"><b>'.$flied_main_table[1][2].'</b></td>
       <td class="table_1"><b>'.$flied_main_table[2][2].'</b></td>
       <td class="table_1"><b>'.$flied_main_table[3][2].'</b></td>
     </tr>';
   $query_select_from_main_table   ='SELECT * FROM `'.$name_main_table.'` '.@$_SESSION['s_where_filter'.$var_end];
   $result =  @mysql_query($query_select_from_main_table) or die( mysql_error());
   while($line = mysql_fetch_assoc($result))
   {
    for($i=0;$i<count($flied_image);$i++)
    if($line[$flied_main_table[$flied_image[$i]][0]]!='')
       $fl_img[]=$line[$flied_main_table[$flied_image[$i]][0]];

     echo'  <tr>
         <td class="table_1"><a href="'.$name_page_add_edit_main_table.'?action=edit&id='.$line[$flied_main_table[0][0]].'">
         <img src="images/b_edit.png"  alt="Редактировать" border=0>
         </a></td>
         <td class="table_1">
         <a onClick="return confirm(\'Вы действительно хотите статью  \')" href="'.$name_page_add_edit_main_table.'?action=del&id='.$line[$flied_main_table[0][0]].'&image='.@implode('|',$fl_img).'">
         <img src="images/b_drop.png"  alt="Удалить" border=0>
         </a></td>

       <td class="table_1">&nbsp;'.$line[$flied_main_table[5][0]].'</td>
       <td class="table_1">&nbsp;'.$line[$flied_main_table[4][0]].'</td>
       <td class="table_1">&nbsp;'.select_for_print('region_news','id_region_news','name_region_news',$line[$flied_main_table[1][0]]).'</td>
       <td class="table_1">&nbsp;'.select_for_print('category_news','id_category_news','name_category_news',$line[$flied_main_table[2][0]]).'</td>
       <td class="table_1">&nbsp;'.(($line[$flied_main_table[3][0]]==1)? 'топ':'--').'</td>
                </tr>';


     }
     echo '</table>';
}
 echo '<br><br>Страница была сгенирирована за '.(time()+microtime()-$start).' сек.';
?>