<?php
$ad_unit_path = get_field('ad-unit-path');
$ad_placeholder_id = get_field('ad_placeholder_id');
$ad_sizes = get_field('ad_sizes');
$tag_name = get_field('article_tag_name', 'option');
$targets = get_field('target-key-values');
//$targets[] = ['key' => 'domain', 'value' => $_SERVER['SERVER_NAME']];
if (count($ad_sizes) > 1) {
    $ad_sizes = array_column($ad_sizes, 'size');
    $sizes = '[' . implode(',', $ad_sizes) . ']';
} else {
    $sizes = array_column($ad_sizes, 'size')[0];
}
$amp_target = [$tag_name => $post_id];
if (count($targets) > 0) {
    foreach ($targets as $target) {
        $amp_target["" . esc_html($target['key']) . ""] = "" . esc_html($target['value']) . "";
    }
}
?>
<?php if (is_bool($is_preview) && $is_preview == true): ?>
    <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))) . 'assets/images/vam_preview_placeholder.png' ?>"
         height="150" width="auto">
    <style>
        .acf-block-fields.acf-fields {
            margin: 0 auto;
        }
    </style>
<?php else: ?>
    <?php if (function_exists('amp_is_request') && amp_is_request()): ?>
        <amp-ad
                data-slot="<?php echo esc_html($ad_unit_path); ?>"
                data-<?php echo $tag_name ?>="<?php $post_id; ?>"
                height="250"
                layout="fixed"
                type="doubleclick"
                json='{"targeting": <?php echo json_encode($amp_target); ?>}'
                width="300">
        </amp-ad>
    <?php else: ?>
        <div class="ad-container">
            <div id="div-gpt-ad-<?php echo esc_html($ad_placeholder_id); ?>-<?php the_ID(); ?>"
                 data-ad-unit-path="<?php echo esc_html($ad_unit_path); ?>"
                 data-ad-placeholder-id="<?php echo esc_html($ad_placeholder_id); ?>"
                 data-ad-sizes="<?php echo esc_html($sizes); ?>"
                 data-default-tag-name="<?php echo $tag_name; ?>">
                <?php if (count($targets) > 0) : ?>
                    <?php foreach ($targets as $index => $target) : ?>
                        <input type="hidden" name="<?php echo esc_html($target['key']) ?>"
                               value="<?php echo esc_html($target['value']) ?>">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>


