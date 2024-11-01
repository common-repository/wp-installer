<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'IPLaun_Setting' ))
{
    /**
     * Class for manage post setting
     *
     * @package WordpressInstaller
     * @author WordpressInstaller
     * @link http://WordpressInstaller.ga
     */

    class IPLaun_Setting extends IPLaun_Config
    {
        /**
         * Take post id
         *
         * @var string
         */
        protected $_postId;

        /**
         * Take setting name
         *
         * @var string
         */
        protected $_name;

        /**
         * Class construct
         *
         * @param int $postId
         * @param string $name
         * @return void
         */
        public function __construct( $postId, $name )
        {
            $this->_postId = absint( $postId );
            $this->_name   = $name;
            $this->_prepare();
        }

        /**
         * Prepare class
         *
         * @return void
         */
        protected function _prepare()
        {
            $id = $this->_postId;
            if ( ! empty( $id )) {
                $metas = get_post_meta( $id, $this->_name );
                $meta  = array_shift( $metas );
                $this->_settings = maybe_unserialize( $meta );
            }
        }

        /**
         * Update settings
         *
         * @param  array $settings
         * @return boolean
         */
        protected function _update( $settings )
        {
            $settings = (array)$settings;
            return update_post_meta( $this->_postId, $this->_name, $settings );
        }
    }
}
