<?php

// Create Shortcode show_filterable_products
// Shortcode: [show_filterable_products]
function create_showfilterableprod_shortcode() {

    ob_start(); ?>

    <div id="productcontainer">
        <div id="filters" class="button-group">  <button class="button is-checked" data-filter="*">Everything</button>
            <?php

            $get_terms_args = array (
                'taxonomy' => 'product_cat',
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => true
            );

            $get_product_cats = get_terms($get_terms_args);

            foreach ($get_product_cats as $get_product_cat) { ?>

                <button class="button" data-filter=".<?php echo $get_product_cat->name; ?>"><?php echo $get_product_cat->name; ?></button>

            <?php }

            ?>
        </div>

    <?php
        $products_args = array(
            'post_type' => 'product',
            'posts_per_page' => -1
        );

        $products_loop = new WP_Query( $products_args );

        if ( $products_loop->have_posts() ) :
            echo '<ul class="stage">';
            while ( $products_loop->have_posts() ) : $products_loop->the_post();
            $get_product_cats = get_the_term_list(get_the_ID(), 'product_cat', '', ' ', ''); ?>

                <li class="<?php echo strip_tags($get_product_cats); ?>">
                    <figure>
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="><?php the_title(); ?>" />
                    </figure>
                    <a href="?add-to-cart=<?php echo get_the_ID(); ?>" data-quantity="1" data-product_id="<?php echo get_the_ID(); ?>" data-product_name="<?php the_title(); ?>" class="addtocartbtn add_to_cart_button ajax_add_to_cart">Lägg i varukorg</a>
                    <div class="prod__content">
                        <h3>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <?php $product = wc_get_product( get_the_ID() ); ?>
                        <span class="totalprice"><?php echo $product->get_price_html(); ?></span>
                    </div>

                </li>
            <?php endwhile;
            echo "</ul>";

        endif;

        wp_reset_postdata();

    ?>

    </div>

    <?php $content = ob_get_clean();
    return $content;

}
add_shortcode( 'show_filterable_products', 'create_showfilterableprod_shortcode' );