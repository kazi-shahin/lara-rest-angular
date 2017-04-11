
<div ng-app="mainApp" ng-controller="studentController">
    <form id="userForm">
        {{ csrf_field() }}
        <input type="text" name="state" ng-model="dfgdfg"/>
        <input type="text" name="city" />
        <input type="text" name="zip"/>
        <input type="text" name="country"/>

        <input type="button" ng-click="submit_form()" value="Add" />
    </form>

    <div>
        <table border="1">
            <thead>
            <tr>
                <th>State</th>
                <th>City</th>
                <th>Zip</th>
                <th>Country</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="user_body">
                <?php foreach($users as $user){ ?>
                <tr>
                    <td>{{$user->state}}</td>
                    <td>{{$user->city}}</td>
                    <td>{{$user->zip}}</td>
                    <td>{{$user->country}}</td>
                    <td><a href="{{url('get_user',$user->user_id)}}">View</a>
                        <a href="#" ng-click="delete_user({{$user->user_id}})">Delete</a>
                    </td>
                </tr>
                <?php }?>
                </tbody>
        </table>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

<script>
    var mainApp = angular.module("mainApp", []);
    mainApp.controller('studentController', function($scope, $http) {
        $scope.submit_form = function()
        {
            var url = '{{url('create_user')}}';
            var data = $('#userForm').serialize();

            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                }
            }

            $http.post(url, data, config)
                    .success(function (data, status, headers, config) {
                        //$scope.reset();
                        $('#userForm')[0].reset();
                        var view_url = '{{url('get_user',$user->user_id)}}';
                        var delete_url = '{{url('delete_user',$user->user_id)}}';
                        var row = '<tr>';
                         row +='<td>'+data.user.state+'</td>';
                         row +='<td>'+data.user.city+'</td>';
                         row +='<td>'+data.user.zip+'</td>';
                         row +='<td>'+data.user.country+'</td>';
                         row +='<td><a href="'+view_url+'">View</a>';
                         row +='<a href="'+delete_url+'">Delete</a>';
                         row +='</td>';
                         row +='</tr>';

                        $("#user_body").append(row);
                    })
                    .error(function (data, status, header, config) {
                        console.log(data);
                    });
        }


        $scope.delete_user = function(id)
        {
            if(confirm('Are you sure you want to delete this user?')){
                var url = '{{url('delete_user')}}';
                var data = $.param({
                    user_id: id
                });

                var config = {
                    headers : {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                    }
                }

                $http.post(url, data, config)
                        .success(function (data, status, headers, config) {
                            window.location.href='{{url('user')}}';
                        })
                        .error(function (data, status, header, config) {
                            console.log(data);
                        });
            }
        }
    });

</script>