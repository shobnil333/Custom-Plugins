/*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 * 
 */
function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function() {
        $('.registerBox').fadeIn('fast');
        $('.modal-title').html('Bank Account');
    }); 
    $('.error').removeClass('alert alert-danger').html('');
       
}
function showLoginForm(){
    $('#loginModal .registerBox').fadeOut('fast',function() {
        $('.loginBox').fadeIn('fast');
        $('.modal-title').html('Wallet');
    });
    $('.error').removeClass('alert alert-danger').html(''); 
}


function showSCBox(parentId,lvl,amount){
	getScDtl(parentId,lvl,amount);
	$('#walletmodal').modal('show');
	$('.loginBox').fadeIn('fast');
	$('.modal-title').html('Pay Service Charge');
    $('.error').removeClass('alert alert-danger').html(''); 
}

function showPaymentMd(parentId,lvl){
	getWalletDtl(parentId,lvl);
	$('#loginModal').modal('show');
	$('.loginBox').fadeIn('fast');
	$('.modal-title').html('Give Help');
    $('.error').removeClass('alert alert-danger').html(''); 
}

function openLoginModal(accno,qrcode,mapid,paymentid){
	$('#accNo').val(accno);
	$('#accNo1').val(accno);
	$('#mapid').val(mapid);
	$('#qrcodehid').val(qrcode);
	$('#paymentid').val(paymentid);
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}

function removebk(mapid,flag) {

   var data = { "map_id": mapid	};
   if(confirm("Are you sure?")) {
	   $.ajax({
		   url: '../ajaxcall/deletebankacc.php',
		   type: 'POST',
		   data: {myData:data},
		   error: function(e) {
			console.log(e.message);
			// Show image container
			shakeModal(); 
		   },
		   success: function(response) {
				console.log(response);
				if(flag=="b") {
					$("#messages").html('<div align="center" id="loader1"><img src="../assets/img/loading.gif" width="32" height="32" border="0" alt=""> </div>');
					getBankAcc();
				}
				if(flag=="w") {
					$("#profile").html('<div align="center" id="loader1"><img src="../assets/img/loading.gif" width="32" height="32" border="0" alt=""> </div>');
					getWallet();
				}
		   }
	  });
   }
}


function updatebk(mapid,e) {
	var acc_status=0;

	if(e.checked) {
		acc_status=1;
	}

	var data = { "map_id": mapid, "acc_status" : acc_status	};
	$.ajax({
	   url: '../ajaxcall/updbankacc.php',
	   type: 'POST',
	   data: {myData:data},
	   error: function(e) {
		console.log(e.message);
		// Show image container
		shakeModal(); 
	   },
	   success: function(response) {
		   console.log(response);
			//$("#messages").html('<div align="center" id="loader1"><img src="../assets/img/loading.gif" width="32" height="32" border="0" alt=""> </div>');
			//getBankAcc();
	   }
	});
}

function bankAccAjax(){

	if($('#bankAccNo').val()=="" || $('#bankAccNo').val()!=$('#bankAccNo1').val() || $('#ifscCode').val()=="" || $('#bankName').val()=="" ) {
		shakeModal();
		return false;
	}

	var data = { "bankAccNo": $('#bankAccNo').val(), 
		"ifscCode": $('#iFSCCode').val(), 
		"bankName": $('#bankName').val()
		};


   $.ajax({
	   url: '../ajaxcall/savebankacc.php',
	   type: 'POST',
	   data: {myData:data},
	   error: function(e) {
        console.log(e.message);
		// Show image container
		shakeModal(); 
	   },
	   success: function(response) {
		   console.log(response);
			$('#loginModal').modal('hide');
			$("#messages").html('<div align="center" id="loader1"><img src="../assets/img/loading.gif" width="32" height="32" border="0" alt=""> </div>');
			getBankAcc();
	   }
	  });
}

function loginAjax(){

	if($('#accNo').val()=="") {
		shakeModal();
		return false;
	}


	var file_data = $("#QRCode").prop("files")[0];   
    var form_data = new FormData();
    form_data.append("file", file_data);
    form_data.append("accNo", $('#accNo').val());
    form_data.append("qrcodehid", $('#qrcodehid').val());
    form_data.append("mapid", $('#mapid').val());
    form_data.append("paymentid", $('#paymentid').val());

	$.ajax({
		url: '../ajaxcall/savewallet.php', // point to server-side PHP script 
		dataType: 'text',  // what to expect back from the PHP script, if anything
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,                         
		type: 'post',
		success: function(response) {
		   console.log(response);
			$('#loginModal').modal('hide');
			$("#profile").html('<div align="center" id="loader1"><img src="../assets/img/loading.gif" width="32" height="32" border="0" alt=""> </div>');
			getWallet();
		}
	 });
}

function shakeModal(){
    $('#loginModal .modal-dialog').addClass('shake');
	 $('.error').addClass('alert alert-danger').html("Invalid entry");
	 setTimeout( function(){ 
		$('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}

function getWallet() {
	$.ajax({
	   url: '../ajaxcall/wallet.php',
	   type: 'get',
	   data: '',
	   beforeSend: function(){
		// Show image container
		$("#loader").show();
	   },
	   success: function(response){
		$('#profile').html(response);
	   },
	   complete:function(data){
		// Hide image container
		$("#loader").hide();
	   }
	  });
}

function ConfirmReceive(myid,lvl) {

	var data = { "myid": myid};
	$.ajax({
		url: '../ajaxcall/confirmReceive.php', // point to server-side PHP script 
		data: {myData:data},                    
		type: 'post',
		success: function(response) {
		     console.log(response);
		     alert("Updated");
			 location.href="gethelp.php?lvl="+lvl;			
		  }
	 });
}


function ConfirmScPayNow(parentId,lvl) {

	var data = { "parentId": parentId,"amount":$('#servicefee').val(),"lvl":lvl};

	$.ajax({
		url: '../ajaxcall/confirmScPayNow.php', // point to server-side PHP script 
		data: {myData:data},                    
		type: 'post',
		success: function(response) {
		     console.log(response);
		     alert("Successfully Paid");
			 location.href="givehelp.php";			
		  }
	 });
}


function ConfirmPayNow(parentId,lvl) {

	var data = { "parentId": parentId,"remarks":$('#remarks').val(),"amount":$('#amount').val(),"lvl":lvl};

	$.ajax({
		url: '../ajaxcall/confirmPayNow.php', // point to server-side PHP script 
		data: {myData:data},                    
		type: 'post',
		success: function(response) {
		     console.log(response);
		     alert("Updated");
			 location.href="givehelp.php";			
		  }
	 });
}

function getWalletDtl(parentId,lvl) {
//	alert(parentId)
	$.ajax({
	   url: '../ajaxcall/getWalletDtl.php?parentId='+parentId+'&lvl='+lvl,
	   type: 'get',
	   data: '',
	   beforeSend: function(){
		// Show image container
		//$("#loader").show();
	   },
	   success: function(response){
		$('#loginModalFrm').html(response);
	   },
	   complete:function(data) {
		// Hide image container
		//$("#loader").hide();
	   }
	  });
}


function getScDtl(parentId,lvl,amount) {
//	alert(parentId)
	$.ajax({
	   url: '../ajaxcall/getScDtl.php?parentId='+parentId+'&lvl='+lvl+'&amount='+amount,
	   type: 'get',
	   data: '',
	   beforeSend: function(){
		// Show image container
		//$("#loader").show();
	   },
	   success: function(response){
		$('#scfrm').html(response);
	   },
	   complete:function(data) {
		// Hide image container
		//$("#loader").hide();
	   }
	  });
}

function getBankAcc() {

	$.ajax({
	   url: '../ajaxcall/bankacc.php',
	   type: 'get',
	   data: '',
	   beforeSend: function(){
		// Show image container
		$("#loader1").show();
	   },
	   success: function(response){
		$('#messages').html(response);
	   },
	   complete:function(data){
		// Hide image container
		$("#loader1").hide();
	   }
	  });

}

function showimage(myimage) {


    $('#myimage').attr("src", myimage);

	$('#showimagemodal').modal('show');
	$('.loginBox').fadeIn('fast');
	$('.modal-title').html('Scan QR Code');

}