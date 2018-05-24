<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo (isset($title))?$title:'VoiceboxIt';?></title>
   
      <script type="text/jscript">
		var base_url = '<?php echo BASE_URL;?>';
	  </script>
  </head>
  <body>
  
  	<div><?php echo (!empty($header))?$header:'';?></div>
    
    <div><?php echo (!empty($layout_content))?$layout_content:'';?></div>
    
    <div><?php echo (!empty($footer))?$footer:'';?></div>
    
  </body>
</html>