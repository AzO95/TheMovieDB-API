<?php
class TheMovieDB{

    const URL_API     = 'api.themoviedb.org';
    const version_api = '3';

    private $api_key;
    private $api_langage;
    private $params = array();

    /**
     * Constructor
     * @param string $api_key     API KEY
     * @param string $api_langage Langage
     */
    function __construct($api_key,$api_langage = 'fr')
    {
        $this->api_key     = $api_key;
        $this->api_langage = $api_langage;
    }

    /**
     * Retrieve All Movie By Title
     * @param  string $title
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
     * Retrieve Popuplar personn
     * @return array
     */
    public function getPopularPerson($page = 1)
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
    private function showAll($page = 1,&$resArray = array())
    {
        $this->param['page'] = $page;
        $data = $this->getData();
        if($data['total_pages'] > 1 && $page <= $data['total_pages'])
        {
            $page++;
            foreach ($data['results'] as $key => $value)
            {
               array_push($resArray,$value);
            }
            $this->showAll($page,$resArray);
        }
        return $resArray;
    }

    /**
     * Execute request curl
     * @param  integer $page number page
     * @return array
     */
    private function getData()
    {
        if(isset($this->params['page']) && is_int($this->params['page']))
        {
            $url = "http://".self::URL_API."/".self::version_api."".$this->params['query']."&page=".$this->params['page']."&api_key=".$this->api_key."&language=".$this->api_langage."";
        }
        else
        {
           $url = "http://".self::URL_API."/".self::version_api."".$this->params['query']."?&api_key=".$this->api_key."&language=".$this->api_langage."";
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