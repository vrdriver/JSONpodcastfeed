This JSON feed was created/modified by Stephen Monro 2018.
bluetomatomedia.com

I know that JSON is currently not really supported much by podcasting software yet, but times are changing, and this is happening.
Of all the solutions I found, they were able to import or convert an RSS to JSON. This was no good, as I needed a native non-coversion solution.
There is no XML in this, and the way of the future looks like it's JSON.
I also needed a solution that could do this, and I couldn't wait until someone else came up with a solution.

To use:
Put this file in your path with mp3 files, configure the file and you will then get a json file with a list of the mp3 files.
Just remember to look at the config settings in the file, otherwise it won't work correctly.

I also strongly suggest installing getID3 in the same path as well.
http://getid3.sourceforge.net/

Your path should then look something like this:

  \getid3\
  A.mp3
  B.mp3
  C.mp3
  json.php
  S.mp3
  T.mp3
  

Sample JSON:

{
    "version": "https://jsonfeed.org/version/1",
    "user_comment": "A description of the feed",
    "title": "A title of the feed",
    "home_page_url": "https://mycoolwebsite.com",
    "feed_url": "https://mycoolwebsite.com/audio/json.php",
    "items":
    [
        
		{
			"id": "",
			"title": "",
			"url": "https://mycoolwebsite.com",
			"content_text": "",
			"content_html": "",
			"summary": "",
			"date_published": "Sun, 29 Apr 2018 09:45:45 +0000",
			"attachments":
			[
				{
				    "url": "https://mycoolwebsite.com/audio/raw1.mp3",
				    "mime_type": "audio/mpeg",
				    "size_in_bytes": 58365724,
				    "duration_in_seconds": "24:19"
				}
			]
		}
		,
		{
			"id": "",
			"title": "",
			"url": "https://mycoolwebsite.com",
			"content_text": "",
			"content_html": "",
			"summary": "",
			"date_published": "Sun, 29 Apr 2018 09:43:36 +0000",
			"attachments":
			[
				{
				    "url": "https://mycoolwebsite.com/audio/raw2.mp3",
				    "mime_type": "audio/mpeg",
				    "size_in_bytes": 54619318,
				    "duration_in_seconds": "22:45"
				}
			]
		}
  ]
}

This script is originally based on the itunes-podcast-feed from Aaron Snoswell, this file creates JSON instread of RSS.
https://github.com/aaronsnoswell/itunes-podcast-feed


