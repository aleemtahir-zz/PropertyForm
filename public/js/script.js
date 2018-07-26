
$(document).ready(function(){

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
	});

    //Remove Section
    $(document).on('click', ".c-action-col a", function() {

    	var section_group 		= $(this).parents('.c-repeating-section-group');
    	var section_container 	= $(this).parents('.c-repeating-section-container');
    	section_container.css('display', 'none');
    	
    	//numbering
		var num = 1;
		section_group.children().each(function () {

			if($(this).css('display') === "block"){
				$(this).find('.c-repeating-section-item-title span').text(num);
				num++;
			}
		});
	});


	$(function () {
       $('.datepicker').datepicker();
    });


    //Save Button
    /*$('.save_btn').click(function(){
        var clickBtnValue = $(this).val();
        var ajaxurl = 'ajax.php',
        data =  {'action': clickBtnValue};
        $.post(ajaxurl, data, function (response) {
            // Response div goes here.
            alert("action performed successfully");
        });
    });
    */

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

$('#fc_symbol').val('');		        
$('#fc_symbol').val(mapper[fc]);	
/*Foriegn Currency
=====================================*/
$('#fc_name').change(function(){
	var fc = $('#fc_name').val();
	var mapper = {'United States Dollar': 'USD', 'Canadian Dollar': 'CAD', 'Pound Sterling': 'UKP'};

	$('#fc_symbol').val('');		        
	$('#fc_symbol').val(mapper[fc]);		        
})

/*Calculate Price
=====================================*/
$('#c_price').change(function(){
	var price = $('#c_price').val();
	var pricej = $('#c_pricej').val();		        
	var rate = $('#fc_rate').val();		        

	$('#c_pricej').val(price*rate);		        
})
$('#fc_rate').change(function(){
	var price = $('#c_price').val();
	var pricej = $('#c_pricej').val();		        
	var rate = $('#fc_rate').val();		        

	$('#c_pricej').val(price*rate);		        
})		


$('input[type=file]').change(function () {
	var filePath=$('#fileUpload').val();
	$('.c-fileupload-dropzone-message').html(filePath.replace('C:\\fakepath\\','')); 
});

checkDropDownStatus();

/*END Document Ready
====================================*/
});


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
function fetchRecordDev()
{
	var volume_no 	= $('#c-25-1627').val();
	var folio_no 	= $('#c-25-1628').val();

	var folio_key = volume_no+'_'+folio_no;

	if(volume_no && folio_no)
	{
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		
		$.ajax({
            /* the route pointing to the post function */
            url: 'updateDevelopmentView',
            type: 'POST',
            data: { key : folio_key },
            dataType: 'JSON',
            beforeSend: function () {
            	/*Font Awesome
				====================================*/
				$('#gear1').css('display','block');
				
            },
            success: function (data) { 
            	setTimeout(function(){ 
            		$('#gear1').css('display','none'); 

            		var form_data = data;

	            	if(data == '')
	            	{	
	            		$('input').val('');
						$('#c-message').text('*No record found!.') ; 
	            	}
	            	else
	            	{
	            		$('#c-message').empty(); 
	            		$.each(form_data, function(key, value){
		            		//console.log(key+'  :'+value.key);
	            			var i = $("input[name='"+value.key+"']");
	            			var t = $("textarea[name='"+value.key+"']");
	            			var s = $("select[name='"+value.key+"']");

	            			if(i.length)
	            				$("input[name='"+value.key+"']").val(value.value);
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
	else if(!volume_no)
	{	
		$('input').val('');
		$('textarea').val('');
		$('#c-message').text('*Please Fill Volume No. Field.') ; 
	}
	else if(!folio_no)
	{	
		$('input').val('');
		$('textarea').val('');
		$('#c-message').text('*Please Fill Folio No. Field.') ; 
	}

}

/*Fetch Property Form Record
=====================================*/
function onClickFolio()
{
	var volume_no 	= $('#c-25-1627').val();
	var folio_no 	= $('#c-2-768').val();

	folio_key = volume_no+'_'+folio_no;

	if(volume_no && folio_no)
	{
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		
		$.ajax({
            /* the route pointing to the post function */
            url: 'updatePropertyView',
            type: 'post',
            data: { folio : folio_key },
            dataType: 'JSON',
            beforeSend: function () {
            	/*Font Awesome
				====================================*/
				$('#gear-folio').css('display','block');
				
            },
            success: function (data) { 
            	setTimeout(function(){ 
            		$('#gear-folio').css('display','none'); 

            		var form_data = data;

	            	if(data == '')
	            	{	
	            		$('input').val('');
						$('#c-message-folio').text('*No record found!.') ; 
	            	}
	            	else
	            	{
	            		$('#c-message-folio').empty(); 
	            		$.each(form_data, function(key, value){
		            		//console.log(value.key+'  :'+value.value);
		            		//console.log(value.key);
		            		//console.log($("input[name*='"+value.key+"']"));
	            			var i = $("input[name*='"+value.key+"']");
	            			var t = $("textarea[name*='"+value.key+"']");
	            			var s = $("select[name*='"+value.key+"']");

	            			if(i.length)
	            				$("input[name*='"+value.key+"']").val(value.value);
	            			if(t.length)
	            				$("textarea[name*='"+value.key+"']").val(value.value);
	            			if(s.length){
	            				$("select[name*='"+value.key+"']").val(value.value);
	            				$("select[name*='"+value.key+"']").css('color','black')
	            			}

		            	});
	            		checkDropDownStatus();
	            	}
            	}, 300);         	

            }
        }); 
	}
	else if(!volume_no)
	{	
		$('input').val('');
		$('textarea').val('');
		$('#c-message-folio').text('*Please Fill Volume No. Field.') ; 
	}
	else if(!folio_no)
	{	
		$('input').val('');
		$('textarea').val('');
		$('#c-message-folio').text('*Please Fill Folio No. Field.') ; 
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
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		
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
	            		$('input').val('');
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
	}
}