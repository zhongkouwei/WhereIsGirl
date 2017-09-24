<?php
/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/9/12
 * Time: 11:50
 */
include "../Db.class.php";

class  main{

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

        $level_arr = ['year', 'position', 'college', 'major', 'class', 'score'];

        $sql = "SELECT sex, COUNT(*) num FROM students WHERE year ='$year' and $level_arr[$level] = '$name' GROUP BY sex";
        $result = mysqli_query($this->client, $sql)->fetch_all();
        
        print json_encode(array('code'=>0, 'desc'=>'', 'result'=>$result,'sql'=>$sql));
    }

}


$Main = new main();
$Main->get_data();




