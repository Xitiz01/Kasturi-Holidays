<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Kasturi_Packages_Widget extends \Elementor\Widget_Base {

     public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        // Register Swiper if not already done
        if (!wp_script_is('swiper', 'registered')) {
            wp_register_script(
                'swiper', 
                'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', 
                [], 
                '11.0.5', 
                true
            );
            wp_register_style(
                'swiper',
                'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
                [],
                '11.0.5'
            );
        }}

    public function get_script_depends() {
    return [ 'swiper', 'travel-packages-widget-script' ];
    }
    public function get_style_depends() {
        return [ 'swiper', 'travel-packages-widget-style' ];
    }

    public function get_name() {
        return 'travel_packages';
    }

    public function get_title() {
        return __( 'Travel Packages', 'kadence-child' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

     protected function _register_controls() {
        $this->start_controls_section(
            'packages_section',
            [
                'label' => __( 'Travel Packages', 'kadence-child' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Style Variation Control
        $this->add_control(
            'layout_style',
            [
                'label' => __('Layout Style', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => __('Grid Layout', 'kadence-child'),
                    'slider' => __('Slider Layout', 'kadence-child'),
                ],
            ]
        );
//         $this->add_control(
//             'grid_columns',
//             [
//                 'label' => __('Columns', 'kadence-child'),
//                 'type' => \Elementor\Controls_Manager::NUMBER,
//                 'min' => 1,
//                 'max' => 6,
//                 'default' => 3,
//                 'condition' => ['layout_style' => 'grid'],
//                 'selectors' => [
//                     '{{WRAPPER}} .packages-container.grid-layout' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
//                 ],
//             ]
//         );
		  // --- CHANGE #1: Made the Columns control responsive ---
        $this->add_responsive_control(
            'grid_columns',
            [
                'label' => __('Columns', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'condition' => ['layout_style' => 'grid'],
                'selectors' => [
                    // This will now apply the correct column count for each device
                    '{{WRAPPER}} .packages-container.grid-layout' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        // Grid Row Control
        $this->add_responsive_control(
            'grid_rows',
            [
                'label' => __('Rows', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 2,
                'condition' => ['layout_style' => 'grid'],
                'selectors' => [
                    '{{WRAPPER}} .packages-container.grid-layout' => 'grid-template-rows: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );
		


        // Slider Controls
        $this->add_control(
            'slider_settings_heading',
            [
                'label' => __('Slider Settings', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['layout_style' => 'slider'],
            ]
        );

        $this->add_control(
            'slides_to_show',
            [
                'label' => __('Slides to Show', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 3,
                'condition' => ['layout_style' => 'slider'],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['layout_style' => 'slider'],
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label' => __('Show Arrows', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['layout_style' => 'slider'],
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'label' => __('Show Dots', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['layout_style' => 'slider'],
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'package_repeater',
            [
                'label' => __('Packages', 'kadence-child'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Packages Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Package Image', 'kadence-child' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Package Title', 'kadence-child' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Package Title', 'kadence-child' ),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __( 'Description', 'kadence-child' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Package description goes here...', 'kadence-child' ),
            ]
        );

        $repeater->add_control(
            'duration',
            [
                'label' => __( 'Duration', 'kadence-child' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '7 Nights And 8 Days', 'kadence-child' ),
            ]
        );
       $repeater->add_control(
            'link_text',
            [
                'label' => __( 'Learn More Text', 'kadence-child' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Learn More', 'kadence-child' ),
                'default' => __( 'Learn More', 'kadence-child' ),
            ]
        );

        $repeater->add_control(
            'link_url',
            [
                'label' => __( 'Learn More Link', 'kadence-child' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'kadence-child' ),
            ]
        );

        $this->add_control(
            'packages',
            [
                'label' => __( 'Packages', 'kadence-child' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'default' => [
                    [
                        'image' => [ 'url' => 'https://upload.wikimedia.org/wikipedia/commons/5/5d/Kathmandu-Valley-Nepal.jpg' ],
                        'title' => 'Kathmandu – Pokhara – Chitwan Tour',
                        'description' => 'The package includes the three major tourist attraction cities of Nepal. The three cities have their own importance and attractions.',
                        'duration' => '7 Nights And 8 Days',
                        'link' => [ 'url' => '#' ],
                    ],
                    [
                        'image' => [ 'url' => 'https://upload.wikimedia.org/wikipedia/commons/6/6e/Chitwan_elephant_safari.jpg' ],
                        'title' => 'Kathmandu – Chitwan',
                        'description' => 'Our Kathmandu to Chitwan tour is the combination of the heritages and the wildlife. The packages include the ancient heritage visit to the Kathmandu valley and the wildlife exploration of the Chitwan national Park.',
                        'duration' => '5 Nights And 6 Days',
                        'link' => [ 'url' => '#' ],
                    ],
                    [
                        'image' => [ 'url' => 'https://upload.wikimedia.org/wikipedia/commons/7/7e/Poon_Hill_signboard.jpg' ],
                        'title' => 'Poon Hill Trek',
                        'description' => 'Poon hill is one of the easiest trek from Pokhara city. It has the routes in the Annapurna Sanctuary. Poon hill trek is the trek which every beginner should try onto.',
                        'duration' => '5 Nights And 4 Days.',
                        'link' => [ 'url' => '#' ],
                    ],
                ],
            ]
        );
        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Styles', 'kadence-child'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        // Container Styles
        $this->add_control(
            'container_heading',
            [
                'label' => __('Container', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => __('Background', 'kadence-child'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .package-card',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'label' => __('Border', 'kadence-child'),
                'selector' => '{{WRAPPER}} .package-card',
            ]
        );

        $this->add_responsive_control(
            'container_border_radius',
            [
                'label' => __('Border Radius', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .package-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => __('Box Shadow', 'kadence-child'),
                'selector' => '{{WRAPPER}} .package-card',
            ]
        );

        // Title Styles
        $this->add_control(
            'title_heading',
            [
                'label' => __('Title', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'title_alignment',
            [
                'label' => __('Alignment', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'kadence-child'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'kadence-child'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'kadence-child'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .package-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'kadence-child'),
                'selector' => '{{WRAPPER}} .package-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .package-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __('Spacing', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .package-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Description Styles
        $this->add_control(
            'description_heading',
            [
                'label' => __('Description', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
			'description_word_limit',
			[
				'label' => __( 'Description Word Limit', 'kadence-child' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'default' => 20,
				'description' => __( 'Set the maximum number of words for all descriptions.', 'kadence-child' ),
			]
		);

        $this->add_responsive_control(
            'description_alignment',
            [
                'label' => __('Alignment', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'kadence-child'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'kadence-child'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'kadence-child'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .package-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Typography', 'kadence-child'),
                'selector' => '{{WRAPPER}} .package-description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Color', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .package-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Duration Styles
        $this->add_control(
            'duration_heading',
            [
                'label' => __('Duration', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'duration_alignment',
            [
                'label' => __('Duration Alignment', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'kadence-child'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'kadence-child'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'kadence-child'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .package-duration' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'duration_icon_color',
            [
                'label' => __('Icon Color', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .package-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'duration_text_color',
            [
                'label' => __('Text Color', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .package-duration' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'duration_typography',
                'label' => __('Typography', 'kadence-child'),
                'selector' => '{{WRAPPER}} .package-duration',
            ]
        );

        // CTA Button Styles
        $this->add_control(
            'cta_heading',
            [
                'label' => __('CTA Button', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        // CTA Button Alignment Control
        $this->add_responsive_control(
            'cta_alignment',
            [
                'label' => __('CTA Alignment', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'kadence-child'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'kadence-child'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'kadence-child'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .package-cta' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        // Slider Navigation Arrows Styles
        $this->add_control(
            'arrows_heading',
            [
                'label' => __('Slider Arrows', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['layout_style' => 'slider'],
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __('Arrow Color', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'color: {{VALUE}};',
                ],
                'condition' => ['layout_style' => 'slider'],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __('Arrow Background', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['layout_style' => 'slider'],
            ]
        );

        $this->add_responsive_control(
            'arrow_size',
            [
                'label' => __('Arrow Size', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 16,
                        'max' => 64,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['layout_style' => 'slider'],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'arrow_border',
                'label' => __('Arrow Border', 'kadence-child'),
                'selector' => '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev',
                'condition' => ['layout_style' => 'slider'],
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => __('Arrow Border Radius', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['layout_style' => 'slider'],
            ]
        );

        $this->add_responsive_control(
            'arrow_spacing',
            [
                'label' => __('Arrow Spacing', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['layout_style' => 'slider'],
            ]
        );


        $this->start_controls_tabs('cta_tabs');

        $this->start_controls_tab(
            'cta_normal',
            [
                'label' => __('Normal', 'kadence-child'),
            ]
        );

        $this->add_control(
            'cta_text_color',
            [
                'label' => __('Text Color', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .learn-more-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_icon_color',
            [
                'label' => __('Icon Color', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .arrow-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'cta_typography',
                'label' => __('Typography', 'kadence-child'),
                'selector' => '{{WRAPPER}} .learn-more-btn',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'cta_hover',
            [
                'label' => __('Hover', 'kadence-child'),
            ]
        );

        $this->add_control(
            'cta_hover_color',
            [
                'label' => __('Text Color', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .learn-more-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_icon_hover_color',
            [
                'label' => __('Icon Color', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .learn-more-btn:hover .arrow-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_hover_animation',
            [
                'label' => __('Hover Animation', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

protected function render() {
    $settings = $this->get_settings_for_display();
    $is_slider = ($settings['layout_style'] === 'slider');
    $widget_id = 'kasturi-packages-' . $this->get_id();

    // Grid setup
    $grid_columns = !empty($settings['grid_columns']) ? $settings['grid_columns'] : 3;
    $grid_rows = !empty($settings['grid_rows']) ? $settings['grid_rows'] : 2;
    $max_items = $grid_columns * $grid_rows;
    $package_count = 0;
    $slides_to_show = !empty($settings['slides_to_show']) ? $settings['slides_to_show'] : 3;

    ?>
    <div class="travel-packages-widget <?php echo esc_attr($is_slider ? 'is-slider' : 'is-grid'); ?>" id="<?php echo esc_attr($widget_id); ?>">
        <?php if ($is_slider): ?>
            <div class="swiper-container">
                <div class="swiper-wrapper">
        <?php else: ?>
            <div class="packages-container grid-layout" style="--grid-columns: <?php echo esc_attr($grid_columns); ?>;">
        <?php endif; ?>

        <?php if (!empty($settings['packages'])) : ?>
            <?php foreach ($settings['packages'] as $package) : ?>
                <?php if (!$is_slider && $package_count >= $max_items) break; ?>
                <?php if ($is_slider): ?>
                    <div class="swiper-slide">
                <?php endif; ?>

                <div class="package-card">
                    <div class="package-image">
                        <img src="<?php echo esc_url($package['image']['url']); ?>" alt="<?php echo esc_attr($package['title']); ?>">
                    </div>
                    <div class="package-content">
                        <h3 class="package-title"><?php echo esc_html($package['title']); ?></h3>
                        <?php
                            $desc = $package['description'];
                            $word_limit = !empty($settings['description_word_limit']) ? intval($settings['description_word_limit']) : 20;

                            $desc_words = explode(' ', wp_strip_all_tags($desc));
                            if (count($desc_words) > $word_limit) {
                                $desc_trimmed = implode(' ', array_slice($desc_words, 0, $word_limit)) . '...';
                            } else {
                                $desc_trimmed = $desc;
                            }
                        ?>
                        <div class="package-description"><?php echo esc_html($desc_trimmed); ?></div>
                        
                        <div class="package-footer">
                            <div class="package-duration">
                                <span class="package-icon">🕒</span><?php echo esc_html($package['duration']); ?>
                            </div>
                            <div class="package-cta">
                                <a class="learn-more-btn"
                                href="<?php echo esc_url($package['link_url']['url']); ?>"
                                <?php if (!empty($package['link_url']['is_external'])) : ?>
                                    target="_blank" rel="noopener noreferrer"
                                <?php endif; ?>>
                                    <span class="arrow-icon">→</span> <?php echo esc_html($package['link_text']); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($is_slider): ?>
                    </div>
                <?php endif; ?>
                <?php $package_count++; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($is_slider): ?>
                </div>
                <?php if ($settings['show_dots'] === 'yes'): ?>
                    <div class="swiper-pagination"></div>
                <?php endif; ?>
            </div>
            <?php if ($settings['show_arrows'] === 'yes'): ?>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            <?php endif; ?>
        <?php else: ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($is_slider): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Swiper !== 'undefined') {
                new Swiper('#<?php echo esc_js($widget_id); ?> .swiper-container', {
                    loop: true,
                    <?php if ($settings['autoplay'] === 'yes'): ?>
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false,
                    },
                    <?php endif; ?>
                    navigation: {
                        nextEl: '#<?php echo esc_js($widget_id); ?> .swiper-button-next',
                        prevEl: '#<?php echo esc_js($widget_id); ?> .swiper-button-prev',
                    },
                    pagination: {
                        el: '#<?php echo esc_js($widget_id); ?> .swiper-pagination',
                        clickable: true,
                    },
                    // THIS IS THE CRITICAL FIX FOR RESPONSIVENESS
                    breakpoints: {
                        // For screens 320px and up (Mobile)
                        320: {
                            slidesPerView: 1, // <-- THIS IS THE RULE FOR MOBILE
                            spaceBetween: 15 
                        },
                        // For screens 768px and up (Tablet)
                        768: {
                            slidesPerView: 2, // <-- THIS IS THE RULE FOR TABLET
                            spaceBetween: 20
                        },
                        // For screens 1024px and up (Desktop)
                        1024: {
                            slidesPerView: <?php echo (int)$slides_to_show; ?>,
                            spaceBetween: 30
                        }
                    }
                });
            }
        });
    </script>
    <?php endif; ?>

    <style>
        /* All the CSS is correct and can remain as it was */
        /****************************************
         * GLOBAL & BASE STYLES
         ****************************************/
        .swiper-button-next::after, 
        .swiper-button-prev::after { 
            font-size: inherit; 
        }

        .travel-packages-widget {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 0;
            position: relative;
        }

        /****************************************
         * GRID LAYOUT
         ****************************************/
        .travel-packages-widget.is-grid .packages-container.grid-layout {
            display: grid;
            gap: 30px;
            grid-template-columns: repeat(var(--grid-columns, 3), 1fr);
        }

        /****************************************
         * SLIDER LAYOUT
         ****************************************/
        .travel-packages-widget.is-slider .swiper-container {
            overflow: hidden;
            position: relative;
        }
        .swiper-wrapper {
            align-items: stretch; /* Vertical alignment for all slides */
        }
        .swiper-slide {
            height: auto; /* Let content define height */
        }

        /****************************************
         * UNIVERSAL PACKAGE CARD STYLES
         ****************************************/
        .package-card {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%; /* Stretch to fill the slide's height */
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            border: 1px solid #f0f0f0;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .package-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        }

        .package-image {
            height: 220px;
            overflow: hidden;
        }
        .package-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .package-card:hover .package-image img {
            transform: scale(1.05);
        }

        .package-content {
            display: flex;
            flex-direction: column;
            flex-grow: 1; /* CRUCIAL: Makes content area fill remaining space */
            padding: 24px;
        }
        
        .package-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d323c;
            margin: 0 0 12px 0;
            line-height: 1.4;
        }
        .package-description {
            font-size: 0.95rem;
            color: #767b86;
            line-height: 1.6;
            margin: 0;
        }

        .package-footer {
            margin-top: auto; /* CRUCIAL: Pushes this block to the bottom */
            padding-top: 20px;
        }
        .package-duration {
            font-size: 0.9rem;
            font-weight: 500;
            color: #388e3c;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .package-icon {
            margin-right: 8px;
        }
        .package-cta {
            display: flex;
            justify-content: var(--cta-alignment, flex-start);
        }
        .learn-more-btn {
            display: inline-flex;
            align-items: center;
            color: #ffc107;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            gap: 8px;
            transition: all 0.2s ease;
        }
        .learn-more-btn:hover {
            color: #ff9800;
        }
        
        /****************************************
         * RESPONSIVE STYLES
         ****************************************/

        /* Tablet (<= 1024px) */
        @media (max-width: 1024px) {
            .travel-packages-widget.is-grid .packages-container.grid-layout {
                grid-template-columns: repeat(2, 1fr);
            }
            .package-image {
                height: 180px;
            }
            .package-title {
                font-size: 1.1rem;
            }
        }

        /* Mobile (<= 767px) */
        @media (max-width: 767px) {
            .travel-packages-widget {
                padding-left: 15px;
                padding-right: 15px;
            }
            .travel-packages-widget.is-grid .packages-container.grid-layout {
                grid-template-columns: 1fr;
                gap: 24px;
            }
            .package-image {
                height: 160px;
            }
            .package-content {
                padding: 20px 15px;
            }
            .package-title {
                font-size: 1.05rem;
            }
        }

        .swiper-button-next,
        .swiper-button-prev {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }
        .swiper-button-next {
            right: 0;
        }
        .swiper-button-prev {
            left: 0;
        }
    </style>
    <?php
}}
