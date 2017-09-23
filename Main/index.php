<?php
/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/9/12
 * Time: 11:50
 */
include "../Db.class.php";

class main {

    private $client;
    public function _construct()
    {
        $this->client = DB::getInstance()->getCon();
        if (!$this->client)
        {
            die('Could not connect: ' . mysqli_error($this->client));
        }
        mysqli_select_db($this->client, 'Course');
    }

    public function get_data()
    {

        $result = array();
        return json_encode(array('code'=>0, 'desc'=>'', 'result'=>$result));
    }

}




