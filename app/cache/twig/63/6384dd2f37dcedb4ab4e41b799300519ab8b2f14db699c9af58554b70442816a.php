<?php

/* template/autorizationForm.html */
class __TwigTemplate_2ec421810c9d891760152ee6c80f3f5c25b7769431dfefc9770620fa3a1f6b5d extends Twig_Template
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
        echo "<form method='post' enctype='multipart/form-data' id=\"Form\">
    <p id=\"PanelForEnter\">
    <div class=\"input-group margin-bottom-sm\">
        <span class=\"input-group-addon\"><i class=\"fa fa-user fa-fw\"></i></span>
        <input class=\"form-control\" type=\"text\" placeholder=\"Логин\" name='login' id=\"Login\">
    </div>

    <div id=\"inputPassword\" class=\"input-group\">
        <span class=\"input-group-addon\"><i class=\"fa fa-key fa-fw\"></i></span>
        <input class=\"form-control\" type=\"password\" placeholder=\"Пароль\" name='password' id=\"Password\">
    </div>
    </p>

    <p id=\"Enter\">
        <button id='Submit' type='submit' class=\"btn btn-primary\"><i class=\"fa fa-cog fa-spin\"></i> Вход </button>
    </p>
</form>";
    }

    public function getTemplateName()
    {
        return "template/autorizationForm.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
/* <form method='post' enctype='multipart/form-data' id="Form">*/
/*     <p id="PanelForEnter">*/
/*     <div class="input-group margin-bottom-sm">*/
/*         <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>*/
/*         <input class="form-control" type="text" placeholder="Логин" name='login' id="Login">*/
/*     </div>*/
/* */
/*     <div id="inputPassword" class="input-group">*/
/*         <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>*/
/*         <input class="form-control" type="password" placeholder="Пароль" name='password' id="Password">*/
/*     </div>*/
/*     </p>*/
/* */
/*     <p id="Enter">*/
/*         <button id='Submit' type='submit' class="btn btn-primary"><i class="fa fa-cog fa-spin"></i> Вход </button>*/
/*     </p>*/
/* </form>*/
