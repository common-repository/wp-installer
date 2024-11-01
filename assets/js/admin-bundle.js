(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var ui           = require( './../libs/ui.js' );
var formHandler  = require( './../libs/form.js' );
var fademenu     = require( './../libs/fademenu.js' );
var collapse     = require( './../libs/collapse.js' );
var onoff        = require( './../libs/onoff.js' );
var uploader     = require( './../libs/uploader.js' );
var tab          = require( './../libs/tab.js' );
var imgOption    = require( './../libs/image-option.js' );
var manage       = require( './../libs/manage.js' );
var option       = require( './../libs/fancy-option.js' );
var stat         = require( './../libs/stat.js' );
var buttonActive = require( './../libs/button-active.js' );
var selectPreview = require( './../libs/select-preview.js' );

(function($)
{
  "use strict";

  ui.base.loader.prototype.image_base  = iplaun_img_url;
  ui.base.loader.prototype.loader_file = 'loading.gif'; 
  var loader  = new ui.base.loader();

  var iplaunData = 
  {
    categories: [],
    posts: [],
    pages: [],
  };

  //
  //Get pages list
  $( '.iplaun-pages-list .iplaun-field-row').each( function()
  {
    var id    = $( 'input[type="checkbox"]', $(this) ).val().replace( 's:', '' );
    var title = $( 'label span', $(this) ).text();

    iplaunData.pages.push({
      id: id,
      title: title
    });
  });

  /**
   * fademenu
   */
  if ( $( '.iplaun-fademenu' ).length > 0 )
  {
    fademenu( $('.iplaun-fademenu' ) );
  }

  /**
   * collapse
   */
  if ( $( '.collapse' ).length > 0 )
  {
    collapse( $('.collapse' ) );
  }

  /**
   * on/off button
   */
  if ( $( '.iplaun-onoff' ).length > 0 ) {
    onoff( $( '.iplaun-onoff' ), {
      func_select: function( button, cont )
      {
        var root = cont.parents( '.iplaun-content-onoff' );
        if ( cont.hasClass( 'iplaun-onoff-action' ) && root.length > 0 )
        {
          var value = button.data( 'value' );
          if ( value == true ) {
            $( '.iplaun-content-onoff-main', root ).show();
          } else {
            $( '.iplaun-content-onoff-main', root ).hide();
          }
        }
      }
    });
  }

  /**
   * File upload select
   */
  $( '.iplaun-upload-box input[type="file"]' ).change( function()
  {
    var input = $(this);
    var file  = input[0].files[0];
    var name  = file.name;

    if ( file.type.match('application/zip') )
    {
      $( '.iplaun-error', input.parents( '.iplaun-upload-file' ) ).hide();
      $( '.iplaun-file-info', input.parents( '.iplaun-upload-box' ) ).text( name );
      $( '.iplaun-upload-submit button', input.parents( '.iplaun-upload-file' ) )
        .removeAttr( 'disabled' )
        .removeClass( 'disabled' );
    }
    else 
    {
      $( '.iplaun-upload-submit button', input.parents( '.iplaun-upload-file' ) )
        .attr( 'disabled', 'disabled' );

      $( '.iplaun-error', input.parents( '.iplaun-upload-file' ) ).show();
    }

  });

  //
  //Submit upload theme
  $( '.iplaun-upload-file._theme .iplaun-upload-submit button' ).click( function()
  {
    var root  = $(this).parents( '.iplaun-upload-file' );
    var input = $( 'input[type="file"]', root );
    var file  = input[0].files[0];
    var data  = new FormData();
    data.append( 'themezip', file, file.name );

    //show loader
    loader.show();

    $.ajax({
      url: ajaxurl+'?doajax=1&iplaun=1&action=upload_theme_file',
      type: "POST",
      data: data,
      dataType: "html",
      processData: false,
      contentType: false,
      success: function ( result ) 
      {
        IPLaun_AfterInstallTheme();
      }
    });
  });


  /**
   * URL theme upload select
   */
  $( '.iplaun-upload-url input[type="text"]' ).keyup( function()
  {
    var input    = $(this);
    var url      = input.val();
    var urlRegex = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;


    if ( url.match( urlRegex ) )
    {
      $( '.iplaun-error', input.parents( '.iplaun-upload-url' ) ).hide();
      $( '.iplaun-upload-submit button', input.parents( '.iplaun-upload-url' ) )
        .removeAttr( 'disabled' )
        .removeClass( 'disabled' );
    }
    else 
    {
      $( '.iplaun-upload-submit button', input.parents( '.iplaun-upload-url' ) )
        .attr( 'disabled', 'disabled' );
      $( '.iplaun-error', input.parents( '.iplaun-upload-url' ) ).show();
    }
  });
  //
  //Submit upload theme
  $( '.iplaun-upload-url._theme .iplaun-upload-submit button' ).click( function()
  {
    var root  = $(this).parents( '.iplaun-upload-url' );
    var input = $( 'input[type="text"]', root );
    var url   = input.val();

    //show loader
    loader.show();

    $.ajax({
      url: ajaxurl+'?doajax=1&iplaun=1&action=upload_theme_url',
      type: "POST",
      data: 'url='+url,
      dataType: "html",
      success: function ( result ) 
      {
        IPLaun_AfterInstallTheme();
      }
    });
  });

  //
  //After install theme handler
  function IPLaun_AfterInstallTheme()
  {
    $.ajax({
      url: ajaxurl+'?doajax=1&iplaun=1&action=get_themes',
      type: "POST",
      data: '',
      dataType: "json",
      processData: false,
      contentType: false,
      success: function ( result ) 
      {
        var themeCount = $( '.iplaun-themes-list .iplaun-field-row' ).length;
        if ( result.count <= themeCount ) {
          ui.message.modal( result.errorMessage, 'alert-danger' );
        }
        else {
          $( '.iplaun-themes-list' ).html( result.content );
          ui.message.modal( result.successMessage, 'alert-success' );
        }

        //
        //Reset form
        $( '.iplaun-upload-box input[type="file"]' ).val('');
        $( '.iplaun-upload-box .iplaun-file-info' ).text('');
        $( '.iplaun-upload-url input[type="text"]' ).val('');

        //hide loader
        loader.hide();
      }
    });
  }

  //
  //Submit upload plugin
  $( '.iplaun-upload-file._plugin .iplaun-upload-submit button' ).click( function()
  {
    var root  = $(this).parents( '.iplaun-upload-file' );
    var input = $( 'input[type="file"]', root );
    var file  = input[0].files[0];
    var data  = new FormData();
    data.append( 'pluginzip', file, file.name );

    //show loader
    loader.show();

    $.ajax({
      url: ajaxurl+'?doajax=1&iplaun=1&action=upload_plugin_file',
      type: "POST",
      data: data,
      dataType: "html",
      processData: false,
      contentType: false,
      success: function ( result ) 
      {
        IPLaun_AfterInstallPlugin();
      }
    });
  });
  //
  //Submit upload plugin
  $( '.iplaun-upload-url._plugin .iplaun-upload-submit button' ).click( function()
  {
    var root  = $(this).parents( '.iplaun-upload-url' );
    var input = $( 'input[type="text"]', root );
    var url   = input.val();

    //show loader
    loader.show();

    $.ajax({
      url: ajaxurl+'?doajax=1&iplaun=1&action=upload_plugin_url',
      type: "POST",
      data: 'url='+url,
      dataType: "html",
      success: function ( result ) 
      {
        IPLaun_AfterInstallPlugin();
      }
    });
  });

  //
  //After install plugin handler
  function IPLaun_AfterInstallPlugin()
  {
    $.ajax({
      url: ajaxurl+'?doajax=1&iplaun=1&action=get_plugins',
      type: "POST",
      data: '',
      dataType: "json",
      processData: false,
      contentType: false,
      success: function ( result ) 
      {
        var pluginCount = $( '.iplaun-plugins-list .iplaun-field-row' ).length;
        if ( result.count <= pluginCount ) {
          ui.message.modal( result.errorMessage, 'alert-danger' );
        }
        else {
          $( '.iplaun-plugins-list' ).html( result.content );
          ui.message.modal( result.successMessage, 'alert-success' );
        }

        //
        //Reset form
        $( '.iplaun-upload-box input[type="file"]' ).val('');
        $( '.iplaun-upload-box .iplaun-file-info' ).text('');
        $( '.iplaun-upload-url input[type="text"]' ).val('');

        //hide loader
        loader.hide();
      }
    });
  };

  //
  //Category inputs
  $( '#__input-default-category-name' ).keyup( function()
  {
    var name = $(this).val();
    $( '.iplaun-default-category-value' ).text( name );
  });

  $( '#input-categories-name' ).keyup( function()
  {
    var names  = $(this).val();
    var button = $( '.iplaun-add-submit button', $(this).parents( '.iplaun-fields' ) );

    if ( names != '' ) {
      button.removeAttr( 'disabled' );
    } else {
      button.attr( 'disabled', 'disabled' );
    }
  });
  $( '#input-categories-name' ).focus( function()
  {
    var names  = $(this).val();
    var button = $( '.iplaun-add-submit button', $(this).parents( '.iplaun-fields' ) );

    if ( names != '' ) {
      button.removeAttr( 'disabled' );
    } else {
      button.attr( 'disabled', 'disabled' );
    }
  });
  //
  //Add categories
  $( '#iplaun-section-category .iplaun-add-submit button' ).click( function()
  {
    var name   = $( '#input-categories-name' ).val();
    var names  = name.split("\n");
    var count  = iplaunData.categories.length;
    var index  = count + 1;

    $.each(names, function(k)
    {
      var value    = names[k];
      var category = {
        id: index,
        name: value
      };
      var item  = '<div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">' +
                    '<div class="iplaun-field">' +
                      '<label>' +
                        '<input type="checkbox" name="categories_active[]" value="' + index + '" checked>' +
                        value +
                      '</label>' +
                    '</div>' +
                  '</div>';

      $( '.iplaun-categories-list' ).append( item );
      iplaunData.categories.push( category );

      //
      //Append category options
      $( '#iplaun-edit-content-popup .iplaun-data-category' )
        .append( '<option value="c:' + index + '">' + value + '</option>' );

      index++;
    });

    $( '#input-categories-name' ).val('');

    return false;
  });

  //
  //Post inputs
  $( '#input-posts-title' ).keyup( function()
  {
    var titles = $(this).val();
    var button = $( '.iplaun-add-submit button', $(this).parents( '.iplaun-fields' ) );

    if ( titles != '' ) {
      button.removeAttr( 'disabled' );
    } else {
      button.attr( 'disabled', 'disabled' );
    }
  });
  $( '#input-posts-title' ).focus( function()
  {
    var titles = $(this).val();
    var button = $( '.iplaun-add-submit button', $(this).parents( '.iplaun-fields' ) );

    if ( titles != '' ) {
      button.removeAttr( 'disabled' );
    } else {
      button.attr( 'disabled', 'disabled' );
    }
  });
  //
  //Add posts
  $( '#iplaun-section-post .iplaun-add-submit button' ).click( function()
  {
    var title  = $( '#input-posts-title' ).val();
    var titles = title.split("\n");
    var count  = iplaunData.posts.length;
    var index  = count + 1;

    $.each(titles, function(k)
    {
      var value = titles[k];
      var post  = {
        id: index,
        title: value
      };
      var link  = $( '<a class="iplaun-edit-link" data-type="post" href="#'+index+'"></a>' );
      link.append( '<i class="iplaun-fa iplaun-fa-pencil"></i>');
      link.click( function()
      {
        IPLaun_editContent( $(this) );
        return false;
      });

      var item  = '<div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">' +
                    '<div class="iplaun-field">' +
                      '<label>' +
                        '<input type="checkbox" name="posts_title[]" value="c:' + index + '" checked>' +
                        '<span>' + value + '</span>' +
                      '</label>' +
                    '</div>' +
                  '</div>';

      var $item = $(item);
      $( 'label', $item ).after( link );

      $( '.iplaun-posts-list' ).append( $item );
      iplaunData.posts.push( post );

      index++;
    });

    $( '#input-posts-title' ).val('');

    return false;
  });

  //
  //Page inputs
  $( '#input-pages-title' ).keyup( function()
  {
    var titles = $(this).val();
    var button = $( '.iplaun-add-submit button', $(this).parents( '.iplaun-fields' ) );

    if ( titles != '' ) {
      button.removeAttr( 'disabled' );
    } else {
      button.attr( 'disabled', 'disabled' );
    }
  });
  $( '#input-pages-title' ).focus( function()
  {
    var titles = $(this).val();
    var button = $( '.iplaun-add-submit button', $(this).parents( '.iplaun-fields' ) );

    if ( titles != '' ) {
      button.removeAttr( 'disabled' );
    } else {
      button.attr( 'disabled', 'disabled' );
    }
  });
  //
  //Add pages
  $( '#iplaun-section-page .iplaun-add-submit button' ).click( function()
  {
    var title  = $( '#input-pages-title' ).val();
    var titles = title.split("\n");
    var count  = iplaunData.pages.length;
    var index  = count + 1;

    $.each(titles, function(k)
    {
      var value = titles[k];
      var page  = {
        id: index,
        title: value
      };
      var link  = $( '<a class="iplaun-edit-link" data-type="page" href="#'+index+'"></a>' );
      link.append( '<i class="iplaun-fa iplaun-fa-pencil"></i>');
      link.click( function()
      {
        IPLaun_editContent( $(this) );
        return false;
      });

      var item  = '<div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">' +
                    '<div class="iplaun-field">' +
                      '<label>' +
                        '<input type="checkbox" name="pages_name[]" value="c:' + index + '" checked>' +
                        '<span>' + value + '</span>' +
                      '</label>' +
                    '</div>' +
                  '</div>';

      var $item = $(item);
      $( 'label', $item ).after( link );

      $( '.iplaun-pages-list' ).append( $item );
      iplaunData.pages.push( page );

      index++;
    });

    $( '#input-pages-title' ).val('');

    return false;
  });

  //
  //Get object in an array
  function IPLaun_getObjectInArray( id, data )
  {
    var object = false;
    $.each(data, function(k)
    {
      var item = data[k];
      if ( item.id == id ) {
        object = item;
        return;
      }
    });
    return object;
  };

  //
  //Get object in an array
  function IPLaun_setDataInArray( id, alldata, data )
  {
    $.each(alldata, function(k)
    {
      if ( alldata[k].id == id ) 
      {
        alldata[k] = data;
        return;
      }
    });
  };

  //
  //
  //Edit content handler
  //
  $( '.iplaun-edit-link' ).click( function()
  {
    var link  = $(this);
    IPLaun_editContent( link );

    return false;
  });
  //Close modal
  $( '.iplaun-ui-close-link' ).click( function()
  {
    ui.modal.popup_hide( $(this).parents( '.iplaun-ui-modal' ) );
    return false;
  });
  //
  //Save content
  $( '#iplaun-save-content-button' ).click( function()
  {
    var form     = $(this).parents( 'form' );
    var type     = $( '.iplaun-data-type', form ).val();
    var id       = $( '.iplaun-data-id', form ).val();
    var title    = $( '.iplaun-data-title', form ).val();
    var category = $( '.iplaun-data-category', form ).val();
    var content  = '';

    if ( typeof tinyMCE !== 'undefined' && $( '#wp-postcontent-wrap' ).hasClass( 'tmce-active' ) ) 
    {
      if ( tinyMCE.activeEditor ) {
        content = tinyMCE.activeEditor.getContent(); 
      }
    }
    else {
      content = $( '#postcontent' ).val();
    }

    if ( type == 'post' ) {
      var alldata = iplaunData.posts;
    } 
    else {
      var alldata = iplaunData.pages;
    }
    var data = {
      id: id,
      title: title,
      content: content,
      category: category
    }
    IPLaun_setDataInArray( id, alldata, data );

    //Change title
    if ( IPLaun_currentEdit )
    {
      var row = $( IPLaun_currentEdit ).parents('.iplaun-field-row');
      $( 'label span', row ).text( title );
    }

    //Hide modal
    ui.modal.popup_hide( $( '#iplaun-edit-content-popup' ) );

    return false;
  });

  //
  //Get object in an array
  var IPLaun_currentEdit = false;
  function IPLaun_editContent( link )
  {
    IPLaun_currentEdit = link;

    var id    = link.attr( 'href' ).replace( '#', '' );
    var type  = link.attr( 'data-type' );
    var modal = $( '#iplaun-edit-content-popup' );

    if ( type == 'post' ) {
      var data = IPLaun_getObjectInArray( id, iplaunData.posts );
    } 
    else {
      var data = IPLaun_getObjectInArray( id, iplaunData.pages );
    }

    if ( ! data ) {
      return false;
    }

    if ( type == 'page' ) {
      $( '.iplaun-field-category', modal ).hide();
    } 
    else {
      $( '.iplaun-field-category', modal ).show();
    }

    //Set content
    var content = '';
    if ( typeof data.content !== 'undefined' ) {
      content = data.content;
    }
    $( '.iplaun-data-type', modal ).val( type );
    $( '.iplaun-data-id', modal ).val( id );
    $( '.iplaun-data-title', modal ).val( data.title );
    $( '#postcontent' ).val( content );

    if ( typeof tinyMCE !== 'undefined' ) {
      if ( tinyMCE.activeEditor ) {
        tinyMCE.activeEditor.setContent( content ); 
      }
    }

    if ( typeof data.category !== 'undefined' ) 
    {
      $( '.iplaun-data-category', modal ).val( data.category );
    }

    //Show modal
    ui.modal.popup_show( modal );
  }

  //
  //Form handler
  $( '#iplaun-form-main-submit' ).click( function()
  {
    var button   = $(this);
    var form     = button.parents( 'form' );
    var nextStep = button.attr( 'data-step' );
    var currStep = nextStep - 1;

    $( '.iplaun-submit-text-next', button ).show();
    $( '.iplaun-submit-text-finish', button ).hide();
    $( '.iplaun-button-draft' ).hide();

    if ( currStep < 1 ) {
      currStep = 1;
    }
    if ( nextStep == 6 ) 
    {
      loader.show();
      //Finish
      IPLaun_finish( button, nextStep );
    }

    if ( nextStep == 5 )  
    {
      $( '.iplaun-submit-text-next', button ).hide();
      $( '.iplaun-submit-text-finish', button ).show();
      $( '.iplaun-button-draft' ).show();
    }

    var currentSection = $( '.iplaun-section[data-step="'+currStep+'"]' );
    var nextSection    = $( '.iplaun-section[data-step="'+nextStep+'"]' );

    currentSection.hide();
    nextSection.show();

    //
    //Activiting menu
    IPLaun_setMenu( nextStep );

    nextStep++;
    button.attr( 'data-step', nextStep );

    return false;
  });

  //
  //Sidebar
  $( '.iplaun-page-menu a' ).click( function()
  {
    if ( $(this).hasClass( 'disabled' )) {
      return false;
    }

    var button      = $( '#iplaun-form-main-submit' );
    var step        = $(this).attr( 'data-step' );
    var linkCurrent = $( '.iplaun-page-menu a.current' );
    var currStep    = linkCurrent.attr( 'data-step' );

    IPLaun_setMenu( step );

    $( '.iplaun-submit-text-next', button ).show();
    $( '.iplaun-submit-text-finish', button ).hide();
    $( '.iplaun-button-draft' ).hide();

    if ( step == 5 ) {
      $( '.iplaun-submit-text-next', button ).hide();
      $( '.iplaun-submit-text-finish', button ).show();
      $( '.iplaun-button-draft' ).show();
    }

    var currentSection = $( '.iplaun-section[data-step="'+currStep+'"]' );
    var nextSection    = $( '.iplaun-section[data-step="'+step+'"]' );

    currentSection.hide();
    nextSection.show();

    var stepNum  = new Number( step );
    var nextStep = stepNum + 1;
    button.attr( 'data-step', nextStep );

    return false;
  });

  //
  //Set menu
  function IPLaun_setMenu( step )
  {
    var menu = $( '.iplaun-page-menu a[data-step="'+step+'"]' );

    $( '.iplaun-page-menu a.current' ).addClass( 'active' );
    $( '.iplaun-page-menu a' ).removeClass( 'current' );
    menu.removeClass( 'disabled' )
        .addClass( 'current' );

    //Set page info based on menu
    var pageTitle = $( '.iplaun-tab-menu-label strong', menu ).text();
    var pageDesc  = $( '.iplaun-tab-menu-label em', menu ).text();
    var pageIcon  = $( 'i', menu ).attr( 'class' );

    $( '.iplaun-page-info i' ).attr( 'class', pageIcon );
    $( '.iplaun-page-info .iplaun-info h4' ).text( pageDesc );
    $( '.iplaun-page-info .iplaun-info h3' ).text( pageTitle );
  };

  //
  //Finish 
  function IPLaun_finish( button )
  {
    var jsondata = IPLaun_getPostData();

    $.ajax({
      url: ajaxurl+'?doajax=1&iplaun=1&action=install',
      type: "POST",
      data: jsondata,
      dataType: "json",
      processData: false,
      contentType: "application/json",
      success: function ( result ) 
      {
        window.location.href = result.redirect;
        return;
      }
    });
  };

  function IPLaun_getPostData()
  {
    var data = {
      'wp_ez_launcher': 1,
      'raw': {
        'pages':      iplaunData.pages,
        'posts':      iplaunData.posts,
        'categories': iplaunData.categories
      }
    }

    var root      = $( '.iplaun-primary' );
    var selector  = 'input[type=text]';
    selector += ', input[type=hidden]';
    selector += ', input[type=password]';
    selector += ', input[type=radio]:checked';
    selector += ', input[type=checkbox]:checked';
    selector += ', textarea';
    selector += ', select';

    var posts      = '';
    var pages      = '';
    var plugins    = '';
    var categories = '';

    $( selector, root ).each( function()
    {
      var name  = $(this).attr( 'name' );
      var value = $(this).val();

      if ( name != 'posts_title[]' && name != 'pages_name[]' && name != 'plugins_active[]' && name != 'categories_active[]' )
      {
        data[name] = value;
      }
      else if ( name == 'posts_title[]' )
      {
        posts += '|' + value;
      }
      else if ( name == 'pages_name[]' )
      {
        pages += '|' + value;
      }
      else if ( name == 'plugins_active[]' )
      {
        plugins += '|' + value;
      }
      else if ( name == 'categories_active[]' )
      {
        categories += '|' + value;
      }
    });

    data['posts']      = posts;
    data['pages']      = pages;
    data['plugins']    = plugins;
    data['categories'] = categories;

    var jsondata = JSON.stringify(data);

    return jsondata;
  };

  //
  //Save draft
  //
  $( '#iplaun-submit-save-draft' ).click( function()
  {
    loader.show();

    var jsondata = IPLaun_getPostData();

    $.ajax({
      url: ajaxurl+'?doajax=1&iplaun=1&action=savedraft',
      type: "POST",
      data: jsondata,
      dataType: "json",
      processData: false,
      contentType: "application/json",
      success: function ( result ) 
      {
        loader.hide();
        window.location.href = result.redirect;
        return;
      }
    });

    return false;
  });

})(jQuery);

},{"./../libs/button-active.js":2,"./../libs/collapse.js":3,"./../libs/fademenu.js":4,"./../libs/fancy-option.js":5,"./../libs/form.js":6,"./../libs/image-option.js":7,"./../libs/manage.js":8,"./../libs/onoff.js":9,"./../libs/select-preview.js":10,"./../libs/stat.js":11,"./../libs/tab.js":12,"./../libs/ui.js":13,"./../libs/uploader.js":14}],2:[function(require,module,exports){
/*
 *===========================================================
 * Button active
 *===========================================================*/

var buttonActive;
(function($)
{
    "use strict";

    buttonActive = function( button, options )
    {
        var defaults  = {
            func_select: function( button ){}
        };
        var opt = $.extend( defaults, options );

        button.click( function()
        {
            if ( $(this).hasClass( 'active' )) {
                $(this).removeClass( 'active' );
                $( 'input', $(this) ).val( 'off' );
            } else {
                $(this).addClass( 'active' );
                $( 'input', $(this) ).val( 'on' );
            }

            //Select callback
            opt.func_select( $(this) );
            return false;
        });
    };

})(jQuery);

module.exports = buttonActive;

},{}],3:[function(require,module,exports){
/*
 *===========================================================
 * Toggle/Collapse
 *===========================================================*/
var collapse;

(function($)
{
    "use strict";

    collapse = function( root )
    {
        //
        //init
        //
        $( '.intm-options-section' ).each( function()
        {
            if ( $(this).is( ":hidden" ) ) {
                $(this).addClass( '_tempshow' ).show();
            }
        });
        $( '.intm-option-fields' ).each( function()
        {
            if ( $(this).is( ":hidden" ) ) {
                $(this).addClass( '_tempshow' ).show();
            }
        });

        root.each( function()
        {
            var cont   = $(this);
            var height = $( '.collapse-content', cont ).height();
            $( '.collapse-trigger', cont ).click( function()
            {
                if ( cont.hasClass( 'open' ))
                {
                    cont.removeClass( 'open' );
                    cont.addClass( 'close' );
                    $( '.intm-panel-actions i', $(this) ).removeClass( 'intm-fa-chevron-down' );
                    $( '.intm-panel-actions i', $(this) ).addClass( 'intm-fa-chevron-right' );
                    $( '.collapse-content', cont )
                        .height( height )
                        .animate(
                            { height: 0 }, 500
                        );
                }
                else
                {
                    cont.removeClass( 'close' );
                    cont.addClass( 'open' );
                    $( '.intm-panel-actions i', $(this) ).removeClass( 'intm-fa-chevron-right' );
                    $( '.intm-panel-actions i', $(this) ).addClass( 'intm-fa-chevron-down' );
                    $( '.collapse-content', cont )
                        .height( 0 )
                        .show()
                        .animate(
                            { height: height }, 500
                        );

                }
                return false;
            });
        });

        $( '._tempshow' ).hide();
    };

})(jQuery);

module.exports = collapse;

},{}],4:[function(require,module,exports){
/*
 *===========================================================
 * Fade Menu
 *===========================================================*/
var fademenu;

(function($)
{
  "use strict";

  fademenu = function( root )
  {
    $(root).each( function()
    {
      var button = $(this);
      var mouse_in_menu = false;
      $( '.iplaun-fademenu-button', button ).click( function()
      {
        $( '.iplaun-fademenu-content' ).fadeOut( "fast" );
        $( '.iplaun-fademenu-button' ).removeClass( 'active' );

        var link    = $(this);
        var content = $( '.iplaun-fademenu-content', button );

        if ( content.is(":visible") ) {
          content.fadeOut( "fast" );
          link.removeClass( 'active' );
        } else {
          content.fadeIn( "fast" );
          link.addClass( 'active' );
        }
        return false;
      });

      $( '.iplaun-fademenu-content', button ).hover( function(){
        mouse_in_menu = true;
      }, function(){
        mouse_in_menu = false;
      });
      $( "body" ).click(function(){
        if ( ! mouse_in_menu ) {
          $( '.iplaun-fademenu-content', button ).fadeOut( "fast" );
          $( '.iplaun-fademenu-button', button ).removeClass( 'active' );
        }
      });
      $( '.iplaun-fademenu-content a', button ).click(function(){
        return true;
      });
    });
  };
})(jQuery);

module.exports = fademenu;

},{}],5:[function(require,module,exports){
/*
 *===========================================================
 * Fancy Option
 *===========================================================*/
var option;

(function($)
{
    "use strict";

    //Fancy option
    option = function( items, options ){

        var defaults  = {
            func_select: function( option ){},
        };
        var options = $.extend( defaults, options );

        //Setup
        $( '.iplaun-select li:first-child' ).addClass( 'iplaun-item-selected' );

        $(items).each( function(){

            var option  = $(this);
            var in_menu = false;

            $( '.iplaun-selected', option ).click( function(){

                var menu   = $(this);
                var select = $( '.iplaun-select', option );

                if ( select.is(":visible") ) {
                    select.fadeOut( "fast" );
                    menu.removeClass( 'active' );
                } else {

                    $( '.iplaun-select' ).each( function(){
                        $(this).fadeOut( "fast" );
                        $(this).parents( '.iplaun-selected' ).removeClass( 'active' );
                    });
                    select.fadeIn( "fast" );
                    menu.addClass( 'active' );
                }
                return false;
            });
            $( '.iplaun-select', option ).hover( function(){
                    in_menu = true;
                }, function(){
                    in_menu = false;
            });
            $( "body" ).click(function(){
                if ( ! in_menu ) {
                    $( '.iplaun-select', option ).fadeOut( "fast" );
                    $( '.iplaun-selected', option ).removeClass( 'active' );
                }
            });

            $( 'li', option ).click( function(){

                var item  = $(this);
                var label = $( '.iplaun-select-label', item ).clone().html();
                var data  = item.data( 'select' );
                $( '.iplaun-selected .iplaun-selected-box', option ).html( label );
                $( '.iplaun-select li', option ).removeClass( 'iplaun-item-selected' );
                item.parents( 'li' ).addClass( 'iplaun-item-selected' );
                $( '.iplaun-input-select', option ).val( data );

                //Hide Select box
                $( '.iplaun-select', option ).fadeOut( "fast" );
                $( '.iplaun-selected', option ).removeClass( 'active' );

                options.func_select( option );
            });

        });

    };

})(jQuery);

module.exports = option;

},{}],6:[function(require,module,exports){
/*
 *===========================================================
 * Form Handler
 *===========================================================
 */
 var formHandler;
 var uifunc = require( './../libs/ui.js' );

(function($)
{
    "use strict";

    //Prepare ui
    if (typeof iplaun_img_url != 'undefined') {
        uifunc.base.construct.prototype.image_base = iplaun_img_url;
    }
    uifunc.base.confirm.prototype.set_ajax = function( ajax_url )
    {
        this.ajax_url = ajax_url;
    };
    uifunc.init();

    /**
     * Form handler
     */
    function ip_form( id ){
        this.form   = $( id );
        this.action = this.form.attr( 'action' );
    }
    //Set vars
    ip_form.prototype =
    {
        //Variables
        button_id:          '.iplaun-form-submit',
        cont_id:            '.iplaun-form-container',
        error_process:      'Error',
        success_process:    'Success',
        ajax_type:          'POST',
        ajax_dataType:      'json',

        afterSuccess:        function(){},

        //Init
        init: function()
        {
            var $this = this;
            //Prepare
            this.prepare();
            //Form submit
            $( this.button_id, $this.form ).click( function()
            {
                if ( $this.validator() ) {
                    if ( $this.before() ) {
                        uifunc.loader.show();
                        var data   = $this.get_data();
                        var result = $this.process();
                        $this.after( result );
                    }
                }
                $this.error();
                return false;
            });
        },
        //Prepare form
        prepare: function(){},
        //Main process
        process: function()
        {
            var $this = this;
            var data  = $this.get_data();
            $.ajax({
                url: $this.action,
                type: $this.ajax_type,
                dataType: $this.ajax_dataType,
                data: data,
                success: function( result ) {
                    $this.ajax_success( result, $this );
                },
                error: function() {
                    $this.ajax_error( $this );
                }
            });
        },
        //Before process
        before: function()
        {
            return true;
        },
        //After process
        after: function( result ){},
        //Process if error
        error: function(){},
        //Process if ajax success
        ajax_success: function( result, $this )
        {
            $( '.ui-message', $this.form ).remove();
            uifunc.loader.hide();
            if ( result.status == 1 ) {
                if ( typeof result.redirect != 'undefined' ) {
                    window.location.href = result.redirect;
                } else {
                    if ( typeof result.reset != 'undefined' ) {
                        $this.form[0].reset();
                    }
                    uifunc.message.modal( result.message, 'alert-success' );
                    this.afterSuccess( result, $this );
                }
            } else {
                uifunc.message.modal( result.message, 'alert-danger' );
            }
        },
        //Process if ajax error
        ajax_error: function( $this )
        {
            uifunc.loader.hide();
            uifunc.message.modal( $this.error_process, 'alert-danger' );
        },

        //Validating form data
        validator: function()
        {
            return true;
        },
        check_empty: function( id, message )
        {
            var input = $( id );
            if ( input.val() == '' ) {
                uifunc.message.block( message, 'ip-ui-danger', input );
                return true;
            }
            return false;
        },

        //Get data form
        get_data: function()
        {
            var root = this.form;
            var selector  = 'input[type=text]';
            selector += ', input[type=hidden]';
            selector += ', input[type=password]';
            selector += ', input[type=radio]:checked';
            selector += ', input[type=checkbox]:checked';
            selector += ', textarea';
            selector += ', select';

            var data = '';
            $( selector, root ).each( function(){
                var name  = $(this).attr( 'name' );
                var value = encodeURIComponent( $(this).val() );

                if ( data != '' ) {
                    data += '&';
                }
                data += name+'='+value;
            });
            if (typeof tinyMCE !== 'undefined') {
                for ( var edId in tinyMCE.editors ) {

                    if ( edId.length > 1 ) {
                        var value = tinyMCE.editors[edId].getContent();
                        if ( data != '' ) {
                            data += '&';
                        }
                        data += edId+'='+value;
                    }
                }
            }
            data = this.additional_data( data );
            return data;
        },
        additional_data: function( data )
        {
            return data;
        },

        //Get tiny mce object
        get_tinymce: function( contentId )
        {
            var content = '';
            if (typeof tinyMCE !== 'undefined') {
                content = tinyMCE.get( contentId ).getContent();
            }
            return content;
        },
        //Set tiny mce object with a content
        set_tinymce: function( contentId, content )
        {
            if (typeof tinyMCE !== 'undefined') {
                tinyMCE.get( contentId ).setContent( content );
            }
        }
    };
    formHandler = ip_form;

})(jQuery);

module.exports = formHandler;

},{"./../libs/ui.js":13}],7:[function(require,module,exports){
/*
 *===========================================================
 *  Input image option
 *===========================================================*/
var option;

(function($)
{
    "use strict";

    option = function( root, options )
    {
        var defaults  = {
            after: function( item ){},
        };
        var options = $.extend( defaults, options );

        root.each( function()
        {
            var input = $(this);

            $( '._item', input ).click( function()
            {
                $( '._item', input ).removeClass( '_selected' );
                var value = $(this).data( 'value' );
                $(this).addClass( '_selected' );
                $( '._value-selected', input ).val( value );
                //
                //Callback
                options.after( value, input );
                return false;
            })
        });
    };

})(jQuery);

module.exports = option;

},{}],8:[function(require,module,exports){
/*
 *===========================================================
 * Manage script
 *===========================================================*/
var uifunc = require( './../libs/ui.js' );
var manage;

(function($)
{
    "use strict";

    var delete_confirm_title = '';
    var delete_confirm_info  = '';

    if (typeof ui_message != 'undefined') {
        if (typeof ui_message.delete_confirm_title != 'undefined') {
            delete_confirm_title = ui_message.delete_confirm_title;
        }
        if (typeof ui_message.delete_confirm_info != 'undefined') {
            delete_confirm_info = ui_message.delete_confirm_info;
        }
    }

    //Prepare ui
    if (typeof ui_base_image != 'undefined') {
        uifunc.base.construct.prototype.image_base = ui_base_image;
    }
    uifunc.base.confirm.prototype.set_ajax = function( ajax_url )
    {
        this.ajax_url = ajax_url;
    };

    uifunc.init();
    uifunc.delete_confirm = new uifunc.base.confirm();

    uifunc.delete_confirm.set_vars({
        title: delete_confirm_title,
        info: delete_confirm_info,
        yes_class:  'iplaun-btn iplaun-btn-md iplaun-btn-danger',
        no_class:   'iplaun-btn iplaun-btn-md iplaun-btn-default',
        action:     function( object, ui )
        {
            var id = object.data( 'id' );
            uifunc.loader.show();
            ui.hide( object );

            $.ajax({
                url: ui.ajax_url + '&id='+id,
                type: "POST",
                dataType: "json",
                success: function (result)
                {
                    if ( object.hasClass( 'iplaun-delete-edit' ) )
                    {
                        window.location.href = result.redirect;
                    } else
                    {
                        if ( result.status == '-1' ) {
                            uifunc.message.modal( result.message, 'alert-danger' );
                        } else {
                            uifunc.message.modal( result.message, 'alert-success' );
                            ui.vars.remove_element( object, ui );
                        }
                        uifunc.loader.hide();
                    }
                },
                error: function () {
                    alert( "Error in deleting item." );
                },
            });
        },
        remove_element: function( object, ui )
        {
            var tr = object.parents( 'tr' );
            tr.hide( 'blind' );
            setTimeout( function(){
                tr.remove();
            }, 600);
        }
    });

    manage = {
        delete: function( items, url )
        {
            $(items).each( function()
            {
                var button = $(this);
                button.click( function()
                {
                    uifunc.delete_confirm.set_ajax( url );
                    uifunc.delete_confirm.set_vars({
                        remove_element: function( object, ui ){
                            var cont   = object.parents( '.iplaun-manage-list' );
                            var item   = object.parents( '.iplaun-list-item' );
                            var length = $( '.iplaun-list-item', cont ).length;

                            item.hide( 'blind' );
                            if ( length == 1 ) {
                                $( '.iplaun-list-empty', cont ).show();
                            }
                            setTimeout( function(){
                                item.remove();
                            }, 600);
                        }
                    });
                    uifunc.delete_confirm.show( button );
                    return false;
                });
            });
        }
    }
})(jQuery);

module.exports = manage;

},{"./../libs/ui.js":13}],9:[function(require,module,exports){
/*
 *===========================================================
 * On Off Button
 *===========================================================*/
var onoff;

(function($)
{
    "use strict";

    /**
     * On Off button
     */
    onoff = function( root, options )
    {
        var defaults  = {
            func_select: function( button ){},
        };
        var options = $.extend( defaults, options );

        $(root).each( function(){

            var cont = $(this);
            $( '.iplaun-btn-onoff', cont ).click( function()
            {
                var value = $(this).data( 'value' );
                if ( ! $(this).hasClass( 'active' ) ) {
                    $( 'button', cont ).removeClass( 'active' );
                    $( 'button', cont ).removeClass( 'iplaun-btn-on' );
                    $( 'button', cont ).removeClass( 'iplaun-btn-off' );
                    if ( value == true ) {
                        $(this).addClass( 'iplaun-btn-on' );
                    } else {
                        $(this).addClass( 'iplaun-btn-off' );
                    }
                    $(this).addClass( 'active' );
                }
                $( '.iplaun-onoff-value', cont ).val(value);

                var field = $(this).parents( '.iplaun-field-row' );
                if ( field.hasClass( 'iplaun-toggle' )) {

                    if ( value == 'false' || value == false ) {
                        $( '.iplaun-toggle-option', field ).hide();
                    } else {
                        $( '.iplaun-toggle-option', field ).show();
                    }
                }
                options.func_select( $(this), cont );
                return false;
            });
        });
    };

})(jQuery);

module.exports = onoff;

},{}],10:[function(require,module,exports){
/*
 *===========================================================
 * Select preview
 *===========================================================*/

var selectPreview;

(function($)
{
    "use strict";

    selectPreview = function( input, options )
    {
        var defaults  = {
            cont_selector:          '.iplaun-field-row',
            cont_preview_selector:  '.iplaun-select-preview',
            item_preview_class:     'iplaun-preview',
            root_image:             '',
            preview_data:           [],
            func_select:            function( input ){}
        };
        var opt  = $.extend( defaults, options );
        var cont = input.parents( opt.cont_selector );

        input.change( function()
        {
            var select  = $(this).val();
            var preview = $( opt.cont_preview_selector, cont );
            var opts    = opt.preview_data;
            preview.html( '' );
            for (var i = 0; i < opts.length; i++)
            {
                var key = opts[i];
                var src = opt.root_image+select+'/'+key+'.png';
                preview.append(
                    '<span class="'+opt.item_preview_class+'"><img src="'+src+'" alt="'+key+'"></span>'
                );
            }
            opt.func_select( $(this) );
        });
    };

})(jQuery);

module.exports = selectPreview;

},{}],11:[function(require,module,exports){
/*
 *===========================================================
 * Tab menu
 *===========================================================*/
var stat;

(function($)
{
    "use strict";

    stat = function( object, options )
    {
        var defaults  = {
            ajax_url: '',
            chart_id:  'iplaun-chart-div'
        };
        var iplaun_opt = $.extend( defaults, options );

        var root = $(object);

        //Date picker
        $( '#date-start',root )
            .datepicker()
            .bind('changeDate', function(ev){
                $( '#date-start',root ).datepicker('hide');
            });

        $( '#date-end', root )
            .datepicker()
            .bind('changeDate', function(ev){
                $( '#date-end',root ).datepicker('hide');
            });

        //Do filter date
        $( '#do-filter-date', root ).click( function()
        {
            var dateStart = $( '#date-start' ).val();
            var dateEnd   = $( '#date-end' ).val();
            var pageId    = $( '#value-pageid' ).val();
            var type      = $( '#value-stat-type' ).val();

            //Show loader
            $( '.iplaun-chart-main', root ).html('').hide();
            $( '.iplaun-chart-load', root ).show();

            $.ajax({
                url: iplaun_opt.ajax_url,
                type: "POST",
                data: 'start='+dateStart+'&end='+dateEnd+'&pageid='+pageId+'&type='+type,
                dataType: "json",
                success: function (result ) {

                    $( '.iplaun-chart-main' ).show();
                    $( '.iplaun-chart-load' ).hide();
                    if ( result.status == 1 && result.data.length > 0 )
                    {
                        var dataTable = new google.visualization.DataTable();
                        dataTable.addColumn( 'date', result.labelDate );
                        dataTable.addColumn( 'number', result.labelValue );

                        var rows = [];
                        for (var i=0; i<result.data.length; i++)
                        {
                            var cur   = result.data[i];
                            var data  = [ new Date( cur.year, cur.mon, cur.day ), cur.value ];
                            rows.push( data );
                        }
                        dataTable.addRows( rows );
                        var options = {
                            series: [{pointSize:6}]
                        };
                        var chart = new google.visualization.LineChart(document.getElementById(iplaun_opt.chart_id));
                        chart.draw(dataTable, options);
                    }
                },
                error: function () {
                    alert( "Error in get statistic data" );
                },
            });

            return false;
        });

        //Stat Nav
        $( '.iplaun-stat-nav a' ).click( function()
        {
            var link   = $(this);
            var root   = link.parents( 'li' );
            var type   = link.attr( 'href' ).replace( '#stat-', '' );
            var pageId = $( '#value-pageid' ).val();

            if ( root.hasClass( 'active' )) {
                return true;
            }
            $( '.iplaun-stat-nav li' ).removeClass( 'active' );
            root.addClass( 'active' );
            $( '#value-stat-type' ).val( type );

            //Show loader
            $( '.iplaun-chart-main' ).html('').hide();
            $( '.iplaun-chart-load' ).show();

            //Load cart
            $.ajax({
                url: iplaun_opt.ajax_url,
                type: "POST",
                data: 'pageid='+pageId+'&type='+type,
                dataType: "json",
                success: function (result ) {

                    $( '.iplaun-chart-main' ).show();
                    $( '.iplaun-chart-load' ).hide();
                    if ( result.status == 1 && result.data.length > 0 )
                    {
                        var dataTable = new google.visualization.DataTable();
                        dataTable.addColumn( 'date', result.labelDate );
                        dataTable.addColumn( 'number', result.labelValue );

                        var rows = [];
                        for (var i=0; i<result.data.length; i++)
                        {
                            var cur   = result.data[i];
                            var data  = [ new Date( cur.year, cur.mon, cur.day ), cur.value ];
                            rows.push( data );
                        }
                        dataTable.addRows( rows );
                        var options = {
                            series: [{pointSize:6}]
                        };
                        var chart = new google.visualization.LineChart(document.getElementById(iplaun_opt.chart_id));
                        chart.draw(dataTable, options);
                    }
                },
                error: function () {
                alert( "Error in get statistic data" );
                },
            });

            return false;
        });
    };

})(jQuery);

module.exports = stat;

},{}],12:[function(require,module,exports){
/*
 *===========================================================
 * Tab menu
 *===========================================================*/
var tab;

(function($)
{
    "use strict";

    tab = function( object, options )
    {
        var defaults  = {
            after_click:     function(){},
            tab_init:        function(){}
        };
        var opt  = $.extend( defaults, options );

        $(object).each( function()
        {
            var root = $(this);

            tab_init();

            $( '.iplaun-tab-menu a', root ).click( function()
            {
                clear_tab();
                $( this ).addClass( 'active' );

                var idtab = $(this).attr( 'href' ).replace( '#', '' );
                $( '#'+idtab ).show();
                $( '#iplaun-tab-selected' ).val( idtab );

                opt.after_click( idtab, root );

                return false;
            });

            function clear_tab()
            {
                $( '.iplaun-tab-menu a', root ).each( function(){
                    $(this).removeClass( 'active' );
                });
                $( '.iplaun-tab-content', root ).hide();
            };

            function tab_init()
            {
                clear_tab();
                $( '#iplaun-tab-selected', root ).hide();
                var current = $( '#iplaun-tab-selected' ).val();
                $( '#'+current ).show();
                $( 'a[href="#'+current+'"]' ).addClass( 'active' );
                $( '#iplaun-tab-selected' ).val( current );

                opt.tab_init( current, root );
            };
        });
    };

})(jQuery);

module.exports = tab;

},{}],13:[function(require,module,exports){
/*
 *===========================================================
 * UI
 *===========================================================
 */
var ui;

(function($)
{
    "use strict";

    //Inherit function
    function inherit( proto )
    {
        function F() {}
        F.prototype = proto
        return new F
    }

    /*
     *===========================================================
     * Ui prototype
     *===========================================================*/
    function ui_construct( options ){};

    ui_construct.prototype =
    {

        vars:               {},
        class_prefix:       'iplaun-',
        class_main:         '-main',
        class_title:        '-title',
        class_content:      '-content',
        class_disabled:     'disabled',
        class_close:        'ui-close',
        label_close:        'x',
        image_base:         '',

        top_margin:         '1px',
        overlay_speed:      600,
        main_speed:         400,
        show_speed:         4000,

        show_after:         function(){},
        hide_after:         function(){},

        popup_body: function( class_root, content, title, close )
        {
            var body = $( '<div class="'+class_root+'"></div>' );
            var main = $( '<div class="'+class_root + this.class_main+'"></div>' );
            if ( title )
            {
                var _title = $( '<div class="'+class_root + this.class_title+'"></div>' )
                                .append( '<h3>'+title+'</h3>' );
                if ( close )
                {
                    var _close = $( '<a href="#">'+this.label_close+'</a>' );
                    this.popup_close( _close, class_root );

                    _title.append(
                        $( '<div class="'+this.class_prefix+this.class_close+'"></div>' ).append( _close )
                    );
                }
                main.append( _title );
            }
            if ( content ) {
                main.append(
                    $( '<div class="'+class_root + this.class_content+'"></div>' ).append( content )
                );
            }
            body.append( main );
            return body;
        },
        popup_show: function( popup )
        {
            var c_root = popup.attr( 'class' );
            var main   = $( '.'+c_root+this.class_main, popup );
            popup.show();
            main.css( 'margin-top', '-40%' )
                .animate({marginTop: this.top_margin}, this.main_speed, this.show_after);
        },
        popup_hide: function( popup )
        {
            var c_root = popup.attr( 'class' );
            var main   = $( '.'+c_root+this.class_main, popup );

            popup.animate( {opacity: 0}, this.overlay_speed, function(){
                $(this).css( 'opacity', 1 )
                       .hide();
            });
            main.animate( {marginTop: '-60%'}, this.main_speed, this.hide_after);
        },
        popup_close: function( button, class_popup )
        {
            var ui = this;
            button.click( function(){
                var popup = $( '.'+class_popup );
                ui.popup_hide( popup );
                return false;
            });
        },
        is_load: function( selector )
        {
            if ( $( selector ).length > 0 ) {
                return true;
            }
            return false;
        },
        set_vars: function( options )
        {
            this.vars = $.extend(this.vars, options);
        },
        set_base_vars: function( options )
        {
            this.vars = $.extend(this, options);
        },
        go_to: function( selector )
        {
            var pos = $( selector ).position();
            $('html, body').animate({scrollTop: ( pos.top )}, 600);
            return false;
        }
    };

    /*
     * Modal Class
     **/
    function modal(){};
    modal.prototype = inherit( ui_construct.prototype );
    //Modal message
    modal.prototype.ajax = function( id, url )
    {
        var ui      = this;
        var c_root  = this.class_prefix + this.class_modal;
        var modal   = this.popup_body( c_root, '', false, false ).appendTo( $( 'body' ) );
        modal.addClass( class_type )
             .attr( 'id', id );

        this.popup_show( modal );
    };

    /*
     * Loader Class
     **/
    function loader(){};
    loader.prototype = inherit( ui_construct.prototype );
    //Properties
    loader.prototype.class_root     = 'ui-loader';
    loader.prototype.loader_file    = 'loading.gif';
    //Show loader
    loader.prototype.show = function()
    {
        var loader = this.create();
        this.popup_show( loader );
    };
    //Hide loader
    loader.prototype.hide = function()
    {
        var loader = this.create();
        this.popup_hide( loader );
    };
    //Create loader
    loader.prototype.create = function()
    {
        var c_root = this.class_prefix + this.class_root;
        if ( this.is_load( '.'+c_root )) {
            return $( '.'+c_root );
        } else
        {
            var image  = '<img src="'+this.image_base+this.loader_file+'" alt="Loading...">';
            var loader = this.popup_body( c_root, image, false, false ).appendTo( $( 'body' ) );
            loader.hide();

            return loader;
        }
    };


    /*
     * Inline loader Class
     **/
    function iloader(){};
    iloader.prototype = inherit( ui_construct.prototype );
    //Properties
    iloader.prototype.class_root   = 'ui-inline-loader';
    iloader.prototype.loader_file  = 'spin.gif';
    //Loader show
    iloader.prototype.show = function( button )
    {
        button.attr( 'disabled', 'disabled' );
        this.create( button ).show();
    };
    //Loader hide
    iloader.prototype.hide = function( button )
    {
        button.removeAttr( 'disabled' );
        this.create( button ).hide();
    };
    //Creating loader
    iloader.prototype.create = function( button )
    {
        var root   = button.parent();
        var lclass = this.class_prefix + this.class_root;
        if ( $( '.'+lclass, root ).length > 0 ) {
            var loader = $( '.'+lclass, root );
        } else {
            var image  = '<img src="'+this.image_base+this.loader_file+'" alt="Loading...">';
            var loader = $( '<span class="'+lclass+'"></span>' )
                            .append( image )
                            .css( 'margin-left', '8px' );
        }
        button.after( loader );
        return loader;
    };


    /*
     * Confirm popup
     **/
    function confirm( options )
    {
        var defaults = {
            title:      'Confirmation',
            info:       '',
            yes_label:  'Yes',
            no_label:   'Cancel',
            yes_class:  'btn btn-danger',
            no_class:   'btn btn-success',
            action:     function( object ){}
        };
        this.vars = $.extend(defaults, options);
    };
    confirm.prototype = inherit( ui_construct.prototype );
    //Properties
    confirm.prototype.class_root = 'ui-confirm';
    //Confirm show
    confirm.prototype.show = function( object )
    {
        var confirm = this.create( object );
        this.popup_show( confirm );
    };
    //Confirm hide
    confirm.prototype.hide = function( object )
    {
        var confirm = this.create( object );
        this.popup_hide( confirm );
    };
    //Creating confirm
    confirm.prototype.create = function( object )
    {
        var ui     = this;
        var c_root = this.class_prefix + this.class_root;
        if ( this.is_load( '.'+c_root )) {
            $( '.'+c_root ).remove();
        }
        //Create confirm
        var yesbtn = $( '<a href="#" class="ip-confirm-yes '+this.vars.yes_class+'">'+this.vars.yes_label+'</a>' );
        var nobtn  = $( '<a href="#" class="ip-confirm-no '+this.vars.no_class+'">'+this.vars.no_label+'</a>' );

        yesbtn.click( function(){
            ui.vars.action( object, ui );
            return false;
        });
        this.popup_close( nobtn, c_root );

        var content = $( '<div class="'+c_root+'-inner"></div>' )
            .append( '<p>'+this.vars.info+'</p>' )
            .append(
                $( '<div class="'+c_root+'-actions"></div>' )
                    .append( yesbtn )
                    .append( nobtn )
            );

        var confirm = this.popup_body( c_root, content, this.vars.title, false ).appendTo( $( 'body' ) );
        confirm.hide();

        return confirm;
    };


    /*
     * Alert popup
     **/
    function alert( options )
    {
        var defaults = {
            message:        '',
            label_button:   'Ok',
            class_root:     '',
            class_button:   'iplaun-btn iplaun-btn-sm iplaun-btn-danger',
            after:          function(){}
        };
        this.vars = $.extend(defaults, options);
    };
    alert.prototype = inherit( ui_construct.prototype );
    //Properties
    alert.prototype.class_root = 'ui-alert';
    //Alert show
    alert.prototype.show = function( message )
    {
        this.vars.message = message;
        var alert = this.create();
        this.popup_show( alert );
    };
    //Alert hide
    alert.prototype.hide = function()
    {
        var alert = this.create();
        this.hide_after = this.vars.after;
        this.popup_hide( alert );
    };
    //Creating alert
    alert.prototype.create = function()
    {
        var ui     = this;
        var c_root = this.class_prefix + this.class_root;
        if ( this.is_load( '.'+c_root )) {
            return $( '.'+c_root );
        } else
        {
            var button = $( '<a href="#" class="'+this.vars.class_button+'">'+this.vars.label_button+'</a>' );
            this.popup_close( button, c_root );

            var c_info  = c_root + '-inner';
            if ( this.vars.class_root != '' ) {
                c_info += ' ' + this.vars.class_root;
            }
            var content = $( '<div class="'+c_info+'"></div>' )
                .append( '<p>'+this.vars.message+'</p>' )
                .append(
                    $( '<div class="'+c_root+'-actions"></div>' )
                        .append( button )
                );

            var popup  = this.popup_body( c_root, content, false, false ).appendTo( $( 'body' ) );
            popup.hide();

            return popup;
        }
    };


    /*
     * Message
     **/
    function message(){};
    message.prototype = inherit( ui_construct.prototype );
    //Properties
    message.prototype.class_modal = 'ui-modal-message';
    message.prototype.class_block = 'ui-message';
    //Modal message
    message.prototype.modal = function( message, class_type )
    {
        var ui      = this;
        var c_root  = this.class_prefix + this.class_modal;
        var content = '<p>'+message+'</p>';
        var msg     = this.popup_body( c_root, content, false, false ).appendTo( $( 'body' ) );
        msg.addClass( class_type )
           .show()
           .animate({top: "0"}, ui.overlay_speed, function(){
                var object = $( this );
                setTimeout( function(){
                    object.animate({top: '-100px'}, ui.overlay_speed, function(){
                        object.remove();
                    });
                }, ui.show_speed);
            });
    };
    //Bloack message
    message.prototype.block = function( message, class_type, block, close )
    {
        var ui      = this;
        var c_root  = this.class_prefix + this.class_block;
        var parent  = block.parent();

        $( '.'+c_root, parent ).remove();

        var msg = $( '<div></div>' );
        msg.addClass( c_root )
           .addClass( class_type )
           .append( '<p>'+message+'</p>' );

        if ( close )
        {
            var _close = $( '<a href="#">'+this.close_label+'</a>' );
            _close.click( function()
            {
                var _msg = $(this).parents( '.'+c_root );
                _msg.animate({opacity: "0"}, ui.overlay_speed, function(){
                    _msg.remove();
                });
                return false;
            });
            msg.append(
                $( '<div class="'+this.class_prefix+this.class_close+'"></div>' ).append( _close )
            );
        }
        msg.css( 'opacity', '0' );
        parent.prepend( msg );
        msg.animate({opacity: "1"}, ui.overlay_speed);
    };

    ui =
    {
        base: {
            construct:  ui_construct,
            loader:     loader,
            iloader:    iloader,
            confirm:    confirm,
            message:    message,
            alert:      alert,
            modal:      modal

        },
        init: function()
        {
            this.loader  = new this.base.loader(),
            this.iloader = new this.base.iloader(),
            this.confirm = new this.base.confirm(),
            this.message = new this.base.message(),
            this.alert   = new this.base.alert(),
            this.modal   = new this.base.modal()
        }
    };

})(jQuery);

module.exports = ui;

},{}],14:[function(require,module,exports){
/*
 *===========================================================
 * Image uploader handle
 *===========================================================*/
var uploader;

(function($)
{
    "use strict";

    uploader = function( element, options )
    {
        var defaults  = {
            func_select: function( input ){},
        };
        var options = $.extend( defaults, options );

        $(element).each( function()
        {
            var root = $(this);
            var frame;
            $( '.iplaun-btn-media', root ).click( function(e)
            {
                var $el = $(this);
                e.preventDefault();

                // If the media frame already exists, reopen it.
                if ( frame ) {
                    frame.open();
                    return;
                }
                // Create the media frame.
                frame = wp.media.frames.customHeader = wp.media({
                    // Set the title of the modal.
                    title: $el.data('choose'),

                    // Tell the modal to show only images.
                    library: {
                        type: 'image'
                    },

                    // Customize the submit button.
                    button: {
                        // Set the text of the button.
                        text: $el.data('update'),
                        // Tell the button not to close the modal, since we're
                        // going to refresh the page when the image is selected.
                        close: false
                    }
                });

                // When an image is selected, run a callback.
                frame.on( 'select', function() {
                    // Grab the selected attachment.
                    var attachment = frame.state().get('selection').first();
                    var id         = attachment.id;

                    var url = '';
                    if (typeof attachment.attributes.sizes.thumbnail != 'undefined') {
                        url = attachment.attributes.sizes.thumbnail.url;
                    }
                    else if (typeof attachment.attributes.sizes.medium != 'undefined') {
                        url = attachment.attributes.sizes.medium.url;
                    }
                    else if (typeof attachment.attributes.sizes.full != 'undefined') {
                        url = attachment.attributes.sizes.full.url;
                    }

                    $( '.iplaun-upload-preview .none', root ).hide();
                    $( '.iplaun-upload-preview .image', root )
                        .html( '<img src="'+url+'" alt="" />' )
                        .show();
                    $( '.iplaun-image-id', root ).val( id );
                    $( '.iplaun-btn-reset', root ).show();

                    //Select callback
                    options.func_select( element );

                    frame.close();
                });
                frame.open();

                return false;
            });
            $( '.iplaun-btn-reset', root ).click( function(e)
            {
                $( '.iplaun-upload-preview .none', root ).show();
                $( '.iplaun-upload-preview .image', root ).html( '' ).hide();
                $( '.iplaun-image-id', root ).val( 0 );
                $( '.iplaun-btn-reset', root ).hide();
                return false;
            });
        });
    };

})(jQuery);

module.exports = uploader;

},{}]},{},[1]);
