<!DOCTYPE html>    
    <head>
        <base href="{{ asset(config('settings.theme')) }}/">
        <meta charset="UTF-8" />
        <title>{{ $title ?? 'PinkRio :: Панель администратора' }}</title>
        
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
        
        <link rel="stylesheet" type="text/css" media="all" href="css/reset.css" /> <!-- RESET STYLESHEET -->
        <link rel="stylesheet" type="text/css" media="all" href="style.css" /> <!-- MAIN THEME STYLESHEET -->         
        <link rel="stylesheet" id="thickbox-css" href="css/thickbox.css" type="text/css" media="all" />
        <link rel="stylesheet" id="styles-minified-css" href="css/style-minifield.css" type="text/css" media="all" />
        <link rel="stylesheet" id="buttons" href="css/buttons.css" type="text/css" media="all" />
        <link rel="stylesheet" id="cache-custom-css" href="css/cache-custom.css" type="text/css" media="all" />
        <link rel="stylesheet" id="custom-css" href="css/custom.css" type="text/css" media="all" />
        <link rel="stylesheet" id="jquery-ui-css" href="css/jquery-ui.css" type="text/css" media="all" />
	    
        <link rel="stylesheet" id="google-fonts-css" href="http://fonts.googleapis.com/css?family=Oswald%7CDroid+Sans%7CPlayfair+Display%7COpen+Sans+Condensed%3A300%7CRokkitt%7CShadows+Into+Light%7CAbel%7CDamion%7CMontez&amp;ver=3.4.2" type="text/css" media="all" />
        <link rel='stylesheet' href='css/font-awesome.css' type='text/css' media='all' />
        
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>

    </head>    
    <body class="no_js responsive page-template-home-php stretched">        
        <div class="bg-shadow">                        
            <div id="wrapper" class="group">                                
                <div id="header" class="group">                    
                    <div class="group inner">                        
                        <div id="logo" class="group">
                            <a href="{{ route('admin.index') }}" title="Pink Rio"><img src="images/logo.png" title="Pink Rio" alt="Pink Rio" /></a>
                        </div>                          
                        <div id="sidebar-header" class="group">
                            <div class="widget-first widget yit_text_quote">
                                <blockquote class="text-quote-quote">&#8220;The caterpillar does all the work but the butterfly gets all the publicity.&#8221;</blockquote>
                                <cite class="text-quote-author">George Carlin</cite>
                            </div>
                        </div>
                        <div class="clearer"></div>                        
                        <hr />                                                
                        	@yield('navigation')                        
                        <div id="header-shadow"></div>
                        <div id="menu-shadow"></div>
                    </div>                    
                </div>

				<div id="primary" class="sidebar-no">
				    <div class="inner group">
                        @if (count($errors) > 0)
                            <div class="box error-box">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        
                        @if (session('status'))
                            <div class="box success-box">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        @if (session('error'))
                            <div class="box error-box">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        @yield('content')
				    </div>
				</div>
                    @yield('footer')                
            </div>
        </div>
    </body>
</html>