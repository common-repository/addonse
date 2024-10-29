<?php

namespace Addonse\Modules\CreativeImage\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class Creative_Image extends Widget_Base {
 
  /**
   * Retrieve the widget name.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'creative-image';
  }
 
  /**
   * Retrieve the widget title.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget title.
   */
  public function get_title() {
    return __( 'Creative image', 'addonse' );
  }
 
  /**
   * Retrieve the widget icon.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget icon.
   */
  public function get_icon() {
    return 'addonse-creative-image';
  }

  /**
  * Get widget keywords.
  *
  * Retrieve the list of keywords the widget belongs to.
  *
  * @since 2.1.0
  * @access public
  *
  * @return array Widget keywords.
  */
	public function get_keywords() {
	return [ 'image', 'icon', 'link' ];
	}
 
  /**
   * Retrieve the list of categories the widget belongs to.
   *
   * Used to determine where to display the widget in the editor.
   *
   * Note that currently Elementor supports only one category.
   * When multiple categories passed, Elementor uses the first one.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return array Widget categories.
   */
	public function get_categories() {
		return [ ADDONSE_SLUG ];
	}
 
	/**
   * Register the widget controls.
   *
   * Adds different input fields to allow the user to change and customize the widget settings.
   *
   * @since 1.1.0
   *
   * @access protected
   */
  protected function _register_controls() {
    $this->start_controls_section(
      'section_content',
      [
        'label' => __( 'Image', 'addonse' ),
      ]
	);

	$this->add_control(
		'image',
		[
			'label' => __( 'Choose Image', 'addonse' ),
			'type' => Controls_Manager::MEDIA,
			'dynamic' => [
				'active' => true,
			],
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		]
	);

	$this->add_control(
		'image_mask_heading',
		[
			'label' => __( 'Mask', 'addonse' ),
			'type' => Controls_Manager::HEADING,
			'separator' => 'before',
		]
	);

	$this->add_control(
		'image_mask',
		[
			'label' => __( 'Type', 'addonse' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => 'style_1',
			'options' => [
				'style_1'  => __( 'Style 1', 'addonse' ),
				'style_2' => __( 'Style 2', 'addonse' ),
				'style_3' => __( 'Style 3', 'addonse' ),
				'style_4' => __( 'Style 4', 'addonse' ),
				'style_5' => __( 'Style 5', 'addonse' ),
				'style_6' => __( 'Style 6', 'addonse'),
				'style_7' => __( 'Style 7', 'addonse'),
				'style_8' => __( 'Style 8', 'addonse'),
				'none' => __( 'None', 'addonse' ),
			],
		]
	);

	$this->end_controls_section();
	
	$this->start_controls_section(
		'section_image_style',
		[
			'label' => __( 'Image', 'addonse' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);

	$this->add_responsive_control(
		'image_padding',
		[
			'label' => __( 'Padding', 'elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .addonse-imagemask' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator' => 'before',
		]
	);
	
	$this->end_controls_section();
}
 
	/**
	 * Render social icons widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display(); 
		$svg_id = 'addonse-svg-' . $this->get_id();
		$image_id = 'addonse-image-' . $this->get_id();
		?>

		<?php if ($settings['image_mask'] == 'style_1'){ ?>
			<svg id="<?php echo $svg_id; ?>" class="addonse-imagemask" width="100%" height="100%" viewBox="0 0 606 364" preserveAspectRatio="xMidYMid slice">
				<defs>
					<mask id="<?php echo $image_id; ?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" preserveAspectRatio="xMidYMid slice">
						<path fill="white" d="M348.9,9c49.3-3.1,103.1-1.7,148.4,21.1c36.9,18.7,64.7,51.1,79.8,89.4c29.5,74.6,19,172.1-58.5,211.7
						c-47.2,24.2-103.9,23.2-155.6,24.1c-66.9,1.2-133.7-2.3-200.4-7.7c-45.3-3.7-93.2-11.4-122.2-50.6C12,258.5,5.1,200.3,22,155.8
						C69.2,31.8,238.2,15.9,348.9,9z"/>
					</mask>
				</defs>
					<image width="100%" height="100%" preserveAspectRatio="xMidYMid slice" xlink:href="<?php echo $settings['image']['url']; ?>" mask="url(#<?php echo $image_id; ?>)"></image>
				</svg>
		<?php } ?>
		<?php if ($settings['image_mask'] == 'style_2'){ ?>
			<svg id="<?php echo $svg_id; ?>" class="addonse-imagemask" width="100%" height="100%" viewBox="0 0 606 364" preserveAspectRatio="xMidYMid slice">
				<defs>
					<mask id="<?php echo $image_id; ?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" preserveAspectRatio="xMidYMid slice">
						<path fill="white" d="M256.3,9C207,5.9,153.2,7.2,107.9,30.1C71,48.8,43.2,81.2,28.1,119.5c-29.5,74.6-19,172.1,58.5,211.7
						c47.2,24.2,103.9,23.2,155.6,24.1c66.9,1.2,133.7-2.3,200.4-7.7c45.3-3.7,93.2-11.4,122.2-50.6c28.5-38.5,35.5-96.7,18.5-141.2
						C536,31.8,367.1,15.9,256.3,9z"/>
					</mask>
				</defs>
				<image width="100%" height="100%" preserveAspectRatio="xMidYMid slice" xlink:href="<?php echo $settings['image']['url']; ?>" mask="url(#<?php echo $image_id; ?>)"></image>
				</svg>
		<?php } ?>
		<?php if ($settings['image_mask'] == 'style_3'){ ?>
			<svg id="<?php echo $svg_id; ?>" class="addonse-imagemask"  width="100%" height="100%" viewBox="0 0 308 246" preserveAspectRatio="xMidYMid slice">
				<defs>
					<mask id="<?php echo $image_id; ?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" preserveAspectRatio="xMidYMid slice">
						<path fill="white" d="M145.5,243.3c-91.6,4.7-125.2-38.4-139.3-93C-18.5,55.5,48.8-12,149.5,1.8c61.2,8.4,117.4,26.1,141.9,90.3
						c13.8,36.1,24.9,74.2,3.9,112.2c-6.6,12-17.3,19.3-30.4,22.8C225.8,237.4,185.8,241.7,145.5,243.3z"/>
					</mask>
				</defs>
				<image width="100%" height="100%" preserveAspectRatio="xMidYMid slice" xlink:href="<?php echo $settings['image']['url']; ?>" mask="url(#<?php echo $image_id; ?>)"></image>
			</svg>
		<?php } ?> 
		<?php if ($settings['image_mask'] == 'style_4'){ ?>
			<svg id="<?php echo $svg_id; ?>" class="addonse-imagemask"  width="100%" height="100%" viewBox="0 0 308 246" preserveAspectRatio="xMidYMid slice">
				<defs>
					<mask id="<?php echo $image_id; ?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" preserveAspectRatio="xMidYMid slice">
						<path fill="white" d="M1.2,75.5c0.3-28.8,15.9-51.2,43.6-60c34.6-10.9,75.6-15,111.8-15.1c56.9-0.2,104.2,8.5,133.8,62.4
						c29.5,53.7,19.5,124.3-31,162.1c-41.3,30.9-106.5,21.8-152.8,7.1C35.7,209.6,0.8,148.6,1.2,75.5z"/>
					</mask>
				</defs>
				<image width="100%" height="100%" preserveAspectRatio="xMidYMid slice" xlink:href="<?php echo $settings['image']['url']; ?>" mask="url(#<?php echo $image_id; ?>)"></image>
			</svg>
		<?php } ?> 
		<?php if ($settings['image_mask'] == 'style_5'){ ?>
			<svg id="<?php echo $svg_id; ?>" class="addonse-imagemask"  width="100%" height="100%" viewBox="0 0 307 246" preserveAspectRatio="xMidYMid slice">
				<defs>
					<mask id="<?php echo $image_id; ?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" preserveAspectRatio="xMidYMid slice">
						<path  fill="white" d="M0.1,171.7C-4.3,103,25,42.6,92.6,16.3c76.2-29.7,184.3-27.4,210.3,66.5c18.5,66.7-22,153.4-95.4,161.4
						c-44.2,4.8-92.5,2.1-136-6.2c-19.9-3.8-41.3-7.1-56-22.4C1.5,201.1,1.1,188.9,0.1,171.7z"/>
					</mask>
				</defs>
				<image width="100%" height="100%" preserveAspectRatio="xMidYMid slice" xlink:href="<?php echo $settings['image']['url']; ?>" mask="url(#<?php echo $image_id; ?>)"></image>
			</svg>
		<?php } ?> 
		<?php if ($settings['image_mask'] == 'style_6'){ ?>
			<svg id="<?php echo $svg_id; ?>" class="addonse-imagemask" width="100%" height="100%" viewBox="0 0 1100.6 1209.8" preserveAspectRatio="xMidYMid slice">
				<mask id="<?php echo $image_id; ?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" preserveAspectRatio="xMidYMid slice">
					<path fill="white" d="M6.6,568.5l246.1-466.9c8.5-16.2,24.3-27.3,42.4-29.9L789.3,0.6c21.3-3.1,42.5,6.1,54.9,23.7L1090.2,374
					c9.3,13.2,12.6,29.7,9,45.5l-132.2,586c-4.4,19.7-19,35.6-38.2,41.8L433.9,1207c-24.7,8-51.6-1.7-65.6-23.5L9.1,626.1
					C-2.1,608.8-3,586.7,6.6,568.5z"/>
				</mask>
				<image width="100%" height="100%"  xlink:href="<?php echo $settings['image']['url']; ?>" preserveAspectRatio="xMidYMid slice" mask="url(#<?php echo $image_id; ?>)"></image>
			</svg>
		<?php } ?> 
		<?php if ($settings['image_mask'] == 'style_7'){ ?>
			<svg id="<?php echo $svg_id; ?>" class="addonse-imagemask" width="100%" height="100%" viewBox="0 0 1096.7 1224.4" preserveAspectRatio="xMidYMid slice">
				<mask id="<?php echo $image_id; ?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" preserveAspectRatio="xMidYMid slice">
					<path fill="white" d="M21,488.7c99.3-81,453.4-370.3,582.5-475.8c25.7-21,63.8-15.8,82.9,11.3l399.8,566.4
					c12.1,17.1,13.8,39.5,4.5,58.3l-222.2,449.3c-8.3,16.8-24.4,28.5-43,31.2l-643.9,94.3c-30.5,4.5-59-16-64.5-46.3L0.9,543.3
					C-2.8,522.8,4.9,501.8,21,488.7z"/>
				</mask>
				<image width="100%" height="100%"  xlink:href="<?php echo $settings['image']['url']; ?>" preserveAspectRatio="xMidYMid slice" mask="url(#<?php echo $image_id; ?>)"></image>
			</svg>
		<?php } ?>        
		<?php if ($settings['image_mask'] == 'style_8'){ ?>
			<svg id="<?php echo $svg_id; ?>" class="addonse-imagemask" width="100%" height="100%" viewBox="0 0 1094.1 1142.1" preserveAspectRatio="xMidYMid slice">
				<mask id="<?php echo $image_id; ?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" preserveAspectRatio="xMidYMid slice">
					<g>
					<path fill="white" class="st0" d="M427.4,65.5L810.2,0.8c23.1-3.9,46.3,6.7,58.5,26.8l190.5,315c19.4,32,3.3,73.7-32.6,84.4L658.3,537
						c-25.5,7.6-52.9-3.4-66.1-26.5l-205-360.4C367.6,115.6,388.2,72.1,427.4,65.5z"/>
					<path fill="white" class="st0" d="M640.1,604.9l381.4-134.2c25.6-7.2,52.8,4.3,65.5,27.6v0c8.2,15,9.3,33,2.9,48.9l-225.8,559.2
						c-10.3,25.4-37.2,40-64.1,34.7l-410.9-80.9c-40-7.9-59.2-53.9-36.5-87.8l255.2-344.1C615.5,616.8,626.9,608.6,640.1,604.9z"/>
					<path fill="white" class="st0" d="M321.4,173.1l234.5,371.7c12.5,19.7,11.7,45.1-2,64L308.6,948.5c-25,34.6-77.6,30.7-97.2-7.2L6.4,544.2
						c-9.7-18.7-8.3-41.2,3.7-58.6l215.8-314.4C249.1,137.3,299.5,138.3,321.4,173.1z"/>
					</g>
				</mask>	
				<image width="100%" height="100%"  xlink:href="<?php echo $settings['image']['url']; ?>" preserveAspectRatio="xMidYMid slice" mask="url(#<?php echo $image_id; ?>)"></image>
			</svg>
		<?php } 
	}
}