<?php
/**
 * Bofilltech Starter Theme
 *
 * Template Name: Structured Menu
 *
 * @package Starter Theme
 * @author  CG
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

get_header(); ?>
<main>
    <?php do_action( 'genesis_entry_header' ); ?>
    <section class="structured-menu">
        <div class="structured-menu-navigation">
            <div class="wrap">
                <?php if ( have_rows( 'structured_menu_sections' ) ) : ?>
                    <ul class="structured-menu-items">
                        <li>
                            <a class="structured-menu-tab btn-active" onclick="structuredMenuTabActions(this)" href="#" data-target="all">All</a>
                        </li>
                        <?php while ( have_rows( 'structured_menu_sections' ) ) : the_row(); ?>
                            <?php $section_slug = slugify( get_sub_field( 'section_name' ) ); ?>
                            <li>
                                <a class="structured-menu-tab" onclick="structuredMenuTabActions(this)" href="#" data-target="<?php echo esc_attr( $section_slug ); ?>">
                                    <?php echo esc_html( get_sub_field( 'section_name' ) ); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

        <div class="structured-menu-sections">
            <?php if ( have_rows( 'structured_menu_sections' ) ) : ?>
                <?php while ( have_rows( 'structured_menu_sections' ) ) : the_row(); ?>
                    <?php
                    $section_name = get_sub_field( 'section_name' );
                    $section_slug = slugify( $section_name );
                    $section_intro = get_sub_field( 'section_intro' );
                    ?>
                    <div class="structured-menu-section section-<?php echo esc_attr( $section_slug ); ?>" data-tab="<?php echo esc_attr( $section_slug ); ?>">
                        <?php if ( ! empty( $section_name ) ) : ?>
                            <h3><?php echo esc_html( $section_name ); ?></h3>
                        <?php endif; ?>

                        <div class="wrap">
                            <?php if ( ! empty( $section_intro ) ) : ?>
                                <div class="structured-menu-intro">
                                    <?php echo wp_kses_post( wpautop( $section_intro ) ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( have_rows( 'structured_menu_categories' ) ) : ?>
                                <div class="structured-menu-categories">
                                    <?php while ( have_rows( 'structured_menu_categories' ) ) : the_row(); ?>
                                        <?php
                                        $category_name = get_sub_field( 'category_name' );
                                        $category_intro = get_sub_field( 'category_intro' );
                                        $category_layout = get_sub_field( 'category_layout' );
                                        $category_images = get_sub_field( 'category_images' );
                                        ?>
                                        <div class="structured-menu-category layout-<?php echo esc_attr( $category_layout ); ?>">
                                            <?php if ( ! empty( $category_name ) ) : ?>
                                                <h4><?php echo esc_html( $category_name ); ?></h4>
                                            <?php endif; ?>

                                            <?php if ( ! empty( $category_intro ) ) : ?>
                                                <div class="structured-menu-category-intro">
                                                    <?php echo wp_kses_post( wpautop( $category_intro ) ); ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="structured-menu-category-content">
                                                <?php if ( have_rows( 'structured_menu_items' ) ) : ?>
                                                    <div class="structured-menu-list">
                                                        <?php while ( have_rows( 'structured_menu_items' ) ) : the_row(); ?>
                                                            <?php
                                                            $item_name = get_sub_field( 'item_name' );
                                                            $item_description = get_sub_field( 'item_description' );
                                                            $item_price = get_sub_field( 'item_price' );
                                                            ?>
                                                            <article class="structured-menu-item">
                                                                <div class="structured-menu-item-heading">
                                                                    <?php if ( ! empty( $item_name ) ) : ?>
                                                                        <h5><?php echo esc_html( $item_name ); ?></h5>
                                                                    <?php endif; ?>
                                                                    <?php if ( ! empty( $item_price ) ) : ?>
                                                                        <span><?php echo esc_html( $item_price ); ?></span>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php if ( ! empty( $item_description ) ) : ?>
                                                                    <?php echo wp_kses_post( wpautop( $item_description ) ); ?>
                                                                <?php endif; ?>
                                                            </article>
                                                        <?php endwhile; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ( ! empty( $category_images ) ) : ?>
                                                    <div class="structured-menu-images">
                                                        <?php foreach ( $category_images as $image ) : ?>
                                                            <figure>
                                                                <img src="<?php echo esc_url( $image['sizes']['menu-showcase'] ?? $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy" decoding="async" />
                                                                <?php if ( ! empty( $image['caption'] ) ) : ?>
                                                                    <figcaption><?php echo esc_html( $image['caption'] ); ?></figcaption>
                                                                <?php endif; ?>
                                                            </figure>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>

    <script>
        function structuredMenuTabActions(obj) {
            const dataTarget = obj.dataset.target;
            const tabTargeted = document.querySelector('[data-tab="' + dataTarget + '"]');
            const allTabs = document.querySelectorAll('.structured-menu-section');
            const allBtns = document.querySelectorAll('.structured-menu-tab');
            const sections = document.querySelector('.structured-menu-sections');

            allTabs.forEach((tab) => {
                tab.classList.remove('tab-active');
            });

            allBtns.forEach((btn) => {
                btn.classList.remove('btn-active');
            });

            if ('all' !== dataTarget) {
                tabTargeted.classList.add('tab-active');
                sections.classList.add('filtered');
            } else {
                sections.classList.remove('filtered');
            }

            obj.classList.add('btn-active');
        }
    </script>
<?php get_footer(); ?>
