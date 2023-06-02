<?php
/**
 * Block template file: member.php
 *
 * Membership Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// The get_block_wrapper_attributes() is a requirement. Want think about which new attributes we might need.

$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'member'
    ]
);
?>


<div <?= $wrapper_attributes ?>>

<!--    HTML + ACF Code and Logic-->

</div>