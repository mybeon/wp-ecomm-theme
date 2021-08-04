<?php get_header() ?>
<h2 style="text-align: center; margin: 3rem 0">You searched for: <?php echo get_search_query(); ?></h2>
<div class="container" style="width: 50%">
    <?php get_search_form(); ?>
</div>
<div class="container" style="margin: 4rem auto">
    <div class="row">
<?php if(have_posts() && get_post_type() == "product") {
    while (have_posts()) {
        the_post();
        get_template_part("templates/content", "product");
    }
} else {
    echo "<h2>No result found.</h2>";
} ?>
</div>
</div>
<?php get_footer() ?>