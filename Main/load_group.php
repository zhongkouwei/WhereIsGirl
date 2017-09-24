<?php
/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/9/24
 * Time: 19:14
 */

include "../Db.class.php";

class  group{

    private $client;

    public function __construct()
    {
        $this->client = DB::getInstance()->getCon();
        if (!$this->client)
        {
            die('Could not connect: ' . mysqli_error());
        }
    }

    function get_data()
    {
        $level = $_REQUEST['level'];
        $name  = $_REQUEST['name'];
        $year = $_REQUEST['year'];
        $next = $level+1;

        $level_arr = ['year', 'position', 'college', 'major', 'class', 'score'];

        $sql = "SELECT DISTINCT $level_arr[$next] FROM students WHERE year='$year' and $level_arr[$level] = '$name'";
        $rows = mysqli_query($this->client, $sql)->fetch_all();

        $result = array();
        foreach ($rows as $k =>$v){
            $result[] = $v[0];
        }

        print json_encode(array('code'=>0, 'desc'=>'', 'result'=>$result, 'sql'=>$sql));
    }

}


$Main = new group();
$Main->get_data();