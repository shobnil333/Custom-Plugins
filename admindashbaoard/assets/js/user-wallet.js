/*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 * 
 */

function getWallet() {
	$.ajax({
	   url: '../ajaxcall/getuserwallet.php',
	   type: 'get',
	   data: '',
	   beforeSend: function(){
		// Show image container
		$("#loader").show();
	   },
	   success: function(response){
		console.log(response);
		$('#mywallet').html(response);
	   },
	   complete:function(data){
		// Hide image container
		$("#loader").hide();
	   }
	  });
}



function getTransfer() {
	$.ajax({
	   url: '../ajaxcall/userwallettransfer.php',
	   type: 'get',
	   data: '',
	   beforeSend: function(){
		// Show image container
		$("#loader1").show();
	   },
	   success: function(response){
		console.log(response);
		$('#transfer').html(response);
	   },
	   complete:function(data){
		// Hide image container
		$("#loader1").hide();
	   }
	  });
}



function getHistory() {
	$.ajax({
	   url: '../ajaxcall/userwallethistory.php',
	   type: 'get',
	   data: '',
	   beforeSend: function(){
		// Show image container
		$("#loader2").show();
	   },
	   success: function(response){
		console.log(response);
		$('#history').html(response);
	   },
	   complete:function(data){
		// Hide image container
		$("#loader2").hide();
	   }
	  });
}