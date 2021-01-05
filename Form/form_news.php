<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-mos.css" title="green" />
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/calendar-ru.js"></script>
<script type="text/javascript" src="calendar/mambojavascript.js" ></script>
<script type="text/javascript" src="edit_text/edit_text.js" ></script>

<?php
	include_once('class_form.php');
	$form = new HTML_form();
	// установка парметров формы
	$form->name_form     = 'news' ;
	$form->method_form   = 'POST';
	$form->action_form   = $name_page_add_edit_main_table ;
	$form->enctype_form  = 'multipart/form-data';

	if (!isset($line[$flied_main_table[4][0]]))
		{
			$date_news = date('Y-m-d') ;
			$time_news = date('H:i') ;
		}
			else
				{
					$date_news = substr($line[$flied_main_table[4][0]],0,10 );
					$time_news = substr($line[$flied_main_table[4][0]],11,5 );
				}
					echo $form->set_form() ;
					// Дата
					echo $form ->hidden('id',@$_GET['id']);
					echo $form ->hidden('action_send',@$_GET['action']);
?>

<table  border="0" cellspacing="0" cellpadding="3" align="center">
	<tr>
		<td><?=$flied_main_table[4][2]?></td>
		<td>
		<?=$form->text_include('date_news',$date_news,'25','19','id="'.'date_news'.'" class="text_area" ');?>
		<?=$form->button_include('reset','reset','...',"class=\"button\" onClick=\"return showCalendar('".'date_news'."', 'y-mm-dd');\"")?>
		<?=$form->text('time_news',$time_news,10,10)?>
		</td>
	</tr>

	<tr>
		<td><?=$flied_main_table[2][2]?></td>
		<td> <?=$form->select_from_table_order('category_news','','id_category_news' ,'id_category_news' ,'name_category_news' ,$line[$flied_main_table[2][0]],'order_category_news' )?></td>
	</tr>

	<tr>
		<td><?=$flied_main_table[1][2]?></td>
		<td> <?=$form->select_from_table_order('region_news','','id_region_news' ,'id_region_news' ,'name_region_news' ,$line[$flied_main_table[1][0]],'order_region_news' )?></td>
	</tr>

	<tr>
		<td><?=$flied_main_table[5][2]?></td>
		<td>
			<?
			echo $form->textarea($flied_main_table[5][0],@$line[$flied_main_table[5][0]],'on',3,85).'&nbsp;';
			echo $form->button_include('button','','...','onClick="edit_text(\''.$form->name_form.'\',\''.$flied_main_table[5][0].'\')"');
			?>
		</td>
	</tr>

	<tr>
		<td><?=$flied_main_table[19][2]?></td>
		<td>
			<?
			echo $form->textarea($flied_main_table[19][0],@$line[$flied_main_table[19][0]],'on',10,85).'&nbsp;';
			echo $form->button_include('button','','...','onClick="edit_text(\''.$form->name_form.'\',\''.$flied_main_table[19][0].'\')"');
			?>
		</td>
	</tr>

	<tr>
		<td><?=$flied_main_table[20][2]?></td>
		<td>
			<?
			echo $form->textarea($flied_main_table[20][0],@$line[$flied_main_table[20][0]],'on',3,85).'&nbsp;';
			echo $form->button_include('button','','...','onClick="edit_text(\''.$form->name_form.'\',\''.$flied_main_table[20][0].'\')"');
			?>
		</td>
	</tr>

	<tr>
		<td><?=$flied_main_table[21][2]?></td>
		<td><?=$form->text($flied_main_table[21][0],@$line[$flied_main_table[21][0]],80,128)?></td>
	</tr>

	<tr>
		<td><?=$flied_main_table[22][2]?></td>
		<td><?=$form->text($flied_main_table[22][0],@$line[$flied_main_table[22][0]],80,128)?></td>
	</tr>

	<tr>
		<td><?=$flied_main_table[23][2]?></td>
		<td><?=$form->text($flied_main_table[23][0],@$line[$flied_main_table[23][0]],80,128)?></td>
	</tr>

	<?
		if (@$line[$flied_main_table[10][0]]!='')
			{
				echo'<tr>
						<td>Фото №1</td>
						<td>'.$form->show_picture($http_path,@$line[$flied_main_table[10][0]]).'</td>
					</tr>

					<tr>
						<td>Удалить старое Фото №1</td>
						<td>'.$form->hidden_old_picture($http_path,$flied_main_table[10][0],@$line[$flied_main_table[10][0]]).'</td>
					</tr>';
			}
	?>

	<tr>
		<td><?=$flied_main_table[10][2]?></td>
		<td><?=$form->upfile($flied_main_table[10][0])?></td>
	</tr>

	<tr>
		<td><?=$flied_main_table[14][2]?></td>
		<td><?=$form->text($flied_main_table[14][0],@$line[$flied_main_table[14][0]],80,128)?></td>
	</tr>

	<?
		if (@$line[$flied_main_table[11][0]]!='')
			{
			echo'<tr>
					<td>Фото №2</td>
					<td>'.$form->show_picture($http_path,@$line[$flied_main_table[11][0]]).'</td>
				</tr>

				<tr>
					<td>Удалить старое Фото №2</td>
					<td>'.$form->hidden_old_picture($http_path,$flied_main_table[11][0],@$line[$flied_main_table[11][0]]).'</td>
				</tr>';
			}
	?>

	<tr>
		<td><?=$flied_main_table[11][2]?></td>
		<td><?=$form->upfile($flied_main_table[11][0])?></td>
	</tr>

	<tr>
		<td><?=$flied_main_table[15][2]?></td>
		<td><?=$form->text($flied_main_table[15][0],@$line[$flied_main_table[15][0]],80,128)?></td>
	</tr>

	<?
		if (@$line[$flied_main_table[12][0]]!='')
			{
				echo'<tr>
						<td>Фото №3</td>
						<td>'.$form->show_picture($http_path,@$line[$flied_main_table[12][0]]).'</td>
					</tr>

					<tr>
						<td>Удалить старое Фото №3</td>
						<td>'.$form->hidden_old_picture($http_path,$flied_main_table[12][0],@$line[$flied_main_table[12][0]]).'</td>
					</tr>';
			}
	?>

	<tr>
		<td><?=$flied_main_table[12][2]?></td>
		<td><?=$form->upfile($flied_main_table[12][0])?></td>
	</tr>

	<tr>
		<td><?=$flied_main_table[16][2]?></td>
		<td><?=$form->text($flied_main_table[16][0],@$line[$flied_main_table[16][0]],80,128)?></td>
	</tr>
	<?
		if (@$line[$flied_main_table[13][0]]!='')
			{
				echo'<tr>
						<td>Фото №4</td>
						<td>'.$form->show_picture($http_path,@$line[$flied_main_table[13][0]]).'</td>
					</tr>

					<tr>
						<td>Удалить старое Фото №4</td>
						<td>'.$form->hidden_old_picture($http_path,$flied_main_table[13][0],@$line[$flied_main_table[13][0]]).'</td>
					</tr>';
			}
	?>

	<tr>
		<td><?=$flied_main_table[13][2]?></td>
		<td><?=$form->upfile($flied_main_table[13][0])?></td>
	</tr>

	<tr>
		<td><?=$flied_main_table[17][2]?></td>
		<td><?=$form->text($flied_main_table[17][0],@$line[$flied_main_table[17][0]],80,128)?></td>
	</tr>

	<tr>
		<td colspan="2"  >&nbsp;</td>
	</tr>

	<tr height="1">
		<td colspan="2"  bgcolor='000000'></td>
	</tr>

	<tr>
		<td >&nbsp;</td>
	</tr>

	<tr>
		<td><?=$flied_main_table[3][2]?></td>
		<td><?=$form->checkbox($flied_main_table[3][0],'1',@$line[$flied_main_table[3][0]],1) ?> </td>
	</tr>

	<?
		if (@$line[$flied_main_table[9][0]]!='')
			{
				echo'<tr>
						<td>Фото №1</td>
						<td>'.$form->show_picture($http_path,@$line[$flied_main_table[9][0]]).'</td>
					</tr>

					<tr>
						<td>Удалить старое Фото №1</td>
						<td>'.$form->hidden_old_picture($http_path,$flied_main_table[9][0],@$line[$flied_main_table[9][0]]).'</td>
					</tr>';
			}
	?>

	<tr>
		<td><?=$flied_main_table[9][2]?></td>
		<td><?=$form->upfile($flied_main_table[9][0])?></td>
	</tr>

	<tr>
		<td>
		<?=$flied_main_table[18][2]?>
		</td>
		<td>
			<?
				echo $form->textarea($flied_main_table[18][0],@$line[$flied_main_table[18][0]],'on',5,85).'&nbsp;';
				echo $form->button_include('button','','...','onClick="edit_text(\''.$form->name_form.'\',\''.$flied_main_table[18][0].'\')"');
			?>
		</td>
  </tr>

	<tr>
		<td></td>
		<td><?
			if( $_GET['action']=='edit')   $name_button='Редактировать';
			if( $_GET['action']=='add')   $name_button='Добавить';
			echo $form ->button('submit','Submit_Main',$name_button) ?>
		</td>
	</tr>
</table>

 <?=$form->end_form()  ;?>
