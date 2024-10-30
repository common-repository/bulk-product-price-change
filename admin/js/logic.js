jQuery(document).ready(function( $ ) {
// ========================== Ajax Call for updating all product pricess============================//
var roundChecked = 1;
$('.round-value').click(function() {
    if($(this).not(':checked'))
        roundChecked = 0;
    else
        roundChecked = 1;
});
$('.bulk-update-price-btn').click(function(){
   
  var curAddProd 	= $('.price-by-currency').val();
  var curAddCat 	= $('.price-by-percentage').val();
  var curMinusProd 	= $('.m-price-by-currency').val();
  var curMinusCat 	= $('.m-price-by-percentage').val();



$.ajax({
    type: "POST",
    url: ajaxurl,
    data: { action: 'product_update_btn' , curAddProd: curAddProd,curAddCat:curAddCat,curMinusProd: curMinusProd,curMinusCat:curMinusCat, roundChecked: roundChecked   }
  }).done(function( msg ) {
         alert(  msg );
          location.reload();
});

 });//end of ajax call for product price update

// ========================== Ajax Call for updating category based product prices============================//
var roundChecked = 1;
$('.round-value').click(function() {
    if($(this).not(':checked'))
        roundChecked = 0;
    else
        roundChecked = 1;
});
$('.bulk-update-price-btn-cat').click(function(){
  //getting category name
  var productCat      = $('.woo-live-sale-secondTab option').val(); 
  var curAddProdCat   = $('.price-by-currency-cat').val();
                      
  var curAddCatCat    = $('.price-by-percentage-cat').val();
  var curMinusProdCat  = $('.m-price-by-currency-cat').val();
  var curMinusCatCat   = $('.m-price-by-percentage-cat').val();
  //getting category name
  $('.woo-live-sale-secondTab option').val();

$.ajax({
    type: "POST",
    url: ajaxurl,
    data: { action: 'product_update_btn' , curAddProdCat: curAddProdCat,curAddCatCat:curAddCatCat,curMinusProdCat: curMinusProdCat,curMinusCatCat:curMinusCatCat, roundChecked: roundChecked, productCat: productCat   }
  }).done(function( msg ) {
         alert(  msg );
         location.reload();
});
 });//end of ajax call for product price update

// ajax call for reverting the the last action
$('.revert-sumbit').click(function() {
  var lastAction = $(this).attr('proc-id');
 $.ajax({
    type: "POST",
    url: ajaxurl,
    data: { action: 'product_update_btn' , lastAction: lastAction }
  }).done(function( msg ) {
         alert(  msg );
         //location.reload();
});
  })

});