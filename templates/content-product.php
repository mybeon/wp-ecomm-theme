<?php
global $product;
$attrs = $product->get_attribute("pa_size");
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-4'); ?>>
    <div class="card mb-4 product-wap rounded-0">
        <div class="card rounded-0">
            <img class="card-img rounded-0 img-fluid" src="<?php the_post_thumbnail_url("large"); ?>">
            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                <ul class="list-unstyled">
                    <li><a class="btn btn-success text-white mt-2" href="<?php the_permalink() ?>"><i class="far fa-eye"></i></a></li>
                    <li class="try_flex"><?php woocommerce_template_loop_add_to_cart(get_the_ID(), $product) ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <a href="<?php the_permalink(); ?>" class="h3 text-decoration-none"><?php the_title(); ?></a>
            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                <li><?php echo str_replace(", ", "/", $attrs) ?></li>
            </ul>
            <ul class="list-unstyled d-flex justify-content-center mb-1">
            <?php
                $ratings = $product->average_rating; 
                echo str_repeat('<i class="text-warning fa fa-star"></i>', intval($ratings));
                echo str_repeat('<i class="text-muted fa fa-star"></i>', 5 - intval($ratings));
                ?>
            </ul>
            <p class="text-center mb-0">$<?php echo $product->price ?>.00</p>
        </div>
    </div>
</div>