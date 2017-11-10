<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Module Name: Contact
 */
class TB_Contact_Module extends Themify_Builder_Module {
	function __construct() {
		parent::__construct(array(
			'name' => __('Contact', 'builder-contact'),
			'slug' => 'contact'
		));
	}

	function get_assets() {
		$instance = Builder_Contact::get_instance();
		return array(
			'selector' => '.module-contact',
			'css' => themify_enque($instance->url . 'assets/style.css'),
			'js' => themify_enque($instance->url . 'assets/scripts.js'),
			'external' => Themify_Builder_Model::localize_js( 'BuilderContact', array(
				'admin_url' => admin_url( 'admin-ajax.php' )
			) ),
			'ver' => $instance->version,
		);
	}

	public function get_options() {
		return array(
			array(
				'id' => 'mod_title_contact',
				'type' => 'text',
				'label' => __('Module Title', 'builder-contact'),
				'class' => 'large',
				'render_callback' => array(
					'binding' => 'live'
				)
			),
			array(
				'id' => 'layout_contact',
				'type' => 'layout',
				'label' => __('Layout', 'builder-contact'),
				'options' => array(
					array('img' => Builder_Contact::get_instance()->url . 'assets/style1.png', 'value' => 'style1', 'label' => __('Style 1', 'builder-contact')),
					array('img' => Builder_Contact::get_instance()->url . 'assets/style2.png', 'value' => 'style2', 'label' => __('Style 2', 'builder-contact')),
					array('img' => Builder_Contact::get_instance()->url . 'assets/style3.png', 'value' => 'style3', 'label' => __('Style 3', 'builder-contact')),
					array('img' => Builder_Contact::get_instance()->url . 'assets/style4.png', 'value' => 'animated-label', 'label' => __('Animated Label', 'builder-contact')),
				),
				'render_callback' => array(
					'binding' => 'live'
				)
			),
			array(
				'id' => 'mail_contact',
				'type' => 'text',
				'label' => __('Send to', 'builder-contact'),
				'class' => 'large',
				'after' => '<br><small>' . __( 'To send the form to multiple recipients, comma-separate the mail addresses.', 'builder-contact' ) . '</small>',
				'render_callback' => array(
					'binding' => 'live'
				),
				'required' => array(
					'rule' => 'email',
					'message' => esc_html__( 'Please enter valid email address.', 'builder-contact' )
				)
			),
			array(
				'id' => 'default_subject',
				'type' => 'text',
				'label' => __( 'Default Subject', 'builder-contact' ),
				'class' => 'large',
				'after' => '<br><small>' . __( 'This will be used as the subject of the mail if the Subject field is not shown on the contact form.', 'builder-contact' ) . '</small>',
				'render_callback' => array(
					'binding' => 'live'
				)
			),
			array(
				'id' => 'fields_contact',
				'type' => 'contact_fields',
				'class' => 'large',
				'render_callback' => array(
					'binding' => 'live',
					'control_type' => 'fields_contact'
				)
			)
                        ,
			// Additional CSS
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr/>')
			),
			array(
				'id' => 'css_class_contact',
				'type' => 'text',
				'label' => __('Additional CSS Class', 'builder-contact'),
				'class' => 'large exclude-from-reset-field',
				'help' => sprintf( '<br/><small>%s</small>', __('Add additional CSS class(es) for custom styling', 'builder-contact') ),
				'render_callback' => array(
					'binding' => 'live'
				)
			)
		);
	}

	public function get_default_settings() {
		return array(
			'field_name_label' => esc_html__( 'Your Name', 'builder-contact' ),
			'field_email_label' => esc_html__( 'Your Email', 'builder-contact' ),
			'field_subject_label' => esc_html__( 'Subject', 'builder-contact' ),
			'field_subject_active' => 'yes',
			'field_message_label' => esc_html__( 'Message', 'builder-contact' ),
			'field_sendcopy_label' => __( 'Send a copy to myself', 'builder-contact' ),
			'field_send_label' => esc_html__( 'Send', 'builder-contact' ),
		);
	}

	public function get_animation() {
		$animation = array(
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . esc_html__( 'Appearance Animation', 'themify' ) . '</h4>')
			),
			array(
				'id' => 'animation_effect',
				'type' => 'animation_select',
				'label' => __( 'Effect', 'themify' )
			),
			array(
				'id' => 'animation_effect_delay',
				'type' => 'text',
				'label' => __( 'Delay', 'themify' ),
				'class' => 'xsmall',
				'description' => __( 'Delay (s)', 'themify' ),
			),
			array(
				'id' => 'animation_effect_repeat',
				'type' => 'text',
				'label' => __( 'Repeat', 'themify' ),
				'class' => 'xsmall',
				'description' => __( 'Repeat (x)', 'themify' ),
			),
		);

		return $animation;
	}

	public function get_styling() {
		$general = array(
			array(
				'id' => 'separator_image_background',
				'title' => '',
				'description' => '',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Background', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'background_color',
				'type' => 'color',
				'label' => __('Background Color', 'builder-contact'),
				'class' => 'small',
				'prop' => 'background-color',
				'selector' => '.module-contact'
			),
			// Font
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Font', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'font_family',
				'type' => 'font_select',
				'label' => __('Font Family', 'builder-contact'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => array( '.module-contact' )
			),
			array(
				'id' => 'font_color',
				'type' => 'color',
				'label' => __('Font Color', 'builder-contact'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => array( '.module-contact' )
			),
			array(
				'id' => 'multi_font_size',
				'type' => 'multi',
				'label' => __('Font Size', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'font_size',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'font_size_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => 'em', 'name' => __('em', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact')),
						)
					)
				)
			),
			array(
				'id' => 'multi_line_height',
				'type' => 'multi',
				'label' => __('Line Height', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'line_height',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'line-height',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'line_height_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => '', 'name' => ''),
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => 'em', 'name' => __('em', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					)
				)
			),
			array(
				'id' => 'text_align',
				'label' => __( 'Text Align', 'builder-contact' ),
				'type' => 'radio',
				'meta' => array(
					array( 'value' => '', 'name' => __( 'Default', 'builder-contact' ), 'selected' => true ),
					array( 'value' => 'left', 'name' => __( 'Left', 'builder-contact' ) ),
					array( 'value' => 'center', 'name' => __( 'Center', 'builder-contact' ) ),
					array( 'value' => 'right', 'name' => __( 'Right', 'builder-contact' ) ),
					array( 'value' => 'justify', 'name' => __( 'Justify', 'builder-contact' ) )
				),
				'prop' => 'text-align',
				'selector' => '.module-contact'
			),
			// Padding
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_padding',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Padding', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'multi_padding_top',
				'type' => 'multi',
				'label' => __('Padding', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'padding_top',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'padding-top',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'padding_top_unit',
						'type' => 'select',
						'description' => __('top', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_right',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_right',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'padding-right',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'padding_right_unit',
						'type' => 'select',
						'description' => __('right', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_bottom',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_bottom',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'padding-bottom',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'padding_bottom_unit',
						'type' => 'select',
						'description' => __('bottom', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_left',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_left',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'padding-left',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'padding_left_unit',
						'type' => 'select',
						'description' => __('left', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			// "Apply all" // apply all padding
			array(
				'id' => 'checkbox_padding_apply_all',
				'class' => 'style_apply_all style_apply_all_padding',
				'type' => 'checkbox',
				'label' => false,
				'options' => array(
					array( 'name' => 'padding', 'value' => __( 'Apply to all padding', 'builder-contact' ) )
				)
			),
			// Margin
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_margin',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Margin', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'multi_margin_top',
				'type' => 'multi',
				'label' => __('Margin', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'margin_top',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'margin-top',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'margin_top_unit',
						'type' => 'select',
						'description' => __('top', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_right',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_right',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'margin-right',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'margin_right_unit',
						'type' => 'select',
						'description' => __('right', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_bottom',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_bottom',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'margin-bottom',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'margin_bottom_unit',
						'type' => 'select',
						'description' => __('bottom', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_left',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_left',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'margin-left',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'margin_left_unit',
						'type' => 'select',
						'description' => __('left', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			// "Apply all" // apply all margin
			array(
				'id' => 'checkbox_margin_apply_all',
				'class' => 'style_apply_all style_apply_all_margin',
				'type' => 'checkbox',
				'label' => false,
				'options' => array(
					array( 'name' => 'margin', 'value' => __( 'Apply to all margin', 'builder-contact' ) )
				)
			),
			// Border
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_border',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Border', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'multi_border_top',
				'type' => 'multi',
				'label' => __('Border', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'border_top_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-top-color',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'border_top_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-top-width',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'border_top_style',
						'type' => 'select',
						'description' => __('top', 'builder-contact'),
						'meta' => Themify_Builder_model::get_border_styles(),
						'prop' => 'border-top-style',
						'selector' => '.module-contact'
					)
				)
			),
			array(
				'id' => 'multi_border_right',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_right_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-right-color',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'border_right_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-right-width',
						'selector' => '.module-contact',
					),
					array(
						'id' => 'border_right_style',
						'type' => 'select',
						'description' => __('right', 'builder-contact'),
						'meta' => Themify_Builder_model::get_border_styles(),
						'prop' => 'border-right-style',
						'selector' => '.module-contact'
					)
				)
			),
			array(
				'id' => 'multi_border_bottom',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_bottom_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-bottom-color',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'border_bottom_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-bottom-width',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'border_bottom_style',
						'type' => 'select',
						'description' => __('bottom', 'builder-contact'),
						'meta' => Themify_Builder_model::get_border_styles(),
						'prop' => 'border-bottom-style',
						'selector' => '.module-contact'
					)
				)
			),
			array(
				'id' => 'multi_border_left',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_left_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-left-color',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'border_left_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-left-width',
						'selector' => '.module-contact'
					),
					array(
						'id' => 'border_left_style',
						'type' => 'select',
						'description' => __('left', 'builder-contact'),
						'meta' => Themify_Builder_model::get_border_styles(),
						'prop' => 'border-left-style',
						'selector' => '.module-contact'
					)
				)
			),
			// "Apply all" // apply all border
			array(
				'id' => 'checkbox_border_apply_all',
				'class' => 'style_apply_all style_apply_all_border',
				'type' => 'checkbox',
				'label' => false,
				'default'=>'border',
				'options' => array(
					array( 'name' => 'border', 'value' => __( 'Apply to all border', 'builder-contact' ) )
				)
			),
		);

		$labels = array(
			// Font
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Font', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'font_family_labels',
				'type' => 'font_select',
				'label' => __('Font Family', 'builder-contact'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => array( '.module-contact .control-label' )
			),
			array(
				'id' => 'font_color_labels',
				'type' => 'color',
				'label' => __('Font Color', 'builder-contact'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => array( '.module-contact .control-label' )
			),
			array(
				'id' => 'multi_font_size_labels',
				'type' => 'multi',
				'label' => __('Font Size', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'font_size_labels',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => '.module-contact .control-label'
					),
					array(
						'id' => 'font_size_labels_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => 'em', 'name' => __('em', 'builder-contact'))
						)
					)
				)
			),
		);

		$inputs = array(
			array(
				'id' => 'background_color_inputs',
				'type' => 'color',
				'label' => __('Background Color', 'builder-contact'),
				'class' => 'small',
				'prop' => 'background-color',
				'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
			),
			// Font
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_inputs',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Font', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'font_family_inputs',
				'type' => 'font_select',
				'label' => __('Font Family', 'builder-contact'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
			),
			array(
				'id' => 'font_color_inputs',
				'type' => 'color',
				'label' => __('Font Color', 'builder-contact'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
			),
			array(
				'id' => 'multi_font_size_inputs',
				'type' => 'multi',
				'label' => __('Font Size', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'font_size_inputs',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					),
					array(
						'id' => 'font_size_inputs_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => 'em', 'name' => __('em', 'builder-contact'))
						)
					)
				)
			),
			// Border
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_border_inputs',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Border', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'multi_border_top_inputs',
				'type' => 'multi',
				'label' => __('Border', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'border_top_inputs_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-top-color',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					),
					array(
						'id' => 'border_top_inputs_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-top-width',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					),
					array(
						'id' => 'border_top_inputs_style',
						'type' => 'select',
						'description' => __('top', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-top-style',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					)
				)
			),
			array(
				'id' => 'multi_border_right_inputs',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_right_inputs_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-right-color',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					),
					array(
						'id' => 'border_right_inputs_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-right-width',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					),
					array(
						'id' => 'border_right_inputs_style',
						'type' => 'select',
						'description' => __('right', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-right-style',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					)
				)
			),
			array(
				'id' => 'multi_border_bottom_inputs',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_bottom_inputs_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-bottom-color',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					),
					array(
						'id' => 'border_bottom_inputs_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-bottom-width',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					),
					array(
						'id' => 'border_bottom_inputs_style',
						'type' => 'select',
						'description' => __('bottom', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-bottom-style',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					)
				)
			),
			array(
				'id' => 'multi_border_left_inputs',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_left_inputs_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-left-color',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					),
					array(
						'id' => 'border_left_inputs_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-left-width',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					),
					array(
						'id' => 'border_left_inputs_style',
						'type' => 'select',
						'description' => __('left', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-left-style',
						'selector' => array( '.module-contact input[type="text"]', '.module-contact textarea' )
					)
				)
			),
		);

		$send_button = array(
			array(
				'id' => 'background_color_send',
				'type' => 'color',
				'label' => __('Background Color', 'builder-contact'),
				'class' => 'small',
				'prop' => 'background-color',
				'selector' => array( '.module-contact .builder-contact-field-send button' )
			),
			// Font
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_send',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Font', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'font_family_send',
				'type' => 'font_select',
				'label' => __('Font Family', 'builder-contact'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => array( '.module-contact .builder-contact-field-send button' )
			),
			array(
				'id' => 'font_color_send',
				'type' => 'color',
				'label' => __('Font Color', 'builder-contact'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => array( '.module-contact .builder-contact-field-send button' )
			),
			array(
				'id' => 'multi_font_size_send',
				'type' => 'multi',
				'label' => __('Font Size', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'font_size_send',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					),
					array(
						'id' => 'font_size_send_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => 'em', 'name' => __('em', 'builder-contact'))
						)
					)
				)
			),
			// Border
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_border_send',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Border', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'multi_border_top_send',
				'type' => 'multi',
				'label' => __('Border', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'border_top_send_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-top-color',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					),
					array(
						'id' => 'border_top_send_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-top-width',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					),
					array(
						'id' => 'border_top_send_style',
						'type' => 'select',
						'description' => __('top', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-top-style',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					)
				)
			),
			array(
				'id' => 'multi_border_right_send',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_right_send_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-right-color',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					),
					array(
						'id' => 'border_right_send_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-right-width',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					),
					array(
						'id' => 'border_right_send_style',
						'type' => 'select',
						'description' => __('right', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-right-style',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					)
				)
			),
			array(
				'id' => 'multi_border_bottom_send',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_bottom_send_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-bottom-color',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					),
					array(
						'id' => 'border_bottom_send_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-bottom-width',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					),
					array(
						'id' => 'border_bottom_send_style',
						'type' => 'select',
						'description' => __('bottom', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-bottom-style',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					)
				)
			),
			array(
				'id' => 'multi_border_left_send',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_left_send_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-left-color',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					),
					array(
						'id' => 'border_left_send_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-left-width',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					),
					array(
						'id' => 'border_left_send_style',
						'type' => 'select',
						'description' => __('left', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-left-style',
						'selector' => array( '.module-contact .builder-contact-field-send button' )
					)
				)
			),
		);

		$success_message = array(
			array(
				'id' => 'separator_success',
				'title' => '',
				'description' => '',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Background', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'background_color_success_message',
				'type' => 'color',
				'label' => __('Background Color', 'builder-contact'),
				'class' => 'small',
				'prop' => 'background-color',
				'selector' => '.module-contact .contact-success'
			),
			// Font
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Font', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'font_family_success_message',
				'type' => 'font_select',
				'label' => __('Font Family', 'builder-contact'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => array( '.module-contact .contact-success' )
			),
			array(
				'id' => 'font_color_success_message',
				'type' => 'color',
				'label' => __('Font Color', 'builder-contact'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => array( '.module-contact .contact-success' )
			),
			array(
				'id' => 'multi_font_size_success_message',
				'type' => 'multi',
				'label' => __('Font Size', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'font_size_success_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'font_size_success_message_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => '', 'name' => ''),
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => 'em', 'name' => __('em', 'builder-contact'))
						)
					)
				)
			),
			array(
				'id' => 'multi_line_height_success_message',
				'type' => 'multi',
				'label' => __('Line Height', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'line_height_success_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'line-height',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'line_height_success_message_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => '', 'name' => ''),
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => 'em', 'name' => __('em', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					)
				)
			),
			array(
				'id' => 'text_align_success_message',
				'label' => __( 'Text Align', 'builder-contact' ),
				'type' => 'radio',
				'meta' => array(
					array( 'value' => '', 'name' => __( 'Default', 'builder-contact' ), 'selected' => true ),
					array( 'value' => 'left', 'name' => __( 'Left', 'builder-contact' ) ),
					array( 'value' => 'center', 'name' => __( 'Center', 'builder-contact' ) ),
					array( 'value' => 'right', 'name' => __( 'Right', 'builder-contact' ) ),
					array( 'value' => 'justify', 'name' => __( 'Justify', 'builder-contact' ) )
				),
				'prop' => 'text-align',
				'selector' => '.module-contact .contact-success'
			),
			// Padding
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_padding_success_message',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Padding', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'multi_padding_top_success_message',
				'type' => 'multi',
				'label' => __('Padding', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'padding_top_success_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'padding-top',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'padding_top_success_message_unit',
						'type' => 'select',
						'description' => __('top', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_right_success_message',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_right_success_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'padding-right',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'padding_right_success_message_unit',
						'type' => 'select',
						'description' => __('right', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_bottom_success_message',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_bottom_success_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'padding-bottom',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'padding_bottom_success_message_unit',
						'type' => 'select',
						'description' => __('bottom', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_left_success_message',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_success_message_left',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'padding-left',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'padding_left_success_message_unit',
						'type' => 'select',
						'description' => __('left', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			// Margin
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_margin_success_message',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Margin', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'multi_margin_top_success_message',
				'type' => 'multi',
				'label' => __('Margin', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'margin_top_success_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'margin-top',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'margin_top_success_message_unit',
						'type' => 'select',
						'description' => __('top', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_right_success_message',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_right_success_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'margin-right',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'margin_right_success_message_unit',
						'type' => 'select',
						'description' => __('right', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_bottom_success_message',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_bottom_success_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'margin-bottom',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'margin_bottom_success_message_unit',
						'type' => 'select',
						'description' => __('bottom', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_left_success_message',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_left_success_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'margin-left',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'margin_left_success_message_unit',
						'type' => 'select',
						'description' => __('left', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			// Border
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_border_success_message',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Border', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'multi_border_top_success_message',
				'type' => 'multi',
				'label' => __('Border', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'border_top_success_message_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-top-color',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'border_top_success_message_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-top-width',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'border_top_success_message_style',
						'type' => 'select',
						'description' => __('top', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-top-style',
						'selector' => '.module-contact .contact-success'
					)
				)
			),
			array(
				'id' => 'multi_border_right',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_right_success_message_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-right-color',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'border_right_success_message_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-right-width',
						'selector' => '.module-contact .contact-success',
					),
					array(
						'id' => 'border_right_success_message_style',
						'type' => 'select',
						'description' => __('right', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-right-style',
						'selector' => '.module-contact .contact-success'
					)
				)
			),
			array(
				'id' => 'multi_border_bottom',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_bottom_success_message_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-bottom-color',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'border_bottom_success_message_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-bottom-width',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'border_bottom_success_message_style',
						'type' => 'select',
						'description' => __('bottom', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-bottom-style',
						'selector' => '.module-contact .contact-success'
					)
				)
			),
			array(
				'id' => 'multi_border_left',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_left_success_message_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-left-color',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'border_left_success_message_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-left-width',
						'selector' => '.module-contact .contact-success'
					),
					array(
						'id' => 'border_left_success_message_style',
						'type' => 'select',
						'description' => __('left', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-left-style',
						'selector' => '.module-contact .contact-success'
					)
				)
			),
		);

		$error_message = array(
			array(
				'id' => 'separator_success',
				'title' => '',
				'description' => '',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Background', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'background_color_error_message',
				'type' => 'color',
				'label' => __('Background Color', 'builder-contact'),
				'class' => 'small',
				'prop' => 'background-color',
				'selector' => '.module-contact .contact-error'
			),
			// Font
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Font', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'font_family_error_message',
				'type' => 'font_select',
				'label' => __('Font Family', 'builder-contact'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => array( '.module-contact .contact-error' )
			),
			array(
				'id' => 'font_color_error_message',
				'type' => 'color',
				'label' => __('Font Color', 'builder-contact'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => array( '.module-contact .contact-error' )
			),
			array(
				'id' => 'multi_font_size_error_message',
				'type' => 'multi',
				'label' => __('Font Size', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'font_size_error_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'font_size_error_message_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => '', 'name' => ''),
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => 'em', 'name' => __('em', 'builder-contact'))
						)
					)
				)
			),
			array(
				'id' => 'multi_line_height_error_message',
				'type' => 'multi',
				'label' => __('Line Height', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'line_height_error_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'line-height',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'line_height_error_message_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => '', 'name' => ''),
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => 'em', 'name' => __('em', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					)
				)
			),
			array(
				'id' => 'text_align_error_message',
				'label' => __( 'Text Align', 'builder-contact' ),
				'type' => 'radio',
				'meta' => array(
					array( 'value' => '', 'name' => __( 'Default', 'builder-contact' ), 'selected' => true ),
					array( 'value' => 'left', 'name' => __( 'Left', 'builder-contact' ) ),
					array( 'value' => 'center', 'name' => __( 'Center', 'builder-contact' ) ),
					array( 'value' => 'right', 'name' => __( 'Right', 'builder-contact' ) ),
					array( 'value' => 'justify', 'name' => __( 'Justify', 'builder-contact' ) )
				),
				'prop' => 'text-align',
				'selector' => '.module-contact .contact-error'
			),
			// Padding
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_padding_error_message',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Padding', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'multi_padding_top_error_message',
				'type' => 'multi',
				'label' => __('Padding', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'padding_top_error_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'padding-top',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'padding_top_error_message_unit',
						'type' => 'select',
						'description' => __('top', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_right_error_message',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_right_error_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'padding-right',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'padding_right_error_message_unit',
						'type' => 'select',
						'description' => __('right', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_bottom_error_message',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_bottom_error_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'padding-bottom',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'padding_bottom_error_message_unit',
						'type' => 'select',
						'description' => __('bottom', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_left_error_message',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_error_message_left',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'padding-left',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'padding_left_error_message_unit',
						'type' => 'select',
						'description' => __('left', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			// Margin
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_margin_error_message',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Margin', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'multi_margin_top_error_message',
				'type' => 'multi',
				'label' => __('Margin', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'margin_top_error_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'margin-top',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'margin_top_error_message_unit',
						'type' => 'select',
						'description' => __('top', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_right_error_message',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_right_error_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'margin-right',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'margin_right_error_message_unit',
						'type' => 'select',
						'description' => __('right', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_bottom_error_message',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_bottom_error_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'margin-bottom',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'margin_bottom_error_message_unit',
						'type' => 'select',
						'description' => __('bottom', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_left_error_message',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_left_error_message',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'margin-left',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'margin_left_error_message_unit',
						'type' => 'select',
						'description' => __('left', 'builder-contact'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'builder-contact')),
							array('value' => '%', 'name' => __('%', 'builder-contact'))
						)
					),
				)
			),
			// Border
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_border_error_message',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Border', 'builder-contact').'</h4>'),
			),
			array(
				'id' => 'multi_border_top_error_message',
				'type' => 'multi',
				'label' => __('Border', 'builder-contact'),
				'fields' => array(
					array(
						'id' => 'border_top_error_message_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-top-color',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'border_top_error_message_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-top-width',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'border_top_error_message_style',
						'type' => 'select',
						'description' => __('top', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-top-style',
						'selector' => '.module-contact .contact-error'
					)
				)
			),
			array(
				'id' => 'multi_border_right',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_right_error_message_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-right-color',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'border_right_error_message_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-right-width',
						'selector' => '.module-contact .contact-error',
					),
					array(
						'id' => 'border_right_error_message_style',
						'type' => 'select',
						'description' => __('right', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-right-style',
						'selector' => '.module-contact .contact-error'
					)
				)
			),
			array(
				'id' => 'multi_border_bottom',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_bottom_error_message_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-bottom-color',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'border_bottom_error_message_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-bottom-width',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'border_bottom_error_message_style',
						'type' => 'select',
						'description' => __('bottom', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-bottom-style',
						'selector' => '.module-contact .contact-error'
					)
				)
			),
			array(
				'id' => 'multi_border_left',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_left_error_message_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-left-color',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'border_left_error_message_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-left-width',
						'selector' => '.module-contact .contact-error'
					),
					array(
						'id' => 'border_left_error_message_style',
						'type' => 'select',
						'description' => __('left', 'builder-contact'),
						'meta' => array(
							array( 'value' => '', 'name' => '' ),
							array( 'value' => 'solid', 'name' => __( 'Solid', 'builder-contact' ) ),
							array( 'value' => 'dashed', 'name' => __( 'Dashed', 'builder-contact' ) ),
							array( 'value' => 'dotted', 'name' => __( 'Dotted', 'builder-contact' ) ),
							array( 'value' => 'double', 'name' => __( 'Double', 'builder-contact' ) )
						),
						'prop' => 'border-left-style',
						'selector' => '.module-contact .contact-error'
					)
				)
			),
		);

		return array(
			array(
				'type' => 'tabs',
				'id' => 'module-styling',
				'tabs' => array(
					'general' => array(
						'label' => __('General', 'themify'),
						'fields' => $general
					),
					'labels' => array(
						'label' => __('Field Labels', 'themify'),
						'fields' => $labels
					),
					'inputs' => array(
						'label' => __('Input Fields', 'themify'),
						'fields' => $inputs
					),
					'send_button' => array(
						'label' => __('Send Button', 'themify'),
						'fields' => $send_button
					),
					'success_message' => array(
						'label' => __('Success Message', 'themify'),
						'fields' => $success_message
					),
					'error_message' => array(
						'label' => __('Error Message', 'themify'),
						'fields' => $error_message
					),
				)
			),
		);

	}

	protected function _visual_template() {
		$module_args = $this->get_module_args();?>
		<div class="module module-<?php echo esc_attr( $this->slug ); ?> {{ data.css_class_contact }} <# data.layout_contact ? print('contact-' + data.layout_contact) : ''; #>">
			<# if( data.mod_title_contact ) { #>
				<?php echo $module_args['before_title']; ?>
				{{{ data.mod_title_contact }}}
				<?php echo $module_args['after_title']; ?>
			<# } #>

			<?php do_action( 'themify_builder_before_template_content_render' ); ?>

			<form class="builder-contact" method="post">
				<div class="contact-message"></div>

				<div class="builder-contact-fields">
					<div class="builder-contact-field builder-contact-field-name">
						<label class="control-label"><# data.field_name_label != '' ? print(data.field_name_label) : print('Name') #> <# if( data.field_name_label != '' ) { #><span class="required">*</span><# } #></label>
						<div class="control-input">
							<input type="text" name="contact-name" placeholder="{{{ data.field_name_placeholder }}}" value="" class="form-control" required />
						</div>
					</div>

					<div class="builder-contact-field builder-contact-field-email">
						<label class="control-label"><# data.field_email_label != '' ? print(data.field_email_label) : print('Email') #> <# if( data.field_email_label != '' ) { #><span class="required">*</span><# } #></label>
						<div class="control-input">
							<input type="text" name="contact-email" placeholder="{{{ data.field_email_placeholder }}}" value="" class="form-control" required />
						</div>
					</div>

					<# if( data.field_subject_active == 'yes' ) { #>
					<div class="builder-contact-field builder-contact-field-subject">
						<label class="control-label"><# data.field_subject_label != '' ? print(data.field_subject_label) : print('Subject') #></label>
						<div class="control-input">
							<input type="text" name="contact-subject" placeholder="{{{ data.field_subject_placeholder }}}" value="" class="form-control" />
						</div>
					</div>
					<# } #>

					<div class="builder-contact-field builder-contact-field-message">
						<label class="control-label"><# data.field_message_label != '' ? print(data.field_message_label) : print('Message') #> <# if( data.field_message_label != '' ) { #><span class="required">*</span><# } #></label>
						<div class="control-input">
							<textarea name="contact-message" placeholder="{{{ data.field_message_placeholder }}}" rows="8" cols="45" class="form-control" required></textarea>
						</div>
					</div>

					<# if( data.field_sendcopy_active ) { #>
					<div class="builder-contact-field builder-contact-field-sendcopy">
						<div class="control-label">
							<div class="control-input checkbox">
								<label class="send-copy">
									<input type="checkbox" name="send-copy" value="1" /> <# data.field_sendcopy_label != '' ? print(data.field_sendcopy_label) : print('Send a copy to myself') #>
								</label>
							</div>
						</div>
					</div>
					<# } #>
					
					<# if( data.field_captcha_active == 'yes' ) { #>
						<div class="builder-contact-field builder-contact-field-captcha">
							<label class="control-label">{{{ data.field_captcha_label }}} <span class="required">*</span></label>
							<div class="control-input">
								 <div class="g-recaptcha" data-sitekey="<?php echo esc_attr( Builder_Contact::get_instance()->get_option( 'recapthca_public_key' ) ); ?>"></div>
							</div>
						</div>
					<# } #>

					<div class="builder-contact-field builder-contact-field-send">
						<div class="control-input">
							<button type="submit" class="btn btn-primary"> <i class="fa fa-cog fa-spin"></i> <# if( data.field_send_label != '' ) { #> {{{ data.field_send_label }}} <# }else{ #> Send <# } #></button>
						</div>
					</div>
				</div>
			</form>

			<?php do_action( 'themify_builder_after_template_content_render' ); ?>
		</div>
	<?php
	}
}

function themify_builder_field_contact_fields( $field, $mod_name ) {
	?>
	<div class="themify_builder_field builder_contact_fields">
		<div class="themify_builder_input">
		<table class="contact_fields">
		<thead>
			<tr>
				<th><?php _e( 'Field', 'builder-contact' ); ?></th>
				<th><?php _e( 'Label', 'builder-contact' ); ?></th>
				<th><?php _e( 'Placeholder', 'builder-contact' ); ?></th>
				<th><?php _e( 'Show', 'builder-contact' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php _e( 'Name', 'builder-contact' ) ?></td>
				<td><input type="text" id="field_name_label" name="field_name_label" value="" class="tfb_lb_option large" placeholder="<?php _e( 'Name', 'builder-contact' ) ?>" data-control-binding="live" data-control-type="text" /></td>
				<td><input type="text" id="field_name_placeholder" name="field_name_placeholder" value="" class="tfb_lb_option large" placeholder="<?php _e( 'Placeholder', 'builder-contact' ) ?>" data-control-binding="live" data-control-type="text" /></td>
				<td></td>
			</tr>
			<tr>
				<td><?php _e( 'Email', 'builder-contact' ) ?></td>
				<td><input type="text" id="field_email_label" name="field_email_label" value="" class="tfb_lb_option large" placeholder="<?php _e( 'Email', 'builder-contact' ) ?>" data-control-binding="live" data-control-type="text" /></td>
				<td><input type="text" id="field_email_placeholder" name="field_email_placeholder" value="" class="tfb_lb_option large" placeholder="<?php _e( 'Placeholder', 'builder-contact' ) ?>" data-control-binding="live" data-control-type="text" /></td>
				<td></td>
			</tr>
			<tr>
				<td><?php _e( 'Subject', 'builder-contact' ) ?></td>
				<td><input type="text" id="field_subject_label" name="field_subject_label" value="" class="tfb_lb_option large" placeholder="<?php _e( 'Subject', 'builder-contact' ) ?>" data-control-binding="live" data-control-type="text" /></td>
				<td><input type="text" id="field_subject_placeholder" name="field_subject_placeholder" value="" class="tfb_lb_option large" placeholder="<?php _e( 'Placeholder', 'builder-contact' ) ?>" data-control-binding="live" data-control-type="text" /></td>
				<td class="tfb_lb_option themify-checkbox" id="field_subject_active" data-control-binding="live" data-control-type="checkbox"><input type="checkbox" name="field_subject_active" value="yes" class="tf-checkbox" /></td>
			</tr>
			<tr>
				<td><?php _e( 'Captcha', 'builder-contact' ) ?></td>
				<td><input type="text" id="field_captcha_label" name="field_captcha_label" value="" class="tfb_lb_option large" placeholder="<?php _e( 'Captcha', 'builder-contact' ) ?>" data-control-binding="live" data-control-type="text" />
				<p class="description"><?php printf( __( 'Requires Captcha keys entered at: <a href="%s">reCAPTCHA settings</a>.', 'builder-contact' ), admin_url( 'admin.php?page=builder-contact' ) ); ?></p>
				</td>
				<td></td>
				<td class="tfb_lb_option themify-checkbox" id="field_captcha_active" data-control-binding="live" data-control-type="checkbox"><input type="checkbox" name="field_captcha_active" value="yes" class="tf-checkbox" /></td>
			</tr>
			<tr>
				<td><?php _e( 'Message', 'builder-contact' ) ?></td>
				<td><input type="text" id="field_message_label" name="field_message_label" value="" class="tfb_lb_option large" placeholder="<?php _e( 'Message', 'builder-contact' ) ?>" data-control-binding="live" data-control-type="text" /></td>
				<td><input type="text" id="field_message_placeholder" name="field_message_placeholder" value="" class="tfb_lb_option large" placeholder="<?php _e( 'Placeholder', 'builder-contact' ) ?>" data-control-binding="live" data-control-type="text" /></td>
				<td class=""></td>
			</tr>
			<tr>
				<td><?php _e( 'Send Copy', 'builder-contact' ) ?></td>
				<td><input type="text" id="field_sendcopy_label" name="field_sendcopy_label" value="" class="tfb_lb_option large" placeholder="<?php _e( 'Send Copy', 'builder-contact' ) ?>" data-control-binding="live" data-control-type="text" /></td>
				<td></td>
				<td class="tfb_lb_option themify-checkbox" id="field_sendcopy_active" data-control-binding="live" data-control-type="checkbox"><input type="checkbox" name="field_sendcopy_active" value="yes" class="tf-checkbox" /></td>
			</tr>
			<tr>
				<td><?php _e( 'Send Button', 'builder-contact' ) ?></td>
				<td><input type="text" id="field_send_label" name="field_send_label" value="" class="tfb_lb_option large" placeholder="<?php _e( 'Send', 'builder-contact' ) ?>" data-control-binding="live" data-control-type="text" /></td>
				<td></td>
				<td class="">&nbsp;</td>
			</tr>
		</tbody>
		</table>
		</div>
	</div>
	<?php
}

Themify_Builder_Model::register_module( 'TB_Contact_Module' );