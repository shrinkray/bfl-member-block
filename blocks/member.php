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
    $form_page   = get_field( 'link' );

    // Repeater

    if ( have_rows( 'add_card' ) ) :
        while ( have_rows( 'add_card' ) ) : the_row();
            $type_member = get_sub_field( 'type_member' );
            $classname = get_sub_field( 'set_classname' ); ?>

        <?php

            /**
             * link builder, build button link based on type
             * this produces the page link along with query string to prefill a selection.
             */

            $btn_link = $classname ? $form_page . '?type=' . $classname : $form_page;

            ?>
    <article class="card <?= esc_attr( $classname ); ?>">

            <?php
        // Repeater

            if ( have_rows( 'build_segment' ) ) :
                while ( have_rows( 'build_segment' ) ) : the_row();

                    $cost = get_sub_field( 'select_price' );
                    $description = get_sub_field( 'description' );
                    $segment_name = get_sub_field( 'name_segment' );
                    $btn_label = get_sub_field( 'label' );
                    $cost_note = get_sub_field( 'cost_note' );

                    ?>

                    <div class="header <?= esc_attr( $classname ); ?>">

                        <h3 class="unit-desc"><?= esc_html( $type_member ) ?></h3>

                    </div>

                    <div class="body">

                        <?php // Code option for price, show a message for flex spaces
                        if ( $cost ) :
                        ?> 
                        <div class="unit-cost">
                        <span class="dollar-sign">$</span><span class="value"><?= esc_attr( $cost ); ?></span><span
                                class="range">/mo</span>
                        </div>
                        <?php
                        else : ?>
                        
                         <div class="unit-cost flex-col ">
                            <span class="check-prices"><?= esc_attr( $cost_note ); ?></span>
                        </div>

                    <?php endif; ?>

                    <?php
                     if ( $description ) : ?>
                        <div class="description"><?= esc_html( $description ); ?></div>

                    <?php
                    endif;  ?>

                    </div>
                
                    <div class="footer">

                        <a class="cta-btn" type="link" href="<?= esc_html( $btn_link ); ?>" target="_self"><?= esc_html( $btn_label ); ?></a>

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