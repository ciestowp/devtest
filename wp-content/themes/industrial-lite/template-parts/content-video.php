<?php
/**
 * The template part for displaying post
 *
 * @package Industrial Lite 
 * @subpackage industrial-lite
 * @since industrial-lite 1.0
 */
?>
<?php 
  $industrial_lite_archive_year  = get_the_time('Y'); 
  $industrial_lite_archive_month = get_the_time('m'); 
  $industrial_lite_archive_day   = get_the_time('d'); 
?>
<?php
  $content = apply_filters( 'the_content', get_the_content() );
  $video = false;

  // Only get video from the content if a playlist isn't present.
  if ( false === strpos( $content, 'wp-playlist-script' ) ) {
    $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
  }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="post-main-box ">
    <div class="box-image">
      <?php
        if ( ! is_single() ) {
          // If not a single post, highlight the video file.
          if ( ! empty( $video ) ) {
            foreach ( $video as $video_html ) {
              echo '<div class="entry-video">';
                echo $video_html;
              echo '</div>';
            }
          };
        };
      ?>
    </div>
    <div class="new-text">
      <h2 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
      <?php if( get_theme_mod( 'industrial_lite_toggle_postdate',true) != '' || get_theme_mod( 'industrial_lite_toggle_author',true) != '' || get_theme_mod( 'industrial_lite_toggle_comments',true) != '') { ?>
        <div class="post-info">
          <?php if(get_theme_mod('industrial_lite_toggle_postdate',true)==1){ ?>
            <i class="fas fa-calendar-alt"></i><span class="entry-date"><a href="<?php echo esc_url( get_day_link( $industrial_lite_archive_year, $industrial_lite_archive_month, $industrial_lite_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span><span>|</span>
          <?php } ?>

          <?php if(get_theme_mod('industrial_lite_toggle_author',true)==1){ ?>
            <i class="far fa-user"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span><span>|</span>
          <?php } ?>

          <?php if(get_theme_mod('industrial_lite_toggle_comments',true)==1){ ?>
            <i class="fa fa-comments" aria-hidden="true"></i><span class="entry-comments"><?php comments_number( __('0 Comment', 'industrial-lite'), __('0 Comments', 'industrial-lite'), __('% Comments', 'industrial-lite') ); ?> </span><span>|</span>
          <?php } ?>

          <?php if(get_theme_mod('industrial_lite_toggle_time',true)==1){ ?>
            <i class="far fa-clock"></i><span class="entry-time"><?php echo esc_html( get_the_time() ); ?></span>
          <?php } ?>
          <hr>
        </div>
      <?php } ?>
      <div class="entry-content">
        <p>
          <?php $industrial_lite_theme_lay = get_theme_mod( 'industrial_lite_excerpt_settings','Excerpt');
          if($industrial_lite_theme_lay == 'Content'){ ?>
            <?php the_content(); ?>
          <?php }
          if($industrial_lite_theme_lay == 'Excerpt'){ ?>
            <?php if(get_the_excerpt()) { ?>
              <?php $excerpt = get_the_excerpt(); echo esc_html( industrial_lite_string_limit_words( $excerpt, esc_attr(get_theme_mod('industrial_lite_excerpt_number','30')))); ?> <?php echo esc_html(get_theme_mod('industrial_lite_excerpt_suffix',''));?>
            <?php }?>
          <?php }?>
        </p>
      </div>
      <?php if( get_theme_mod('industrial_lite_button_text','READ MORE') != ''){ ?>
        <div class="more-btn">
          <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('industrial_lite_button_text',__('READ MORE','industrial-lite')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('industrial_lite_button_text',__('READ MORE','industrial-lite')));?></span></a>
        </div>
      <?php }?>
    </div>
  </div>
</article>