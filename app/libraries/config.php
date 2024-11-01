<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'IPLaun_Config' )) 
{
    /**
     * Class for manage config data
     *
     * @package WordpressInstaller
     * @author WordpressInstaller
     * @link http://WordpressInstaller.ga
     */

    class IPLaun_Config
    {
        /**
         * Take post setting
         *
         * @var array
         */
        protected $_settings;

        /**
         * Class construct
         *
         * @param array $settings
         * @return void
         */
        public function __construct( $settings = array() )
        {
            $this->_settings = $settings;
        }

        /**
         * Get all post setting
         *
         * @return string
         */
        public function getSettings()
        {
            return $this->_settings;
        }

        /**
         * Get post setting
         *
         * @param  string $key
         * @param  mixed  $default
         * @return string
         */
        public function getSetting( $key, $default = false, $allowEmpty = false )
        {
            $setting = $default;
            if ( $allowEmpty ) {
                if ( isset( $this->_settings[$key] ) ) {
                    $setting = $this->_settings[$key];
                }
            } else {
                if ( ! empty( $this->_settings[$key] ) ) {
                    $setting = $this->_settings[$key];
                }
            }
            return $setting;
        }

        /**
         * Add setting
         *
         * @param  array $data
         * @return boolean
         */
        public function addSettings( $data )
        {
            $data     = (array)$data;
            $settings = (array)$this->_settings;
            $settings = array_merge( $settings, $data );
            $this->_settings = $settings;
        }

        /**
         * Set all post setting
         *
         * @param  array $data
         * @return boolean
         */
        public function setSettings( $data )
        {
            $data     = (array)$data;
            $settings = (array)$this->_settings;
            $settings = array_merge( $settings, $data );
            $this->_settings = $settings;
            return $this->_update( $settings );
        }

        /**
         * Set post setting
         *
         * @param  string $key
         * @param  string $value
         * @return boolean
         */
        public function setSetting( $key, $value )
        {
            $data = array(
                $key => $value
            );
            $settings = (array)$this->_settings;
            $settings = array_merge( $settings, $data );
            $this->_settings = $settings;
            return $this->_update( $settings );
        }

        /**
         * Reset post setting
         *
         * @return boolean
         */
        public function reset()
        {
            $this->_settings = array();
            $data = array( 'reset' => 1 );
            return $this->_update( $data );
        }

        /**
         * Update settings
         *
         * @param  array $settings
         * @return boolean
         */
        protected function _update( $settings )
        {
        }
    }
}
