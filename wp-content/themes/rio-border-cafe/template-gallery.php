<?php
/**
 * Chase Creek Child Theme.
 *
 * Template Name: Gallery
 *
 * @package Paragon
 * @author  CG
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

get_header(); ?>

<main>
    <?php do_action('genesis_entry_header');?>
    <section class="gallery-tabs">
        <div class="wrap">
            <?php if( have_rows('gallery_tab') ): ?>
                <nav>
                <ul class="gallery-tab-nav">
                    <?php $it= 0;  while( have_rows('gallery_tab') ): the_row(); $it++;?>
                        <li>
                            <a class="btn-tab <?php if($it == 1){ ?> btn-active <?php } ?>" onclick="tabActions(this)" data-target="<?php echo slugify(get_sub_field('tab_name')); ?>"><?php the_sub_field('tab_name'); ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
                </nav>
            <?php endif; ?>

            <?php if( have_rows('gallery_tab') ): ?>
                <div class="tabs-panel">
                    <?php $i = 0; $posts_ids = array(); while( have_rows('gallery_tab') ): the_row(); $i++;?>
                        <div class="tab <?php if($i == 1){ ?> tab-active <?php } ?>" data-tab="<?php echo slugify(get_sub_field('tab_name')); ?>">
                           <?php $posts_ids[] = '#gallery-'. slugify(get_sub_field('tab_name')); ?>
                            <?php $images = get_sub_field('gallery_images'); ?>
                            <?php if( $images ): ?>
                                <ul id="gallery-<?php echo slugify(get_sub_field('tab_name')); ?>">
                                    <?php  foreach( $images as $image ): ?>
                                        <?php
                                        $size   = 'full-gallery';
                                        $width  = $image['sizes'][ $size . '-width' ];
                                        $height = $image['sizes'][ $size . '-height' ];
                                         ?>
                                            <li>
                                                <a href="<?php echo esc_url($image['url'] ); ?>" data-pswp-width="<?php echo $width; ?>" data-pswp-height="<?php echo $height; ?>" target="_blank">
                                                    <figure><img src="<?php echo bofilltech_encode_image_base64($image['sizes']['lazy-thumb-square']) ?>" data-src="<?php echo esc_url($image['sizes']['gallery-square']); ?>" class="defer-img" alt="<?php echo esc_attr($image['alt']); ?>" decoding="async" width="276" height="276" loading="lazy"/></figure>
                                                </a>
                                            </li>
                                    <?php  endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
</main>
<script>
function tabActions(obj) {
    const dataTarget = obj.dataset.target;
    const tabTargeted = document.querySelector('[data-tab="' + dataTarget + '"]');
    const allTabs = document.querySelectorAll('.tab');
    const allBtns = document.querySelectorAll('.btn-tab');
    allTabs.forEach((tab) => {
        tab.classList.remove("tab-active");
    });
    allBtns.forEach((btn) => {
        btn.classList.remove("btn-active");
    });
    tabTargeted.classList.add("tab-active");
    obj.classList.add("btn-active");
}
</script>
<script type="module">
    import PhotoSwipeLightbox from '<?php echo get_stylesheet_directory_uri(); ?>/js/photoswipe-lightbox.esm.min.js';
    const lightbox = new PhotoSwipeLightbox({
        gallery: '<?php if(!empty($posts_ids)){ echo implode(',' , $posts_ids);}  ?>',
        children: 'a',
        wheelToZoom: true,
        showHideAnimationType: 'zoom',
        pswpModule: () => import('<?php echo get_stylesheet_directory_uri(); ?>/js/photoswipe.esm.min.js')
    });
    lightbox.init();
</script>
<?php get_footer(); ?>
