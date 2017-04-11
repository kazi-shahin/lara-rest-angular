
<div ng-app="mainApp" ng-controller="studentController">
    <form id="userForm">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{$user->user_id}}"/>
        <input type="text" name="state" value="{{$user->state}}"/>
        <input type="text" name="city" value="{{$user->city}}"/>
        <input type="text" name="zip" value="{{$user->zip}}"/>
        <input type="text" name="country" value="{{$user->country}}"/>

        <input type="button" ng-click="submit_form()" value="Update" />
    </form>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

<script>
    var mainApp = angular.module("mainApp", []);
    mainApp.controller('studentController', function($scope, $http) {
        $scope.submit_form = function()
        {
            var url = '{{url('update_user')}}';
            var data = $('#userForm').serialize();
            console.log(url);
            console.log(data);

            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                }
            }

            $http.post(url, data, config)
                    .success(function (data, status, headers, config) {
                        alert(data.reason);
                    })
                    .error(function (data, status, header, config) {
                        console.log(data);
                    });
        }
    });

</script>