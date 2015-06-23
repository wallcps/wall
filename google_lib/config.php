<?php
global $apiConfig;
$apiConfig = array(

    'use_objects' => false,
    'application_name' => 'Application Name',

    // OAuth2 Settings, you can get these keys at https://code.google.com/apis/console
    'oauth2_client_id' => 'Google Client ID',
    'oauth2_client_secret' => 'Google Client Secret',
    'oauth2_redirect_uri' => 'http://www.yourwebsite.com/google_login.php',

    // The developer key, you get this at https://code.google.com/apis/console
    'developer_key' => '',

    // OAuth1 Settings.
    // If you're using the apiOAuth auth class, it will use these values for the oauth consumer key and secret.
    // See http://code.google.com/apis/accounts/docs/RegistrationForWebAppsAuto.html for info on how to obtain those
    'oauth_consumer_key'    => 'www.yourwebsite.com',
    'oauth_consumer_secret' => 'Oauth Consumer Secret',

    // Site name to show in the Google's OAuth 1 authentication screen.
    'site_name' => 'www.yourwebsite.com',

    // Which Authentication, Storage and HTTP IO classes to use.
    'authClass'    => 'apiOAuth2',
    'ioClass'      => 'apiCurlIO',
    'cacheClass'   => 'apiFileCache',

    // If you want to run the test suite (by running # phpunit AllTests.php in the tests/ directory), fill in the settings below
    'oauth_test_token' => '', // the oauth access token to use (which you can get by runing authenticate() as the test user and copying the token value), ie '{"key":"foo","secret":"bar","callback_url":null}'
    'oauth_test_user' => '', // and the user ID to use, this can either be a vanity name 'testuser' or a numberic ID '123456'

    // Don't change these unless you're working against a special development or testing environment.
    'basePath' => 'https://www.googleapis.com',

    // IO Class dependent configuration, you only have to configure the values for the class that was configured as the ioClass above
    'ioFileCache_directory'  =>
        (function_exists('sys_get_temp_dir') ?
            sys_get_temp_dir() . '/apiClient' :
        '/tmp/apiClient'),
    'ioMemCacheStorage_host' => '127.0.0.1',
    'ioMemcacheStorage_port' => '11211',

    // Definition of service specific values like scopes, oauth token URLs, etc
    'services' => array(
      'analytics' => array('scope' => 'https://www.googleapis.com/auth/analytics.readonly'),
      'calendar' => array(
          'scope' => array(
              "https://www.googleapis.com/auth/calendar",
              "https://www.googleapis.com/auth/calendar.readonly",
          )
      ),
      'books' => array('scope' => 'https://www.googleapis.com/auth/books'),
      'latitude' => array(
          'scope' => array(
              'https://www.googleapis.com/auth/latitude.all.best',
              'https://www.googleapis.com/auth/latitude.all.city',
          )
      ),
      'moderator' => array('scope' => 'https://www.googleapis.com/auth/moderator'),
      'oauth2' => array(
          'scope' => array(
              'https://www.googleapis.com/auth/userinfo.profile',
              'https://www.googleapis.com/auth/userinfo.email',
          )
      ),
      'plus' => array('scope' => 'https://www.googleapis.com/auth/plus.me'),
      'siteVerification' => array('scope' => 'https://www.googleapis.com/auth/siteverification'),
      'tasks' => array('scope' => 'https://www.googleapis.com/auth/tasks'),
      'urlshortener' => array('scope' => 'https://www.googleapis.com/auth/urlshortener')
    )
);
