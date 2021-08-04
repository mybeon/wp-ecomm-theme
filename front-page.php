<?php get_header(); 

get_template_part('templates/content', 'slider');
?>

<!-- Start Banner Hero -->
    <!-- End Banner Hero -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Categories of The Month</h1>
                <p>
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
        <div class="row">

 <?php 

 $cats = get_terms("product_cat", array(
     "hide_empty" => false,
     "include" => array("19", "18", "17")
 ));
 
 foreach ( $cats as $cat ) { 
    
    $thumb_id = get_term_meta( $cat->term_id, "thumbnail_id", true );
    $thumb_url = wp_get_attachment_image_url( $thumb_id, array(400, 400) );
     ?>
        <!-- Start Categories of The Month -->
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="<?php echo esc_url(get_category_link( $cat->term_id )) ?>"><img src="<?php echo $thumb_url ?>" class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3"><?php echo $cat->name ?></h5>
                <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
            </div>
    <!-- End Categories of The Month -->
 <?php } ?>
        </div>
    </section>
    
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Featured Product</h1>
                    <p>
                        Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident.
                    </p>
                </div>
            </div>
            <div class="row">

    <?php 
    $feat_ids = wc_get_featured_product_ids();

        $featured_products = new WP_Query(array(
            "post_type" => "product",
            "post_per_page" => 3,
            "post__in" => $feat_ids,
        ));

        if( $featured_products->have_posts() ) {
            while( $featured_products->have_posts() ) {
                $featured_products->the_post(); 
                $review_count = get_post_meta( get_the_ID(), "_wc_review_count", true);
                $ratings = get_post_meta(get_the_ID(), "_wc_average_rating", true); ?>

<div class="col-12 col-md-4 mb-4">
    <div class="card h-100">
        <a href="<?php the_permalink(); ?>">
            <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="...">
        </a>
        <div class="card-body">
            <ul class="list-unstyled d-flex justify-content-between">
                <li>
                    <?php 
                    echo str_repeat('<i class="text-warning fa fa-star"></i>', intval($ratings));
                    echo str_repeat('<i class="text-muted fa fa-star"></i>', 5 - intval($ratings));
                    ?>
                </li>
                <li class="text-muted text-right"><?php echo "$". get_post_meta( get_the_ID(), '_price', true ) . ".00"?></li>
            </ul>
            <a href="shop-single.html" class="h2 text-decoration-none text-dark"><?php the_title(); ?></a>
            <p class="card-text"><?php echo strip_tags(get_the_content()); ?></p>
            <p class="text-muted">Reviews (<?php echo $review_count ?>)</p>
        </div>
    </div>
</div>
            <?php 
        wp_reset_postdata();    
        }
            
        } else {
            echo "<p>no product found.</p>";
        }
    ?>
    </div>
        </div>
    </section>

<?php get_footer();