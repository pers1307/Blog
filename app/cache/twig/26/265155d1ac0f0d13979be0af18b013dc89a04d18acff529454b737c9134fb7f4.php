<?php

/* layout.html */
class __TwigTemplate_61ef210cc11d14e7250ec613721e549ecbaf1fcc08cf7df6451c699c96d9aed2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'menu' => array($this, 'block_menu'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
<html lang=\"ru\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Блог Юрия Перескокова</title>

    <!-- Bootstrap -->
    <link href=\"/css/bootstrap.css\" rel=\"stylesheet\">
    <link href=\"/css/font-awesome.css\" rel=\"stylesheet\">
    <!--Стили-->
    <link href=\"/css/main.css\" type=\"text/css\" rel=\"Stylesheet\" />
    <link href=\"/css/controlPanel.css\" type=\"text/css\" rel=\"Stylesheet\" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
    <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->
</head>
<body>
";
        // line 24
        $this->displayBlock('menu', $context, $blocks);
        // line 26
        echo "
";
        // line 27
        $this->displayBlock('content', $context, $blocks);
        // line 29
        echo "
";
        // line 30
        $this->displayBlock('footer', $context, $blocks);
        // line 32
        echo "<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js\"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src=\"/js/bootstrap.js\"></script>
<script src=\"/js/ajax.js\"></script>
</body>
</html>";
    }

    // line 24
    public function block_menu($context, array $blocks = array())
    {
    }

    // line 27
    public function block_content($context, array $blocks = array())
    {
    }

    // line 30
    public function block_footer($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "layout.html";
    }

    public function getDebugInfo()
    {
        return array (  79 => 30,  74 => 27,  69 => 24,  59 => 32,  57 => 30,  54 => 29,  52 => 27,  49 => 26,  47 => 24,  22 => 1,);
    }
}
/* <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">*/
/* <html lang="ru">*/
/* <head>*/
/*     <meta charset="utf-8">*/
/*     <meta http-equiv="X-UA-Compatible" content="IE=edge">*/
/*     <meta name="viewport" content="width=device-width, initial-scale=1">*/
/*     <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->*/
/*     <title>Блог Юрия Перескокова</title>*/
/* */
/*     <!-- Bootstrap -->*/
/*     <link href="/css/bootstrap.css" rel="stylesheet">*/
/*     <link href="/css/font-awesome.css" rel="stylesheet">*/
/*     <!--Стили-->*/
/*     <link href="/css/main.css" type="text/css" rel="Stylesheet" />*/
/*     <link href="/css/controlPanel.css" type="text/css" rel="Stylesheet" />*/
/*     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->*/
/*     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->*/
/*     <!--[if lt IE 9]>*/
/*     <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>*/
/*     <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>*/
/*     <![endif]-->*/
/* </head>*/
/* <body>*/
/* {% block menu %}*/
/* {% endblock %}*/
/* */
/* {% block content %}*/
/* {% endblock %}*/
/* */
/* {% block footer %}*/
/* {% endblock %}*/
/* <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->*/
/* <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>*/
/* <!-- Include all compiled plugins (below), or include individual files as needed -->*/
/* <script src="/js/bootstrap.js"></script>*/
/* <script src="/js/ajax.js"></script>*/
/* </body>*/
/* </html>*/
