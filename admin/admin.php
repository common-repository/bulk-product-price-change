<?php
/*
** adding necessarey files
*/

function bulk_update_product_prices_admin_files() {

    wp_enqueue_style('bulk_update_product_prices_main_style', plugins_url('/css/style.css', __FILE__));
    wp_enqueue_script('bulk_update_product_prices_custom_logic', plugins_url('/js/logic.js',__FILE__ ));
}
add_action('admin_enqueue_scripts', 'bulk_update_product_prices_admin_files');


//Theme customize 
add_action( 'admin_menu', 'bulk_update_product_prices_admin_page' );


 //Adds a new settings page under Setting menu
function bulk_update_product_prices_admin_page() {
    add_options_page( __( 'Bulk Update Product Prices' ), __( 'Bulk Update Product Prices' ), 'manage_options', 'bulk_update_product_prices_home_page', 'bulk_update_product_prices_page_display' );
}


//Multiple tabs 

function wooLiveSaleAdminTabs( $current = 'first' ) {
    $tabs = array(
        'first'   => __( 'All Proudct Price', 'plugin-textdomain' ), 
        'second'  => __( 'Categories Price', 'plugin-textdomain' ),
        );
    $html = '<h2 class="wooLiveSalenav-tabnav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? 'nav-tab-active' : '';
        $html .= '<a class="nav-tab ' . esc_html($class) . '" href="?page=bulk_update_product_prices_home_page&tab=' . esc_html($tab) . '">' . esc_html($name) . '</a>';
    }
    $html .= '</h2>';
    echo $html ;
}

function bulk_update_product_prices_page_display(){
    ?>
    <div class="cont-p-dashboard">
        <div class="post_like_dislike_header wrap">Dashboard<span>Contact me for further customization, starting from $5. 
            <a href="https://www.fiverr.com/aliali44">Contact</a>
        </span>
    </div>
    <?php

    // ================== Tabs ========================//
     $tab = ( ! empty( $_GET['tab'] ) ) ? esc_attr( $_GET['tab'] ) : 'first';
     wooLiveSaleAdminTabs( $tab );


   // =========================== Tab 1 ========================//
    if ( $tab == 'first' ) {
        ?>
        <div class="woo-live-saleTabs woo-live-sale-firstTab">
            <div class="header-change-price">
                Add price
            </div>
            <div class="cont-list">
                <label>Change all product price using <b>currency</b>(Add price)</label>
                <br>
                <br>
                <div class="example-i">Example: Product price(80) + add price(2) = New price(82)</div>
                <input type="text" class="price-by-currency" placeholder="Enter amount">
            </div>
            <div class="cont-list">
                <label>Change all product price using <b>percentage</b>(Add price)</label>
                <br>
                <br>
                <div class="example-i">Example: Product price(80) + add price(5%) = New price(84)</div>
                <input type="text" class="price-by-percentage" placeholder="Enter amount">
            </div>
            <div class="header-change-price">
               Minus price
            </div>
             <div class="cont-list">
                <label>Change all product price using <b>currency</b>(Minus price)</label>
                <br>
                <br>
                <div class="example-i">Example: Product price(80) - minus price(2) = New price(78)</div>
                <input type="text" class="m-price-by-currency" placeholder="Enter amount">
            </div>
            <div class="cont-list">
                <label>Change all product price using <b>percentage(Minus price)</b></label>
                <br>
                <br>
                <div class="example-i">Example: Product price(80) - minus price(5%) = New price(76)</div>
                <input type="text" class="m-price-by-percentage" placeholder="Enter amount">
            </div>
             <div class="round-value-perc">
                <label>Round value</label>

                <input type="checkbox" class="round-value" checked="">
                <br>
                <br>
                <div class="example-i">Round the value if you want to increase or decrease the price using percentage</div>
                <div class="example-i">Currently the free plugin does not support the increase/descrease values without round</div>
            </div>
           
            <br>
            <button class="button button-primary button-large bulk-update-price-btn">Update</button>
        </div>

        <?php
    }
    // =========================== Tab 2 ========================//
     elseif($tab == 'second' ){
        ?>
        <div class="woo-live-saleTabs woo-live-sale-secondTab">
            <p>Select the Category</p>
            <select>
             
            <?php
            $orderby = 'name';
            $order = 'asc';
            $hide_empty = false ;
            $cat_args = array(
                'orderby'    => $orderby,
                'order'      => $order,
                'hide_empty' => $hide_empty,
            ); 
            $product_categories = get_terms( 'product_cat', $cat_args );
             
            if( !empty($product_categories) ){
                foreach ($product_categories as $key => $category) {
                   echo '<option value="'.$category->name.'">';
                    echo $category->name;
                    echo "</option>";
                }    
            }
            ?>
            </select>
            <div class="header-change-price">
                Add price
            </div>
            <div class="cont-list">
                <label>Change all product price using <b>currency</b>(Add price)</label>
                <br>
                <br>
                <div class="example-i">Example: Product price(80) + add price(2) = New price(82)</div>
                <input type="text" class="price-by-currency-cat" placeholder="Enter amount">
            </div>
            <div class="cont-list">
                <label>Change all product price using <b>percentage</b>(Add price)</label>
                <br>
                <br>
                <div class="example-i">Example: Product price(80) + add price(5%) = New price(84)</div>
                <input type="text" class="price-by-percentage-cat" placeholder="Enter amount">
            </div>
            <div class="header-change-price">
               Minus price
            </div>
             <div class="cont-list">
                <label>Change all product price using <b>currency</b>(Minus price)</label>
                <br>
                <br>
                <div class="example-i">Example: Product price(80) - minus price(2) = New price(78)</div>
                <input type="text" class="m-price-by-currency-cat" placeholder="Enter amount">
            </div>
            <div class="cont-list">
                <label>Change all product price using <b>percentage(Minus price)</b></label>
                <br>
                <br>
                <div class="example-i">Example: Product price(80) - minus price(5%) = New price(76)</div>
                <input type="text" class="m-price-by-percentage-cat" placeholder="Enter amount">
            </div>

           
            <br>
            <button class="button button-primary button-large bulk-update-price-btn-cat">Update</button>
        </div>
        <?php

     }
     // =========================== Tab 3 ========================//
     else{
        ?>
        <div class="woo-live-saleTabs woo-live-sale-thirdTab">
          
        </div>

        <?php
        
     }
}
// ============================ Ajax call for updating the product prices =================================//
add_action('wp_ajax_product_update_btn', 'bppuBulkPriceUpdateAjax');

function bppuBulkPriceUpdateAjax(){


    
 global $wpdb;
 // ========================add amount in the prdouct using currency ==================
 if (isset($_POST['curAddProd']) && $_POST['curAddProd'] != "") {
//get new addable price
$addPrice = (float)$_POST['curAddProd'];
//table name
 $db_table_name = $wpdb->prefix . "postmeta"; 
//setting new sale price
 $update = "UPDATE $db_table_name SET meta_value = meta_value + $addPrice WHERE meta_key = '_sale_price'";
 $results = $wpdb->query( $update );

 $update = "UPDATE $db_table_name SET meta_value = meta_value + $addPrice WHERE meta_key = '_price'";
 $results = $wpdb->query( $update );

  //setting new regular price
 $update = "UPDATE $db_table_name SET meta_value = meta_value + $addPrice WHERE meta_key = '_regular_price'";
 $results = $wpdb->query( $update );
 echo esc_html( "Prouduct prices updated successfully" );
wc_delete_product_transients(); 
//adding data to post meta for last entry
bulk_update_product_prices_last_entry("curAddProd&".$addPrice);
}

// =================add amount in the prdouct using Percentage ==============
 if (isset($_POST['curAddCat']) && $_POST['curAddCat'] != "") {
//get new addable price
$addPrice = (float)$_POST['curAddCat'];
//round value if the checkbox is checked
if ($_POST['roundChecked'] == 1) {
    $addPrice = round($addPrice);
    
}
//table name
 $db_table_name = $wpdb->prefix . "postmeta"; 
//setting new sale price
 $update = "UPDATE $db_table_name SET meta_value = meta_value + meta_value * $addPrice/100 WHERE meta_key = '_sale_price'";
 $results = $wpdb->query( $update );

 //setting new price for veriation
 $update = "UPDATE $db_table_name SET meta_value = meta_value + meta_value * $addPrice/100 WHERE meta_key = '_price'";
 $results = $wpdb->query( $update );

  //setting new regular price
 $update = "UPDATE $db_table_name SET meta_value = meta_value + meta_value * $addPrice/100 WHERE meta_key = '_regular_price'";
 $results = $wpdb->query( $update );
 echo esc_html( "Prouduct prices updated successfully" );
wc_delete_product_transients(); 
//adding data to post meta for last entry
bulk_update_product_prices_last_entry("curAddCat&".$addPrice);
}
 // ========================Minus amount in the prdouct using currency ==================
 if (isset($_POST['curMinusProd']) && $_POST['curMinusProd'] != "") {
//get new addable price
$addPrice = (float)$_POST['curMinusProd'];
//table name
 $db_table_name = $wpdb->prefix . "postmeta"; 
//setting new sale price
 $update = "UPDATE $db_table_name SET meta_value = meta_value - $addPrice WHERE meta_key = '_sale_price'";
 $results = $wpdb->query( $update );

 $update = "UPDATE $db_table_name SET meta_value = meta_value - $addPrice WHERE meta_key = '_price'";
 $results = $wpdb->query( $update );

  //setting new regular price
 $update = "UPDATE $db_table_name SET meta_value = meta_value - $addPrice WHERE meta_key = '_regular_price'";
 $results = $wpdb->query( $update );
 echo esc_html( "Prouduct prices updated successfully" );
wc_delete_product_transients();
//adding data to post meta for last entry
bulk_update_product_prices_last_entry("curMinusProd&".$addPrice); 
}

// =================add amount in the prdouct using Percentage ==============
 if (isset($_POST['curMinusCat']) && $_POST['curMinusCat'] != "") {
//get new addable price
$addPrice = (float)$_POST['curMinusCat'];
//round value if the checkbox is checked
if ($_POST['roundChecked'] == 1) {
    $addPrice = round($addPrice);
}
//table name
 $db_table_name = $wpdb->prefix . "postmeta"; 
//setting new sale price
 $update = "UPDATE $db_table_name SET meta_value = meta_value - meta_value * $addPrice/100 WHERE meta_key = '_sale_price'";
 $results = $wpdb->query( $update );

 //setting new price for veriation
 $update = "UPDATE $db_table_name SET meta_value = meta_value - meta_value * $addPrice/100 WHERE meta_key = '_price'";
 $results = $wpdb->query( $update );

  //setting new regular price
 $update = "UPDATE $db_table_name SET meta_value = meta_value - meta_value * $addPrice/100 WHERE meta_key = '_regular_price'";
 $results = $wpdb->query( $update );
 echo esc_html( "Prouduct prices updated successfully" );
wc_delete_product_transients(); 
//adding data to post meta for last entry
bulk_update_product_prices_last_entry("curMinusCat&".$addPrice);
}
// ======================================= Category wise update ============================//
 // ========================add amount in the prdouct using currency through category ==================
 if (isset($_POST['curAddProdCat']) && $_POST['curAddProdCat'] != "" && $_POST['productCat'] != "") {
//get new addable price
$addPrice   = (float)$_POST['curAddProdCat'];
$pCategory  = $_POST['productCat'];

//getting category id
$categoryList = $wpdb->get_results("SELECT term_id FROM $wpdb->terms WHERE name = '$pCategory'");
$catId        = $categoryList[0]->term_id;

//getting post id 
$args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 500,'product_cat' => 'men-shirt', 'orderby' =>'date','order' => 'ASC' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
global $product;

//post id
$postId = $product->id;

//table name
 $db_table_name = $wpdb->prefix . "postmeta"; 
//setting new sale price
 $update = "UPDATE $db_table_name SET meta_value = meta_value + $addPrice WHERE meta_key = '_sale_price' && post_id ='$postId'";
 $results = $wpdb->query( $update );

 $update = "UPDATE $db_table_name SET meta_value = meta_value + $addPrice WHERE meta_key = '_price' && post_id ='$postId'";
 $results = $wpdb->query( $update );

  //setting new regular price
 $update = "UPDATE $db_table_name SET meta_value = meta_value + $addPrice WHERE meta_key = '_regular_price' && post_id ='$postId'";
 $results = $wpdb->query( $update );
wc_delete_product_transients();
//adding data to post meta for last entry
bulk_update_product_prices_last_entry("curAddProdCat&".$addPrice);
endwhile;wp_reset_query(); 
echo esc_html( "Prouduct prices updated successfully" );
 
}

// ========================add amount in the prdouct using percentage through category ==================
 if (isset($_POST['curAddCatCat']) && $_POST['curAddCatCat'] != "" && $_POST['productCat'] != "") {
//get new addable price
$addPrice = (float)$_POST['curAddCatCat'];
$pCategory  = $_POST['productCat'];

//getting category id
$categoryList = $wpdb->get_results("SELECT term_id FROM $wpdb->terms WHERE name = '$pCategory'");
$catId        = $categoryList[0]->term_id;

//getting post id 
$args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 500,'product_cat' => 'men-shirt', 'orderby' =>'date','order' => 'ASC' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
global $product;

//post id
$postId = $product->id;

//table name
 $db_table_name = $wpdb->prefix . "postmeta"; 
//setting new sale price
 $update = "UPDATE $db_table_name SET meta_value =meta_value + meta_value * $addPrice/100 WHERE meta_key = '_sale_price' && post_id ='$postId'";
 $results = $wpdb->query( $update );

 $update = "UPDATE $db_table_name SET meta_value =meta_value + meta_value * $addPrice/100 WHERE meta_key = '_price' && post_id ='$postId'";
 $results = $wpdb->query( $update );

  //setting new regular price
 $update = "UPDATE $db_table_name SET meta_value = meta_value + meta_value * $addPrice/100 WHERE meta_key = '_regular_price' && post_id ='$postId'";
 $results = $wpdb->query( $update );
 
//adding data to post meta for last entry
bulk_update_product_prices_last_entry("curAddCatCat&".$addPrice);
endwhile;wp_reset_query();
wc_delete_product_transients();
//showing result
 echo esc_html( "Prouduct prices updated successfully" );
}

// ========================Minus amount in the prdouct using currency through category ==================
 if (isset($_POST['curMinusProdCat']) && $_POST['curMinusProdCat'] != "" && $_POST['productCat'] != "") {
//get new addable price
$addPrice = (float)$_POST['curMinusProdCat'];
$pCategory  = $_POST['productCat'];

//getting category id
$categoryList = $wpdb->get_results("SELECT term_id FROM $wpdb->terms WHERE name = '$pCategory'");
$catId   = $categoryList[0]->term_id;

//getting post id 
$args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 500,'product_cat' => 'men-shirt', 'orderby' =>'date','order' => 'ASC' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
global $product;

//post id
$postId = $product->id;

//table name
 $db_table_name = $wpdb->prefix . "postmeta"; 
//setting new sale price
 $update = "UPDATE $db_table_name SET meta_value = meta_value - $addPrice  WHERE meta_key = '_sale_price' && post_id ='$postId'";
 $results = $wpdb->query( $update );

 $update = "UPDATE $db_table_name SET meta_value = meta_value - $addPrice WHERE meta_key = '_price' && post_id ='$postId'";
 $results = $wpdb->query( $update );

  //setting new regular price
 $update = "UPDATE $db_table_name SET meta_value = meta_value - $addPrice WHERE meta_key = '_regular_price' && post_id ='$postId'";
 $results = $wpdb->query( $update );
 
wc_delete_product_transients(); 
//adding data to post meta for last entry
bulk_update_product_prices_last_entry("curMinusProdCat&".$addPrice);
endwhile;wp_reset_query(); 
echo esc_html( "Prouduct prices updated successfully" );
}

// ========================Minus amount in the prdouct using percentage through category ==================
 if (isset($_POST['curMinusCatCat']) && $_POST['curMinusCatCat'] != "" && $_POST['productCat'] != "") {
//get new addable price
$addPrice = (float)$_POST['curMinusCatCat'];
$pCategory  = $_POST['productCat'];
//round value if the checkbox is checked
if ($_POST['roundChecked'] == 1) {
    $addPrice = round($addPrice);
}
//getting category id
$categoryList = $wpdb->get_results("SELECT term_id FROM $wpdb->terms WHERE name = '$pCategory'");
$catId   = $categoryList[0]->term_id;

//getting post id 
$args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 500,'product_cat' => 'men-shirt', 'orderby' =>'date','order' => 'ASC' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
global $product;

//post id
$postId = $product->id;

//table name
 $db_table_name = $wpdb->prefix . "postmeta"; 
//setting new sale price
 $update = "UPDATE $db_table_name SET meta_value = meta_value - meta_value * $addPrice/100 WHERE meta_key = '_sale_price' && post_id ='$postId'";
 $results = $wpdb->query( $update );

 $update = "UPDATE $db_table_name SET meta_value = meta_value - meta_value * $addPrice/100 WHERE meta_key = '_price' && post_id ='$postId'";
 $results = $wpdb->query( $update );

  //setting new regular price
 $update = "UPDATE $db_table_name SET meta_value = meta_value - meta_value * $addPrice/100 WHERE meta_key = '_regular_price' && post_id ='$postId'";
 $results = $wpdb->query( $update );

wc_delete_product_transients(); 
//adding data to post meta for last entry
bulk_update_product_prices_last_entry("curMinusCatCat&".$addPrice);
endwhile;wp_reset_query(); 
}
exit();
 echo esc_html( "Prouduct prices updated successfully" );
}


// ======================== Last entry ============================//
function bulk_update_product_prices_last_entry($lastAdded){
$postMeta = get_post_meta( 100000000, 'bppuLastProcedure', true );
if ($postMeta == "") {
    add_post_meta( 100000000, 'bppuLastProcedure', $lastAdded );
 } 
 else{
     update_post_meta( 100000000, 'bppuLastProcedure', $lastAdded );
 }
 get_post_meta( 100000000, 'bppuLastProcedure', true );
}



