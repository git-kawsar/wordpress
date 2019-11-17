<?php
// Adds widget: VerumFlickerWidget
class Verumflickerwidget_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'verumflickerwidget_widget',
			esc_html__( 'VerumFlickerWidget', 'verum' ),
			array( 'description' => esc_html__( 'Flicker widgets', 'verum' ), ) // Args
		);
	}

	private $widget_fields = array(
		array(
			'label' => 'Flickr ID',
			'id' => 'verum_flickr_id',
			'type' => 'text',
		),
		array(
			'label' => 'Number Of Photos',
			'id' => 'verum_number_photos',
			'default' => '12',
			'type' => 'text',
		),
	);

	public function widget( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		// Output generated fields
        $flickr_output = wp_remote_get( "https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key=2536218fa5fd678491b238c9f5d07685&user_id={$instance['verum_flickr_id']}&per_page={$instance['verum_number_photos']}&format=json&nojsoncallback=1" );
		if ( is_array( $flickr_output ) ) {
			$photos = json_decode( $flickr_output['body'], true );
			?>
				<div class="flickr-photo-section">
					<div class="flickr-logo">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/flickr.jpg" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/flickr@2x.jpg 2x" alt=""/>
					</div>
					<div class="flickr_gallery owl-carousel owl-theme">
			<?php
			foreach( $photos['photos']['photo'] as $photo ){
				$verum_flickr_img_url = "https://farm{$photo['farm']}.staticflickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}_z.jpg";
				?>
					<div class="item">
					<a target="_blank" href="https://www.flickr.com/photos/<?php echo esc_attr($instance['verum_flickr_id']) ?>/<?php echo esc_attr($photo['id']) ?>/"><img class="img-fluid" src="<?php echo esc_url( $verum_flickr_img_url ); ?>" alt=""/></a>
					</div>
				<?php
			}
			echo '</div></div>';
		}	
		echo wp_kses_post( $args['after_widget'] );
	}

	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$default = '';
			if ( isset($widget_field['default']) ) {
				$default = $widget_field['default'];
			}
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'verum' );
			switch ( $widget_field['type'] ) {
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'verum' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.esc_attr($widget_field['type']).'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'verum' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'verum' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
}

function register_verumflickerwidget_widget() {
	register_widget( 'Verumflickerwidget_Widget' );
}
add_action( 'widgets_init', 'register_verumflickerwidget_widget' );
