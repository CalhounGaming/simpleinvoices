

<div class="CFile CTopic" id=MainTopic><h1 class=CTitle><a name="Language check"></a>Language check</h1><div class=CBody>

<p class=CParagraph>
<?php

		$fp = fopen("http://simpleinvoices.googlecode.com/svn/trunk/lang/lang_check.html", "r" );
		if(!$fp)
		{
		    echo "Couldn't open the data file. Try again later.";
		    exit;
		}
		$filename ="./demo/documentation/ReadMe.english_UK.html";
		$display_block .= fread( $fp, filesize( $filename ) );

                echo $display_block;
?>


</div></div>

</div><!--Content end-->