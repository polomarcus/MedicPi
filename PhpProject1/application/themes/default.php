<!DOCTYPE html>
<html lang="fr" dir="ltr" class="client-nojs">
    <head>
        <title>Medic Pi</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php foreach($css as $url): ?>
      	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
		<?php endforeach; ?>
    </head>
 
    <body>
        <div id="contenu">
            <?php echo $output; ?>
        </div>
        
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
     	<?php foreach($js as $url): ?>
       	 <script type="text/javascript" src="<?php echo $url; ?>"></script> 
		<?php endforeach; ?>
    </body>
 
</html>