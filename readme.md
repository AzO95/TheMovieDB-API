TheMovieDB-API
=========

Simple class API themoviedb.

Example
--------------

```sh
$movies = new TheMovieDB("YOUR_API_KEY");
$movies->searchMovie('X-Men');
print_r($movies);
```

```sh
Array
(
    [page] => 1
    [results] => Array
        (
            [0] => Array
                (
                    [adult] =>
                    [backdrop_path] => /xm75A18CE7Wc6J9k2ZidFyqJ6rX.jpg
                    [id] => 36657
                    [original_title] => X-Men
                    [release_date] => 2000-07-14
                    [poster_path] => /lPnxtwq4niq1222ym339fL2fh9L.jpg
                    [popularity] => 0.58310677110172
                    [title] => X-Men
                    [vote_average] => 6.5
                    [vote_count] => 1724
                )

            [1] => Array
                (
                    [adult] =>
                    [backdrop_path] => /aBkkrhQS4rO3u1OTahywtSXu3It.jpg
                    [id] => 127585
                    [original_title] => X-Men: Days of Future Past
                    [release_date] => 2014-05-23
                    [poster_path] => /mcJ2df14G595oqIYiSmgefvOo6d.jpg
                    [popularity] => 38.848882894558
                    [title] => X-Men : Days of Future Past
                    [vote_average] => 7.9
                    [vote_count] => 716
                )

            [2] => Array
                (
                    [adult] =>
                    [backdrop_path] =>
                    [id] => 246655
                    [original_title] => X-Men: Apocalypse
                    [release_date] => 2016-05-27
                    [poster_path] =>
                    [popularity] => 0.3444635869446
                    [title] => X-Men: Apocalypse
                    [vote_average] => 10
                    [vote_count] => 1
                )

            [3] => Array
                (
                    [adult] =>
                    [backdrop_path] => /lLYtfhjYEqS31snkNU9xj8tUHqX.jpg
                    [id] => 37713
                    [original_title] => X-Men: Pryde of the X-Men
                    [release_date] => 1989-07-01
                    [poster_path] => /208meMFoKbMGyho4HJ85h7wRdmD.jpg
                    [popularity] => 0.27914743884787
                    [title] => X-Men: Pryde of the X-Men
                    [vote_average] => 8.3
                    [vote_count] => 2
                )
.....
```