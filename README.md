NDE
===

Reading all the data from Winamp Media Library in PHP
-----------------------------------------------------

Winamp use a system called the "Nullsoft Database Engine" to store you media
library data. Basically everything is stored in two files (main.dat and main.idx).
The main class will help you to read the content of this database

    $path_to_winamp = 'C:\Users\Administrateur\AppData\Roaming\Winamp\Plugins\ml';

    $winamp = new WinampDb( $path );

    while( $song = $winamp->next() ) {
        // -- all known fields are available (artist, album, year, filename...)
        echo "Song: " . $song['title'] . "\n";
    }

You can also get all songs at a time in an array

    $winamp = new WinampDb( $path );
    $all_songs = $winamp->all();

Be smart, call close when finished...

    $winamp->close();

Credits
-------

This work is greatly inspired from the work of Daniel15 [http://www.d15.biz/](http://www.d15.biz/),
on the project [ndephp](https://code.google.com/p/ndephp/)

My work is more concentraded on

  * testability (100% coverage)
  * respect [Symfony2 coding standards](http://symfony.com/doc/current/contributing/code/standards.html)
  * working easily with composer and packagist, just require the neuralys/nde package, and you're up
