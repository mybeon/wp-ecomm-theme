<?php get_header(); ?>

<div class="container py-5">
        <div class="row">
            <div class="col-lg-3">
                <h1 class="h2 pb-4">Categories</h1>
                <ul class="list-unstyled templatemo-accordion">
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Gender
                            
                            <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul class="collapse show list-unstyled pl-3">
                            <li><a class="text-decoration-none" href="<?php echo get_category_link( 24 ) ?>">Men</a></li>
                            <li><a class="text-decoration-none" href="<?php echo get_category_link( 25 )  ?>">Women</a></li>
                        </ul>
                    </li>
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Sale
                            <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                        <?php 
                            $onsaleproducts = new WP_Query(array(
                                "post_type" => "product",
                            ));
                            if( $onsaleproducts->have_posts() ) {
                                while($onsaleproducts->have_posts() ) {
                                    $onsaleproducts->the_post();
                                    global $product;
                                    if ( $product->sale_price) { ?>
                            
                                    <li><a class="text-decoration-none" href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
                            
                                <?php }
                                }
                                wp_reset_postdata();
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-inline shop-top-menu pb-3 pt-1">
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none mr-3" href="<?php echo esc_url(site_url("shop")) ?>">All</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none mr-3" href="<?php echo get_category_link( 24 )  ?>">Men's</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none" href="<?php echo get_category_link( 25 )  ?>">Women's</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 pb-4">
                        <?php woocommerce_catalog_ordering() ?>
                    </div>
                </div>
                <div class="row">
                    <?php 
                    if (have_posts()) {
                        while(have_posts()) {
                            the_post();
                            get_template_part( "templates/content", "product" );
                        }
                    } else {
                        echo "<p>No product found!</p>";
                    }
                    ?>
                    
                </div>
                <div div="row">
                    <?php 
                    $pagination = paginate_links(array(
                        "prev_next" => false,
                        "type" => "array",
                        "class" => "weeew"
                    ));
                    if ($pagination) { 

                        echo '<ul class="pagination pagination-lg justify-content-end">';
                        foreach( $pagination as $pag ) { ?>
                        <li class="page-item">
                            <?php
                            $pagclass = str_replace("page-numbers", "page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark", $pag );
                             echo $pagclass ;
                             ?>
                        </li>
                        <?php }
                        echo "</ul>"; 
                    } ?>
                </div>
            </div>

        </div>
    </div>
    <?php get_footer();