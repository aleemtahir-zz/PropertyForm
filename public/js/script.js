
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
	$('#dev_form').submit(function() {
	    $('#gear2').show(); 
	    return true;
	  });


/*END Document Ready
====================================*/
});



/*Fetch Development Form Record
=====================================*/
function fetchRecordDev()
{
	var folio_key = $('#c-25-1628').val();

	if(folio_key)
	{
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		
		$.ajax({
            /* the route pointing to the post function */
            url: 'updateView',
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

	            	}
            	}, 300);         	
            }
        }); 
	}
	else
	{	
		$('input').val('');
		$('textarea').val('');
		$('#c-message').text('*Please Fill Volume/Folio Field.') ; 
	}

}
