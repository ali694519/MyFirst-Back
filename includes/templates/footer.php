
<div>
    
</div>
<script src="<?php echo $js;?>jquery-3.6.0.min.js"></script>
<script src="<?php echo $js;?>bootstrap.js"></script>
<script src="<?php echo $js;?>jquery-ui.min.js"></script>
<script src="<?php echo $js;?>jquery.selectBoxIt.min.js"></script>
<script src="<?php echo $js;?>popper.min.js"></script>
<script>
    $(function() {

// use strict;


// Dashboard
$('.toggle-info ').click(function() {
    $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);
    if($(this).hasClass('selected')) {
$(this).html('<i class="fa fa-minus fa-lg"></i>');
    }else{
$(this).html('<i class="fa fa-plus fa-lg"></i>');
    }
});


// Trigger The Selectbox

// Calls the selectBoxIt method on your HTML select box and uses the default theme
  $("select").selectBoxIt( {
      
    autoWidth: false
  });

// Hide Placeholder On Form Focus

$('[placeholder]').focus(function() {
    $(this).attr('data-text',$(this).attr('placeholder'));
    $(this).attr('placeholder','');
}).blur(function() {
$(this).attr('placeholder',$(this).attr('data-text'));
});

// Add Asterisk On Required Field

$('input').each(function() {
    if($(this).attr('required')=== 'required') {
        $(this).after("<span class='asterisk'>*</span>")
    }
});

// Convert Password Field To Text Field On Hover

var passField = $('.password');
$('.show-pass').hover(function () {
passField.attr('type','text');
},function () {
passField.attr('type','password');
});

// Confirmation Message On Button

$(".confrim").click(function() {

return confirm('Are You Sure?');
});

    // Category View Option
    $('.cat h3').click(function () {
        $(this).next(".full-view").fadeToggle(200);
    });

    $('.option span').click(function() {

        $(this).addClass('active').siblings('span').removeClass('active');

        if($(this).data('view') == 'full') {
        $('.cat .full-view').fadeIn(200);
        }else
         {
        $('.cat .full-view').fadeOut(200);
         }
    });


// Show delete Button On Child Cats

$(".child-link").hover(function() {

    $(this).find(".show-delete").fadeIn(400);
},function() {

    $(this).find(".show-delete").fadeOut(400);
});



    
});
</script>
</body>

</html>