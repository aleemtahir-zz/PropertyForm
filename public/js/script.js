$(document).on("keypress", "form", function(event) { 
    return event.keyCode != 13;
});

$(document).ready(function(){
	//initialize developer page

	initDevId();

	vfRepeatButtons();

	$(document).on('click', ".c-page-next-page", function() {
		$('.c-forms-pages').children().each(function () {

			//console.log(tag.css('display'));
			if ($(this).css('display') == 'block') {
			    $(this).css('display','none');
			    $(this).next().css('display','block');
			    return false;
			}

		});

		$('.c-forms-progress ol').children().each(function () {

			//console.log(tag.css('display'));
			if ( $(this).hasClass('c-page-selected') ) {
				$(this).removeClass('c-page-selected');
			    $(this).next().addClass('c-page-selected');
			    return false;
			}

		});

	});

    $(document).on('click', ".c-page-previous-page", function() {
		$('.c-forms-pages').children().each(function () {

			//console.log(tag.css('display'));
			if ($(this).css('display') == 'block') {
			    $(this).css('display','none');
			    $(this).prev().css('display','block');
			    return false;
			}

		});

		$('.c-forms-progress ol').children().each(function () {

			//console.log(tag.css('display'));
			if ( $(this).hasClass('c-page-selected') ) {
				$(this).removeClass('c-page-selected');
			    $(this).prev().addClass('c-page-selected');
			    return false;
			}

		});

	});

	//Navigation Button
	$(document).on('click', ".c-forms-progress li", function() {

		var n = $('.c-page-selected').attr('data-page');
		var num = $(this).attr('data-page');

		$('.c-page-selected').removeClass('c-page-selected');
		$(this).addClass('c-page-selected');

		$('.c-page-page'+n).css('display','none');
		$('.c-page-page'+num).css('display','block');

	});

    //Add Section
    $(document).on('click', ".c-repeating-section-add", function() {
    	var section_group 	= $(this).parent().find('.c-repeating-section-group');
    	
    	//For Volume/Folio
    	if(section_group.length == 0){
    		var vf_flag = 1;
    		var section_group 	= $(this).parent().parent();
    	}

    	var add_section 	= section_group.children().last().clone();

    	add_section.css('display', '');
    	add_section.find('.c-editor input').val('');
    	
    	add_section.find('.c-editor input').each(function() {
    		
    		//console.log($(this));
    		var arr			= $(this).attr('id').split('-');
    		var new_value 	= parseInt(arr[2]) + 1;
    		
    		arr[2]			= new_value;

    		var new_arr		= arr.join('-');	
    		$(this).attr('id', new_arr);

    		if($(this).hasClass('datepicker')){
    			//$('.datepicker');
    			//console.log(new_arr);
    			$(this).datepicker();
    		}
    	});

    	//Show Remove Button
		add_section.find('.c-action-col').removeClass('hide-remove-button');

    	//add_section.find('.c-datepicker').attr('id');
		add_section.appendTo(section_group);

		//For VF Repeat
		if(vf_flag  == 1){
			$(this).removeClass('c-repeating-section-add').addClass('c-repeating-section-remove');
			$(this).children().find('i').removeClass('icon-plus').addClass('icon-remove');
			vfRepeatButtons();
		}
		
		//numbering
		var num = 1;
		section_group.children().each(function () {

			if($(this).css('display') === "block"){
				$(this).find('.c-repeating-section-item-title span').text(num);
				num++;
			}
		});

		initInputMask();
		_triggerStatementSum();
	});

	//Remove VF Section 
    $(document).on('click', ".c-repeating-section-remove", function() {
    	var curr_vf_section 	= $(this).parent();
    	curr_vf_section.detach();
    });

    //Remove Section
    $(document).on('click', ".c-action-col a", function() {

    	var section_group 		= $(this).parents('.c-repeating-section-group');
    	var section_container 	= $(this).parents('.c-repeating-section-container');
    	section_container.css('display', 'none');
    	section_container.detach();
    	
    	//numbering
		var num = 1;
		section_group.children().each(function () {

			if($(this).css('display') === "block"){
				$(this).find('.c-repeating-section-item-title span').text(num);
				num++;
			}
		});

		sumExpenses();
		sumPayment();
	});


	$(function () {
       $('.datepicker').datepicker();
    });


    //Delete Button
    $('#delete_btn').click(function(){

        var url = $(this).attr('data-url');
        $.ajax({
		    url: baseurl+'/upload/',
		    method: 'DELETE',
		    //contentType: 'application/json',
		    success: function(result) {
		        console.log("success");
		    },
		    error: function(request,msg,error) {
		        // handle failure
		        console.log("error");
		    }
		});
    });
    

	$('select').change(function(){
		$('select').css('color','black');        
	})

/*	Form Loader
====================================*/
	$('#form').submit(function() {
		$('#gear-sub').show(); 
		setTimeout(function(){ 
	    	$('#gear-sub').hide();
	    },600);
	    return true;
	  });

var fc = $('#fc_name').val();
var mapper = {'United States Dollar': 'USD', 'Canadian Dollar': 'CAD', 'Pound Sterling': 'UKP'};
var symbolMapper = {'United States Dollar': '$', 'Canadian Dollar': '$', 'Pound Sterling': '£'};

$('#fc_symbol').val('');		        
$('#fc_symbol').val(mapper[fc]);	
initInputMask(/*symbolMapper[fc]*/);
/*Foriegn Currency
=====================================*/
$('#fc_name').change(function(){
	var fc = $('#fc_name').val();	

	$('#fc_symbol').val('');		        
	$('#fc_symbol').val(mapper[fc]);
	console.log(symbolMapper[fc]);
	initInputMask(/*symbolMapper[fc]*/);		        
})


$('#fileUpload').change(function () {
	var filePath=$('#fileUpload').val();
	$('.c-fileupload-dropzone-message').html(filePath.replace('C:\\fakepath\\','')); 
});

checkDropDownStatus();
$('select.c-placeholder-text-styled').on('change',function(){
	console.log('parish change');
	checkDropDownStatus();
});


/*RECORD ID AUTOCOMPLETE
===========================================*/

$( "#autocomplete" ).autocomplete({
	source: baseurl+"/property/autocomplete",
	minLength: 1,
	select: function(event, ui) {
		$('#autocomplete').val(ui.item.id);
		$('button[name="mergeBtn"]').map(function(){
			//console.log(this);		
			$(this).removeAttr("disabled");
		
		});
	},   //HERE - make sure to add the comma after your select
    response: function(event, ui) {
        if (!ui.content.length) {
            var noResult = { value:"",label:"No results found" };
            ui.content.push(noResult);
        }
    }
});

$( "#dev_name" ).autocomplete({
	source: baseurl+"/property/autoDevName",
	minLength: 1,
	select: function(event, ui) {
		$('#dev_name').val(ui.item.id);
		$('#dev_id').val(ui.item.id);
		lookUpProperty(1);
		/*$('button[name="mergeBtn"]').map(function(){
			//console.log(this);		
			$(this).removeAttr("disabled");
		
		});*/
	},   //HERE - make sure to add the comma after your select
    response: function(event, ui) {
        if (!ui.content.length) {
            var noResult = { value:"",label:"No results found" };
            ui.content.push(noResult);
        }
    }
});

$( "#devDropDown" ).autocomplete({
	source: baseurl+"/property/autoDevName",
	minLength: 1,
	select: function(event, ui) {
		// console.log(ui);
		// $('#dev_name').val(ui.item.id);
		$('#dev_id').val(ui.item.id);
		var params = {
			'key' : ui.item.id
		};
		ajaxGetDevelopment(params);	
	},   //HERE - make sure to add the comma after your select
    response: function(event, ui) {
        if (!ui.content.length) {
            var noResult = { value:"",label:"No results found" };
            ui.content.push(noResult);
        }
    }
});

// var states = [
//       "Clarendon",
//       "Hanover",
//       "Kingston",
//       "Manchester",
//       "Portland",
//       "Saint Andrew", 
//       "Saint Ann", 
//       "Saint Catherine", 
//       "Saint Elizabeth", 
//       "Saint James", 
//       "Saint Marry", 
//       "Saint Thomas", 
//       "Trelawny",
//       "Westmore Land" 
//     ];
// $( "#state" ).autocomplete({
// 	source: states
// });
// $("#paymentModal").modal();


_triggerStatementSum();



/*END Document Ready
====================================*/
});

/*Account Statement Form*/
function _triggerStatementSum()
{ 
	var totalExpense = 0;
	// console.log($('.totalExpense'));
	$('.totalExpense').change(function(){

		/*let val = $(this).val();
		// val = ( val !== '' ? val.replace(/,/g, '') : 0);
		totalExpense = parseInt(totalExpense) + parseInt(val);     
		console.log(totalExpense);*/

		sumExpenses();

	});

	$('.totalPayment').change(function(){

		//Assign values to price in jamaican
		let i = $(this).attr('id').split('-')[2];
		// console.log($('#fc_rate-1-'+i));
		let rate 	= $('#fc_rate-1-'+i).val();
		let c_price = $('#c_price-1-'+i).val();
	
		rate 		= ( rate !== '' ? parseInt(rate.replace(/,/g, '')) : 0);
		c_price 	= ( c_price !== '' ? parseInt(c_price.replace(/,/g, '')) : 0);

		if(rate > 0 && c_price > 0)
			$('#c_pricej-1-'+i).val(rate * c_price);


		sumPayment();

		// console.log($("input[name='payment[price_j]']"));

	});

	$('input[name*="monetary[total"').change(function(){
		let totalPayment = $("#total_payment").val();
		let totalExpense = $("#total_expense").val();

		totalPayment 		= ( totalPayment !== '' ? parseInt(totalPayment.replace(/,/g, '')) : 0);
		totalExpense 		= ( totalExpense !== '' ? parseInt(totalExpense.replace(/,/g, '')) : 0);


		totalExpense = isNaN(totalExpense) ? 0 : totalExpense;
		totalPayment = isNaN(totalPayment) ? 0 : totalPayment;

		let balance = totalPayment - totalExpense;
		$("#balance").val(balance);
	});

}

/*Sum Expenses
======================================*/
function sumExpenses()
{ 
	let sale_price 		= $('#sale_price').val();
	let contract_price 	= $('#contract_price').val();	
	let upgrades 		= $('#upgrades').val();
	let half_stamp_duty = $('#half_stamp_duty').val();
	let half_reg_fee 	= $('#half_reg_fee').val();
	let half_land_agreement 	= $('#half_land_agreement').val();
	let half_build_agreement 	= $('#half_build_agreement').val();
	let maintenance_expense 	= $('#maintenance_expense').val();
	let half_title_cost = $('#half_title_cost').val();
	let misc_expense 	= $('#misc_expense').val();

	var other_expenses = 0;
	$("input[name*='expense[price]']").each(function(){ 
		let other_price = $(this).val();
		other_price 	= ( other_price !== '' ? parseInt(other_price.replace(/,/g, '')) : 0);
		other_expenses += other_price;
	});

	sale_price 		= ( sale_price !== '' ? parseInt(sale_price.replace(/,/g, '')) : 0);
	contract_price 	= ( contract_price !== '' ? parseInt(contract_price.replace(/,/g, '')) : 0);
	upgrades 		= ( upgrades !== '' ? parseInt(upgrades.replace(/,/g, '')) : 0);
	half_stamp_duty = ( half_stamp_duty !== '' ? parseInt(half_stamp_duty.replace(/,/g, '')) : 0);
	half_reg_fee 	= ( half_reg_fee !== '' ? parseInt(half_reg_fee.replace(/,/g, '')) : 0);
	half_land_agreement 	= ( half_land_agreement !== '' ? parseInt(half_land_agreement.replace(/,/g, '')) : 0);
	half_build_agreement 	= ( half_build_agreement !== '' ? parseInt(half_build_agreement.replace(/,/g, '')) : 0);
	maintenance_expense 	= ( maintenance_expense !== '' ? parseInt(maintenance_expense.replace(/,/g, '')) : 0);
	half_title_cost = ( half_title_cost !== '' ? parseInt(half_title_cost.replace(/,/g, '')) : 0);
	misc_expense 	= ( misc_expense !== '' ? parseInt(misc_expense.replace(/,/g, '')) : 0);

	totalExpense = parseInt(sale_price) + parseInt(contract_price) + parseInt(upgrades) + parseInt(half_stamp_duty) + parseInt(half_reg_fee) 
		+ parseInt(half_land_agreement) + parseInt(half_build_agreement) + parseInt(maintenance_expense) + parseInt(half_title_cost) 
		+ parseInt(misc_expense) + parseInt(other_expenses);
	
	$("#total_expense").val(totalExpense);

	let t_payment 	= $("#total_payment").val();
	t_payment 		= ( t_payment !== '' ? parseInt(t_payment.replace(/,/g, '')) : 0);

	totalExpense = isNaN(totalExpense) ? 0 : totalExpense;
	t_payment = isNaN(t_payment) ? 0 : t_payment;

	let balance 	= t_payment - totalExpense;
	$("#balance").val(balance);
}

/*Sum payment
=======================================*/
function sumPayment()
{
	var totalPayment = 0;
	$("input[name*='payment[price_j']").each(function(){ 
		let other_price = $(this).val();
		other_price 	= ( other_price !== '' ? parseInt(other_price.replace(/,/g, '')) : 0);
		// console.log(other_price);
		totalPayment += other_price;
	});

	$("#total_payment").val(totalPayment);

	let t_expense 	= $("#total_expense").val();
	t_expense 		= ( t_expense !== '' ? parseInt(t_expense.replace(/,/g, '')) : 0);

	totalPayment = isNaN(totalPayment) ? 0 : totalPayment;
	t_expense = isNaN(t_expense) ? 0 : t_expense;

	let balance = totalPayment - t_expense;
	$("#balance").val(balance);
}


/*
Account Statement Form END
=====================================*/

/*Calculate Price
=====================================*/
$(function(){
	$('input[name*="payment"]').each(function (){
		var id = $(this).attr('id');
		$(this).change(function(){
			updateBuilderContractPayment(id);       
		});
	});

	$('input[name*="monetary"]').each(function (){
		var id = $(this).attr('id');
		$(this).change(function(){
			updateBuilderContractPayment(id);       
		});
	});

});


function updateBuilderContractPayment(id)
{	
	let price 		= $('#c_price').val();
	let rate 		= $('#fc_rate').val();	
	let cp_jamaican = $('#c_pricej').val();
	let cp_deposit 	= $('#cp_deposit').val();
	let cp_second 	= $('#cp_second').val();
	let cp_third 	= $('#cp_third').val();
	let final_pay 	= $('#final_pay').val();
	let cp_fourth 	= $('#cp_fourth').val();
	let cp_final 	= $('#cp_final').val();
	let cp_stamp 	= $('#cp_stamp').val();
	let cp_reg_fee 	= $('#cp_reg_fee').val();

	if(id == 'c_price' ||  id == 'fc_rate')
	{	
		price = ( price !== '' ? price.replace(/,/g, '') : '');
		rate = ( rate !== '' ? rate.replace(/,/g, '') : '');

		$('#c_pricej').val(price*rate);	       
		$('#cp_deposit').val(price*rate);	 

		let cp_stamp 	= parseInt(price*rate) * 0.5 * (4 / 100);      
		let cp_reg_fee 	= parseInt(price*rate) * 0.5 * (0.5 / 100);      
		
		// cp_stamp = ( cp_stamp !== '' ? cp_stamp.replace(/,/g, '') : '');
		// cp_reg_fee = ( cp_reg_fee !== '' ? cp_reg_fee.replace(/,/g, '') : '');
		
		$('#cp_stamp').val(cp_stamp);	 
		$('#cp_reg_fee').val(cp_reg_fee);	 

	}
	else if(id == 'c_pricej')
	{
		$('#cp_deposit').val(cp_jamaican);	

		price = ( price !== '' ? price.replace(/,/g, '') : '');
		rate = ( rate !== '' ? rate.replace(/,/g, '') : '');

		let cp_stamp 	= parseInt(price*rate) * 0.5 * (4 / 100);      
		let cp_reg_fee 	= parseInt(price*rate) * 0.5 * (0.5 / 100);      
		$('#cp_stamp').val(cp_stamp);	 
		$('#cp_reg_fee').val(cp_reg_fee);        		      
	}
	else
	{
		if(id == 'cp_deposit'){

			cp_deposit = ( cp_deposit !== '' ? cp_deposit.replace(/,/g, '') : '');
			cp_jamaican = ( cp_jamaican !== '' ? cp_jamaican.replace(/,/g, '') : '');

			let cp_second 	= cp_jamaican - cp_deposit;
			$('#cp_second').val(cp_second);	
		}
		else if(id == 'cp_second'){

			cp_deposit = ( cp_deposit !== '' ? cp_deposit.replace(/,/g, '') : '');
			cp_jamaican = ( cp_jamaican !== '' ? cp_jamaican.replace(/,/g, '') : '');
			cp_second = ( cp_second !== '' ? cp_second.replace(/,/g, '') : '');

			let sum = parseInt(cp_deposit) + parseInt(cp_second);
			let cp_third 	= parseInt(cp_jamaican) - parseInt(sum);
			$('#cp_third').val(cp_third);	
			$('#final_pay').val(cp_third);	
		}	
		else if(id == 'cp_third'){

			cp_deposit = ( cp_deposit !== '' ? cp_deposit.replace(/,/g, '') : '');
			cp_jamaican = ( cp_jamaican !== '' ? cp_jamaican.replace(/,/g, '') : '');
			cp_second = ( cp_second !== '' ? cp_second.replace(/,/g, '') : '');
			cp_third = ( cp_third !== '' ? cp_third.replace(/,/g, '') : '');

			let cp_fourth 	= parseInt(cp_jamaican) - (parseInt(cp_deposit) + parseInt(cp_second) + parseInt(cp_third));
			$('#cp_fourth').val(cp_fourth);	
		}
		else if(id == 'cp_fourth'){

			cp_deposit = ( cp_deposit !== '' ? cp_deposit.replace(/,/g, '') : '');
			cp_jamaican = ( cp_jamaican !== '' ? cp_jamaican.replace(/,/g, '') : '');
			cp_second = ( cp_second !== '' ? cp_second.replace(/,/g, '') : '');
			cp_third = ( cp_third !== '' ? cp_third.replace(/,/g, '') : '');
			cp_fourth = ( cp_fourth !== '' ? cp_fourth.replace(/,/g, '') : '');
			
			let cp_final 	= parseInt(cp_jamaican) - 
			(parseInt(cp_deposit) + parseInt(cp_second) + parseInt(cp_third) + parseInt(cp_fourth));
			$('#cp_final').val(cp_final);	
		}

	}

}

function checkDropDownStatus()
{
	$('select.c-placeholder-text-styled option:selected').map(function(){
		
		//console.log(this);
		if($(this).val() === '')
		{
			$(this).parent().addClass("my-select");
		}
		else
			$(this).parent().removeClass("my-select");	
		
	});
}


/*Fetch Development Form Record
=====================================*/
function vfRepeatButtons(){

	$('.vf-btn').each(function(){

		$(this).click(function(){

			let repeat_section = $(this).parent().parent();
			
			var volume_no = repeat_section.children().find('.key')[0].value;
			var folio_no = repeat_section.children().find('.key')[1].value;

			var folio_key = volume_no+'_'+folio_no;

			if(volume_no && folio_no)
			{
				/*$.ajaxSetup({
				  headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  }
				});*/
				var params = {
					'key' : folio_key, 
					'flag' : 1
				};
				ajaxGetDevelopment(params);
			}
			else if(!volume_no)
			{	
				$('input').val('');
				$('textarea').val('');
				$('#showerror').css('display','') ; 
				$('#showerror ul li').text('*Please Fill Volume No. Field.') ; 
				setTimeout(function(){ 
					$('#showerror').css('display','none') ; 
				},2000);
			}
			else if(!folio_no)
			{	
				$('input').val('');
				$('textarea').val('');
				$('#showerror').css('display','') ; 
				$('#showerror ul li').text('*Please Fill Folio No. Field.') ; 
				setTimeout(function(){ 
					$('#showerror').css('display','none') ; 
				},2000);
			}

		}); 
		
	});
}

function ajaxGetDevelopment(params)
{
	$.ajax({
        /* the route pointing to the post function */
        url: 'updateDevelopmentView',
        type: 'POST',
        data: params,
        dataType: 'JSON',
        beforeSend: function () {
        	/*Font Awesome
			====================================*/
			// console.log(Object.keys(params).length > 1);
			//when coming from Dev DropDown
			if(Object.keys(params).length > 1)
				$('#gear1').css('display','block');
			
        },
        success: function (data) { 
        	setTimeout(function(){ 
        		$('#gear1').css('display','none'); 

        		var form_data = data;

            	if(data == '')
            	{	
            		$('input').val('');
					$('#showerror').css('display','') ; 
					$('#showerror ul li').text('*No record found!.') ; 
					setTimeout(function(){ 
						$('#showerror').css('display','none') ; 
					},2000);
            	}
            	else
            	{
            		$('#showerror').empty(); 
            		$('#showerror').css('display','none'); 

            		$.each(form_data, function(key, value){
	            		//console.log(key+'  :'+value.key);
            			var i = $("input[name*='"+value.key+"']");
            			var t = $("textarea[name='"+value.key+"']");
            			var s = $("select[name='"+value.key+"']");

            			if(i.length)
            				$("input[name*='"+value.key+"']").val(value.value);
            			if(t.length)
            				$("textarea[name='"+value.key+"']").val(value.value);
            			if(s.length){
            				$("select[name='"+value.key+"']").val(value.value);
            				$("select[name='"+value.key+"']").css('color','black')
            			}

	            	});
            		checkDropDownStatus();	
            	}
        	}, 300);         

        }
    }); 
}

/*Fetch Property Form Record
=====================================*/
function lookUpProperty(flag='')
{
	if(flag === 1)
		var record_id 	= $('#dev_name').val();
	else
		var record_id 	= $('#autocomplete').val();

	if(record_id)
	{
		// $.ajaxSetup({
		//   headers: {
		//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		//   }
		// });
		
		$.ajax({
            /* the route pointing to the post function */
            url: 'updatePropertyView',
            type: 'post',
            data: { id : record_id, devFlag : flag},
            dataType: 'JSON',
            beforeSend: function () {
            	/*Font Awesome
				====================================*/
				if(flag != 1)
					$('#gear-folio').css('display','block');
				
            },
            success: function (data) { 
            	setTimeout(function(){ 
            		$('#gear-folio').css('display','none'); 

            		var form_data = data;
	            	if(data == '')
	            	{	
	            		$('input').val('');
						$('#showerror').css('display','') ; 
						$('#showerror ul li').text('*No record found!.') ;  
	            		setTimeout(function(){ 
							$('#showerror').css('display','none') ; 
						},2000);
	            	}
	            	else
	            	{
	            		$('#showerror').empty(); 
			            $('#showerror').css('display','none'); 

	            		//Multiple Vendor Handling
	            		vcount = form_data.vcount - 1;
	            		bcount = form_data.bcount - 1;

	            		delete form_data.vcount;
	            		delete form_data.bcount;

	            		add_section('#vendor',vcount);
	            		add_section('#buyer',bcount);

	            		//console.log(form_data);
	            		$.each(form_data, function(key, value){
		            		// console.log(value.key+'  :'+value.value);
		            		// console.log(value.key);
		            		// console.log(value.value);
		            		// console.log($("input[name*='"+value.key+"']"));
	            			var i = $("input[name*='"+value.key+"']");
	            			var t = $("textarea[name*='"+value.key+"']");
	            			var s = $("select[name*='"+value.key+"']");	            			

	            			if(Array.isArray(value)){
	            				//console.log(value);
            					var i = 0;
            					$("form [name='"+value[0].key+"[]']").map(function(){
				            		$(this).val(value[i++].value);
			            			
			            		});
	            			}
	            			else{

	            				if(i.length){

		            				$("input[name*='"+value.key+"']").val(value.value);
		            			}
		            			if(t.length)
		            				$("textarea[name*='"+value.key+"']").val(value.value);
		            			if(s.length){
		            				$("select[name*='"+value.key+"']").val(value.value);
		            				$("select[name*='"+value.key+"']").css('color','black')
		            			}	
	            			}	
	            			checkDropDownStatus();
	            			if(flag == 'soa')
								sumExpenses();
	            		});
	            	}
            	}, 300);         	

            }
        }); 
	}
	else
	{	
		$('input').val('');
		$('textarea').val('');
		$('#showerror').css('display','') ; 
		$('#showerror ul li').text('*Please Fill Record No. Field.') ; 
		setTimeout(function(){ 
			$('#showerror').css('display','none') ; 
		},2000);
	}

}

function onClickLot()
{
	var volume_no 	= $('#c-25-1627').val();
	var folio_no 	= $('#c-2-768').val();
	var lot_key 	= $('#c-0-770').val();

	if(folio_no && volume_no)
		folio_key = volume_no+'_'+folio_no;		

	if(volume_no && folio_no  && lot_key)
	{
		// $.ajaxSetup({
		//   headers: {
		//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		//   }
		// });
		
		$.ajax({
            /* the route pointing to the post function */
            url: 'updatePropertyView',
            type: 'post',
            data: { folio : folio_key, lot : lot_key },
            dataType: 'JSON',
            beforeSend: function () {
            	/*Font Awesome
				====================================*/
				$('#gear-lot').css('display','block');
				
            },
            success: function (data) { 
            	setTimeout(function(){ 
            		$('#gear-lot').css('display','none'); 

            		var form_data = data;

	            	if(data == '')
	            	{	
	            		// $('input').val('');
						$('#c-message-lot').text('*No record found!.') ; 
	            	}
	            	else
	            	{
	            		//Multiple Vendor Handling
	            		vcount = form_data.vcount - 1;
	            		bcount = form_data.bcount - 1;
	            		console.log(vcount);

	            		delete form_data.vcount;
	            		delete form_data.bcount;

	            		add_section('#vendor',vcount);
	            		add_section('#buyer',bcount);

	            		$('#c-message-lot').empty(); 
	            		//console.log(form_data);
	            		$.each(form_data, function(key, value){
		            		// console.log(value.key+'  :'+value.value);
		            		// console.log(value.key);
		            		// console.log(value.value);
		            		// console.log($("input[name*='"+value.key+"']"));
	            			var i = $("input[name*='"+value.key+"']");
	            			var t = $("textarea[name*='"+value.key+"']");
	            			var s = $("select[name*='"+value.key+"']");	            			

	            			if(Array.isArray(value)){
	            				//console.log(value);
            					var i = 0;
            					$("form [name='"+value[0].key+"[]']").map(function(){
				            		$(this).val(value[i++].value);
			            			
			            		});
	            			}
	            			else{

	            				if(i.length){

		            				$("input[name*='"+value.key+"']").val(value.value);
		            			}
		            			if(t.length)
		            				$("textarea[name*='"+value.key+"']").val(value.value);
		            			if(s.length){
		            				$("select[name*='"+value.key+"']").val(value.value);
		            				$("select[name*='"+value.key+"']").css('color','black')
		            			}	
	            			}	
	            			checkDropDownStatus();
		            	});

	            	}
            	}, 300);         	
            }
        }); 
	}
	else if(!volume_no && !folio_no && !lot_key)
	{	
		$('input').val('');
		$('textarea').val('');
		$('#c-message-folio').text('*Please Fill Volume/Folio Field.') ; 
		$('#c-message-lot').text('*Please Fill Lot No. Field.') ; 
	}
	else if(!volume_no && !folio_no)
	{	
		$('input').not('#c-0-770').val('');
		$('textarea').val('');
		$('#c-message-lot').text('') ; 
		$('#c-message-folio').text('*Please Fill Volume/Folio Field.') ; 
	}
	else if(!lot_key)
	{	
		$('input').not('#c-2-768').val('');
		$('textarea').val('');
		$('#c-message-folio').text('') ; 
		$('#c-message-lot').text('*Please Fill Lot No. Field.') ; 
	}

}

/*Merge & Download
=================================*/


/*Add Section Dynamically
====================================*/
//Add Section
function add_section(id, count) {
	var section_group 	= $(id);
	
	for (var i = 0; i < count; i++) {
		var add_section 	= section_group.children().last().clone();

		add_section.css('display', '');
		add_section.find('.c-editor input').val('');
		
		add_section.find('.c-editor input').each(function() {
			//console.log($(this));
			var arr			= $(this).attr('id').split('-');
			var new_value 	= parseInt(arr[2]) + 1;
			
			arr[2]			= new_value;

			var new_arr		= arr.join('-');	
			$(this).attr('id', new_arr);

			if($(this).hasClass('datepicker')){
				//$('.datepicker');
				//console.log(new_arr);
				$(this).datepicker();
			}
		});
		//add_section.find('.c-datepicker').attr('id');
		add_section.appendTo(section_group);

		//numbering
		var num = 1;
		section_group.children().each(function () {

			if($(this).css('display') === "block"){
				$(this).find('.c-repeating-section-item-title span').text(num);
				num++;
			}
		});
		initInputMask();
	}
}

function initDevId()
{
	$.ajax({
	    url: baseurl+'/getDevId',
	    type: 'get',
	    success: function(result) {
	        $('#dev_id').val(result);
	    },
	    error: function(request,msg,error) {
	        // handle failure
	        console.log("error: devId");
	    }
	});
}

//Currency Input Mask
function initInputMask(/*symbol*/){
	$('.currency').inputmask("numeric", {
	    radixPoint: ".",
	    groupSeparator: ",",
	    digits: 2,
	    autoGroup: true,
	    // prefix: symbol+' ', 		//Space after $, this will not truncate the first character.
	    rightAlign: false
	    // ,oncleared: function () { self.Value(''); }
	});

	$('.phone-mask').inputmask({"mask": "(999) 999-9999"});
	
	$('.trn-mask').inputmask({
		"mask": "[999-999-999]"
	});
}

//Statement of Account Submission
// $(function(){

// 	$(document).on('click', '#payment-submit-button', function(){
// 		//event.preventDefault();
// 		var req = [];
// 		var request = $("input[name*='monetary']").map(function(){
// 			let name 	= $(this).attr("name");
// 			let value 	= $(this).val();
// 			console.log(name);
// 			console.log(value);
// 			req[name] = value;
// 			return req;
// 		}).get();
// 		console.log(request);
// 		/*Merge Data into Statement of Account Template*/
// 		// $.ajax({
//   //           /* the route pointing to the post function */
//   //           url: 'payment/show',
//   //           type: 'post',
//   //           data: {  },
//   //           dataType: 'JSON',
//   //           beforeSend: function () {
//   //           	/*Font Awesome
// 		// 		====================================*/
// 		// 		$('#gear-lot').css('display','block');
				
//   //           },
//   //           success: function (data) { 
//   //           	setTimeout(function(){ 
//   //           		$('#gear-lot').css('display','none'); 

//   //           		var form_data = data;

// 	 //            	if(data == '')
// 	 //            	{	
// 	 //            		// $('input').val('');
// 		// 				$('#c-message-lot').text('*No record found!.') ; 
// 	 //            	}
// 	 //            	else
// 	 //            	{
// 	 //            		//Multiple Vendor Handling
// 	 //            		vcount = form_data.vcount - 1;
// 	 //            		bcount = form_data.bcount - 1;
// 	 //            		console.log(vcount);

// 	 //            		delete form_data.vcount;
// 	 //            		delete form_data.bcount;

// 	 //            		add_section('#vendor',vcount);
// 	 //            		add_section('#buyer',bcount);

// 	 //            		$('#c-message-lot').empty(); 
// 	 //            		//console.log(form_data);
// 	 //            		$.each(form_data, function(key, value){
// 		//             		// console.log(value.key+'  :'+value.value);
// 		//             		// console.log(value.key);
// 		//             		// console.log(value.value);
// 		//             		// console.log($("input[name*='"+value.key+"']"));
// 	 //            			var i = $("input[name*='"+value.key+"']");
// 	 //            			var t = $("textarea[name*='"+value.key+"']");
// 	 //            			var s = $("select[name*='"+value.key+"']");	            			

// 	 //            			if(Array.isArray(value)){
// 	 //            				//console.log(value);
//   //           					var i = 0;
//   //           					$("form [name='"+value[0].key+"[]']").map(function(){
// 		// 		            		$(this).val(value[i++].value);
			            			
// 		// 	            		});
// 	 //            			}
// 	 //            			else{

// 	 //            				if(i.length){

// 		//             				$("input[name*='"+value.key+"']").val(value.value);
// 		//             			}
// 		//             			if(t.length)
// 		//             				$("textarea[name*='"+value.key+"']").val(value.value);
// 		//             			if(s.length){
// 		//             				$("select[name*='"+value.key+"']").val(value.value);
// 		//             				$("select[name*='"+value.key+"']").css('color','black')
// 		//             			}	
// 	 //            			}	
// 	 //            			checkDropDownStatus();
// 		//             	});

// 	 //            	}
//   //           	}, 300);         	
//   //           }
//   //       }); 

// 		//
// 	});
// });