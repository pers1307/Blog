<?php

/* layoutFilled.html */
class __TwigTemplate_1acc59545154f57e70d75e5ba290475abbf5e9cd0fb92ac9bc70795770383a2d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html", "layoutFilled.html", 1);
        $this->blocks = array(
            'menu' => array($this, 'block_menu'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_menu($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"container\">
    <div class=\"row\">
        <div class=\"navbar navbar-default navbar-fixed-top\">
            <div class=\"container\">
                <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#responsive-menu\">
                        <span class=\"sr-only\">Открыть навигацию</span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                    </button>
                    <a class=\"navbar-brand\" href=\"/\">Блог</a>
                </div>
                <div class=\"collapse navbar-collapse\" id=\"responsive-menu\">
                    <ul class=\"nav navbar-nav\">
                        <li><a href=\"/\">Главная</a></li>
                        <li><a href=\"https://github.com/pers1307/Blog_v_2.0\"><i class=\"fa fa-github fa-lg\"></i> Посмотреть код на GitHub</a></li>
                        <li><a href=\"#footer\">Контакты</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
";
    }

    // line 30
    public function block_content($context, array $blocks = array())
    {
        // line 31
        $this->loadTemplate((isset($context["forContent"]) ? $context["forContent"] : null), "layoutFilled.html", 31)->display($context);
    }

    // line 34
    public function block_footer($context, array $blocks = array())
    {
        // line 35
        echo "<div id=\"footer\">
    <p>&copy; Дизайн - собственность Перескокова Юрия</p>
    <p>&copy; CMS - собственность Перескокова Юрия</p>
    <p>Почта: hunterofwallstreet@mail.ru</p>
</div>
";
    }

    public function getTemplateName()
    {
        return "layoutFilled.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 35,  68 => 34,  64 => 31,  61 => 30,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends 'layout.html' %}*/
/* */
/* {% block menu %}*/
/* <div class="container">*/
/*     <div class="row">*/
/*         <div class="navbar navbar-default navbar-fixed-top">*/
/*             <div class="container">*/
/*                 <div class="navbar-header">*/
/*                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">*/
/*                         <span class="sr-only">Открыть навигацию</span>*/
/*                         <span class="icon-bar"></span>*/
/*                         <span class="icon-bar"></span>*/
/*                         <span class="icon-bar"></span>*/
/*                     </button>*/
/*                     <a class="navbar-brand" href="/">Блог</a>*/
/*                 </div>*/
/*                 <div class="collapse navbar-collapse" id="responsive-menu">*/
/*                     <ul class="nav navbar-nav">*/
/*                         <li><a href="/">Главная</a></li>*/
/*                         <li><a href="https://github.com/pers1307/Blog_v_2.0"><i class="fa fa-github fa-lg"></i> Посмотреть код на GitHub</a></li>*/
/*                         <li><a href="#footer">Контакты</a></li>*/
/*                     </ul>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block content %}*/
/* {%include forContent %}*/
/* {% endblock %}*/
/* */
/* {% block footer %}*/
/* <div id="footer">*/
/*     <p>&copy; Дизайн - собственность Перескокова Юрия</p>*/
/*     <p>&copy; CMS - собственность Перескокова Юрия</p>*/
/*     <p>Почта: hunterofwallstreet@mail.ru</p>*/
/* </div>*/
/* {% endblock %}*/
