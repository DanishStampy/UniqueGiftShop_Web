// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
	'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var phoneNum = document.getElementById("phonenumber");
  var name = document.getElementById("name");
  var form = document.getElementById("customers-form");
  const regex = /\d/;

  function checkFormDetail(event) {
  	if (phoneNum.value.length < 11 || phoneNum.length > 11) {
  		phoneNum.setCustomValidity('Please enter the correct length of phone number');

  	}else if(phoneNum.value.slice(3, 4) !== '-'){
  		phoneNum.setCustomValidity('Please enter the correct phone number with dash');

  	}else if(name.value == ""){
  		name.setCustomValidity('Please enter customer name');
  	}
  	else if(regex.test(name.value)){
  		name.setCustomValidity('Please enter correct name');
  	}
  	else{
  		phoneNum.setCustomValidity("");
  	}
  }

  form.onsubmit = checkFormDetail;
})()