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



    // Repeater

    if ( have_rows( 'add_card' ) ) :
        while ( have_rows( 'add_card' ) ) : the_row();

            $type_member    = get_sub_field( 'type_member' );
            $classname      = get_sub_field( 'set_classname' );
            $add_more       = get_sub_field( 'add_more' );


            ?>




            <?php
            echo $add_more;
        // Repeater

            if ( have_rows( 'build_segment' ) ) :
                while ( have_rows( 'build_segment' ) ) : the_row();

                    $cost               = get_sub_field( 'select_price' );
                    $description        = get_sub_field( 'description' );
                    $segment_name       = get_sub_field( 'name_segment' );
                    $btn_label          = get_sub_field( 'label' );
                    $add_note           = get_sub_field( 'add_note' );
                    $cost_note          = get_sub_field( 'cost_note' );
                    $add_plus           = get_sub_field( 'add_plus' );
                    $more_label         = get_sub_field( 'more_link_label' );
                    $more_anchor        = get_sub_field( 'more_link_anchor' );
                    $form_label         = get_sub_field( 'form_link_label' ); // wording on button
                    $form_attr          = get_sub_field( 'form_link_title' ); // title attr
                    $form_url           = get_sub_field( 'form_link_url' );   // link
                    $add_more           = get_sub_field( 'add_more' );




                    // assign special character value to $char if $add_plus is true
                    $add_plus ? $char = '+' : $char = '';



                    ?>
                    <article class="card <?= $add_more ? 'bulb' : '';   ?>">
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

                            </div>

                        <?php
                        endif;  ?>


                    </div>

                    <div class="footer">
                        <?php // add inline anchor

                        if ( $add_more ): ?>
                            <a class="cta-link" type="link" href="<?= '#' . esc_attr( $more_anchor ); ?>"
                               target="_self"><?= esc_html( $more_label ); ?></a>
                        <?php
                            endif; ?>

                        <?php
                        $open_tab           = get_sub_field( 'open_tab' );
                        $set_anchor         = get_sub_field( 'set_link_anchor' );



                        if ( $form_url ):

                            // set value for target if linking internal vs external

                            ( $open_tab ) ?
                                $target = '_blank' :
                                $target = '_parent';

                            //  add an anchor if it does not exist, add nothing.

                            ( $set_anchor ) ?
                                $anchor = '#' . $set_anchor :
                                $anchor = '';

                        ?>
                        <a class="cta-btn" type="link" href="<?= esc_url( $form_url ) ?><?= $anchor; ?>" target="<?= esc_attr( $target ); ?>"
                           title="<?= esc_attr( $form_attr ); ?>"><?= esc_html( $form_label ); ?></a>
                    <?php
                        endif; ?>

                    </div>

                    </article>
                <?php endwhile; // build_segment?>
            <?php else : // build_segment ?>
                <?php // No rows found ?>
            <?php endif; // build_segment ?>



        <?php endwhile; // add_card ?>
    <?php else : // add_card ?>
        <?php // No rows found ?>
    <?php endif; ?>

</section>