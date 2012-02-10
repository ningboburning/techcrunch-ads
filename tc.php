<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="refresh" content="600">
  <title>Techcrunch Without Ads</title>
  <link rel="author" mailto:skyahead@gmail.com />
  <link rel="stylesheet" href="style.css" type="text/css" media="screen" />

  <style type="text/css">
	  div.body-copy {
	  width: 90%;
	  margin-left: 50px;
  }

  </style>

<!-- 
  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-4959325-2']);
    _gaq.push(['_trackPageview']);
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>
 -->

</head>


<body id="techcrunch"> 


<?php
    $link = 'http://techcrunch.com';

    $title_tag = 'h2';
    $title_attrname = 'class';
    $title_attrvalue = 'headline';

    $pic_tag = 'div';
    $pic_attrname = 'class';
    $pic_attrvalue = 'media-container media-loading';

    $intr_tag = 'div';
    $intr_attrname = 'class';
    $intr_attrvalue = 'body-copy';

    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = false;
    @$dom->loadHTMLFile($link);

    $html = getit( $dom, $title_tag, $title_attrname, $title_attrvalue, $pic_tag, $pic_attrname, $pic_attrvalue, $intr_tag, $intr_attrname, $intr_attrvalue );
    $html = str_replace('class="body-copy"', 'class="body-copy" align="left"', $html);
    echo $html;

    
    function getit($dom, $title_tag, $title_attrname, $title_attrvalue, $pic_tag, $pic_attrname, $pic_attrvalue, $intr_tag, $intr_attrname, $intr_attrvalue ){
		$html = '';
		$domxpath = new DOMXPath($dom);
		$newDom = new DOMDocument;
		$newDom->formatOutput = true;
	
		$filtered_title = $domxpath->query("//$title_tag" . '[@' . $title_attrname . "='$title_attrvalue']");
		$filtered_pic 	= $domxpath->query("//$pic_tag" . '[@' . $pic_attrname . "='$pic_attrvalue']");
		$filtered_intr 	= $domxpath->query("//$intr_tag" . '[@' . $intr_attrname . "='$intr_attrvalue']");
	
		$i = 0;
		while( $myItem = $filtered_intr->item($i++) ){
			$node_title = $newDom->importNode( $filtered_title->item($i-1), true );    
			$node_pic 	= $newDom->importNode( $filtered_pic->item($i-1), true );    
			$node_intr 	= $newDom->importNode( $myItem, true );    
			$newDom->appendChild($node_title);                    
			//$newDom->appendChild($node_pic);                    
			$newDom->appendChild($node_intr);                    
		}
		$html = $newDom->saveHTML();
	
		return $html;
    }

?>
</body>
</html>
