
jQuery(function(){
  'use strict'

  feather.replace();

   /* jQuery('[data-toggle="popover"]').popover(); */
  

  ////////// NAVBAR //////////

  // Initialize PerfectScrollbar of navbar menu for mobile only
  if(window.matchMedia('(max-width: 991px)').matches) {
    const psNavbar = new PerfectScrollbar('#navbarMenu', {
      suppressScrollX: true
    });
  }

  // Showing sub-menu of active menu on navbar when mobile
  function showNavbarActiveSub() {
    if(window.matchMedia('(max-width: 991px)').matches) {
      jQuery('#navbarMenu .active').addClass('show');
    } else {
      jQuery('#navbarMenu .active').removeClass('show');
    }
  }

  showNavbarActiveSub()
  jQuery(window).resize(function(){
    showNavbarActiveSub()
  })

  // Initialize backdrop for overlay purpose
  jQuery('body').append('<div class="backdrop"></div>');


  // Showing sub menu of navbar menu while hiding other siblings
  jQuery('.navbar-menu .with-sub .nav-link').on('click', function(e){
    e.preventDefault();
    jQuery(this).parent().toggleClass('show');
    jQuery(this).parent().siblings().removeClass('show');

    if(window.matchMedia('(max-width: 991px)').matches) {
      psNavbar.update();
    }
  })


jQuery(document).on('click','.formhelp', function(e){
	jQuery('[data-toggle="popover"]').popover();
	
});



jQuery( "#sip-advanced-email-notification-rule" ).addClass( "sip-container-wrapper-email" );

jQuery( "#sip-advanced-email-notification-email" ).addClass( "sip-container-wrapper-email" );

jQuery( "#sip-advanced-email-notification-coupon" ).addClass( "sip-container-wrapper-email" );

jQuery( "#advanced-sortables" ).addClass( "sip-container-wrapper-email" );









  // Closing dropdown menu of navbar menu
  jQuery(document).on('click touchstart', function(e){
    e.stopPropagation();

    // closing nav sub menu of header when clicking outside of it
    if(window.matchMedia('(min-width: 992px)').matches) {
      var navTarg = jQuery(e.target).closest('.navbar-menu .nav-item').length;
      if(!navTarg) {
        jQuery('.navbar-header .show').removeClass('show');
      }
    }
  })

  jQuery('#mainMenuClose').on('click', function(e){
    e.preventDefault();
    jQuery('body').removeClass('navbar-nav-show');
  });

  jQuery('#sidebarMenuOpen').on('click', function(e){
    e.preventDefault();
    jQuery('body').addClass('sidebar-show');
  })

  // Navbar Search
  jQuery('#navbarSearch').on('click', function(e){
    e.preventDefault();
    jQuery('.navbar-search').addClass('visible');
    jQuery('.backdrop').addClass('show');
  })

  jQuery('#navbarSearchClose').on('click', function(e){
    e.preventDefault();
    jQuery('.navbar-search').removeClass('visible');
    jQuery('.backdrop').removeClass('show');
  })



  ////////// SIDEBAR //////////

  // Initialize PerfectScrollbar for sidebar menu
  if(jQuery('#sidebarMenu').length) {
    const psSidebar = new PerfectScrollbar('#sidebarMenu', {
      suppressScrollX: true
    });


    // Showing sub menu in sidebar
    jQuery('.sidebar-nav .with-sub').on('click', function(e){
      e.preventDefault();
      jQuery(this).parent().toggleClass('show');

      psSidebar.update();
    })
  }


  jQuery('#mainMenuOpen').on('click touchstart', function(e){
    e.preventDefault();
    jQuery('body').addClass('navbar-nav-show');
  })

  jQuery('#sidebarMenuClose').on('click', function(e){
    e.preventDefault();
    jQuery('body').removeClass('sidebar-show');
  })



jQuery(document).on('input','#sip-rswc-setting-limit-review-characters', function(e){
var min=0;
var max=500;
var rangeval=jQuery(this).val();
var newVal = Number(((rangeval - min) * 100) / (max - min));
jQuery('#rangevalue span').text(rangeval);
//jQuery('#rangevalue').css("width",`calc(${newVal}% + (${8 - newVal * 0.5}px))`);
jQuery('#rangevalue').css("width",`${newVal}%`);


});
  // hide sidebar when clicking outside of it
  jQuery(document).on('click touchstart', function(e){
    e.stopPropagation();

    // closing of sidebar menu when clicking outside of it
    if(!jQuery(e.target).closest('.burger-menu').length) {
      var sb = jQuery(e.target).closest('.sidebar').length;
      var nb = jQuery(e.target).closest('.navbar-menu-wrapper').length;
      if(!sb && !nb) {
        if(jQuery('body').hasClass('navbar-nav-show')) {
          jQuery('body').removeClass('navbar-nav-show');
        } else {
          jQuery('body').removeClass('sidebar-show');
        }
      }
    }
  });

})
