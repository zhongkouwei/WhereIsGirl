<!DOCTYPE html>
<html lang="en" ng-app="myModule">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Find the girl around you">
    <meta name="author" content="">
    <link rel="icon" href="../Public/woman.ico">

    <title>Where Is Girl</title>

    <!-- Bootstrap core CSS -->
    <link href="../Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../Public/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../Public/css/cover.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../Public/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../Public/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body ng-controller="MainController" style="background-color: #f3f3f3">

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container" style="height: 80%">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Boy and Girl</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </nav>
            </div>
          </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="dataTables_length" id="dataTables-example_length">
                        <label>年级</label>
                        <select name="type" aria-controls="dataTables-example" ng-model="data.year" ng-change="load_group(0)"  class="form-control input-sm">
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="dataTables_length" id="dataTables-example_length">
                        <label>南北区</label>
                        <select name="type" aria-controls="dataTables-example" ng-model="data.position" ng-change="load_group(1)"  class="form-control input-sm">
                            <option value="南">南区</option>
                            <option value="北">北区</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="dataTables_length" id="dataTables-example_length">
                        <label>学院</label>
                        <select name="type" aria-controls="dataTables-example" ng-model="data.college" ng-change="load_group(2)"  class="form-control input-sm">
                            <option ng-repeat="i in data.colleges" value="{{i}}">{{i}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="dataTables_length" id="dataTables-example_length">
                        <label>专业</label>
                        <select name="type" aria-controls="dataTables-example" ng-model="data.major" ng-change="load_group(3)"  class="form-control input-sm">
                            <option ng-repeat="i in data.majors" value="{{i}}">{{i}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="dataTables_length" id="dataTables-example_length">
                        <label>班级</label>
                        <select name="type" aria-controls="dataTables-example" ng-model="data.class" ng-change=""  class="form-control input-sm">
                            <option ng-repeat="i in data.classes" value="{{i}}">{{i}}</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary" ng-click="get_data()" style="margin-top: 17px;">查询</button>
                </div>

            </div>
            </form>

            <!-- <h1 class="cover-heading">Cover your page.</h1>
            <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
            <p class="lead">
              <a href="#" class="btn btn-lg btn-default">Learn more</a>
            </p> -->
            <div id="main" style="height:100%;margin-top: 10px;"></div>


          <div class="mastfoot">
            <div class="inner">
              <p>By <a target="_blank" href="https://github.com/zhongkouwei">ZHONGKOUWEI</a></p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
    <script>window.jQuery || document.write('<script src="../Public/js/jquery.min.js"><\/script>')</script>
    <script src="../Public/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../Public/js/ie10-viewport-bug-workaround.js"></script>
    <!-- angularjs -->
    <script src="../Public/js/angularjs/angular.min.js"></script>
    <script src="../Public/js/echarts/echarts.min.js"></script>
    <script>
        var myModule = angular.module('myModule',[]);

        myModule.controller('MainController', function ($scope, $http) {
            $scope.data = {}
            $scope.data.level = 0;
            $scope.data.name = '2014';

            $scope.level_arr = ['year','position','college','major','class'];
            $scope.group_arr = ['years','positions','colleges','majors','classes'];
            $scope.data.year = '2014';
            $scope.data.position = '';
            $scope.data.college='';
            $scope.data.major = '';
            $scope.data.class='';

            $scope.load_group = function (level) {
                var name = $scope.data[$scope.level_arr[level]];

                if(level==0){
                    for(var i = level+1; i< 5; i++){
                        $scope.data[$scope.group_arr[i]] = [];
                        $scope.data[$scope.level_arr[i]] = '';
                    }
                    return ;
                }
                $http.get('load_group.php', {
                    params: {
                        level: level,
                        name: name,
                        year: $scope.data.year
                    }
                }).then(function (response) {
                    if (response.data.code != 0) {
                        alert(response.data.desc);
                        return;
                    }
                    $scope.data[$scope.group_arr[level + 1]] = response.data.result;
                });

                for(var i = level+2; i< 5; i++){
                    $scope.data[$scope.group_arr[i]] = [];
                    $scope.data[$scope.level_arr[i]] = '';
                }
            }

            $scope.get_data = function () {
                // 检查最低层级
                for(var i=4; i>=0; i--){
                    if($scope.data[$scope.level_arr[i]] != ''){
                        $scope.data.level = i;
                        $scope.data.name =$scope.data[$scope.level_arr[i]];
                        break;
                    }
                }

                $http.get('index.php', {
                    params:{
                        level:$scope.data.level,
                        name:$scope.data.name,
                        year:$scope.data.year
                    }
                }).then(function (response) {
                    if (response.data.code != 0) {
                        alert(response.data.desc);
                        return;
                    }
                    $scope.data.rows = response.data.result;
                    $scope.chart();
                });
            }

            $scope.chart = function(){
            var myChart = echarts.init(document.getElementById('main'));
            // 基于准备好的dom，初始化echarts实例
            // 指定图表的配置项和数据
            var option = {
                title : {
                    text: $scope.data.name,
                    subtext: '仅供参考',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: ['男','女']
                },
                series : [
                    {
                        name: '比例',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };

            var data = [];
            data.push({'value':$scope.data.rows[0][1], 'name':$scope.data.rows[0][0]});
            data.push({'value':$scope.data.rows[1][1], 'name':$scope.data.rows[1][0]})
            option['series'][0]['data'] = data;
            myChart.setOption(option);
        }

            $scope.get_data();
        });

    </script>
  </body>
</html>
