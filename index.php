<?php get_header(); ?>

<div class="container">
  <h1><?php echo esc_html__( 'Latest Posts', 'my_custom_theme' ); ?></h1>
  <ul>
    <?php
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
      );
      $query = new WP_Query( $args );
      if ( $query->have_posts() ) :
        while ( $query->have_posts() ) :
          $query->the_post();
    ?>
    <li>
      <h2 class="post-title"><?php the_title(); ?></h2>
      <div class="post-category"><?php echo esc_html__( 'Category:', 'my_custom_theme' ); ?> <?php the_category( ', ' ); ?></div>
      <?php if ( has_post_thumbnail() ) : ?>
        <img class="post-image" src="<?php the_post_thumbnail_url( 'medium' ); ?>" alt="<?php the_title_attribute(); ?>">
      <?php endif; ?>
      <div class="post-content"><?php the_excerpt(); ?></div>
      <div class="post-custom-field"><?php echo get_post_meta( get_the_ID(), 'my_custom_field', true ); ?></div>