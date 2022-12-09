<?php

// CUSTOM FORTH DESCRIPTION FIELD FOR PRODUCT CATEGORIES

add_action( 'product_cat_add_form_fields', 'bscp_wp_editor_add_forth', 10, 2 );

function bscp_wp_editor_add_forth() {
    ?>
    <div class="form-field">
        <label for="forthdesc"><?php echo __( 'Fourth Description', 'woocommerce' ); ?></label>

      <?php
      $settings = array(
         'textarea_name' => 'forthdesc',
         'quicktags' => array( 'buttons' => 'em,strong,link' ),
         'tinymce' => array(
            'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
            'theme_advanced_buttons2' => '',
         ),
         'editor_css' => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
      );

      wp_editor( '', 'forthdesc', $settings );
      ?>

        <p class="description"><?php echo __( 'This is the description that goes BELOW products on the category page', 'woocommerce' ); ?></p>
    </div>
    <?php
}

// ---------------
// 2. Display field on "Edit product category" admin page

add_action( 'product_cat_edit_form_fields', 'bscp_wp_editor_edit_forth', 10, 2 );

function bscp_wp_editor_edit_forth( $term ) {
    $forth_desc = htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'forthdesc', true ) );
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="forth-desc"><?php echo __( 'Fourth Description', 'woocommerce' ); ?></label></th>
        <td>
            <?php

         $settings = array(
            'textarea_name' => 'forthdesc',
            'quicktags' => array( 'buttons' => 'em,strong,link' ),
            'tinymce' => array(
               'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
               'theme_advanced_buttons2' => '',
            ),
            'editor_css' => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
         );

         wp_editor( $forth_desc, 'forthdesc', $settings );
         ?>

            <p class="description"><?php echo __( 'This is the description that goes BELOW products on the category page', 'woocommerce' ); ?></p>
        </td>
    </tr>
    <?php
}

// ---------------
// 3. Save field @ admin page

add_action( 'edit_term', 'bscp_save_wp_editor_forth', 10, 3 );
add_action( 'created_term', 'bscp_save_wp_editor_forth', 10, 3 );

function bscp_save_wp_editor_forth( $term_id, $tt_id = '', $taxonomy = '' ) {
   if ( isset( $_POST['forthdesc'] ) && 'product_cat' === $taxonomy ) {
      update_woocommerce_term_meta( $term_id, 'forthdesc', esc_attr( $_POST['forthdesc'] ) );
   }
}

// ---------------
// 4. Display field under products @ Product Category pages

add_action( 'woocommerce_after_shop_loop', 'bscp_display_wp_editor_content_forth', 5 );

function bscp_display_wp_editor_content_forth() {
   if ( is_product_taxonomy() ) {
      $term = get_queried_object();
      if ( $term && ! empty( get_woocommerce_term_meta( $term->term_id, 'forthdesc', true ) ) ) {
         echo '<p class="term-description">' . wc_format_content( htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'forthdesc', true ) ) ) . '</p>';
      }
   }
}


