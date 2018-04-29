This JSON feed was created/modified by Stephen Monro 2018.
bluetomatomedia.com

I know that JSON is currently not really supported much by podcasting software yet, but times are changing, and this is happening.
Plus, I also needed a solution that could do this, and I couldn't wait until someone else came up with a solution.

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
  


This script is originally based on the itunes-podcast-feed from Aaron Snoswell, this file creates JSON instread of RSS.
https://github.com/aaronsnoswell/itunes-podcast-feed


