<?php
$show_ads = false;
$tag_name = '';
if (is_single() && get_field('show_ads_on_article_pages', 'option')) {
    $show_ads = get_field('show_ads_on_article_pages', 'option');
    $tag_name = get_field('article_tag_name', 'option');
} elseif (is_front_page() && get_field('show_ads_on_homepage', 'option')) {
    $show_ads = get_field('show_ads_on_homepage', 'option');
} elseif (is_category() && get_field('show_ads_on_category_pages', 'option')) {
    $show_ads = get_field('show_ads_on_category_pages', 'option');
    $tag_name = get_field('category_tag_name', 'option');
}
?>
<?php if ($show_ads) : ?>
    <?php $amp_target = [$tag_name => get_the_ID()]; ?>
    <?php if (count($targets) > 0) {
        foreach ($targets as $target) {
            $amp_target["".esc_html($target['key']).""] = "" . esc_html($target['value']) . "";
        }
    }
    ?>
    <?php if (function_exists('amp_is_request') && amp_is_request()): ?>
        <amp-ad
                data-slot ="<?php echo esc_html($ad_unit_path); ?>"
                data-<?php echo $tag_name?>="<?php the_ID(); ?>"
                height="250"
                layout="fixed"
                type="doubleclick"
                json='{"targeting": <?php echo json_encode($amp_target); ?>}'
                width="300">
        </amp-ad>
    <?php else: ?>
        <div id="div-gpt-ad-<?php echo esc_html($ad_placeholder_id); ?>-<?php the_ID(); ?>"
             data-ad-unit-path="<?php echo esc_html($ad_unit_path); ?>"
             data-ad-placeholder-id="<?php echo esc_html($ad_placeholder_id); ?>"
             data-ad-sizes="<?php echo esc_html($sizes); ?>"
             data-default-tag-name="<?php echo $tag_name; ?>"
            <?php if (is_category()): ?>
            data-category-id="<?php echo get_category( get_query_var( 'cat' ) )->cat_ID; ?>"
            <?php endif; ?>
            >
            <?php if (count($targets) > 0) : ?>
                <?php foreach ($targets as $index => $target) : ?>
                    <input type="hidden" name="<?php echo esc_html($target['key']) ?>" value="<?php echo esc_html($target['value']) ?>">
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
