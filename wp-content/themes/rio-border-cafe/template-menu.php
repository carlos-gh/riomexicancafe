<?php
/**
 * Bofilltech Starter Theme
 *
 * Template Name: Menu
 *
 * @package Starter Theme
 * @author  CG
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

get_header(); ?>
<main>
    <?php do_action('genesis_entry_header');?>
    <section class="all-menu">
       <div class="menu-navigation">
           <div class="wrap">
           <?php if( have_rows('menu_sections') ): ?>
               <ul class="menu-items">
                        <li>
                           <a class="menu-tab btn-active" onclick="tabActions(this)" href="#" data-target="all">All</a>
                        </li>
                   <?php while( have_rows('menu_sections') ): the_row(); ?>
                       <li>
                           <a class="menu-tab" onclick="tabActions(this)" href="#" data-target="<?php echo slugify( get_sub_field('category_name') ); ?>">
                               <?php the_sub_field('category_name'); ?>
                           </a>
                       </li>
                   <?php endwhile; ?>
               </ul>
           <?php endif; ?>
           </div>
       </div>
        <div class="menu-sections">
            <?php if( have_rows('menu_sections') ): ?>
            <?php while( have_rows('menu_sections') ): the_row(); ?>
                <div class="menu-section section-<?php echo slugify( get_sub_field('category_name') ); ?>" data-tab="<?php echo slugify( get_sub_field('category_name') ); ?>">
                    <h3><?php the_sub_field('category_name'); ?></h3>
                    <div class="wrap">
                        <div class="menu-categories">
                            <?php if( have_rows('menu_categories') ): ?>
                                <?php while( have_rows('menu_categories') ): the_row(); ?>
                                    <div class="menu-category">
                                        <h4><?php the_sub_field('menu_category'); ?></h4>
                                        <div class="details">
                                            <?php echo do_shortcode( get_sub_field('menu_content') ); ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>

    </section>

    <script>
        function tabActions(obj) {

            const dataTarget = obj.dataset.target;
            const tabTargeted = document.querySelector('[data-tab="' + dataTarget + '"]');
            const allTabs = document.querySelectorAll('.menu-section');
            const allBtns = document.querySelectorAll('.menu-tab');
            const sections = document.querySelector('.menu-sections');

            // remove class active to all tabs
            allTabs.forEach((tab) => {
                tab.classList.remove("tab-active");
            });

            // remove class active to all buttons
            allBtns.forEach((btn) => {
                btn.classList.remove("btn-active");
            });

            if(dataTarget !== "all") {
                tabTargeted.classList.add("tab-active"); // add target tab the active class
                sections.classList.add("filtered");
            }else{
                sections.classList.remove("filtered");
            }

            obj.classList.add("btn-active"); // add the button clicked the active class
        }
    </script>
<?php get_footer(); ?>




