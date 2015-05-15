// create angular app
	var validationApp = angular.module('validationApp', []);

	// create angular controller
	validationApp.controller('mainController', function($scope, $http) { 
		// function to submit the form after all validation has occurred			
		$scope.submitForm = function() {
			
			// check to make sure the form is completely valid
			if ($scope.userForm.$valid) {
				console.log("posting data....");
        		$http.post('/api/contacts', JSON.stringify({
					name   : $scope.userForm.name.$viewValue,
					email  : $scope.userForm.email.$viewValue,
					subject: $scope.userForm.subject.$viewValue,
					message: $scope.userForm.message.$viewValue
				}))
        		.success(function(){alert("Su solicitud ha sido enviada. Le responderemos a la brevedad");})
        		.error(function()  {alert('Algo no ha salido bien, por favor comuniquese telefónicamente si es una urgencia.');});
			}

		};

	});