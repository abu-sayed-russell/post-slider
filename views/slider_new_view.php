<div id="wrapper" class="mmwps-wrapper">  <div class="content">    <div class="row">        <div class="col-md-12">            <div class="panel_s">               <div class="panel-body">                <div class="_button">                <span class="message-heading mright5 test pull-left display-block"><?php esc_html_e( 'New Slider', 'post-slider' ); ?></span>                <a href="admin.php?page=mmwps-slider" class="top-heading mright5 test pull-right display-block" data-toggle="tooltip" data-placement="top" title="Back"><i class="fa fa-undo"></i></a>              </div>              </div>              <form id="slider_form" class="form-horizontal" action="#" method="post" data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">                <input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce( 'slider_form_nonce' ); ?>"/>                <div class="panel-body">                  <div class="col-md-8 col-md-offset-2">                    <div class="panel-body">                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">                          <div class="panel panel-default">                            <div class="panel-heading" role="tab" id="mmwpsQueryheading">                              <h4 class="panel-title">                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#mmwpsQuery" aria-expanded="false" aria-controls="mmwpsQuery">                                  <i class="click-change-icon fa fa-caret-right"></i>                                   <span class="panel-span"><?php esc_html_e( 'Query', 'post-slider' ); ?></span>                                </a>                              </h4>                            </div>                            <div id="mmwpsQuery" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="mmwpsQueryheading">                              <div class="collapse-body">                                <?php                                    $orderby = [                                      'date' => 'Date',                                      'title' => 'Title',                                      'menu_order' => 'Menu Order',                                      'rand' => 'Random'                                    ];                                    $order = [                                      'asc' => 'ASC',                                      'desc' => 'DESC'                                    ];                                    $date = [                                      'anytime' => 'All',                                      'today' => 'Past Day',                                      'week' => 'Past Week',                                      'month' => 'Past Month',                                      'quarter' => 'Past Quarter',                                      'year' => 'Past Year',                                    ];                                    $status = [                                      'publish' => 'publish',                                      'draft' => 'Draft'                                    ];                                      echo MMWPS\Common\MMWPS_Form_Fields::render_input('Slider Name', 'slider_name', '', 'text', true);                                      echo MMWPS\Common\MMWPS_Form_Fields::render_post_type('Source', 'select_posts_type', 'post');                                      echo MMWPS\Common\MMWPS_Form_Fields::render_post('Posts', 'select_posts', '');                                      echo MMWPS\Common\MMWPS_Form_Fields::render_select('Date', 'posts_select_date', $date, 'anytime');                                      echo MMWPS\Common\MMWPS_Form_Fields::render_select('Orderby', 'posts_orderby', $orderby, 'title');                                      echo MMWPS\Common\MMWPS_Form_Fields::render_select('Order', 'posts_order', $order, 'desc');                                      echo MMWPS\Common\MMWPS_Form_Fields::render_input('Limit', 'per_page', '4', 'number');                                      echo MMWPS\Common\MMWPS_Form_Fields::render_select('Status', 'posts_status', $status, 'publish');                                      echo MMWPS\Common\MMWPS_Form_Fields::render_checkbox('Ignore Sticky Posts', 'ignore_sticky_posts', true);                                     ?>                              </div>                            </div>                          </div>                          <div class="panel panel-default">                            <div class="panel-heading" role="tab" id="mmwpsLayoutheading">                              <h4 class="panel-title">                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#mmwpsLayout" aria-expanded="true" aria-controls="mmwpsLayout">                                  <i class="click-change-icon fa fa-caret-right"></i>                                   <span class="panel-span"><?php esc_html_e( 'Layout', 'post-slider' ); ?></span>                                </a>                              </h4>                            </div>                            <div id="mmwpsLayout" class="panel-collapse collapse" role="tabpanel" aria-labelledby="mmwpsLayoutheading">                              <div class="collapse-body">                                  <?php                                    $skin = [                                        'classic' => 'Classic',                                        'card' => 'Card',                                        'full_content' => 'Full Content'                                      ];                                    $column = [                                        '1' => '1',                                        '2' => '2',                                        '3' => '3',                                        '4' => '4',                                        '5' => '5',                                        '6' => '6',                                      ];                                    $image_position = [                                        'top'   => 'Top',                                        'left'  => 'Left',                                        'right' => 'Right',                                        'center' => 'Center',                                        'none'  => 'None'                                      ];                                                                          $title_tag = [                                        'h1'   => 'H1',                                        'h2'   => 'H2',                                        'h3'   => 'H3',                                        'h4'   => 'H4',                                        'h5'   => 'H5',                                        'h6'   => 'H6'                                      ];                                    $Navigation = [                                        'both'   => 'Arrows and Dots',                                        'arrows' => 'Arrows',                                        'dots'   => 'Dots',                                        'none'   => 'none',                                      ];                                                                       echo MMWPS\Common\MMWPS_Form_Fields::render_select('Skin', 'skin', $skin, 'classic');                                    echo MMWPS\Common\MMWPS_Form_Fields::render_select('Column', 'column', $column, '4');                                    echo MMWPS\Common\MMWPS_Form_Fields::render_select('Image Position', 'image_position', $image_position, 'center');                                    echo MMWPS\Common\MMWPS_Form_Fields::render_image_size('Image Size', 'image_size', 'medium');                                    echo MMWPS\Common\MMWPS_Form_Fields::render_yes_no_option('Show Image','show_image', 1, 'Choose Yes to enable Image');                                    echo MMWPS\Common\MMWPS_Form_Fields::render_silderui('Image Width','image_width', 100, 10, 1000, 1);                                    echo '<hr>';                                    echo MMWPS\Common\MMWPS_Form_Fields::render_yes_no_option('Title','show_title', 1);                                    echo MMWPS\Common\MMWPS_Form_Fields::render_select('Title HTML Tag', 'title_tag', $title_tag, 'h2');                                    echo MMWPS\Common\MMWPS_Form_Fields::render_yes_no_option('Excerpt','show_excerpt', 1);                                    echo MMWPS\Common\MMWPS_Form_Fields::render_input('Excerpt Length', 'excerpt_length', 20, 'number');                                    echo '<hr>';                                    echo '<h5 class="inner-heading">Button Option</h5>';                                    echo MMWPS\Common\MMWPS_Form_Fields::render_yes_no_option('Read More','show_read_more', 1);                                    echo MMWPS\Common\MMWPS_Form_Fields::render_input('Read More Text', 'read_more_text', 'Read More', 'text', true);                                     echo '<hr>';                                     echo '<h5 class="inner-heading">Slider Option</h5>';                                     echo MMWPS\Common\MMWPS_Form_Fields::render_select('Navigation', 'navigation', $Navigation, 'arrows');                                     echo MMWPS\Common\MMWPS_Form_Fields::render_checkbox('Autoplay', 'autoplay', true);                                     echo MMWPS\Common\MMWPS_Form_Fields::render_input('Autoplay Speed', 'autoplay_speed', '5000', 'number', true);                                     ?>                              </div>                            </div>                          </div>                          <div class="panel panel-default">                            <div class="panel-heading" role="tab" id="mmwpsStyleheading">                              <h4 class="panel-title">                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#mmwpsStyle" aria-expanded="false" aria-controls="mmwpsStyle">                                  <i class="click-change-icon fa fa-caret-right"></i>                                   <span class="panel-span"><?php esc_html_e( 'Style', 'post-slider' ); ?></span>                                </a>                              </h4>                            </div>                            <div id="mmwpsStyle" class="panel-collapse collapse" role="tabpanel" aria-labelledby="mmwpsStyleheading">                              <div class="collapse-body">                               <?php                                   echo MMWPS\Common\MMWPS_Form_Fields::render_color_picker('Title Color','title_color','#ffffff',true,'#ffffff', true);                                  echo MMWPS\Common\MMWPS_Form_Fields::render_font_size('Title Font Size', 'title_font_size', 24, 'px');                                  echo '<hr>';                                  echo MMWPS\Common\MMWPS_Form_Fields::render_color_picker('Excerpt Color','excerpt_color','#ffffff',true,'#ffffff', true);                                  echo MMWPS\Common\MMWPS_Form_Fields::render_font_size('Excerpt Font Size', 'excerpt_font_size', 16, 'px');                                  echo '<hr>';                                  echo MMWPS\Common\MMWPS_Form_Fields::render_color_picker('Item Background','item_bg','#ffffff',true,'#ffffff', true);                                  echo MMWPS\Common\MMWPS_Form_Fields::render_dimension('Margin', 'item_margin', 0, 0, 0, 0, 'px');                                  echo MMWPS\Common\MMWPS_Form_Fields::render_dimension('Padding', 'item_padding', 0, 0, 0, 0, 'px');                                 ?>                              </div>                            </div>                          </div>                        </div>                    </div>                  </div>                </div>              <div class="panel-body">                <div class="_button">                  <button type="submit" class="btn btn-info test pull-right display-block" id="save-menu"><?php esc_html_e( 'Save','post-slider' ); ?></button>                </div>              </div>            </form>          </div>        </div>    </div>  </div></div>