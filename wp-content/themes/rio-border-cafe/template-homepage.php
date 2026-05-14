<?php

/**
 * Bofilltech Starter Theme
 *
 * Template Name: Homepage
 *
 * @package Starter Theme
 * @author  CG
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

get_header(); ?>
<main>

    <section class="home-hero">

        <div class="bg-layer">
            <?php if (get_post_meta(get_the_ID(), 'background_type', true) == "oembed") { ?>
                <?php
                // Load value.
                $iframe = get_field('oembed_video');
                // Use preg_match to find iframe src.
                preg_match('/src="(.+?)"/', $iframe, $matches);
                $src = $matches[1];
                // Add extra parameters to src and replace HTML.
                $params = array(
                    'controls'  => 0,
                    'hd'        => 1,
                    'autohide'  => 1
                );
                $new_src = add_query_arg($params, $src);
                $iframe = str_replace($src, $new_src, $iframe);
                // Add extra attributes to iframe HTML.
                $attributes = 'frameborder="0"';
                $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
                // Display customized HTML.
                echo $iframe;
                ?>
            <?php } elseif (get_post_meta(get_the_ID(), 'background_type', true) == "html5") { ?>

                <video width="100%" height="100%" autoplay muted loop poster="">
                    <source src="<?php echo get_post_meta(get_the_ID(), 'html_5_video', true) ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>

            <?php } else { ?>

                <div class="desktop-image">
                    <?php $desktop_image = get_field('background_image'); ?>
                    <?php if (!empty($desktop_image)) : ?>
                        <?php get_optimized_bg_image($desktop_image, 'full-gallery'); ?>
                    <?php endif; ?>
                </div>
                <div class="mobile-image">
                    <?php $mobile_image = get_field('mobile_hero_image'); ?>
                    <?php if (!empty($mobile_image)) : ?>
                        <?php get_optimized_bg_image($mobile_image, 'full-gallery'); ?>
                    <?php endif; ?>
                </div>

            <?php } ?>
        </div>

        <div class="text-overlay">
            <div class="wrapper">
                <div class="site-name">
                    <?php echo do_shortcode(get_post_meta(get_the_ID(), 'hero_heading', true)); ?>
                </div>
            </div>
        </div>

    </section>

    <section class="come-celebrate">
        <div class="wrap">
            <div class="intro-text" data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">
                <div><?php echo do_shortcode(get_field('section_celebrate_text')); ?></div>
            </div>
            <div class="intro-image" data-aos="zoom-in" data-aos-delay="400" data-aos-duration="900">
                <?php $image = get_field('section_celebrate_image'); ?>
                <?php if (!empty($image)) : ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="100%" height="400" decoding="async" loading="lazy" />
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="our-menu">

        <div class="bg-layer">
            <img src="<?php echo get_local_image('menu-background.webp') ?>" alt="" loading="lazy" decoding="async" width="100%" height="400" />
        </div>

        <div class="section-heading" data-aos="zoom-in-down" data-aos-delay="400" data-aos-duration="1000">
            <h3>Menu <span class="heading-icon"><img alt="menu" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEIUlEQVR4nNWae4hOQRjGH3bXWpfFyl20KIQVSkJuubVtsYjc4g9R2pJLK5diiWyskviDUv5BtnUpJdctQpJbIXfJvbXWZa1l8emtZ2qaZs7ZD2e+vl99fd88z3nPzOw5Z2beOQvUn/MAYtrnIvXTDv2SQ1fnqgZwB8B2AL3gkZjl8ze6zasDsAVAis+O/OtvvTwDQCmA3ywfBtAwGTuiyAVQRa0omTsijAXwC8APAH2SuSPCbur7I+qDt4505hX5wd9J2xHhAL01SPKO5NKTeSipO9IEwDcAPwFkJXNHhHP08xABeuXf+bsPv2tD9Hg7so3+6qg7ckYrx7jeCtLj7ch8+gei7khXNvILgFMAuoToemxD/pbJz8XIKB/4sL9ifWPTjdvORj8e8xQRoNZCmXHGZTJO4tWoJOWvATGdeMwnRMAtnjwnzrgcxt00OhbUyAxtef/f2cGTb44zbiPjdrKcxXJlQExLHlODCOjNSUomq4FxXI2vfLD7UmvLRr4LiBvAYx4iItRf9wOA0SHHDgVQweNLNL0jtVcBsUU8Zi8iIoVLbHX/LnMct1ibHI8AaKR5Xag/d8S25dWSYwYjQhoAWMfbJcZG6yyiLulrMYBUw+9G/4nl3Gmcf8Q/CU9MZ4VvDP0tdfFt9KT/wHK1D9J7zyHYCxmOkaWGuvhBD7IajlUnDlGXbaIh8EhnVvzS0F9Sd2V4I+hfsAzttQDGwTP9WblMlDq3QybOPPonWB7Fsgzt05AARrMB5YZeTt01PM+kL8+DcJbltUgQ09iAMkMvo+766y6kv4flLyy3R4JY6Ji09lIX38YKY5JUi9EOSBCr2ACZK3SKqYtvYwN9mYugzRsrkSBUOlpo6IXUxbexi34By5O1tVdTJIB9bMACQ19AXXwbar6Qh16tFK5TW4oEcJyV5xt6PnXxbai8frymTdLWXynwzEVWLvm1Ld/WX+zo3KA/SNMkj39MfQw8c5cVqzxD0Ze6+DZUg3s4UoTt8MwzVpxt6NnUxbfx2jHcytIk6EpGhlrltjP0dtTFt/GRfgvHhsMreOYzK25u6GGbC3X0JffQaUxdUmmvqAaZiVMadXnHYUMlZOa7Qhmt1OLRKz9ZsTlcpoY0SKXAslFny2++wTOuBKpZyAZcNX05znZLfoZn1EPbytBbazstNirpt3EMEhXwzAvH8Ns9ZJfkEX3J3c19s5gll4+ca6xY9q90hlO/6oi7Qn+YI+4yPHOMFc8y9NnUjzriSh1xc7T/fvDKela81dBLjHzDtYsoSxKdTdTlvF6Z4FhT3aM+LuStrXkLSVn0ifBMqrZuKuBwWsDya8tEqUhneis7kVP4vmQqy1WW+cULc9lw8yP3exBLHXFLPLXbiry4vM8li3zPq0eMZIXL+WpNlizyLeW/5g/vAxaTs8cNbQAAAABJRU5ErkJggg=="></span></h3>
            <a href="<?php echo get_field('see_all_menus') ?? 'https://riomexicancafe.com/menu/'; ?>">See all menus <span>ᐳ</span></a>
        </div>

        <div class="menu-slider-wrap">
            <div class="splide menu-slider" aria-labelledby="carousel-heading" id="menu-slider">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php if (have_rows('menu_slides')) : ?>
                            <?php while (have_rows('menu_slides')) : the_row(); ?>
                                <li class="splide__slide menu-box">
                                    <div class="inside">

                                        <?php $image = get_sub_field('image');
                                        if (!empty($image)) : ?>
                                            <img src="<?php echo esc_url($image['sizes']['menu-showcase']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php endif; ?>

                                        <div class="menu-text">
                                            <h3><?php echo get_sub_field('title'); ?></h3>
                                            <?php if (get_sub_field('description')) : ?>
                                                <p><?php echo get_sub_field('description'); ?></p>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

    </section>

    <section class="join-festivities">
        <div class="bg-layer">
            <img src="<?php echo get_local_image('festivities-bg.webp') ?>" alt="" loading="lazy" decoding="async" width="100%" height="400" />
        </div>
        <div class="section-heading" data-aos="zoom-in-down" data-aos-delay="400" data-aos-duration="1000">
            <h3>Join the festivities!</h3>
        </div>
        <div class="wrap">
            <?php if (have_rows('activities')) : ?>
                <div class="activities-showcase">
                    <?php while (have_rows('activities')) : the_row(); ?>
                        <div class="activity-block">
                            <div class="inside">
                                <?php $image = get_sub_field('image');
                                if (!empty($image)) : ?>
                                    <img src="<?php echo esc_url($image['sizes']['festivities-showcase']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                <?php endif; ?>
                                <div class="activity-text">
                                    <h3><?php echo get_sub_field('title'); ?></h3>
                                    <?php if (get_sub_field('description')) : ?>
                                        <p><?php echo get_sub_field('description'); ?></p>
                                    <?php endif; ?>
                                    <a href="<?php echo get_sub_field('button_url') ?? ''; ?>"><?php echo get_sub_field('button_label') ?? ''; ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="order-home">
        <div class="wrap">
            <div class="order-title">
                <h3>Order<br /> Online</h3>
            </div>
            <div class="order-types">
                <?php if (have_rows('order_types')) : ?>
                    <ul>
                        <?php while (have_rows('order_types')) : the_row(); ?>
                            <li>
                                <?php $image = get_sub_field('service_icon');
                                if (!empty($image)) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>" loading="lazy" alt="<?php echo esc_attr($image['alt']); ?>" />
                                <?php endif; ?>
                                <a href="<?php echo get_sub_field('button_url'); ?>">
                                    <?php echo get_sub_field('button_label'); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="costumer-comments">
        <div class="bg-layer">
            <img src="<?php echo get_local_image('testimonials-bg.webp') ?>" alt="" loading="lazy" decoding="async" width="100%" height="400" />
        </div>
        <div class="section-heading" data-aos="zoom-in-down" data-aos-delay="400" data-aos-duration="1000">
            <h3>What our Customers says</h3>
        </div>
        <div class="comment-wrapper">
            <div class="splide" id="client-testimonials">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php if (have_rows('what_our_costumer_says')) : ?>
                            <?php while (have_rows('what_our_costumer_says')) : the_row(); ?>
                                <li class="splide__slide ">
                                    <div class="single-testimonial">
                                        <p><?php echo get_sub_field('comment'); ?></p>
                                        <strong> <?php echo get_sub_field('name'); ?></strong>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="wrap">
            <div class="btn-actions">
                <a href="<?php echo get_field('submit_review'); ?>">Submit your review</a>
            </div>
        </div>
    </section>

    <section class="follow-instagram">
        <div class="wrap">
            <div class="column-title">
                <div class="inside">
                    <h3>
                        Follow our instagram
                    </h3>
                    <a href="https://www.instagram.com/riobordercafe/" class="btn-style-two">@riobordercafe</a>
                </div>
            </div>
            <div class="column-images">

                <?php echo do_shortcode('[insta-gallery id="0"]'); ?>
                <!--
                <?php $gallery_images = get_field('instagram_gallery'); ?>
                <?php //if( $gallery_images ) : 
                ?>
                <ul id="gallery-instagram">
                    <?php //foreach( $gallery_images as $image ): 
                    ?>
                        <?php
                        $size   = 'full-gallery';
                        $width  = $image['sizes'][$size . '-width'];
                        $height = $image['sizes'][$size . '-height'];
                        ?>
                        <li>
                            <a href="<?php //echo esc_url($image['url'] ); 
                                        ?>" data-pswp-width="<?php //echo $width; 
                                                                                                ?>" data-pswp-height="<?php //echo $height; 
                                                                                                                                            ?>" target="_blank">
                                <figure><img src="<?php //echo bofilltech_encode_image_base64($image['sizes']['lazy-thumb-square']) 
                                                    ?>" data-src="<?php //echo esc_url($image['sizes']['gallery-square']); 
                                                                                                                                                    ?>" class="defer-img" alt="<?php //echo esc_attr($image['alt']); 
                                                                                                                                                                                                                                        ?>" decoding="async" width="276" height="276" loading="lazy"/></figure>
                            </a>
                        </li>
                    <?php //endforeach; 
                    ?>
                </ul>
                <?php //endif; 
                ?>
                    -->
            </div>
        </div>
    </section>

</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menus = new Splide('#menu-slider', {
            type: 'loop',
            perPage: 4,
            perMove: 1,
            arrows: true,
            breakpoints: {
				960: {
                    perPage: 3,
                },
                640: {
                    perPage: 2,
                },
				460: {
                    perPage: 1,
                },
            }
        });
        menus.mount();

        const testimonials = new Splide('#client-testimonials', {
            type: 'loop',
            perPage: 3,
            perMove: 1,
            arrows: true,
            breakpoints: {
                640: {
                    perPage: 2,
                },
            }
        });
        testimonials.mount();
    });
</script>
<?php get_footer(); ?>