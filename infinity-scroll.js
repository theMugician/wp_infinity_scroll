var ajaxurl = infinity_scroll_params.ajax_url; //'http://localhost/infscroll/custom/wp-admin/admin-ajax.php';
var max = infinity_scroll_params.max_page;
var page = 2;  
var loadWrapper = jQuery('#main');
var btn = jQuery('#load-posts');
var loading = false;

// Simulate Loading animation
function simulateLoad () {
  btn.addClass('button--loading');
  btn.find('span').html('Loading...');
}

// Stop Loading animation
function noLoad () {
  btn.removeClass('button--loading');
  btn.find('span').html('Load More');
}

function loadPosts () {

  jQuery.ajax({
    url: ajaxurl,
    type: 'post',
    data: {
      page: page,
      action: 'load_posts_by_ajax'
    },
    error: function (response) {
      console.log(error);
    },
    success: function (response) {
      jQuery(loadWrapper).append(response);
      if (page === parseInt(max)) {
        btn.remove();
      }
      noLoad();
      loading = false;
      page++;
    }
  })      
};

jQuery(function($) {

  $(window).scroll(function() {
    if($(window).scrollTop() > $(document).height() - $(window).height() - 180 && page <= max){
      if (!loading) {
        loading = true;
        simulateLoad();
        setTimeout(function(){
          loadPosts();
        }, 300);
      }
    }
  })
});