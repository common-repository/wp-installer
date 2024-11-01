<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Class installer
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */

if ( ! class_exists( 'IPLaun_Installer' )) {

  /**
   * Class installer
   */
  class IPLaun_Installer
  {
    /**
     * Take data
     *
     * @var array
     */
    protected $_data;

  	/**
  	 * Take category data
  	 *
  	 * @var array
  	 */
  	protected $_category = array();

  	//{{ __construct

  	/**
     * Class construct
     *
     * @param array $data
     * @return void
     */
    public function __construct( $data )
    {
      $this->_data = $data;
    }

    //}}
  	//{{ install

  	/**
     * Do install
     *
     * @return void
     */
    public function install()
    {
    	$data = $this->_data;

    	//
    	//Delete unwanted content
    	$this->deleteUnwantedContent();
      //
      //Delete unwanted widget
      $this->deleteUnwantedWidget();
      //
      //Install theme
      $this->installTheme();
      //
      //Install plugins
      $this->installPlugins();
      //
      //Add pages
      $this->addPages();
    	//
    	//Add categories
    	$this->addCategories();
      //
      //Add posts
      $this->addPosts();
      //
      //Set settings
      $this->setSettings();
    }

    //}}
  	//{{ deleteUnwantedContent

  	/**
     * Delete unwanted content
     *
     * @return void
     */
    public function deleteUnwantedContent()
    {
    	global $wpdb;

    	$data = $this->_data;

    	//Delete hello worlds
    	if ( isset( $data['delete_post_default'] ) && ! empty( $data['delete_post_default'] ) )
    	{
    		$wpdb->delete( $wpdb->posts, array( 'ID' => 1 ) );
    	}
    	//Delete hello worlds comment 
    	if ( isset( $data['delete_comment_default'] ) && ! empty( $data['delete_comment_default'] ) )
    	{
    		$wpdb->delete( $wpdb->comments, array( 'comment_ID' => 1 ) );
    	}
    	//Delete sample page
    	if ( isset( $data['delete_page_default'] ) && ! empty( $data['delete_page_default'] ) )
    	{
    		wp_delete_post( 2, true );
    	}

    	//Delete all posts
    	if ( isset( $data['delete_post_all'] ) && ! empty( $data['delete_post_all'] ) )
    	{
    		$query = new WP_Query;
	      $posts = $query->query( array(
	        'post_type'   => 'post',
          'post_status' => 'any',
          'posts_per_page' => -1
	      ));
	      if ( ! empty( $posts ))
	      {
	      	foreach( $posts as $post ) {
	      		wp_delete_post( $post->ID, true );
	      	}
	      }
    	}

      //Delete all pages
      if ( isset( $data['delete_page_all'] ) && ! empty( $data['delete_page_all'] ) )
      {
        $query = new WP_Query;
        $pages = $query->query( array(
          'post_type'   => 'page',
          'post_status' => 'any',
          'posts_per_page' => -1
        ));
        if ( ! empty( $pages ))
        {
          foreach( $pages as $page ) {
            wp_delete_post( $page->ID, true );
          }
        }
      }

    	//Delete all comments
    	if ( isset( $data['delete_comment_all'] ) && ! empty( $data['delete_comment_all'] ) )
    	{
        $comments = get_comments();
	      if ( ! empty( $comments ))
	      {
	      	foreach( $comments as $comment ) {
	      		wp_delete_comment( $comment->comment_ID, true );
	      	}
	      }
    	}

    	//Delete all taxonomies
    	if ( isset( $data['delete_taxonomy_all'] ) && ! empty( $data['delete_taxonomy_all'] ) )
    	{
    		//Tags
    		$tags = get_terms( 'post_tag', array(
	    		'hide_empty' => false
				));
	      if ( ! empty( $tags ))
	      {
	      	foreach( $tags as $tag ) {
	      		wp_delete_term( $tag->term_id, 'post_tag' );
	      	}
	      }
	      //Categories
    		$cats = get_terms( 'category', array(
	    		'hide_empty' => false
				));
	      if ( ! empty( $cats ))
	      {
	      	foreach( $cats as $cat ) {
	      		wp_delete_term( $cat->term_id, 'category' );
	      	}
	      }
    	}

    	//Delete all medias
    	if ( isset( $data['delete_media_all'] ) && ! empty( $data['delete_media_all'] ) )
    	{
    		$query  = new WP_Query;
	      $medias = $query->query( array(
	        'post_type'   => 'attachment',
	        'post_status' => 'any',
          'posts_per_page' => -1
	      ));

	      if ( ! empty( $medias ))
	      {
	      	foreach( $medias as $media ) {
	      		wp_delete_attachment( $media->ID, true );
	      	}
	      }
    	}

    	//
    	//Delete revisions post
    	$wpdb->delete( $wpdb->posts, array( 'post_type' => 'revision' ) );

    }

    //}}
    //{{ deleteUnwantedWidget

    /**
     * Delete unwanted widget
     *
     * @return void
     */
    public function deleteUnwantedWidget()
    {
      $data = $this->_data;

      //
      //Remove some widgets
      $widgets = wp_get_sidebars_widgets();
      if ( ! empty( $widgets ))
      {
        //Delete widget recent posts
        if ( isset( $data['delete_widget_all'] ) && ! empty( $data['delete_widget_all'] ) )
        {
          foreach( $widgets as $name => $widgetData )
          {
            $widgets[$name] = array();
          }
        }
        else
        {
          if ( isset( $data['delete_widget_posts'] ) && ! empty( $data['delete_widget_posts'] ) )
          {
            $widgets = $this->_removeWidget( 'recent-posts', $widgets );
          }
          //Delete widget recent comments
          if ( isset( $data['delete_widget_comments'] ) && 
               ! empty( $data['delete_widget_comments'] ) 
          ) {
            $widgets = $this->_removeWidget( 'recent-comments', $widgets );
          }
          //Delete widget archives
          if ( isset( $data['delete_widget_archives'] ) && 
               ! empty( $data['delete_widget_archives'] )
          ) {
            $widgets = $this->_removeWidget( 'recent-archives', $widgets );
          }
          //Delete widget category
          if ( isset( $data['delete_widget_category'] ) && ! empty( $data['delete_widget_category'] ) )
          {
            $widgets = $this->_removeWidget( 'categories', $widgets );
          }
          //Delete widget search
          if ( isset( $data['delete_widget_search'] ) && ! empty( $data['delete_widget_search'] ) )
          {
            $widgets = $this->_removeWidget( 'search', $widgets );
          }
          //Delete widget meta
          if ( isset( $data['delete_widget_meta'] ) && ! empty( $data['delete_widget_meta'] ) )
          {
            $widgets = $this->_removeWidget( 'meta', $widgets );
          }
        }

        //
        //update options
        update_option( 'sidebars_widgets', $widgets );
      }
    }

    //}}
  	//{{ _removeWidget

  	/**
     * Remove widget
     *
     * @param string $widgetName
     * @param string $widgets
     * @return void
     */
    protected function _removeWidget( $widgetName, $widgets )
    {
    	foreach( $widgets as $k => $widgetData )
      {
        if ( empty( $widgetData )) {
          continue;
        }

        foreach( $widgetData as $key => $name )
        {
          $_names = explode( '-', $name );
          array_pop( $_names );
          $_key = implode( '-', $_names );
          if ( $_key == $widgetName ) {
            unset( $widgetData[$key] );
          }
        }

        $widgets[$k] = $widgetData;
      }
      return $widgets;
    }

    //}}
    //{{ installTheme

    /**
     * Install theme
     *
     * @return void
     */
    public function installTheme()
    {
      $data = $this->_data;

      if ( isset( $data['theme_active'] ) && ! empty( $data['theme_active'] ) )
      {
        $theme = wp_get_theme( $data['theme_active'] );
        if ( $theme ) {
          switch_theme( $theme->get_stylesheet() );
        }
      }
    }

    //}}
    //{{ installPlugins

    /**
     * Install plugins
     *
     * @return void
     */
    public function installPlugins()
    {
      $data = $this->_data;

      if ( isset( $data['plugins'] ) && ! empty( $data['plugins'] ) )
      {
        $_plugopt = urldecode( $data['plugins'] );
        $_plugopt = trim( $_plugopt, '|' );
        $plugins  = explode( '|', $_plugopt );

        foreach( $plugins as $plugin ) 
        {
          @activate_plugin( $plugin );
        }
      }
    }

    //}}
    //{{ addPages

    /**
     * Add pages
     *
     * @return void
     */
    public function addPages()
    {
      $data = $this->_data;

      if ( isset( $data['pages'] ) && ! empty( $data['pages'] ) && ! empty( $data['raw']['pages'] ) )
      {
        $_pagesopt = urldecode( $data['pages'] );
        $_pagesopt = trim( $_pagesopt, '|' );
        $pageIds   = explode( '|', $_pagesopt );
        $pageraw   = $data['raw']['pages'];

        foreach( $pageIds as $id ) 
        {
          $id = preg_replace('/[^0-9]/', '', $id);
          $id = absint( $id );

          $pagedata = array();
          foreach( $pageraw as $raw ) 
          {
            if ( $id == $raw['id'] ) {
              $pagedata = $raw;
              break;
            }
          }
          if ( ! empty( $pagedata )) 
          {
            $title = $pagedata['title'];
            $post  = get_page_by_title( $title );
            if ( ! $post )
            {
              //Insert page
              $toinsert = array(
                'post_title'   => apply_filters( 'single_post_title', $title ),
                'post_type'    => 'page',
                'post_status'  => 'publish',
              );
              if ( ! empty( $pagedata['content'] )) {
                $toinsert['post_content'] = $pagedata['content'];
              }
              $result = wp_insert_post( $toinsert );
            }
          }
        }
      }
    }

    //}}
    //{{ addCategories

    /**
     * Add categories
     *
     * @return void
     */
    public function addCategories()
    {
      $data = $this->_data;

      //
      //Rename uncategorized
      if ( ! empty( $data['default_category_name'] ) && 
           $data['default_category_name'] != 'Uncategorized'
      ){
        $name = apply_filters( 'single_post_title', $data['default_category_name'] );
        $slug = sanitize_title( $name );

        wp_update_term(1, 'category', array(
          'name' => $name,
          'slug' => $slug
        ));
      }

      //Add categories
      if ( isset( $data['categories'] ) && 
           ! empty( $data['categories'] ) && 
           ! empty( $data['raw']['categories'] ) 
      ){
        $_catsopt = urldecode( $data['categories'] );
        $_catsopt = trim( $_catsopt, '|' );
        $catIds   = explode( '|', $_catsopt );
        $catraw   = $data['raw']['categories'];

        foreach( $catIds as $id ) 
        {
          $id = preg_replace('/[^0-9]/', '', $id);
          $id = absint( $id );

          $catdata = array();
          foreach( $catraw as $raw ) 
          {
            if ( $id == $raw['id'] ) {
              $catdata = $raw;
              break;
            }
          }
          if ( ! empty( $catdata )) 
          {
            //Insert category
            $name   = apply_filters( 'single_post_title', $catdata['name'] );
            $result = wp_create_category( $name );

            if ( ! empty( $result )) {
              $this->_category[$id] = $result;
            }
          }
        }
      }

    }

    //}}
    //{{ addPosts

    /**
     * Add posts
     *
     * @return void
     */
    public function addPosts()
    {
      $data = $this->_data;

      if ( isset( $data['posts'] ) && ! empty( $data['posts'] ) && ! empty( $data['raw']['posts'] ) )
      {
        $_postsopt = urldecode( $data['posts'] );
        $_postsopt = trim( $_postsopt, '|' );
        $postIds   = explode( '|', $_postsopt );
        $postraw   = $data['raw']['posts'];

        foreach( $postIds as $id ) 
        {
          $id = preg_replace('/[^0-9]/', '', $id);
          $id = absint( $id );

          $postdata = array();
          foreach( $postraw as $raw ) 
          {
            if ( $id == $raw['id'] ) {
              $postdata = $raw;
              break;
            }
          }
          if ( ! empty( $postdata )) 
          {
            $title = $postdata['title'];
            $post  = get_page_by_title( $title, OBJECT, 'post' );
            if ( ! $post )
            {
              //Insert post
              $toinsert = array(
                'post_title'   => apply_filters( 'single_post_title', $title ),
                'post_type'    => 'post',
                'post_status'  => 'publish',
              );
              if ( ! empty( $postdata['content'] )) {
                $toinsert['post_content'] = $postdata['content'];
              }
              $result = wp_insert_post( $toinsert );

              //category
              if ( ! empty( $result ) && ! empty( $postdata['category'] )) 
              {
                $catId = 0;
                if ( strpos($postdata['category'], 's:') !== false )
                {
                  $catIndex = preg_replace('/[^0-9]/', '', $postdata['category']);
                  $catId    = absint( $catIndex );
                }
                else
                {
                  $catIndex = preg_replace('/[^0-9]/', '', $postdata['category']);
                  $catIndex = absint( $catIndex );

                  if ( isset( $this->_category[$catIndex] ))
                  {
                    $catId = $this->_category[$catIndex];
                  }
                }

                if ( ! empty( $catId )) {
                  wp_set_post_categories( $result, array( $catId ) );
                }
              }
            }

          }
        }
      }
    }

    //}}
    //{{ setSettings

    /**
     * Set settings
     *
     * @return void
     */
    public function setSettings()
    {
      $data = $this->_data;

      //
      //Blog title
      if ( ! empty( $data['blog_title'] ))
      {
        $title = apply_filters( 'single_post_title', $data['blog_title'] );
        update_option( 'blogname', $title );
      }

      //
      //Blog description
      if ( ! empty( $data['blog_description'] ))
      {
        $desc = apply_filters( 'single_post_title', $data['blog_description'] );
        update_option( 'blogdescription', $desc );
      }

      //
      //comments notify
      if ( ! empty( $data['disabled_post_comment'] )) {
        update_option( 'comments_notify', 0 );
      } else {
        update_option( 'comments_notify', 1 );
      }

      //
      //comments moderation notify
      if ( ! empty( $data['disabled_comment_moderation'] )) {
        update_option( 'moderation_notify', 0 );
      } else {
        update_option( 'moderation_notify', 1 );
      }

      //
      //Front page
      if ( ! empty( $data['front_page'] ))
      {
        $type = apply_filters( 'single_post_title', $data['front_page'] );
        update_option( 'show_on_front', $type );
      }
      if ( ! empty( $data['static_page_name'] ))
      {
        $title = apply_filters( 'single_post_title', $data['static_page_name'] );

        //Insert page
        $toinsert = array(
          'post_title'   => $title,
          'post_type'    => 'page',
          'post_status'  => 'publish',
        );
        $result = wp_insert_post( $toinsert );
        update_option( 'page_on_front', $result );
      }

      //
      //Permalink
      if ( ! empty( $data['active_permalink'] ) && ! empty( $data['permalink_structure'] ))
      {
        $struct = $data['permalink_structure'];
        update_option( 'permalink_structure', $struct );
      }

      //
      //Post per page
      if ( ! empty( $data['number_posts'] ))
      {
        $numbers = absint( $data['number_posts'] );
        update_option( 'posts_per_page', $numbers );
      }

      //
      //Rss use excerpt
      if ( ! empty( $data['post_content_format'] ) && $data['post_content_format'] == 'summary')
      {
        update_option( 'rss_use_excerpt', 1 );
      }
    }

    //}}

  }
}