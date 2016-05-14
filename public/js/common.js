//Menue navigation
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});

//Hover over tool tip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

//Menu options
var url = window.location;
$('ul.nav a[href="'+ url +'"]').parent().addClass('active');

//Keep tabs active after refresh
$('#navTab a').click(function(e) {
    e.preventDefault();
    $(this).tab('show');
});

// store the currently selected tab in the hash value
$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
});

// on load of the page: switch to the currently selected tab
var hash = window.location.hash;
$('#navTab a[href="' + hash + '"]').tab('show');

