<?php
/**
 * Chase Creek Child Theme.
 *
 * Template Name: Contact
 *
 * @package Paragon
 * @author  CG
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

get_header(); ?>

<main>
    <?php do_action('genesis_entry_header');?>
    <section class="contact-company">
      <div class="wrap">
            <div class="contact-col"><div class="inside"> <?php echo do_shortcode(get_field('contact_form_shortocde')); ?></div></div>
            <div class="map-col"><div class="inside"><?php echo do_shortcode(get_field('map_column')); ?></div></div>
      </div>
    </section>
    <section class="contact-bottom">
        <div class="wrap">
            <?php if( have_rows('contact_details') ): ?>
                <ul class="contact-details">
                    <?php while( have_rows('contact_details') ): the_row();?>
                        <li>
                            <p><?php the_sub_field('label'); ?></p>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>
    </section>
</main>


<?php get_footer(); ?>
