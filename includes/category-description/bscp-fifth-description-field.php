<?php

// CUSTOM FIFTH DESCRIPTION FIELD FOR PRODUCT CATEGORIES

add_action( 'product_cat_add_form_fields', 'bscp_wp_editor_add_fifth', 10, 2 );

function bscp_wp_editor_add_fifth() {
    ?>
    <div class="form-field">
        <label for="fifthdesc"><?php echo __( 'Fifth Description', 'woocommerce' ); ?></label>

      <?php
      $settings = array(
         'textarea_name' => 'fifthdesc',
         'quicktags' => array( 'buttons' => 'em,strong,link' ),
         'tinymce' => array(
            'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
            'theme_advanced_buttons2' => '',
         ),
         'editor_css' => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
      );

      wp_editor( '', 'fifthdesc', $settings );
      ?>

        <p class="description"><?php echo __( 'This is the description that goes BELOW products on the category page', 'woocommerce' ); ?></p>
    </div>
    <?php
}

// ---------------
// 2. Display field on "Edit product category" admin page

add_action( 'product_cat_edit_form_fields', 'bscp_wp_editor_edit_fifth', 10, 2 );

function bscp_wp_editor_edit_fifth( $term ) {
    $fifth_desc = htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'fifthdesc', true ) );
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="fifth-desc"><?php echo __( 'Fifth Description', 'woocommerce' ); ?></label></th>
        <td>
            <?php

         $settings = array(
            'textarea_name' => 'fifthdesc',
            'quicktags' => array( 'buttons' => 'em,strong,link' ),
            'tinymce' => array(
               'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
               'theme_advanced_buttons2' => '',
            ),
            'editor_css' => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
         );

         wp_editor( $fifth_desc, 'fifthdesc', $settings );
         ?>

            <p class="description"><?php echo __( 'This is the description that goes BELOW products on the category page', 'woocommerce' ); ?></p>
        </td>
    </tr>
    <?php
}

// ---------------
// 3. Save field @ admin page

add_action( 'edit_term', 'bscp_save_wp_editor_fifth', 10, 3 );
add_action( 'created_term', 'bscp_save_wp_editor_fifth', 10, 3 );

function bscp_save_wp_editor_fifth( $term_id, $tt_id = '', $taxonomy = '' ) {
   if ( isset( $_POST['fifthdesc'] ) && 'product_cat' === $taxonomy ) {
      update_woocommerce_term_meta( $term_id, 'fifthdesc', esc_attr( $_POST['fifthdesc'] ) );
   }
}

// ---------------
// 4. Display field under products @ Product Category pages7

add_action( 'woocommerce_before_shop_loop_item', 'bscp_display_wp_editor_content_fifth', 5 );

function bscp_display_wp_editor_content_fifth() {
   if ( is_product_taxonomy() ) {
      $term = get_queried_object();
      global $bs_query_counter;
      if ( $term && ! empty( get_woocommerce_term_meta( $term->term_id, 'fifthdesc', true ) ) && $bs_query_counter === 3) {
         echo '<p class="term-description">' . wc_format_content( htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'fifthdesc', true ) ) ) . '</p>';
      }
   }
}


