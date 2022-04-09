// **
// A little fixed Multiple Filter Masonry here
// https://github.com/digistate/resouces/blob/master/multipleFilterMasonry.js

// Params
var j$ = jQuery,
    $mContainer = j$("#mnsry_container"),
    $filterButton = j$(".button"),
    $loadingMessage = j$("#loading_msg");
    $params = {
      itemSelector: ".item",
      filtersGroupSelector:".filters"
    // Uncomment below to set the selectorType to use <ul> instead of inputs
    // selectorType: "list"
    };

// After the page is loaded
j$(window).load(function() { 
  // Do mansonry with filtering 
  $mContainer.multipleFilterMasonry($params);
  // Show articles with fadein
  $mContainer.find("article").animate({
      "opacity":1
    }, 1200);
  // Hide loading message
  $loadingMessage.fadeOut();
  
  // Change the filtering button(label) status 
  $filterButton.find("input").change(function(){
    j$(this).parent().toggleClass("active");
  });
});