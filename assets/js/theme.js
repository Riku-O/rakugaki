(function($) {
$('.gnav__apps-btn').addClass('close');
$('.gnav__apps-item').css('display', 'none');

$('.js-menu').on('click touched',()=>{
  $( '.header' ).css('opacity', 0);
  $( '.header' ).css('pointer-events', 'none');
  $( '.gnav' ).animate({ 
    opacity: 1
  }, 500 );
  $( '.gnav' ).css('pointer-events', 'auto');
    let current_scrollY = $( window ).scrollTop(); 
    $( 'body' ).css( {
      position: 'fixed',
      top: -1 * current_scrollY
    } );
});

$('.js-search').on('click touched',()=>{
  $( '.header' ).css('opacity', 0);
  $( '.header' ).css('pointer-events', 'none');
  $( '.gnav' ).animate({ 
    opacity: 1
  }, 500 );
  $( '.gnav' ).css('pointer-events', 'auto');
    let current_scrollY = $( window ).scrollTop(); 
    $( 'body' ).css( {
      position: 'fixed',
      top: -1 * current_scrollY
    } );
  $('input').eq(0).focus();
});

$(".js-close").on("click touched", function() {
  $( 'body' ).css( {
    position: 'relative',
    top: 0
  } );
  $( '.gnav' ).animate({ 
    opacity: 0
  }, 500 );
  $( '.gnav' ).css('pointer-events', 'none');
  $( '.header' ).css('opacity', 1);
  $( '.header' ).css('pointer-events', 'auto');
});

$(".gnav__apps-ttl").on("click touched", function() {
  let index = $('.gnav__apps-ttl').index(this);
  if ( $('.gnav__apps-btn').eq(index).hasClass( 'close' ) ) {
    $('.gnav__apps-btn').eq(index).removeClass('close');
  } else {
    $('.gnav__apps-btn').eq(index).addClass('close');
  }
  $('.gnav__apps-item').eq(index).slideToggle();
});

var startPos = 0,winScrollTop = 0,h = $('.header').outerHeight();
$('body').css('padding-top', h);
$(window).on('scroll',function(){
  winScrollTop = $(this).scrollTop();
  if (winScrollTop >= startPos && winScrollTop >= h) {
    $('.header').addClass('hide');
  } else {
    $('.header').removeClass('hide');
  }
  startPos = winScrollTop;
});
})( jQuery );