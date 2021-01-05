<html>
  <link rel="stylesheet" href="../css.css" type="text/css">
  <body>
    <h1>Редактирование текста</h1>
    <div align=center>
      <script>
        function Post()
          {
            document.myform.message.value = newTextArea.document.body.innerHTML;
            opener.document.<?=$_GET['form']?>.<?=$_GET['flied']?>.value = newTextArea.document.body.innerHTML;
            window.opener.focus()
            window.close();
          }

        function EditorExecCommand( command_param )
          {
            var tr = frames.newTextArea.document.selection.createRange();
            tr.select();
            tr.execCommand( command_param );
            frames.newTextArea.focus();
          }
      </script>

      <form name="myform" method="POST">
        <input type="hidden" name="message">
      </form>

      <table width="100%"  border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td>
            <div align="center">
              <input type="button"   style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/bold.gif);  "
              title='полужирный'       onClick="EditorExecCommand( 'Bold' );" >

              <input type="button"   style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/italic.gif);  "
              title='курсив'  onClick="EditorExecCommand( 'Italic' );" >

              <input type="button"   style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/underline.gif);  "
              title='подчёркнутый' onClick="EditorExecCommand( 'Underline' );" >

              &nbsp; &nbsp;

              <input type="button"
              style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/left.gif);  "
              title='по левому краю' onClick="EditorExecCommand( 'JustifyLeft' );">

              <input type="button"
              style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/center.gif);  "
              title='по центру' onClick="EditorExecCommand( 'JustifyCenter' );" value="">

              <input type="button"
              style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/right.gif);  "
              title='по правому краю' onClick="EditorExecCommand( 'JustifyRight' );" value="">

              <input type="button"
              style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/justify.gif);  "
              title='по ширине' onClick="EditorExecCommand( 'JustifyFull' );" value="">

              &nbsp; &nbsp;

              <input type="button"
              style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/copy.gif);  "
              title='копировать' onClick="EditorExecCommand( 'Copy' );" value="">

              <input type="button"
              style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/paste.gif);  "
              title='вставить' onClick="EditorExecCommand( 'Paste' );" value="">

              <input type="button"
              style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/cut.gif);  "
              title='вырезать' onClick="EditorExecCommand( 'Cut' );" value="">

              <input type="button"
              style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/ahref.gif);  "
              title='вырезать' onClick="EditorExecCommand( 'CreateLink' );" value="">

              &nbsp;  &nbsp;
              &nbsp;  &nbsp;

              <input type="button"
              style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/ol.gif);  "
              title='нумерация'  onClick="EditorExecCommand( 'InsertOrderedList' );" value="">

              <input type="button"
              style=" BORDER:   #4C709D 1px solid; width:22px;height:22px; background-image:url(image_panel/ul.gif);  "
              title='маркеры' onClick="EditorExecCommand( 'InsertUnorderedList' );" value="">
            </div>
          </td>
        </tr>

        <tr>
          <td>
            <iframe width="100%" height="450" id="newTextArea" name="newTextArea" frameborder="0 | 0"
              style="{
                BORDER-LEFT:   #4C709D 1px solid; BORDER-RIGHT:  #4C709D 1px solid;
                BORDER-TOP:    #4C709D 1px solid; BORDER-BOTTOM: #4C709D 1px solid;
                font-family: verdana, arial; font-weight: regular; color: #226792; text-decoration: underline;
              }"
              >
            </iframe>
          </td>
        </tr>
      </table>

      <input onClick='Post()' type='button' value='Изменить'
      style=" BORDER:   #4C709D 1px solid; width:100 px;height:22px;  font: bold 14px Tahoma  "   >

      <script>
        newTextArea.document.designMode = "on";
        newTextArea.document.open();
        newTextArea.document.writeln(opener.document.<?=$_GET['form']?>.<?=$_GET['flied']?>.value);
        newTextArea.document.close();
      </script>
    </div>
  </body>
</html>
