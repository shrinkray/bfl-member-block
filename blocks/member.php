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


<section <?= $wrapper_attributes ?>>

    <?php

        $link   = get_field( 'link' );

    // Repeater

    if ( have_rows( 'add_card' ) ) :
        while ( have_rows( 'add_card' ) ) : the_row();

            $type_member    = get_sub_field( 'type_member' );
            $classname      = get_sub_field( 'set_classname' ); ?>

    <article class="card ">

            <?php

        // Repeater

            if ( have_rows( 'build_segment' ) ) :
                while ( have_rows( 'build_segment' ) ) : the_row();

                    $cost               = get_sub_field( 'select_price' );
                    $description        = get_sub_field( 'description' );
                    $segment_name       = get_sub_field( 'name_segment' );
                    $btn_label          = get_sub_field( 'label' );
                    $add_note           = get_sub_field( 'add_note' );
                    $cost_note          = get_sub_field( 'cost_note' );
                    $add_plus           = get_sub_field( 'add_+' );
                    $more_label         = get_sub_field( 'more_link_label' );
                    $more_anchor        = get_sub_field( 'more_link_anchor' );



                    // assign special character value to $char if $add_plus is true
                    $add_plus ? $char = '+' : $char = '';

                    ?>

                    <div class="header <?= esc_attr( $classname ); ?>">

                        <h3 class="unit-desc"><?= esc_html( $type_member ) ?></h3>

                    </div>

                    <div class="body">
                        <?php

                        if ( $segment_name ):
                            ?>
                            <h4 class="unit-name"><?= esc_html( $segment_name ) ?></h4>

                        <?php else : ?>
                            <div class="unit-name"></div>
                        <?php
                        endif;
                        ?>

                        <?php // Code option for price, show a message for flex spaces
                        if ( $cost ):
                        ?> 
                        <div class="unit-cost">
                        <span class="dollar-sign">$</span><span class="value"><?= esc_attr( $cost ); ?></span><span 
                                class="plus-char"><?= esc_html( $char ); ?></span><span class="range">/mo</span>
                        </div>
                        <?php

                        endif;
                        if ($add_note ):
                        ?>
                        <div class="cost-extra">
                            <?= $cost_note; ?>
                        </div>
                        <?php
                        endif; ?>
                    <?php
                     if ( $description ): ?>
                        <div class="description"><?= esc_html( $description ); ?>
                            <a class="cta-link" type="link" href="<?= '#' . esc_attr( $more_anchor ); ?>" target="_self"><?= esc_html( $more_label ); ?></a></div>

                    <?php
                    endif;  ?>

                    </div>
                
                    <div class="footer">
                        <?php
                        if ( $link ) :
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'];
                        ?>

                        <a class="cta-btn" type="link" href="<?= esc_url( $link_url ) ?>" target="<?= 
                        esc_attr( $link_target ); ?>" title="<?= esc_attr( $link_title ); ?>"><?= esc_html( $btn_label ); ?></a>
                        <?php
                        endif;
                        ?>
                    </div>

                <?php endwhile; // build_segment?>
            <?php else : // build_segment ?>
                <?php // No rows found ?>
            <?php endif; // build_segment ?>
    </article>

        <?php endwhile; // add_card ?>
    <?php else : // add_card ?>
        <?php // No rows found ?>
    <?php endif; ?>

</section>