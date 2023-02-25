// *************************************************************************//
// ! This is main JS file that contains custom scripts used in this template*/
// *************************************************************************//
/**
	Navigation File

	01. Carousel
	02. Custom Select
	03. Mobile Menu

 */

$( document ).ready(function() {
	"use strict";
	// **********************************************************************//
	// 01. Carousel
	// **********************************************************************//
	$('.base-slider, .slider').owlCarousel({
		loop: true,
		margin: 0,
		nav: true,
		navText: ["<img src='assets/images/arrow-left.png'>","<img src='assets/images/arrow-right.png'>"],
		dots: false,
		item: 1,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
	$('.partner-slider').owlCarousel({
		loop: true,
		margin: 0,
		nav: false,
		autoplay: true,
		dots: false,
		item: 5,
		responsive:{
			0:{
				items:2
			},
			600:{
				items:3
			},
			1000:{
				items:5
			}
		}
	});

	// **********************************************************************//
	// 02. Custom Select
	// **********************************************************************//
	$('select').each(function(){
		var $this = $(this), numberOfOptions = $(this).children('option').length;

		$this.addClass('select-hidden'); 
		$this.wrap('<div class="select"></div>');
		$this.after('<div class="select-styled"></div>');

		var $styledSelect = $this.next('div.select-styled');
		$styledSelect.text($this.children('option').eq(0).text());

		var $list = $('<ul />', {
			'class': 'select-options'
		}).insertAfter($styledSelect);

		for (var i = 0; i < numberOfOptions; i++) $('<li />', {
			rel: $this.children('option').eq(i).val(),
			text: $this.children('option').eq(i).text()
		}).appendTo($list);

		var $listItems = $list.children('li');

		$styledSelect.click(function(e) {
			e.stopPropagation();
			$('div.select-styled.active').not(this).each(function(){
				$(this).removeClass('active').next('ul.select-options').hide();
			});
			$(this).toggleClass('active').next('ul.select-options').toggle();
		});

		$listItems.click(function(e) {
			e.stopPropagation();
			$styledSelect.text($(this).text()).removeClass('active');
			$this.val($(this).attr('rel'));
			$list.hide();
		});

		$(document).click(function() {
			$styledSelect.removeClass('active');
			$list.hide();
		});

	});

	// **********************************************************************//
	// 03. Mobile Menu
	// **********************************************************************//
	$('.mobile-menu-btn').on('click', function(){
		$(this).toggleClass('active');
		$('header').toggleClass('active');
		$('body').toggleClass('mobile-menu-open');
	});

});


$( document ).ready(function() {
	
	var drop = $("input");
drop.on('dragenter', function (e) {
  $(".drop").css({
    "border": "4px dashed #09f",
    "background": "rgba(0, 153, 255, .05)"
  });
  $(".cont").css({
    "color": "#09f"
  });
}).on('dragleave dragend mouseout drop', function (e) {
  $(".drop").css({
    "border": "3px dashed #DADFE3",
    "background": "transparent"
  });
  $(".cont").css({
    "color": "#8E99A5"
  });
});



function handleFileSelect(evt) {
  var files = evt.target.files; // FileList object

  // Loop through the FileList and render image files as thumbnails.
  for (var i = 0, f; f = files[i]; i++) {

    // Only process image files.
    if (!f.type.match('image.*')) {
      continue;
    }

    var reader = new FileReader();

    // Closure to capture the file information.
    reader.onload = (function(theFile) {
      return function(e) {
        // Render thumbnail.
        var span = document.createElement('span');
        span.innerHTML = ['<img class="thumb" src="', e.target.result,
                          '" title="', escape(theFile.name), '"/>'].join('');
        document.getElementById('list').insertBefore(span, null);
      };
    })(f);

    // Read in the image file as a data URL.
    reader.readAsDataURL(f);
  }
}

$('#files').change(handleFileSelect);
});

