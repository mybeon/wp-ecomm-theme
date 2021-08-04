<?php
add_action('customize_register', 'ecomm_slider_customizer');


function ecomm_slider_customizer($wp_customize) {


    $wp_customize->add_panel('slider_panel', array(
        "capability" => "edit_theme_options",
        'title' => 'Home page slider',
        "priority" => 10
    ));

    $all = array("1", "2", "3");

    foreach ( $all as $slide ) {

        $wp_customize->add_section( 'slider_'. $slide .'', array(
            'priority'       => 10,
            'capability'     => 'edit_theme_options',
            'title'          => "slider ". $slide ."",
            'panel'  => 'slider_panel',
        ));
    
        $wp_customize->add_setting('slider_'. $slide .'_title',array(
            'defaule'=> '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        
        $wp_customize->add_control('slider_'. $slide .'_title_control',array(
            'label'=> 'Title',
            'type'=> 'text',
            'section'=>'slider_'. $slide .'',
            'settings'=>'slider_'. $slide .'_title',
        ));
    
    
        $wp_customize->add_setting('slider_'. $slide .'_subtitle',array(
            'defaule'=> '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        
        $wp_customize->add_control('slider_'. $slide .'_subtitle_control',array(
            'label'=> 'Sub title',
            'type'=> 'text',
            'section'=>'slider_'. $slide .'',
            'settings'=>'slider_'. $slide .'_subtitle',
        ));
    
    
        $wp_customize->add_setting('slider_'. $slide .'_description',array(
            'defaule'=> '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        
        
        $wp_customize->add_control('slider_'. $slide .'_description_control',array(
            'label'=> 'Description',
            'type'=> 'textarea',
            'section'=>'slider_'. $slide .'',
            'settings'=>'slider_'. $slide .'_description',
        ));
    
        $wp_customize->add_setting('slider_'. $slide .'_background_img', array(
            'sanitize_callback' => 'ecomm_sanitize_img'
        ));

        function ecomm_sanitize_img( $input ){
 
            /* default output */
            $output = '';
         
            /* check file type */
            $filetype = wp_check_filetype( $input );
            $mime_type = $filetype['type'];
         
            /* only mime type "image" allowed */
            if ( strpos( $mime_type, 'image' ) !== false ){
                $output = $input;
            }
         
            return $output;
        }
        
        
        $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'slider_'. $slide .'_background_img_control',array(
            'label'=> 'Background',
            'section'=>'slider_'. $slide .'',
            'settings'=>'slider_'. $slide .'_background_img',
            'width' => 400,
            'height' => 400
        )));
    }
}