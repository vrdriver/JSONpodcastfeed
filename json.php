<?php 
/*
 * A JSON Feed to display MP3 files.
 * Updated by Stephen Monro
 * bluetomatomedia.com
 *
 * NOPE ---- iTunes-Compatible RSS 2.0 MP3 subscription feed script ----
 * Original work by Rob W of http://www.podcast411.com/
 * Updated by Aaron Snoswell (aaronsnoswell@gmail.com)
 *
 * Recurses a given directory, reading MP3 ID3 tags and generating an itunes
 * compatible RSS podcast feed.
 *
 * Save this .php file wherever you like on your server. The URL for this .php
*/

//error_reporting(E_ALL); 
//ini_set('display_errors', '1');

/* 
 * CONFIGURATION VARIABLES:
 * For more info on these settings
 *
 * JSON SCHEMA: https://jsonfeed.org/version/1
 
 */
// ============================================
// General Configuration Options
// Location of MP3's on server. TRAILING SLASH REQ'D.
$files_dir = "/home/server/yourlocation.com/audio/";
$files_dir = getcwd().'/';
// Corresponding url for accessing the above directory. TRAILING SLASH REQ'D.
$files_url = "https://website.com/audio/";
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
    $protocol = 'http://';
} else {
    $protocol = 'https://';
}
$base_url = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']);
$files_url = $base_url.'/';
// Location of getid3 folder, leave blank to disable. TRAILING SLASH REQ'D.
$getid3_dir = "getid3/";
// ======================================================
// Generic feed options
// Your feed's title
$feed_title = "My Cool Site";
// 'More info' link for your feed
$feed_link = "https://website.com/audio/json.php";
// homepage
$home_page = "https://website.com/";
// Brief description
$feed_description = "This JSON feed is amazing!";
// Copyright / license information
$feed_copyright = "All content &#0169; YOUR COOL BUSINESS" . date("Y");
// How often feed readers check for new material (in seconds) -- mostly ignored by readers
$feed_ttl = 60 * 60 * 24;
// Language locale of your feed, eg en-us, de, fr etc. See http://www.rssboard.org/rss-language-codes
$feed_lang = "en-au";
// ==============================================
// NOPE iTunes-specific feed options
// You, or your organisation's name
$feed_author = "REALLY COOL AUTHOR";
// Feed author's contact email address
$feed_email="";
// Url of a 170x170 .png image to be used on the iTunes page
$feed_image = "";
// If your feed contains explicit material or not (yes, no, clean)
$feed_explicit = "clean";
// iTunes major category of your feed
$feed_category = "Religion &amp; Spirituality";
// iTunes minor category of your feed
$feed_subcategory = "Christianity";
// END OF CONFIGURATION VARIABLES
// If getid3 was requested, attempt to initialise the ID3 engine
$getid3_engine = NULL;
if(strlen($getid3_dir) != 0) {
    require_once($getid3_dir . 'getid3.php');
    $getid3_engine = new getID3;
}
 
?>
{
    "version": "https://jsonfeed.org/version/1",
    "user_comment": "<? echo $feed_description; ?>",
    "title": "<? echo $feed_title; ?>",
    "home_page_url": "<?php echo $home_page; ?>",
    "feed_url": "<? echo $feed_link; ?>",
    "items":
    [
        <?php
	// <!-- The file listings -->
        // Step through file directory
 
	$tooutput = "";
        $files = scandir($files_dir);
        sort($files); 
    
        foreach ($files as $file) 
	{
            $file_path = $files_dir . $file;
            // not . or .., ends in .mp3
	    
            if(is_file($file_path) && strrchr($file_path, '.') == ".mp3")
	    {
                // Initialise file details to sensible defaults
                $file_title = $file;
                $file_url = $files_url . $file;
                $file_author = $feed_author;
                $file_duration = "";
                $file_description = "";
                $file_date = date(DateTime::RFC2822, filemtime($file_path));
                $file_size = filesize($file_path);
                // Read file metadata from the ID3 tags
                if(!is_null($getid3_engine))
		{
                    $id3_info = $getid3_engine->analyze($file_path);
                    getid3_lib::CopyTagsToComments($id3_info);                    
                    
                    if(isset($id3_info["comments_html"]["title"][0]))
                    {
                    $file_title = $id3_info["comments_html"]["title"][0];
                    } else  $file_title  = "";
                    
                    
			if(isset($id3_info["comments_html"]["artist"][0]))
			{
				$file_author = $id3_info["comments_html"]["artist"][0];
			} else  $file_title  = "";
			
			if(isset($id3_info["playtime_string"]))
			{
				$file_duration = $id3_info["playtime_string"];
			} else  $file_title  = "";
		}		
		echo $tooutput . "\n";
		?>
		{
			"id": "",
			"title": "<? echo $file_title; ?>",
			"url": "<?php echo $home_page; ?>",
			"content_text": "",
			"content_html": "",
			"summary": "<? echo $file_description; ?>",
			"date_published": "<? echo $file_date; ?>",
			"attachments":
			[
				{
				    "url": "<? echo $file_url; ?>",
				    "mime_type": "audio/mpeg",
				    "size_in_bytes": <? echo $file_size; ?>,
				    "duration_in_seconds": "<? echo $file_duration; ?>"
				}
			]
		}
		<?php		 
		$tooutput = ","; 
            }
        }
        closedir($directory);
        ?> 
	]
}
