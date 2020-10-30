
	
/* --------------------------------------------------
	Initialization
-------------------------------------------------- */

    // Initialize all functions when the document is ready.
	$(document).ready(function(){
		initResize();
		initScroller();
		initAnimation();
		initowlCarousel();
		initContactAjax();
	});


/* --------------------------------------------------
	Scroll Nav
-------------------------------------------------- */

	function initScroller () {
		$('#scroll-page-content').localScroll({
           target:'#page-content'
        });
		$('#page-top').localScroll({
           target:'body'
        });
	}


/* --------------------------------------------------
	Animation
-------------------------------------------------- */

	function initAnimation () {
		new WOW().init();
	}


	
/* --------------------------------------------------
	Owl Carusel
-------------------------------------------------- */

	function initowlCarousel () {
		$("#owl-blog").owlCarousel({
			autoPlay: 3000,
			items : 3,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,2],
			itemsTablet : [768, 1],
			itemsMobile : [479, 1],
			navigation: false,
		});
		$("#owl-branding").owlCarousel({
			autoPlay: 3000,
			items : 5,
			itemsDesktop : [1199,4],
			itemsDesktopSmall : [979,3],
			itemsTablet : [768, 2],
			itemsMobile : [479, 2],
			navigation: false,
		});
	}

/* --------------------------------------------------
	Resize
-------------------------------------------------- */

	function initResize () {
		var header = $(".header-text");
		$(window).scroll(function() {
			var scroll = $(window).scrollTop();
			if ($(".index-page").length > 0) {
				if (scroll >= 270) {
					header.addClass("remove");
				} else {
					header.removeClass("remove");
				}
			}else{
				if (scroll >= 120) {
					header.addClass("remove");
				} else {
					header.removeClass("remove");
				}
			}
		});
		
		$(window).resize(function(){
			var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
			var footerHeight = $('#footer').outerHeight();
			if (width >= '768') { 
				$('#page-content').css({'marginBottom': footerHeight + 'px'});
			}else{
				$('#page-content').css({'marginBottom': '0px'});
			}
		});
		$(window).resize();
	}
	

/* --------------------------------------------------
	Ajax Contact Form
-------------------------------------------------- */

	function initContactAjax () {
		$("#submit_btn").click(function() { 
		   
			var proceed = true;
			//simple validation at client's end
			//loop through each field and we simply change border color to red for invalid fields		
			$("#contact_form input[required=true], #contact_form textarea[required=true]").each(function(){
				$(this).css('border-color',''); 
				if(!$.trim($(this).val())){ //if this field is empty 
					$(this).css('border-color','red'); //change border color to red   
					proceed = false; //set do not proceed flag
				}
				//check invalid email
				var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
				if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
					$(this).css('border-color','red'); //change border color to red   
					proceed = false; //set do not proceed flag				
				}	
			});
		   
			if(proceed) //everything looks good! proceed...
			{
				//get input field values data to be sent to server
				post_data = {
					'user_name'		: $('input[name=name]').val(), 
					'user_email'	: $('input[name=email]').val(), 
					<!-- 'country_code'	: $('input[name=phone1]').val(),  -->
					<!-- 'phone_number'	: $('input[name=phone2]').val(),  -->
					'subject'		: $('select[name=subject]').val(), 
					'msg'			: $('textarea[name=message]').val()
				};
				
				//Ajax post data to server
				$.post('contact.php', post_data, function(response){  
					if(response.type == 'error'){ //load json data from server and output message     
						output = '<div class="error">'+response.text+'</div>';
					}else{
						output = '<div class="success">'+response.text+'</div>';
						//reset values in all input fields
						$("#contact_form  input[required=true], #contact_form textarea[required=true]").val(''); 
						$("#contact_form #contact_body").slideUp(); //hide form after success
					}
					$("#contact_form #contact_results").hide().html(output).slideDown();
				}, 'json');
			}
		});
		
		//reset previously set border colors and hide all message on .keyup()
		$("#contact_form  input[required=true], #contact_form textarea[required=true]").keyup(function() { 
			$(this).css('border-color',''); 
			$("#result").slideUp();
		});
	}