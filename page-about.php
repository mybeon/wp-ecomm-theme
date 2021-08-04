<?php get_header(); ?>
<section class="bg-success py-5">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-8 text-white">
                    <h1>About Us</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
                <div class="col-md-4">
                    <img src="<?php echo get_theme_file_uri("src/img/about-hero.svg")?>" alt="About Hero">
                </div>
            </div>
        </div>
    </section>
    <!-- Close Banner -->

    <!-- Start Section -->
    <section class="container py-5">
        <div class="row text-center pt-5 pb-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Our Services</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    Lorem ipsum dolor sit amet.
                </p>
            </div>
        </div>
        <div class="row">
            <?php 
            about_html(array(
                "title" => "Delivery Services",
                "icon" => "fa fa-truck fa-lg"
            ));

            about_html(array(
                "title" => "Shipping & Return",
                "icon" => "fas fa-exchange-alt"
            ));

            about_html(array(
                "title" => "Promotion",
                "icon" => "fa fa-percent"
            ));

            about_html(array(
                "title" => "24 Hours Service",
                "icon" => "fa fa-user"
            )) 
            
            ?>
        </div>
    </section>
    <!-- End Section -->
    <?php get_template_part("templates/content", "brands"); ?>
    <!-- Start Brands -->
    
    <!--End Brands-->
    <?php get_footer() ?>