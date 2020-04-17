<div id="wrapper" class="mmwps-wrapper">
  <div class="content">
    <div class="row">
       <?php 
         $edit_id = isset( $_GET['edit-slider'] ) ? sanitize_text_field( $_GET['edit-slider'] ) : '';
         $slider = mmwps_update_slider_data($edit_id);
       ?>
        <div class="col-md-12">
            <div class="panel_s"> 
              <div class="panel-body">
                <div class="_button">
                  <span class="message-heading mright5 test pull-left display-block"><?php esc_html_e( 'Update Slider', 'post-slider' ); ?></span>
                  <a href="admin.php?page=mmwps-slider" class="top-heading mright5 test pull-right display-block" data-toggle="tooltip" data-placement="top" title="Back"><i class="fa fa-undo"></i></a>
                </div>
              </div>
              <?php if (isset($slider) && $slider['_slug'] === $_GET['edit-slider']): ?>
              <form id="update_slider_form" class="form-horizontal" action="#" method="post" data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
                <input type="hidden" name="slider-edit" value="<?php echo isset( $_GET['edit-slider'] ) ? intval( $_GET['edit-slider'] ) : 0; ?>">
                 <input type="hidden" name="slider_edit_id" value="<?php echo intval( $slider['_id'] ) ?>">
                 <input type="hidden" name="slider_slider_status" value="<?php echo intval( $slider['_slider_status'] ) ?>">
                <input type="hidden" id="update_security" name="update_security" value="<?php echo wp_create_nonce( 'slider_edit_form_nonce' ); ?>"/>
                <div class="panel-body">
                  <div class="col-md-8 col-md-offset-2">
                    <div class="panel-body"> 
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="mmwpsQueryheading">
                              <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#mmwpsQuery" aria-expanded="false" aria-controls="mmwpsQuery">
                                  <i class="click-change-icon fa fa-caret-right"></i>
                                   <span class="panel-span"><?php esc_html_e( 'Query', 'post-slider' ); ?></span>
                                </a>
                              </h4>
                            </div>
                            <div id="mmwpsQuery" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="mmwpsQueryheading">
                              <div class="collapse-body">
                                <?php

                                    $orderby = [
                                      'date' => 'Date',
                                      'title' => 'Title',
                                      'menu_order' => 'Menu Order',
                                      'rand' => 'Random'
                                    ];

                                    $order = [
                                      'asc' => 'ASC',
                                      'desc' => 'DESC'
                                    ];

                                    $date = [
                                      'anytime' => 'All',
                                      'today' => 'Past Day',
                                      'week' => 'Past Week',
                                      'month' => 'Past Month',
                                      'quarter' => 'Past Quarter',
                                      'year' => 'Past Year',
                                    ];

                                    $status = [
                                      'publish' => 'publish',
                                      'draft' => 'Draft' 
                                    ];

                                    $_sticky = $slider['_sticky'] == 1 ? true : false;
                                    $_by_manual = !empty($slider['_by_manual']) ? $slider['_by_manual'][0] : '';
                                      echo MMWPS\Common\MMWPS_Form_Fields::render_input('Slider Name', 'slider_name', $slider['_title'], 'text', true);
                                      echo MMWPS\Common\MMWPS_Form_Fields::render_post_type('Source', 'select_posts_type', $slider['_type']);
                                       echo MMWPS\Common\MMWPS_Form_Fields::render_post('Posts', 'select_posts', $_by_manual);
                                      echo MMWPS\Common\MMWPS_Form_Fields::render_select('Date', 'posts_select_date', $date, $slider['_by_date']);
                                      echo MMWPS\Common\MMWPS_Form_Fields::render_select('Orderby', 'posts_orderby', $orderby, $slider['_orderby']);
                                      echo MMWPS\Common\MMWPS_Form_Fields::render_select('Order', 'posts_order', $order, $slider['_order']);
                                      echo MMWPS\Common\MMWPS_Form_Fields::render_input('Limit', 'per_page', $slider['_limit'], 'number');
                                      echo MMWPS\Common\MMWPS_Form_Fields::render_select('Status', 'posts_status', $status, $slider['_status']);
                                      echo MMWPS\Common\MMWPS_Form_Fields::render_checkbox('Ignore Sticky Posts', 'ignore_sticky_posts', $_sticky);
                                     ?> 
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="mmwpsLayoutheading">
                              <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#mmwpsLayout" aria-expanded="true" aria-controls="mmwpsLayout">
                                  <i class="click-change-icon fa fa-caret-right"></i>
                                   <span class="panel-span"><?php esc_html_e( 'Layout', 'post-slider' ); ?></span>
                                </a>
                              </h4>
                            </div>
                            <div id="mmwpsLayout" class="panel-collapse collapse" role="tabpanel" aria-labelledby="mmwpsLayoutheading">
                              <div class="collapse-body">
                                  <?php 

                                    $skin = [
                                        'classic' => 'Classic',
                                        'card' => 'Card',
                                        'full_content' => 'Full Content'
                                      ];

                                    $column = [
                                        '1' => '1',
                                        '2' => '2',
                                        '3' => '3',
                                        '4' => '4',
                                        '5' => '5',
                                        '6' => '6',
                                      ];

                                    $image_position = [
                                        'top'   => 'Top',
                                        'left'  => 'Left',
                                        'right' => 'Right',
                                        'center' => 'Center',
                                        'none'  => 'None'
                                      ];

                                    $title_tag = [
                                        'h1'   => 'H1',
                                        'h2'   => 'H2',
                                        'h3'   => 'H3',
                                        'h4'   => 'H4',
                                        'h5'   => 'H5',
                                        'h6'   => 'H6'
                                      ];

                                    $navigation = [
                                        'both'   => 'Arrows and Dots',
                                        'arrows' => 'Arrows',
                                        'dots'   => 'Dots',
                                        'none'   => 'none',
                                      ];

                                   $_autoplay = $slider['_autoplay'] == 1 ? true : false;

                                    echo MMWPS\Common\MMWPS_Form_Fields::render_select('Skin', 'skin', $skin, $slider['_skin']);
                                    echo MMWPS\Common\MMWPS_Form_Fields::render_select('Column', 'column', $column, $slider['_column']);
                                    echo MMWPS\Common\MMWPS_Form_Fields::render_select('Image Position', 'image_position', $image_position, $slider['_thumb_position']);
                                    echo MMWPS\Common\MMWPS_Form_Fields::render_image_size('Image Size', 'image_size', $slider['_thumb_size']);
                                    echo MMWPS\Common\MMWPS_Form_Fields::render_yes_no_option('Show Image','show_image', $slider['_show_thumb'], 'Choose Yes to enable Image');
                                    echo MMWPS\Common\MMWPS_Form_Fields::render_silderui('Image Width','image_width', $slider['_thumb_width'], 10, 1000, 1);
                                    echo '<hr>';
                                    echo MMWPS\Common\MMWPS_Form_Fields::render_yes_no_option('Title','show_title', $slider['_show_title']);
                                    echo MMWPS\Common\MMWPS_Form_Fields::render_select('Title HTML Tag', 'title_tag', $title_tag, $slider['_title_tag']);
                                    echo MMWPS\Common\MMWPS_Form_Fields::render_yes_no_option('Excerpt','show_excerpt', $slider['_show_excerpt']);
                                    echo MMWPS\Common\MMWPS_Form_Fields::render_input('Excerpt Length', 'excerpt_length', $slider['_excerpt_length'], 'number');
                                    echo '<hr>';
                                    echo '<h5 class="inner-heading">Button Option</h5>';
                                    echo MMWPS\Common\MMWPS_Form_Fields::render_yes_no_option('Read More','show_read_more', $slider['_show_read_more']);
                                    echo MMWPS\Common\MMWPS_Form_Fields::render_input('Read More Text', 'read_more_text', $slider['_read_more_text'], 'text', true);
                                     echo '<hr>';
                                     echo '<h5 class="inner-heading">Slider Option</h5>';
                                     echo MMWPS\Common\MMWPS_Form_Fields::render_select('Navigation', 'navigation', $navigation, $slider['_navigation']);
                                     echo MMWPS\Common\MMWPS_Form_Fields::render_checkbox('Autoplay', 'autoplay', $_autoplay);
                                     echo MMWPS\Common\MMWPS_Form_Fields::render_input('Autoplay Speed', 'autoplay_speed', $slider['_autoplay_speed'], 'number', true);
                                     ?>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="mmwpsStyleheading">
                              <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#mmwpsStyle" aria-expanded="false" aria-controls="mmwpsStyle">
                                  <i class="click-change-icon fa fa-caret-right"></i>
                                   <span class="panel-span"><?php esc_html_e( 'Style', 'post-slider' ); ?></span>
                                </a>
                              </h4>
                            </div>
                            <div id="mmwpsStyle" class="panel-collapse collapse" role="tabpanel" aria-labelledby="mmwpsStyleheading">
                              <div class="collapse-body">
                               <?php 
                                  echo MMWPS\Common\MMWPS_Form_Fields::render_color_picker('Title Color','title_color',$slider['_title_color'],true,'#ffffff', true);
                                  echo MMWPS\Common\MMWPS_Form_Fields::render_font_size('Title Font Size', 'title_font_size', $slider['_title_size'], $slider['_title_unit']);
                                  echo '<hr>';
                                  echo MMWPS\Common\MMWPS_Form_Fields::render_color_picker('Excerpt Color','excerpt_color',$slider['_excerpt_color'],true,'#ffffff', true);
                                  echo MMWPS\Common\MMWPS_Form_Fields::render_font_size('Excerpt Font Size', 'excerpt_font_size', $slider['_excerpt_size'], $slider['_excerpt_unit']);
                                  echo '<hr>';
                                  echo MMWPS\Common\MMWPS_Form_Fields::render_color_picker('Item Background','item_bg',$slider['_item_bg'],true,'#ffffff', true);
                                  echo MMWPS\Common\MMWPS_Form_Fields::render_dimension('Margin', 'item_margin', $slider['_margin_top'], $slider['_margin_right'], $slider['_margin_bottom'], $slider['_margin_left'], $slider['_margin_unit']);
                                  echo MMWPS\Common\MMWPS_Form_Fields::render_dimension('Padding', 'item_padding', $slider['_padding_top'], $slider['_padding_right'], $slider['_padding_bottom'], $slider['_padding_left'], $slider['_padding_unit']);
                                 ?>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div> 
                </div>
              <div class="panel-body">
                <div class="_button">
                  <button type="submit" class="btn btn-info test pull-right display-block" id="save-menu"><?php esc_html_e( 'Save Change','post-slider' ); ?></button>
                </div>
              </div>
            </form>
            <?php else: ?>
              <div class="panel-body">
                <div class="_button text-center">
                 <h1><?php esc_html_e( 'Oops, something went wrong', 'post-slider' ); ?></h1>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
    </div>
  </div>
</div>