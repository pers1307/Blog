<?php

/* index.html */
class __TwigTemplate_52bf753a1b4315bc39b43d63e33ec2ce9eb93139929c8b0a1a75b7f38c49b5bc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"Header\" class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            Блог PHP - разработчика
        </div>
    </div>
</div>

<div id=\"Content\" class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-9\">
            ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["articles"]) ? $context["articles"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 13
            echo "                <div class=\"Block-post\">
                    <h2 class=\"blog-post-title\">";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getName", array(), "method"), "html", null, true);
            echo "</h2>
                    <p class=\"blog-post-meta\">
                        ";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getCreatedAt", array(), "method"), "html", null, true);
            echo " by <span class=\"blog-post-autor\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getAuthor", array(), "method"), "html", null, true);
            echo "</span>
                    </p>
                    <hr>
                    <div class=\"Image\"><img src=\"";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getPathImage", array(), "method"), "html", null, true);
            echo "\" width=\"100%\"> </div>
                    <div class=\"blog-post-text\">
                        ";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getText", array(), "method"), "html", null, true);
            echo "
                    </div>
                </div>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 25
            echo "                <h1>В данный момент в блоге нет статей!</h1>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "
            ";
        // line 28
        if (((isset($context["page"]) ? $context["page"] : null) != 0)) {
            // line 29
            echo "                <ul class=\"pagination pagination-lg\">

                    ";
            // line 31
            if (((isset($context["page"]) ? $context["page"] : null) != 1)) {
                // line 32
                echo "                    <li><a href='?page=";
                echo twig_escape_filter($this->env, ((isset($context["page"]) ? $context["page"] : null) - 1), "html", null, true);
                echo "'>&laquo; Назад</a></li>
                    ";
            }
            // line 34
            echo "
                    ";
            // line 35
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["countPage"]) ? $context["countPage"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["count"]) {
                // line 36
                echo "                    ";
                if (((isset($context["page"]) ? $context["page"] : null) == $context["count"])) {
                    // line 37
                    echo "                    <li class='active'><a href='?page=";
                    echo twig_escape_filter($this->env, $context["count"], "html", null, true);
                    echo "'>";
                    echo twig_escape_filter($this->env, $context["count"], "html", null, true);
                    echo "</a></li>
                    ";
                } else {
                    // line 39
                    echo "                    <li><a href='?page=";
                    echo twig_escape_filter($this->env, $context["count"], "html", null, true);
                    echo "'>";
                    echo twig_escape_filter($this->env, $context["count"], "html", null, true);
                    echo "</a></li>
                    ";
                }
                // line 41
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['count'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 42
            echo "
                    ";
            // line 43
            if (((isset($context["page"]) ? $context["page"] : null) != (isset($context["countPage"]) ? $context["countPage"] : null))) {
                // line 44
                echo "                    <li><a href='?page=";
                echo twig_escape_filter($this->env, ((isset($context["page"]) ? $context["page"] : null) + 1), "html", null, true);
                echo "'>Вперед &raquo;</a></li>
                    ";
            }
            // line 46
            echo "                </ul>
            ";
        }
        // line 48
        echo "        </div>

        <div class=\"col-md-2 col-md-offset-1\">
            <p id=\"MyPhoto\"><img src=\"img/photo.jpg\" width=\"100\" height=\"150\" alt=\"Хозяин блога\"></p>
            ";
        // line 52
        if (((isset($context["error"]) ? $context["error"] : null) == 1)) {
            // line 53
            echo "                <div class=\"alert-danger\">
                    <p>Логин или пароль введен не верно!</p>
                </div>
            ";
        }
        // line 57
        echo "
            ";
        // line 58
        if (((isset($context["error"]) ? $context["error"] : null) != 2)) {
            // line 59
            echo "                ";
            $this->loadTemplate("template/autorizationForm.html", "index.html", 59)->display($context);
            // line 60
            echo "            ";
        } else {
            // line 61
            echo "                <p>Логин : ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "getLogin", array(), "method"), "html", null, true);
            echo "</p>
                <p><a href=\"/articlesDesk\" class=\"btn btn-primary\">Войти</a></p>
                <p><a href=\"?exit=true\" class=\"btn btn-primary\">Выйти</a></p>
            ";
        }
        // line 65
        echo "
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  171 => 65,  163 => 61,  160 => 60,  157 => 59,  155 => 58,  152 => 57,  146 => 53,  144 => 52,  138 => 48,  134 => 46,  128 => 44,  126 => 43,  123 => 42,  117 => 41,  109 => 39,  101 => 37,  98 => 36,  94 => 35,  91 => 34,  85 => 32,  83 => 31,  79 => 29,  77 => 28,  74 => 27,  67 => 25,  58 => 21,  53 => 19,  45 => 16,  40 => 14,  37 => 13,  32 => 12,  19 => 1,);
    }
}
/* <div id="Header" class="container">*/
/*     <div class="row">*/
/*         <div class="col-md-12">*/
/*             Блог PHP - разработчика*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="Content" class="container">*/
/*     <div class="row">*/
/*         <div class="col-md-9">*/
/*             {% for article in articles %}*/
/*                 <div class="Block-post">*/
/*                     <h2 class="blog-post-title">{{ article.getName() }}</h2>*/
/*                     <p class="blog-post-meta">*/
/*                         {{ article.getCreatedAt() }} by <span class="blog-post-autor">{{ article.getAuthor() }}</span>*/
/*                     </p>*/
/*                     <hr>*/
/*                     <div class="Image"><img src="{{ article.getPathImage() }}" width="100%"> </div>*/
/*                     <div class="blog-post-text">*/
/*                         {{ article.getText() }}*/
/*                     </div>*/
/*                 </div>*/
/*             {% else %}*/
/*                 <h1>В данный момент в блоге нет статей!</h1>*/
/*             {% endfor %}*/
/* */
/*             {% if page != 0 %}*/
/*                 <ul class="pagination pagination-lg">*/
/* */
/*                     {% if page != 1 %}*/
/*                     <li><a href='?page={{ page - 1 }}'>&laquo; Назад</a></li>*/
/*                     {% endif %}*/
/* */
/*                     {% for count in 1..countPage %}*/
/*                     {% if page == count %}*/
/*                     <li class='active'><a href='?page={{ count  }}'>{{ count  }}</a></li>*/
/*                     {% else %}*/
/*                     <li><a href='?page={{ count  }}'>{{ count  }}</a></li>*/
/*                     {% endif %}*/
/*                     {% endfor %}*/
/* */
/*                     {% if page != countPage %}*/
/*                     <li><a href='?page={{ page + 1 }}'>Вперед &raquo;</a></li>*/
/*                     {% endif %}*/
/*                 </ul>*/
/*             {% endif %}*/
/*         </div>*/
/* */
/*         <div class="col-md-2 col-md-offset-1">*/
/*             <p id="MyPhoto"><img src="img/photo.jpg" width="100" height="150" alt="Хозяин блога"></p>*/
/*             {% if error == 1 %}*/
/*                 <div class="alert-danger">*/
/*                     <p>Логин или пароль введен не верно!</p>*/
/*                 </div>*/
/*             {% endif %}*/
/* */
/*             {% if error != 2 %}*/
/*                 {%include 'template/autorizationForm.html' %}*/
/*             {% else %}*/
/*                 <p>Логин : {{ user.getLogin() }}</p>*/
/*                 <p><a href="/articlesDesk" class="btn btn-primary">Войти</a></p>*/
/*                 <p><a href="?exit=true" class="btn btn-primary">Выйти</a></p>*/
/*             {% endif %}*/
/* */
/*         </div>*/
/*     </div>*/
/* </div>*/
