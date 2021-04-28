<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * RyanCV Portfolio Widget.
 *
 * @since 1.0
 */
class RyanCV_Portfolio_Widget extends Widget_Base {

	public function get_name() {
		return 'ryancv-portfolio';
	}

	public function get_title() {
		return esc_html__( 'Portfolio', 'ryancv-plugin' );
	}

	public function get_icon() {
		return 'fas fa-suitcase';
	}

	public function get_categories() {
		return [ 'ryancv-category' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'heading_tab',
			[
				'label' => esc_html__( 'Title', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'ryancv-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ryancv-plugin' ),
				'default'     => esc_html__( 'Title', 'ryancv-plugin' ),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1'  => __( 'H1', 'ryancv-plugin' ),
					'h2' => __( 'H2', 'ryancv-plugin' ),
					'h3' => __( 'H3', 'ryancv-plugin' ),
					'div' => __( 'DIV', 'ryancv-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'filters_tab',
			[
				'label' => esc_html__( 'Filters', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'filters',
			[
				'label' => esc_html__( 'Show Filters', 'ryancv-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ryancv-plugin' ),
				'label_off' => __( 'Hide', 'ryancv-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_tab',
			[
				'label' => esc_html__( 'Items', 'ryancv-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'source',
			[
				'label'       => esc_html__( 'Source', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all'  => __( 'All', 'ryancv-plugin' ),
					'categories' => __( 'Categories', 'ryancv-plugin' ),
				],
			]
		);

		$this->add_control(
			'source_categories',
			[
				'label'       => esc_html__( 'Source', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->get_portfolio_categories(),
				'condition' => [
		            'source' => 'categories'
		        ],
			]
		);

		$this->add_control(
			'limit',
			[
				'label'       => esc_html__( 'Number of Items', 'ryancv-plugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => 8,
				'default'     => 8,
			]
		);

		$this->add_control(
			'sort',
			[
				'label'       => esc_html__( 'Sorting By', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'menu_order',
				'options' => [
					'date'  => __( 'Date', 'ryancv-plugin' ),
					'title' => __( 'Title', 'ryancv-plugin' ),
					'rand' => __( 'Random', 'ryancv-plugin' ),
					'menu_order' => __( 'Order', 'ryancv-plugin' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'       => esc_html__( 'Order', 'ryancv-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc'  => __( 'ASC', 'ryancv-plugin' ),
					'desc' => __( 'DESC', 'ryancv-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_styling',
			[
				'label'     => esc_html__( 'Title', 'ryancv-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .content .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .content .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_styling',
			[
				'label'     => esc_html__( 'Items', 'ryancv-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .box-item .image .info .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .box-item .desc .name' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Title Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .box-item .desc .name',
			]
		);

		$this->add_control(
			'item_category_color',
			[
				'label'     => esc_html__( 'Category Color', 'ryancv-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .box-item .desc .category' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_category_typography',
				'label'     => esc_html__( 'Category Typography', 'ryancv-plugin' ),
				'selector' => '{{WRAPPER}} .box-item .desc .category',
			]
		);
		
		$this->end_controls_section();
	}

	/**
	 * Render Categories List.
	 *
	 * @since 1.0
	 */
	protected function get_portfolio_categories() {
		$categories = [];

		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'portfolio_categories',
			'pad_counts'	=> false 
		);

		$portfolio_categories = get_categories( $args );

		foreach ( $portfolio_categories as $category ) {
			$categories[$category->term_id] = $category->name;
		}

		return $categories;
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$this->add_inline_editing_attributes( 'title', 'basic' );

		$portfolio_single = get_field( 'portfolio_single', 'options' );
		$portfolio_qv = get_field( 'portfolio_qv', 'options' );

		if ( $settings['source'] == 'all' ) {
			$cat_ids = '';
		} else {
			$cat_ids = $settings['source_categories'];
		}

		$cat_args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'portfolio_categories',
			'pad_counts'	=> false,
			'include'		=> $cat_ids
		);

		$pf_categories = get_categories( $cat_args );

		$args = array(
			'post_type'			=> 'portfolio',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['sort'],
			'order'				=> $settings['order'],
			'posts_per_page'	=> $settings['limit']
		);

		if( $settings['source'] == 'categories' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'portfolio_categories',
					'field'    => 'id',
					'terms'    => $cat_ids
				)
			);

			$args += array('tax_query' => $tax_array);
		}

		$q = new \WP_Query( $args );

		?>

		<!-- Works -->
		<div class="content works">

			<?php if ( $settings['title'] ) : ?>
			<!-- title -->
			<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title">
				<span <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $settings['title'] ); ?></span>
			</<?php echo esc_attr( $settings['title_tag'] ); ?>>
			<?php endif; ?>

			<?php if ( $settings['filters'] && $pf_categories ) : ?>
			<!-- filters -->
			<div class="filter-menu filter-button-group">
				<div class="f_btn active">
					<label><input type="radio" name="fl_radio" value=".grid-item" /><?php echo esc_html__( 'All', 'ryancv-plugin' ); ?></label>
				</div>
				<?php foreach ( $pf_categories as $category ) : ?>
				<div class="f_btn">
					<label><input type="radio" name="fl_radio" value=".f-<?php echo esc_attr( $category->slug ); ?>" /><?php echo esc_html( $category->name ); ?></label>
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php if ( $q->have_posts() ) : ?>
			<!-- content -->
			<div class="row grid-items border-line-v">

				<?php while ( $q->have_posts() ) : $q->the_post(); 
						
					/* post content */
					$current_categories = get_the_terms( get_the_ID(), 'portfolio_categories' );
					$category = '';
					$category_slug = '';
					if ( $current_categories && ! is_wp_error( $current_categories ) ) {
						$arr_keys = array_keys( $current_categories );
						$last_key = end( $arr_keys );
						foreach ( $current_categories as $key => $value ) {
							if ( $key == $last_key ) {
								$category .= $value->name . ' ';
							} else {
								$category .= $value->name . ', ';
							}
							$category_slug .= 'f-' . $value->slug . ' ';
						}
					}
					$id = get_the_ID();
					$title = get_the_title();
					$href = get_the_permalink();

					/*get portfolio type*/
					$type = get_field( 'portfolio_type', $id );
					$popup_url = get_the_post_thumbnail_url( $id, 'full' );
					$popup_class = 'has-popup-image';
					$preview_icon = 'fas fa-image';
					$images = false;
					$popup_link_target = false;

					if ( $type == 2 ) {
						$popup_url = get_field( 'music_url', $id );
						$popup_class = 'has-popup-music';
						$preview_icon = 'fas fa-music';
					} elseif ( $type == 3 ) {
						$popup_url = get_field( 'video_url', $id );
						$popup_class = 'has-popup-video';
						$preview_icon = 'fas fa-video';
					} elseif ( $type == 4 ) {
						$popup_url = '#popup-' . $id;
						$popup_class = 'has-popup-media';
						$preview_icon = 'fas fa-plus';
						$btn_text = get_field( 'button_text', $id );
						if(empty($btn_text)){
							$btn_text = esc_html__( 'View Project', 'ryancv-plugin' );
						}
						$btn_url = get_field( 'button_url', $id );
					} elseif ( $type == 5 ) {
						$popup_url = '#gallery-' . $id;
						$popup_class = 'has-popup-gallery';
						$preview_icon = 'fas fa-images';
						$images = get_field( 'gallery', $id );
					} elseif ( $type == 6 ) {
						$popup_url = get_field( 'link_url', $id );
						$popup_link_target = true;
						$popup_class = 'has-popup-link';
						$preview_icon = 'fas fa-link';
					} else { }

				?>
				
				<!-- work item -->
				<div class="col col-d-6 col-t-6 col-m-12 border-line-h grid-item <?php echo esc_attr( $category_slug ); ?>">
					<div class="box-item">
						<div class="image">
							<?php if ( $portfolio_qv ) : ?>
								<?php if ( $portfolio_single ) : ?>
									<a>
										<?php if ( has_post_thumbnail( $id ) ) : 
											echo get_the_post_thumbnail( $id, 'ryancv_600xauto' );
										endif; ?>
										<span class="info">
											<span class="ion"></span>
										</span>
									</a>
								<?php else : ?>
									<a href="<?php echo esc_url( get_the_permalink( $id ) ); ?>">
										<?php if ( has_post_thumbnail( $id ) ) : 
											echo get_the_post_thumbnail( $id, 'ryancv_600xauto' );
										endif; ?>
										<span class="info">
											<span class="ion ion-ios-book-outline"></span>
										</span>
									</a>
								<?php endif; ?>
							<?php else : ?>
								<a href="<?php echo esc_url( $popup_url ); ?>" class="<?php echo esc_attr( $popup_class ); ?>"<?php if ( $popup_link_target ) : ?> target="_blank"<?php endif; ?>>
									<?php if ( has_post_thumbnail( $id ) ) : 
										echo get_the_post_thumbnail( $id, 'ryancv_600xauto' );
									endif; ?>
									<span class="info">
										<span class="ion <?php echo esc_attr( $preview_icon ); ?>"></span>
									</span>
								</a>
								<?php if( $images ) : ?>
									<div id="gallery-<?php echo esc_attr( $id ); ?>" class="mfp-hide">
										<?php foreach( $images as $image ): ?>
										<?php $gallery_img_src = wp_get_attachment_image_src( $image['ID'], 'full' ); ?>
										<a href="<?php echo esc_url( $gallery_img_src[0] ); ?>"></a>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>
						<div class="desc">
							<?php if ( $portfolio_single ) : ?>
								<?php if ( $portfolio_qv ) : ?>
									<a class="name"><?php echo esc_html( $title ); ?></a>
								<?php else : ?>
									<a href="<?php echo esc_url( $popup_url ); ?>" class="name <?php echo esc_attr( $popup_class ); ?>"><?php echo esc_html( $title ); ?></a>
								<?php endif; ?>	
							<?php else : ?>
								<a href="<?php echo esc_url( $href ); ?>" class="name"><?php echo esc_html( $title ); ?></a>
							<?php endif; ?>

							<?php if ( $category ) : ?>
								<div class="category"><?php echo esc_html( $category ); ?></div>
							<?php endif; ?>
						</div>

						<?php if ( $type == 4 ) : ?>
						<div id="popup-<?php echo esc_attr( $id ); ?>" class="popup-box mfp-fade mfp-hide">
							<div class="content">
								<div class="preloader-popup">
									<div class="centrize full-width">
										<div class="vertical-center">
											<div class="spinner default-circle"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endwhile; wp_reset_postdata(); ?>

				<div class="clear"></div>
			</div>
			<?php endif; ?>

		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new RyanCV_Portfolio_Widget() );