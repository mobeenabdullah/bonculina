<?php

// Create Shortcode show_filterable_products
// Shortcode: [show_filterable_products]
function create_showfilterableprod_shortcode() {

    ob_start(); ?>

    <style>
        #productcontainer{
            display:block;
            overflow:hidden;
            width: 100%;
            margin:0 auto;
        }

        #productcontainer li {
            float: left;
            height: 300px;
            list-style: none outside none;
            position: relative;
            /* 	 */
            text-align: center;
            margin-right: 34.2px;
            margin-bottom: 30px;
        }

        #productcontainer ul{
            overflow:hidden;
        }

        #productcontainer ul.hidden{
            display:none;
        }
        #productcontainer li:nth-child(5n) {
            margin-right: 0;
        }
        #productcontainer li figure {
            height: 194px;
            width: 194px;
        }
        #productcontainer li figure img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
            transition: all 1s;
        }
        #productcontainer li figure {
            border: 3px solid #f1eeea;
            transition: all .2s;
            cursor: pointer;
            overflow: hidden;
        }
        #productcontainer li:hover {
            transition: all .2s;
        }
        #productcontainer li:hover figure {
            border: 3px solid #D3202B;
            transition: all .2s;
        }
        #productcontainer li:hover img {
            transform: scale(1.5);
        }
        #productcontainer li .addtocartbtn  {
            background-color: #D3202B;
            display: block;
            text-decoration: none;
            padding: 12px ;
            color: #ffffff;
            transition: all .3s;
            margin-bottom: -40px;
            opacity: 0;
        }
        #productcontainer li:hover .addtocartbtn {
            color: #ffffff;
            margin-bottom: -6px;
            opacity: 1;
        }
        #productcontainer li .prod__content h3 {
            margin-top: 15px;
            color: #5e5a54;
            font-size: 18px;
        }
        #productcontainer li .prod__content .totalprice {
            font-weight: 600;
            margin-top: 10px;
            color: #D3202B;
            display: block;
        }

    </style>

    <div id="productcontainer">
        <nav id="filter"></nav>

    <?php
        $products_args = array(
            'post_type' => 'product',
            'posts_per_page' => -1
        );

        $products_loop = new WP_Query( $products_args );

        if ( $products_loop->have_posts() ) :
            echo '<ul class="stage">';
            while ( $products_loop->have_posts() ) : $products_loop->the_post();
            $get_product_cats = get_the_term_list(get_the_ID(), 'product_cat', '', ',', ''); ?>

                <li data-tags="<?php echo strip_tags($get_product_cats); ?>">
                    <figure>
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="><?php the_title(); ?>" />
                    </figure>
                    <a href="#" class="addtocartbtn">Add to Cart</a>
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