<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class TheMovieDB{

    const url_api     = 'api.themoviedb.org';
    const version_api = '3';

    private $api_key;
    private $api_langage;
    private $params = [];

    /**
     * @param $api_key
     * @param string $api_langage
     */
    function __construct($api_key,$api_langage = 'fr')
    {
        $this->api_key     = $api_key;
        $this->api_langage = $api_langage;
    }

    /**
     * Search Movie By Title
     * @param string $title
     * @param null $page
     * @return array
     */
    public function searchMovie($title,$page = NULL)
    {
        if($page)
        {
            $this->params['query'] = '/search/movie?query='.$title.'';
            $this->params['page']  = $page;
            return $this->getData();
        }
        else
        {
            $this->params['query'] = '/search/movie?query='.$title.'';
            return $this->showAll();
        }
    }

    /**
     * Retrieve All Information from movie ID(searchMovie)
     * @param   int $id_movie
     * @return  array
     */
    public function getMovie($id_movie)
    {
        $this->params['query'] = '/movie/'.$id_movie.'';
        return $this->getData();
    }

    /**
     * Get the alternative titles for a specific movie id
     * @param int $id_movie
     * @return array
     */
    public function getAlternativeTitle($id_movie)
    {
        $this->params['query'] = '/movie/'.$id_movie.'/alternative_titles';
        return $this->getData();
    }

    /**
     * Get the cast and crew information for a specific movie id
     * @param $id_movie
     * @return array
     */
    public function getMovieCredits($id_movie)
    {
        $this->params['query'] = '/movie/'.$id_movie.'/credits';
        return $this->getData();
    }

    /**
     * Get the images (posters and backdrops) for a specific movie id
     * @param $id_movie
     * @return array
     */
    public function getMovieImages($id_movie)
    {
        $this->params['query'] = '/movie/'.$id_movie.'/images';
        return $this->getData();
    }

    /**
     * Get the plot keywords for a specific movie id.
     * @param int $id_movie
     * @return array
     */
    public function getMovieKeyword($id_movie)
    {
        $this->params['query'] = '/movie/'.$id_movie.'/keywords';
        return $this->getData();
    }

    /**
     * Get the release date and certification information by country for a specific movie id.
     * @param int $id_movie
     * @return array
     */
    public function getMovieRelease($id_movie)
    {
        $this->params['query'] = '/movie/'.$id_movie.'/releases';
        return $this->getData();
    }

    /**
     * Get the videos (trailers, teasers, clips, etc...) for a specific movie id.
     * @param int $id_movie
     * @param null $all_lang
     * @return array
     */
    public function getMovieVideos($id_movie, $lang = NULL)
    {
        if($lang !== NULL)
        {
            $this->params['query'] = '/movie/'.$id_movie.'/videos';
            return $this->getData();
        }
        else
        {
            $this->api_langage = NULL;
            $this->params['query'] = '/movie/'.$id_movie.'/videos';
            return $this->getData();
        }
    }

    /**
     * Retrieve Popular people
     * @param int $page
     * @return array
     */
    public function getPopularPeople($page = 1)
    {
        $this->params['page'] = $page;
        $this->params['query'] = '/person/popular?';
        return $this->getData();
    }

    /**
     * Retrieve all data when paging
     * @param  integer $page     number page
     * @param  array   $resArray
     * @return array
     */
    private function showAll($page = 1,&$resArray = [])
    {
        $this->params['page'] = $page;
        $data = $this->getData();
        if($data['total_pages'] > 1 && $page <= $data['total_pages'])
        {
            $page++;
            foreach ($data['results'] as $value)
            {
                array_push($resArray,$value);
            }
            $this->showAll($page,$resArray);
        }
        else
        {
            return $this->getData();
        }
        return $resArray;
    }

    /**
     * Request CURL
     * @return array
     */
    private function getData()
    {
        if(isset($this->params['page']) && is_int($this->params['page']))
        {
            $url = "http://".self::url_api."/".self::version_api."".$this->params['query']."&page=".$this->params['page']."&api_key=".$this->api_key."&language=".$this->api_langage."&include_image_language=".$this->api_langage.",null";
        }
        elseif($this->api_langage === NULL)
        {
            $url = "http://".self::url_api."/".self::version_api."".$this->params['query']."?&api_key=".$this->api_key."";
        }
        else
        {
           $url = "http://".self::url_api."/".self::version_api."".$this->params['query']."?&api_key=".$this->api_key."&language=".$this->api_langage.",&include_image_language=".$this->api_langage.",null";
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        return $result;
    }

}
