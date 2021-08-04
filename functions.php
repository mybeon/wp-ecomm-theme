<?php


add_action("wp_enqueue_scripts", function() {
    wp_enqueue_style( "bootstrap-main", get_theme_file_uri("src/css/bootstrap.min.css"), null, null);
    wp_enqueue_style( "templatemo-main", get_theme_file_uri("src/css/templatemo.css"), null, null);
    wp_enqueue_style( "google-fonts-ecomm","https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap", null, null);
    wp_enqueue_style( "custom-main", get_theme_file_uri("src/css/custom.css"), array("bootstrap-main"), null);
    wp_enqueue_style( "font-awesome-main", get_theme_file_uri("src/css/fontawesome.min.css"),null, null);
    wp_enqueue_style( "splide-main", get_theme_file_uri("src/css/splide.min.css"),null, null);
    wp_enqueue_script( "boostrap-js", get_theme_file_uri("src/js/bootstrap.bundle.min.js"), null, null, true );
    wp_enqueue_script( "jquery-js", get_theme_file_uri("src/js/jquery-1.11.0.min.js"), null, null, true );
    wp_enqueue_script( "jquery-migrate-js", get_theme_file_uri("src/js/jquery-migrate-1.2.1.min.js"), array("jquery"), null, true );
    wp_enqueue_script( "templatemo-js", get_theme_file_uri("src/js/templatemo.js"), null, null, true );
    wp_enqueue_script( "custom-js", get_theme_file_uri("src/js/custom.js"), array("splide-js"), null, true );
    wp_enqueue_script( "splide-js", get_theme_file_uri("src/js/splide.min.js"), null, null, true );
});

add_action("after_setup_theme", function() {
    add_theme_support("title-tag");
    add_theme_support( "woocommerce");
    add_theme_support( "html5");
    //add_theme_support( "wc-product-gallery-slider");
    //add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support("custom-logo");
    add_theme_support( 'automatic-feed-links' );
});

/**
 * Show cart contents / total Ajax
*/
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
    <a class="cart-icon nav-icon position-relative text-decoration-none" href="<?php echo wc_get_cart_url() ?>">
    <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
    </a>
	<?php
	$fragments['a.cart-icon'] = ob_get_clean();
	return $fragments;
}

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );

add_filter('woocommerce_checkout_fields', function($field) {
    //var_dump($field);
    $field["billing"]["billing_phone"]["priority"] = 21;
    $field["billing"]["billing_email"]["priority"] = 20;
    $field["billing"]["billing_email"]["priority"] = 20;
    $field["billing"]["billing_first_name"]["class"] = ["inline_field"];
    $field["billing"]["billing_last_name"]["class"] = ["inline_field"];
    return $field;
});

add_action("woocommerce_checkout_before_order_review_heading", function() {
    echo '<div class="container last_form">';
});
add_action("woocommerce_checkout_after_order_review", function() {
    echo "</div>";
});

add_action("woocommerce_review_order_before_payment", function() {
    echo '<h3 style="margin-bottom: 1rem">Payment methods</h3>';
});

function disable_woo_commerce_hooks() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); 
    remove_action( "woocommerce_before_main_content", "woocommerce_breadcrumb", 20 );
    remove_action("woocommerce_single_product_summary", "woocommerce_template_single_title", 5);
    remove_action("woocommerce_single_product_summary", "woocommerce_template_single_rating", 10);
    remove_action("woocommerce_single_product_summary", "woocommerce_template_single_excerpt", 20);
    remove_action("woocommerce_single_product_summary", "woocommerce_template_single_meta", 40);
    remove_action("woocommerce_after_single_product_summary", "woocommerce_output_product_data_tabs", 10);
    remove_action("woocommerce_after_single_product_summary", "woocommerce_output_related_products", 20);
    add_action("woocommerce_account_dashboard", "ecomm_dashboard");
    add_action("woocommerce_single_product_summary", "ecomm_theme_title", 5);
    add_action("woocommerce_single_product_summary", "ecomm_theme_brand", 12);
    add_action("woocommerce_single_product_summary", "ecomm_theme_rating", 11);
    add_action("woocommerce_single_product_summary", "ecomm_theme_desciption", 15);
    add_action("woocommerce_single_product_summary", "ecomm_theme_specs", 20);
    add_action("woocommerce_after_single_product_summary", "ecomm_theme_related", 20);
}
add_action('init', 'disable_woo_commerce_hooks');

function ecomm_theme_title() {
    the_title( '<h1 class="h2">', '</h1>' );
}


function ecomm_theme_brand() {  
    if( get_field("brand") ) { ?>
        <ul class="list-inline">
        <li class="list-inline-item">
            <h6><strong>Brand:</strong></h6>
        </li>
        <li class="list-inline-item">
            <p class="text-muted"><strong><?php the_field("brand") ?></strong></p>
        </li>
    </ul>
<?php    }
   }


function ecomm_theme_rating() {
    global $product;
    $ratings = get_post_meta(get_the_ID(), "_wc_average_rating", true);
    echo '<p class="py-2">';
    echo str_repeat('<i class="text-warning fa fa-star"></i>', intval($ratings));
    echo str_repeat('<i class="text-muted fa fa-star"></i>', 5 - intval($ratings));
    echo sprintf('<span class="list-inline-item text-dark">Rating %s | %d Comments</span>', $ratings, $product->review_count);
    echo "</p>";
}

function ecomm_theme_desciption() { ?>
    <h6 class="h4">Description: </h6>
    <p><?php echo esc_html(get_the_content()) ?></p>
<?php }

function ecomm_theme_specs() { ?>
    <h6 class="h4">Specification: </h6>
    <p><?php echo get_the_excerpt() ?></p>
<?php 
}

function ecomm_theme_related() {
    $post_ids = wc_get_related_products( get_the_ID(), 3);
    if ($post_ids) {
        $related_products = new WP_Query(array(
            "post_type" => "product",
            "post__in" => $post_ids
        )); ?>
        <section class="py-5">
                <div class="container">
                    <h6 class="h4">Related products</h6>
                    <div class="related">
                        <?php while($related_products->have_posts()) {
                        $related_products->the_post(); ?>
                        <?php get_template_part("templates/content", "product"); ?>
                        <?php } 
                        wp_reset_postdata();
                        ?>
                    </div>
            </div>
       </section>
<?php  }
 }

add_action("pre_get_posts", function($query) {
    if (is_shop() && $query->is_main_query() && !is_admin() ) {

        $query->set("tax_query", array(
            array(
                'taxonomy' => "product_cat",
                "field" => "term_id",
                "terms" => array(24, 25)
            )
        ));
    }
});

function about_html($args) { ?>
    <div class="col-md-6 col-lg-3 pb-5">
        <div class="h-100 py-5 services-icon-wap shadow">
            <div class="h1 text-success text-center"><i class="<?php echo $args["icon"] ?>"></i></div>
            <h2 class="h5 mt-4 text-center"><?php echo $args["title"] ?></h2>
        </div>
    </div>
<?php }

add_filter( 'get_custom_logo', 'change_logo_class' );


function change_logo_class( $html ) {

    $html = str_replace( 'custom-logo-link', 'custom-logo-link navbar-brand text-success logo h1 align-self-center', $html );

    return $html;
}


function slider_html($args) { ?>
    
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="<?php echo $args['image'] ?>" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><?php $args['title'] ?></h1>
                            <h3 class="h2"><?php echo $args['subtitle'] ?></h3>
                            <p><?php echo  $args['desc'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php }

function ecomm_dashboard() {
    $customer = WC()->customer; 
    $lastorder = wc_get_customer_last_order(get_current_user_id());
    $dateun = date_create($lastorder->date_created->date);
    $date = date_format($dateun,"Y/m/d") . " at " . date_format($dateun, "H:i:s");
    ?>
    <div class="dashboard_ecomm">
    <h3>Welcome back, <?php echo $customer->username ?>.</h3>
    <?php if($lastorder) { ?>
        <h4>Your last order:</h4>
        <table>
            <thead>
                <th>date</th>
                <th>order</th>
                <th>total</th>
                <th>status</th>
                <th>view order</th>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $date ?></td>
                    <td><?php echo $lastorder->order_key ?></td>
                    <td><?php echo $lastorder->total ?><?php echo $lastorder->currency ?></td>
                    <td><p class="<?php echo $lastorder->status ?>"><?php echo $lastorder->status ?></p></td>
                    <td><a href="<?php echo $lastorder->get_view_order_url(); ?>">view</a></td>
                </tr>
            </tbody>
        </table>
        <a class="button" href="">view all orders</a>
        </div>
   <?php }
    }


require get_theme_file_path("inc/customizer.php");
