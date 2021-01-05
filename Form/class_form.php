<?php
  //    HTML_form 0.0.0.1        <input name="Name" type="radio" value="" checked>
  class HTML_form
  {
    var $array_set_form;
    var $print_HTML_form='';

        var $name_form       ;
        var $method_form    ;  // Создание выпадающего списка из массива
        var $action_form   ;
        var $enctype_form   ;
        var $inc   ;

function textarea_t($name_textarea,$value_textarea,$wrap,$rows,$cols){
        $print_to_HTML= '<!-- tinyMCE -->
	                    <script language="javascript" type="text/javascript" src="./tiny_mce/tiny_mce.js"></script>
	                    <script language="javascript" type="text/javascript">
	tinyMCE.init({
		theme : "advanced",
		mode : "exact",
		elements : "elm1,elm2,keywords_firm",
		save_callback : "customSave",
		content_css : "example_advanced.css",
		extended_valid_elements : "a[href|target|name]",
		plugins : "table",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		//invalid_elements : "a",
		theme_advanced_styles : "Header 1=header1;Header 2=header2;Header 3=header3;Table Row=tableRow1", // Theme specific setting CSS classes
		//execcommand_callback : "myCustomExecCommandHandler",
		debug : false
	});

	// Custom event handler
	function myCustomExecCommandHandler(editor_id, elm, command, user_interface, value) {
		var linkElm, imageElm, inst;

		switch (command) {
			case "mceLink":
				inst = tinyMCE.getInstanceById(editor_id);
				linkElm = tinyMCE.getParentElement(inst.selection.getFocusElement(), "a");

				if (linkElm)
					alert("Link dialog has been overriden. Found link href: " + tinyMCE.getAttrib(linkElm, "href"));
				else
					alert("Link dialog has been overriden.");

				return true;

			case "mceImage":
				inst = tinyMCE.getInstanceById(editor_id);
				imageElm = tinyMCE.getParentElement(inst.selection.getFocusElement(), "img");

				if (imageElm)
					alert("Image dialog has been overriden. Found image src: " + tinyMCE.getAttrib(imageElm, "src"));
				else
					alert("Image dialog has been overriden.");

				return true;
		}

		return false; // Pass to next handler in chain
	}

	// Custom save callback, gets called when the contents is to be submitted
	function customSave(id, content) {
		//alert(id + "=" + content);
	}
</script>
<!-- /tinyMCE -->';
        $print_to_HTML.=  '<textarea name="'.$name_textarea.'" rows='.$rows.' cols='.$cols.' wrap="'.$wrap.'">'.$value_textarea.'</textarea>';
        return $print_to_HTML;
    }


   function set_form()
    {
      $print_to_HTML='<form name="'.$this->name_form.'" method="'.$this->method_form.'" action="'.$this->action_form.'" enctype="'.$this->enctype_form.'"  '.$this->inc.'>';

      return $print_to_HTML;
    }

    function end_form()
    {
      $print_to_HTML='</form>';

      return $print_to_HTML;
    }
   // для создания из массива выпадающего меню
    function select_from_array($name_select,$array_select,$selected)
    {
       $print_to_HTML='<select size="1" name="'.$name_select.'">';

       foreach($array_select as $v=>$k)
       {
        if($v==$selected){$s ='selected';}else{$s='';};
        $print_to_HTML.= '<option value="'.$v.'" '.$s.' >'.$k.'</option>';
       }

       $print_to_HTML.='</select>' ;
     return $print_to_HTML;
    }

    function select_from_array2($name_select,$array_select,$selected,$action='',$plus_k='',$plus_v='')
    {
       $print_to_HTML='<select size="1" name="'.$name_select.'" "'.$action.'">';
       $sl='';
       if($plus_k && $plus_v){
      	if($selected==$plus_k){$sl=' selected';}
      	$print_to_HTML.= "<option value=\"".$plus_k."\"".$sl.">".$plus_v."</option>\n";
      }
       foreach($array_select as $v=>$k)
       {
        if($v==$selected && $sl==''){$s ='selected';}else{$s='';};
        $print_to_HTML.= '<option value="'.$v.'" '.$s.' >'.$k.'</option>';
       }

       $print_to_HTML.='</select>' ;
     return $print_to_HTML;
    }
//==============================================================================
  function radio($name, $static_val, $checked_val)
  {
   $print_to_HTML = '<input name="'.$name.'" type="radio" value="'.$static_val.'" '.(($static_val==$checked_val)? 'checked' :'').'>';
   return $print_to_HTML;
  }


//==============================================================================

  function select_from_table1($name_table,$where,$action,$name_select,$id_from_select,$file_from_name,$num_select,$order_by,$order="DESC")
  {
     $select = "<select name=\"$name_select\" $action> \n"   ;
      fast_conect_to_bd();


      $query  = "SELECT * FROM `".$name_table."` ".$where." ORDER BY `".$order_by."` $order ";
      $result = @mysql_query($query) or die(mysql_error());

     while($line = mysql_fetch_assoc($result) )
     {
       if (($line[$id_from_select]+0)==$num_select)
       {
       $select.= "<option value=\"".$line[$id_from_select]."\" selected>".$line[$file_from_name]."</option>\n";
       }
       else
       {
        $select.=  "<option value=\"".$line[$id_from_select]."\">".$line[$file_from_name]."</option>\n";

       }

     }
     $select.=  "</select>\n";
    // mysql_free_result($result);
    // mysql_close($conect);

     return $select  ;
   }

//===========================================================================

  function select_from_table_null($name_table,$where,$action,$name_select,$id_from_select,$file_from_name,$num_select,$nul_select,$order_by,$order="DESC",$plus_k='',$plus_v='')
  {
    $select = "<select name=\"$name_select\" $action> \n";
    $sl='';
      if($plus_k && $plus_v){
      	if($num_select==$plus_k){$sl=' selected';}
      	$select.= "<option value=\"".$plus_k."\"".$sl.">".$plus_v."</option>\n";
      }
      if(($num_select+0)==0 && $sl==''){
      	$select.= "<option value=\"0\" selected>".$nul_select."</option>\n";
      }else{      	$select.= "<option value=\"0\">".$nul_select."</option>\n";
      }
      fast_conect_to_bd();


      $query  = "SELECT * FROM `".$name_table."` ".$where." ORDER BY `".$order_by."` $order ";
      $result = @mysql_query($query) or die(mysql_error());

     while($line = mysql_fetch_assoc($result) )
     {
       if (($line[$id_from_select]+0)==$num_select)
       {
       $select.= "<option value=\"".$line[$id_from_select]."\" selected>".$line[$file_from_name]."</option>\n";
       }
       else
       {
        $select.=  "<option value=\"".$line[$id_from_select]."\">".$line[$file_from_name]."</option>\n";

       }

     }
     $select.=  "</select>\n";
    // mysql_free_result($result);
    // mysql_close($conect);

     return $select  ;
   }
   //==============================================================================

  function select_from_table_order($name_table,$where,$name_select,$id_from_select,$file_from_name,$num_select,$order_by,$order="ASC")
  {
    $select = "<select name=\"$name_select\"> \n"   ;

      fast_conect_to_bd();

      $query  = "SELECT * FROM `".$name_table."` ".$where." ORDER BY `".$order_by."` $order";
      $result = @mysql_query($query) or die(mysql_error());

     while($line = mysql_fetch_assoc($result) )
     {
       if (($line[$id_from_select]+0)==$num_select)
       {
       $select.= "<option value=\"".$line[$id_from_select]."\" selected>".$line[$file_from_name]."</option>\n";
       }
       else
       {
        $select.=  "<option value=\"".$line[$id_from_select]."\">".$line[$file_from_name]."</option>\n";

       }

     }
     $select.=  "</select>\n";
    // mysql_free_result($result);
    // mysql_close($conect);

     return $select  ;
   }
//=============================================================================
  function select_simple_from_table($name_table,$name_select,$id_from_select,$file_from_name,$num_select)
  {
    $select = "<select name=\"$name_select\" > \n"   ;
      fast_conect_to_bd();


     $query  = "SELECT * FROM `".$name_table."` ";
      $result = @mysql_query($query) or die(mysql_error());

     while($line = mysql_fetch_assoc($result) )
     {
       if (($line[$id_from_select]+0)==$num_select)
       {
      $select.= "<option value=\"".$line[$id_from_select]."\" selected>".$line[$file_from_name]."</option>\n";
       }
       else
       {
       $select.=  "<option value=\"".$line[$id_from_select]."\">".$line[$file_from_name]."</option>\n";

       }

     }
     $select.=  "</select>\n";
    // mysql_free_result($result);
    // mysql_close($conect);

     return $select  ;
   }
//------------------------------------------------------------------------------
  function show_picture($http_path, $name_image)
  {
     if ($name_image!='')
     {

     $print_to_HTML = '<img src="'.@$http_path.'/'.@ $name_image.'" >';
     }
     else
     {
     $print_to_HTML = '';
     }
     return $print_to_HTML ;
  }
//------------------------------------------------------------------------------
  function show_swf($http_path, $name_swf,$height_pixel,$width_pixel)
  {
    $print_to_HTML ='
   <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="'.$width_pixel.'" height="'.$height_pixel.'">
    <param name=movie value="'.@$http_path.'/'.$name_swf.'">
    <param name=quality value=high>
    <embed src="'.@$http_path.'/'.$name_swf.'" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="429" height="62">
    </embed>
  </object>
   ';
   return $print_to_HTML ;

   }
  function hidden_old_picture($http_path, $name_flied_image,$name_image)
  {

     if ($name_image!='')
     {
      $print_to_HTML =  '    <input name="del_'.$name_flied_image.'" type="checkbox" value="ON">
                             <input name="old_'.$name_flied_image.'" type="hidden" value="'.$name_image.'">
                             ';
     }
     else
     {
       $print_to_HTML = '';
     }
       return $print_to_HTML ;
  }




//------------------------------------------------------------------------------

   // для выпадающие меню для года с пустым полем
   /* function select_year_null($first_year,$name_select,$selected)
    {
      $print_to_HTML='<select size="1" name="'.$name_select.'">';

      $y='';
      $s=($y==$selected)?'selected':'';
      $print_to_HTML.= '<option value="'.$y.'" '.$s.' >'.$y.'</option>';

      for($y=$first_year; $y<=date('Y');$y++)
       {
        $s=($y==$selected)?'selected':'';
        $print_to_HTML.= '<option value="'.$y.'" '.$s.' >'.$y.'</option>';
       }

       $print_to_HTML.='</select>' ;
     return $print_to_HTML;
    }
   // для выпадающие меню для месыца с пустым полем
   /* function select_month_null($name_select,$array_select,$selected)
    {
       $print_to_HTML='<select size="1" name="'.$name_select.'">';

       foreach($array_select as $v=>$k)
       {
        if($v==$selected){$s ='selected';}else{$s='';};
        $print_to_HTML.= '<option value="'.$v.'" '.$s.' >'.$k.'</option>';
       }

       $print_to_HTML.='</select>' ;
     return $print_to_HTML;
    }
     */
   // для кнопки
    function button($type_button,$name_button,$value_button)
    {
       $print_to_HTML='<input type="'.$type_button.'" name="'.$name_button.'" value="'.$value_button.'">';

       return $print_to_HTML;
    }

    function button_include($type_button,$name_button,$value_button,$include_button)
    {
       $print_to_HTML='<input type="'.$type_button.'" name="'.$name_button.'" value="'.$value_button.'" '.$include_button.'>';

       return $print_to_HTML;
    }
   // для текстового поля
    function text($name_text,$value_text,$size,$maxlength)
    {
       $print_to_HTML='<input type="text" name="'.$name_text.'" value="'.$value_text.'" size="'.$size.'" maxlength="'.$maxlength.'">';

       return $print_to_HTML;
    }
    function text_include($name_text,$value_text,$size,$maxlength,$include_text)
    {
       $print_to_HTML='<input type="text" name="'.$name_text.'" value="'.$value_text.'" size="'.$size.'" maxlength="'.$maxlength.'" '.$include_text.'>';
       return $print_to_HTML;
    }

   // для скрытого поля
    function hidden($name_hidden,$value_hidden)
    {
       $print_to_HTML='<input type="hidden" name="'.$name_hidden.'" value="'.$value_hidden.'">';
       return $print_to_HTML;
    }

   // для пароля
    function password($name_password,$value_password,$size,$maxlength)
    {
       $print_to_HTML='<input  type="password"  name="'.$name_password.'" value="'.$value_password.'" size="'.$size.'" maxlength="'.$maxlength.'">';
       return $print_to_HTML;
    }
    // для скрытого поля
    function checkbox($name_checkbox,$value_checkbox,$checked,$compare)
    {
       $print_to_HTML='<input type="checkbox" name="'.$name_checkbox.'" value="'.$value_checkbox.'" '.((isset($checked) and $checked==$compare)?'checked':'').'>';
       return $print_to_HTML;
     }

    function textarea($name_textarea,$value_textarea,$wrap,$rows,$cols)
    {
     $print_to_HTML=  '<textarea name="'.$name_textarea.'" rows='.$rows.' cols='.$cols.' wrap="'.$wrap.'">'.$value_textarea.'</textarea>';
      return $print_to_HTML;
    }

    function upfile($name_upfile, $size=20)
    {
     $print_to_HTML=  '<input type="file"  size="'.$size.'" name="'.$name_upfile.'">';
      return $print_to_HTML;
    }

    function upfile_size($name_upfile, $size)
    {
     $print_to_HTML=  '<input type="file"  size="'.$size.'"name="'.$name_upfile.'">';
      return $print_to_HTML;
    }
  } ;



?>