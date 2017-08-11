<div class="wrap"> 
 <?php    echo "<div id='icon-tools' class='icon32'></br></div><h2>" . __( 'Opciones de Donostiblogs', 'dblogs_trdom' ) . "</h2>"; ?>
<div style='float:right;'>
 <h3>Editar color de la barra</h3>
<form method="post" action="options.php">
            <?php settings_fields('donostiblogs_opciones_options'); ?>
            <?php $options = get_option('dblog_sample'); ?>
             <INPUT name="dblog_sample[option1]" TYPE="radio" NAME="equipos" VALUE="0" <?php checked('0', $options['option1']); ?>>Blanca
             </BR><INPUT name="dblog_sample[option1]" TYPE="radio" NAME="equipos" VALUE="1" <?php checked('1', $options['option1']); ?>>Gris Oscuro
             </BR><INPUT name="dblog_sample[option1]" TYPE="radio" NAME="equipos" VALUE="2" <?php checked('2', $options['option1']); ?>>Azul
             </br><p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>
</FORM>
       <!-- <form method="post" action="options.php">
            <?php settings_fields('donostiblogs_opciones_options'); ?>
            <?php $options = get_option('dblog_sample'); ?>
            <table class="form-table">
                <tr valign="top"><th scope="row">Barra oscura:</th>
                    <td><input name="dblog_sample[option1]" type="checkbox" value="1" <?php checked('1', $options['option1']); ?> /></td>
                </tr>
                <tr valign="top"><th scope="row">Rellenar con texto para otra opci?n</th>
                    <td><input type="text" name="dblog_sample[sometext]" value="<?php echo $options['sometext']; ?>" /></td>
                </tr>
            </table>
            <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>-->
</div>

   
<?php  		echo "

<p><b>IMPORTANT:</b> Installing this plugin your accept having external links to other sites with related content.
</br><b>IMPORTANTE:</b> Al instalar este plugin aceptas tener vinculos a otras p&aacute;ginas de contenido relacionado.</p>

<table cellspacing='12px'><tr>
<td>
<img src='http://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Bandera_de_Donostia-San_Sebasti%C3%A1n_%28Guip%C3%BAzcoa%2C_Espa%C3%B1a%29.svg/800px-Bandera_de_Donostia-San_Sebasti%C3%A1n_%28Guip%C3%BAzcoa%2C_Espa%C3%B1a%29.svg.png' widht='100px' height='60px' style='float: left
; border:1px solid black;'>

</td>
<td>
	<p>Este plugin est&aacute; en fase beta, se actualizar&aacute; con frecuencia.</p>
	<p>Los blogs los a&ntilde;ado desde mi web, y se actualizan en todas las webs que tengan este plugin instalado.</p>
	<p>Los iconos correspondientes los ir&aacute;s viendo aparecer en la barra directamente.</p>
	<p>Estoy a&ntilde;adiendo opciones, que aparecer&aacute;n aqu&iacute;, para a&ntilde;adir las p&aacute;ginas que cada uno quiera poner.</p>
</td>
</tr></table>
<a href='http://www.donostiblogs.com' target='_blank'><b>P&aacute;gina web Donostiblogs</b></a>
</br>
</br>
<h3> Lista de blogs a&ntilde;adidos</h3>
";
 ?>  

<?php

function dblog_panel(){       
   global $wpdb; 
   $table_name = $wpdb->prefix . "donostiblogs";
   if(isset($_POST['dblogs_inserta'])){   
         $sql = "INSERT INTO $table_name (dblog) VALUES ('{$_POST['dblogs_inserta']}');";
         $wpdb->query($sql);
   }
}

  $url="http://dl.dropbox.com/u/2778128/donostiblogs.html";  //automaticamente se actualiza con mi archivo y aparecen los nuevos blogs
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_HEADER, 0);  // ignore any headers
  ob_start();  // use output buffering so the contents don't get sent directly to the browser
  curl_exec($curl);  // get the file
  curl_close($curl);
  $file = ob_get_contents();  // save the contents of the file into $file
  ob_end_clean();  // turn output buffering back off
	
  	$salida = str_replace("<td", "</tr><tr><td", $file);
	$salida = str_replace("<div id='mostrar' style='position: fixed;text-decoration: none; top: 3px; left: 3px;z-index:6000;'>
<a href='javascript:cerrar();'><img style='border:none;padding:0px; margin:0px;' src='http://dl.dropbox.com/u/2778128/arriba.gif'></img></a>
 | <a href='javascript:mostrardiv();'><img style='border:none; padding:0px; margin:0px;' src='http://dl.dropbox.com/u/2778128/abajo.gif'></img></a>
</div>", "", $salida);
	$salida = str_replace("<div id='barrablogs'>
<div style='float:left; margin-left:100px; vertical-align:middle;'><a href='http://www.donostiblogs.com'>
<img style='vertical-align:middle;' class='barra1' src='http://dl.dropbox.com/u/2778128/donostiblogs/donostia.jpg'></a>
<span id='titulo'>Donostiblogs</span></div>
", "
<table class='widefat' style='width:420px;'>
<thead><tr><th><a href='http://www.donostiblogs.com'>
<img style='vertical-align:middle;' src='http://dl.dropbox.com/u/2778128/donostiblogs/donostia.jpg'>Donostiblogs</a></th></tr></thead>
", $salida);
	$salida = str_replace("<td style='color: black; font-weight: bold; font-size:12px; text-align:top;'>&nbsp;</td>", "", $salida);
        $salida = str_replace("</div></div>", "</table>", $salida);
        $salida = str_replace("<table class='tablabarra' border='0' style='margin-left:30%; margin-right:auto; vertical-align:center;' cellpadding='0px' cellspacing='0px'>", "<tbody>", $salida);
       $salida = str_replace("</tr></table>", "</tr></tbody>", $salida);
	//$salida = str_replace("style='margin-left:30%; margin-right:40%;", "style='margin-left:0px; margin-right:0px;", $salida);
	//$salida = str_replace("style='float:left; margin-left:100px;", "style='margin-left:0px;", $salida);

        echo $salida;
echo $dblog; 
?>
</br>
<p>
Si quieres a&ntilde;adir alguno m&aacute;s escribeme a:<b>caballero@tellodibujo.com</b>
</br><img src='http://sphotos.ak.fbcdn.net/hphotos-ak-snc4/hs1183.snc4/150546_167484456615858_124291604268477_382194_5198642_n.jpg' width='50' height='50'>

</div> 
 
        

