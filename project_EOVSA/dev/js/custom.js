// Only enable if the document has a long scroll bar
// Note the window height + offset
if ( ($(window).height() + 100) < $(document).height() ) {
    $('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:100}
    });
}

$('#myTab a').click(function(e) {
  e.preventDefault();
  $(this).tab('show');
});




// store the currently selected tab in the hash value
// $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
//   var id = $(e.target).attr("href").substr(1);
//   window.location.hash = id;
// });

// // on load of the page: switch to the currently selected tab
// var hash = window.location.hash;
// $('#myTab a[href="' + hash + '"]').tab('show');