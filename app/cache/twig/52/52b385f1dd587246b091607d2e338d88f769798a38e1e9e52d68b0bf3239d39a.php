<?php

/* articleDesk.html */
class __TwigTemplate_1ec95d361a2b34e53aa7f2faaaba24e4bb06e582b5f81d7ff880f2c62abc342b extends Twig_Template
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
        echo "<div id=\"HeaderControlPanel\" class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <i class=\"fa fa-wrench\"></i>Панель управления контентом блога
        </div>
    </div>
</div>

<div id=\"ContentControlPanel\" class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div id=\"New-post\">
                <h3>Добавить новую статью в блог!</h3>
                <form role=\"form\" method=\"post\" action=\"\" enctype=\"multipart/form-data\">
                    ";
        // line 15
        if (($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "CodeError", array(), "array") != 0)) {
            // line 16
            echo "                        <div class=\"form-group alert-danger col-md-12\">
                            <h4>";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "TextError", array(), "array"), "html", null, true);
            echo "</h4>
                        </div>
                    ";
        }
        // line 20
        echo "
                    <div class=\"form-group col-md-8 ";
        // line 21
        echo ((($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "CodeError", array(), "array") == "1")) ? ("has-error") : (""));
        echo "\">
                        <label for=\"exampleInputEmail1\">Название статьи</label>
                        <input type=\"text\" class=\"form-control\" placeholder=\"Название статьи\" name=\"newArticleName\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "CodeError", array(), "array") != "0")) ? ($this->getAttribute($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "Article", array(), "array"), "getName", array(), "method")) : ("")), "html", null, true);
        echo "\">
                    </div>
                    <div class=\"form-group col-md-4 ";
        // line 25
        echo ((($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "CodeError", array(), "array") == "2")) ? ("has-error") : (""));
        echo "\">
                        <label for=\"exampleInputPassword1\">Автор статьи</label>
                        <input type=\"text\" class=\"form-control\" placeholder=\"Автор статьи\" value=\"";
        // line 27
        echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "CodeError", array(), "array") != "0")) ? ($this->getAttribute($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "Article", array(), "array"), "getAuthor", array(), "method")) : ("Перескоков Юрий")), "html", null, true);
        echo "\" name=\"newArticleAuthor\">
                    </div>

                    <div class=\"form-group col-md-12\" ";
        // line 30
        echo ((($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "CodeError", array(), "array") == "3")) ? ("style='outline: 1px solid #A90006'") : (""));
        echo " >

                        ";
        // line 32
        if (($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "CodeError", array(), "array") != 0)) {
            // line 33
            echo "                            <label for=\"exampleInputFile\">Текущая картинка: ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "Article", array(), "array"), "getPathImage", array(), "method"), "html", null, true);
            echo " </label>
                            <p><label for=\"exampleInputFile\">Добавьте её снова!</label></p>
                        ";
        }
        // line 36
        echo "
                        <label for=\"exampleInputFile\">Хочу добавить картинку!</label>
                        <input type=\"file\" name=\"newArticleImage[]\" multiple=\"multiple\">
                    </div>

                    <div class=\"form-group col-md-12 ";
        // line 41
        echo ((($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "CodeError", array(), "array") == "4")) ? ("has-error") : (""));
        echo "\">
                        <label for=\"exampleInputFile\">Текст статьи: </label>
                        <textarea id=\"newArticle\" class=\"form-control\" rows=\"6\" name=\"newArticleText\" style=\"resize: none\">";
        // line 43
        echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "CodeError", array(), "array") != "0")) ? ($this->getAttribute($this->getAttribute((isset($context["errorAddArticle"]) ? $context["errorAddArticle"] : null), "Article", array(), "array"), "getText", array(), "method")) : ("")), "html", null, true);
        echo "</textarea>
                    </div>

                    <div class=\"form-group\">
                        <button id=\"ForSub\" type=\"submit\" class=\"btn btn-primary\" name=\"sub\"><i class=\"fa fa-check\"></i>Отправить</button>
                    </div>
                </form>
            </div>
        </div>


        <div id='WrapAccordion'>
            <h3>Редактирование существующих статей</h3>
            <div class=\"panel-group\" id=\"accordion\">
                ";
        // line 57
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["articles"]) ? $context["articles"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 58
            echo "                    <div class=\"panel panel-default\" id=\"idPost";
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getId", array(), "method"), "html", null, true);
            echo "\">
                        <div class=\"panel-heading\">
                            <h4 class=\"panel-title\">
                                <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getId", array(), "method"), "html", null, true);
            echo "\" class=\"PostName\">
                                    Дата ";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getCreatedAt", array(), "method"), "html", null, true);
            echo " Название статьи: ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getName", array(), "method"), "html", null, true);
            echo "
                                </a>
                                <a href='?Delete=";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getId", array(), "method"), "html", null, true);
            echo "' class='btn btn-danger btn-xs delete' data-delete='";
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getId", array(), "method"), "html", null, true);
            echo "'><i class=\"fa fa-times fa-2x\"></i></a>
                                <a href='/EditArticle?Edit=";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getId", array(), "method"), "html", null, true);
            echo "' class='btn btn-info btn-xs'><i class=\"fa fa-pencil-square-o fa-2x\"></i></a>
                            </h4>
                        </div>
                        <div id=\"";
            // line 68
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getId", array(), "method"), "html", null, true);
            echo "\" class=\"panel-collapse collapse\">
                            <div class=\"panel-body\">
                                <div class=\"Image\"><img src=\"";
            // line 70
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getPathImage", array(), "method"), "html", null, true);
            echo "\" width=\"100%\"> </div>
                                <p>Автор: ";
            // line 71
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getAuthor", array(), "method"), "html", null, true);
            echo "</p>
                                ";
            // line 72
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "getText", array(), "method"), "html", null, true);
            echo "
                            </div>
                        </div>
                    </div>
                ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 77
            echo "                    <h1>В данный момент в блоге нет статей!</h1>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 79
        echo "            </div>
        </div>
    </div>
</div>
</div>";
    }

    public function getTemplateName()
    {
        return "articleDesk.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 79,  171 => 77,  161 => 72,  157 => 71,  153 => 70,  148 => 68,  142 => 65,  136 => 64,  129 => 62,  125 => 61,  118 => 58,  113 => 57,  96 => 43,  91 => 41,  84 => 36,  77 => 33,  75 => 32,  70 => 30,  64 => 27,  59 => 25,  54 => 23,  49 => 21,  46 => 20,  40 => 17,  37 => 16,  35 => 15,  19 => 1,);
    }
}
/* <div id="HeaderControlPanel" class="container">*/
/*     <div class="row">*/
/*         <div class="col-md-12">*/
/*             <i class="fa fa-wrench"></i>Панель управления контентом блога*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="ContentControlPanel" class="container">*/
/*     <div class="row">*/
/*         <div class="col-md-12">*/
/*             <div id="New-post">*/
/*                 <h3>Добавить новую статью в блог!</h3>*/
/*                 <form role="form" method="post" action="" enctype="multipart/form-data">*/
/*                     {% if errorAddArticle['CodeError'] != 0 %}*/
/*                         <div class="form-group alert-danger col-md-12">*/
/*                             <h4>{{ errorAddArticle['TextError'] }}</h4>*/
/*                         </div>*/
/*                     {% endif %}*/
/* */
/*                     <div class="form-group col-md-8 {{ (errorAddArticle['CodeError'] == '1') ? 'has-error' }}">*/
/*                         <label for="exampleInputEmail1">Название статьи</label>*/
/*                         <input type="text" class="form-control" placeholder="Название статьи" name="newArticleName" value="{{ (errorAddArticle['CodeError'] != '0') ? errorAddArticle['Article'].getName() }}">*/
/*                     </div>*/
/*                     <div class="form-group col-md-4 {{ (errorAddArticle['CodeError'] == '2') ? 'has-error' }}">*/
/*                         <label for="exampleInputPassword1">Автор статьи</label>*/
/*                         <input type="text" class="form-control" placeholder="Автор статьи" value="{{ (errorAddArticle['CodeError'] != '0') ? errorAddArticle['Article'].getAuthor() : 'Перескоков Юрий' }}" name="newArticleAuthor">*/
/*                     </div>*/
/* */
/*                     <div class="form-group col-md-12" {{ (errorAddArticle['CodeError'] == '3') ? "style='outline: 1px solid #A90006'" }} >*/
/* */
/*                         {% if errorAddArticle['CodeError'] != 0 %}*/
/*                             <label for="exampleInputFile">Текущая картинка: {{ errorAddArticle['Article'].getPathImage() }} </label>*/
/*                             <p><label for="exampleInputFile">Добавьте её снова!</label></p>*/
/*                         {% endif %}*/
/* */
/*                         <label for="exampleInputFile">Хочу добавить картинку!</label>*/
/*                         <input type="file" name="newArticleImage[]" multiple="multiple">*/
/*                     </div>*/
/* */
/*                     <div class="form-group col-md-12 {{ (errorAddArticle['CodeError'] == '4') ? 'has-error' }}">*/
/*                         <label for="exampleInputFile">Текст статьи: </label>*/
/*                         <textarea id="newArticle" class="form-control" rows="6" name="newArticleText" style="resize: none">{{ (errorAddArticle['CodeError'] != '0') ? errorAddArticle['Article'].getText() }}</textarea>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <button id="ForSub" type="submit" class="btn btn-primary" name="sub"><i class="fa fa-check"></i>Отправить</button>*/
/*                     </div>*/
/*                 </form>*/
/*             </div>*/
/*         </div>*/
/* */
/* */
/*         <div id='WrapAccordion'>*/
/*             <h3>Редактирование существующих статей</h3>*/
/*             <div class="panel-group" id="accordion">*/
/*                 {% for article in articles %}*/
/*                     <div class="panel panel-default" id="idPost{{ article.getId() }}">*/
/*                         <div class="panel-heading">*/
/*                             <h4 class="panel-title">*/
/*                                 <a data-toggle="collapse" data-parent="#accordion" href="#{{ article.getId() }}" class="PostName">*/
/*                                     Дата {{ article.getCreatedAt() }} Название статьи: {{ article.getName() }}*/
/*                                 </a>*/
/*                                 <a href='?Delete={{ article.getId() }}' class='btn btn-danger btn-xs delete' data-delete='{{ article.getId() }}'><i class="fa fa-times fa-2x"></i></a>*/
/*                                 <a href='/EditArticle?Edit={{ article.getId() }}' class='btn btn-info btn-xs'><i class="fa fa-pencil-square-o fa-2x"></i></a>*/
/*                             </h4>*/
/*                         </div>*/
/*                         <div id="{{ article.getId() }}" class="panel-collapse collapse">*/
/*                             <div class="panel-body">*/
/*                                 <div class="Image"><img src="{{ article.getPathImage() }}" width="100%"> </div>*/
/*                                 <p>Автор: {{ article.getAuthor() }}</p>*/
/*                                 {{ article.getText() }}*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 {% else %}*/
/*                     <h1>В данный момент в блоге нет статей!</h1>*/
/*                 {% endfor %}*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* </div>*/
