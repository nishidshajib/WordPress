<?php
// Timber/Twing Macros
add_action( 'jet-engine/timber-views/register-functions', function( $manager ) {
	
	class Do_Macros_Timber_Source extends \Jet_Engine\Timber_Views\View\Functions\Base {

		public function get_name() {
			return 'jet_engine_macros';
		}

		public function get_label() {
			return __( 'Macros', 'jet-engine' );
		}

		public function get_result( $args ) {
			return jet_engine()->listings->macros->do_macros( $args['macros_string'] ?? '' );
		}

		public function get_args() {

			return [
				'macros_string' => [
					'label'   => __( 'Macros string', 'jet-engine' ),
					'type'    => 'textarea',
					'default' => '',
				],
			];
				
		}

	}

	$manager->register_function( new Do_Macros_Timber_Source() );
	
} );

add_action( 'jet-engine/register-macros', function(){

    class Get_Post_Count extends \Jet_Engine_Base_Macros {

        /**
         * @inheritDoc
         */
        public function macros_tag() {
            return 'get_post_count';
        }

        /**
         * @inheritDoc
         */
        public function macros_name() {
            return esc_html__( 'Get Post Count', 'jet-engine' );
        }

        /**
         * @inheritDoc
         */
        public function macros_args() {
            return array(
                'store' => array(
                    'label'   => __( 'Store', 'jet-engine' ),
                    'type'    => 'select',
                    'options' => \Jet_Engine\Modules\Data_Stores\Module::instance()->elementor_integration->get_store_options(),
                ),
            );
        }

        /**
         * @inheritDoc
         */
        public function macros_callback( $args = array() ) {

            $store = ! empty( $args['store'] ) ? $args['store'] : false;

            if ( ! $store ) {
                return 'not found';
            }

            $post_id = jet_engine()->listings->data->get_current_object_id();

            if( ! $post_id ){
                return 'not found f';
            }

            return \Jet_Engine\Modules\Data_Stores\Module::instance()->render->post_count( $store, $post_id );
        }
    }

    new Get_Post_Count();
});
