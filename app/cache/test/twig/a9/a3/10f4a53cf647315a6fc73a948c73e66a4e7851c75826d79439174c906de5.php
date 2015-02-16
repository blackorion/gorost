<?php

/* default/index.html.twig */
class __TwigTemplate_a9a310f4a53cf647315a6fc73a948c73e66a4e7851c75826d79439174c906de5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("base.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"row\">
        <div class=\"col-sm-12\">
            <form class=\"form-horizontal\" role=\"form\" autocomplete=\"off\">
                <div class=\"form-group\">
                    <legend><h3>Форма ввода кол. разрядов</h3></legend>
                </div>
                <div class=\"form-group\">
                    <label for=\"num-digits\" class=\"col-sm-3 control-label\">Кол. разрядов:</label>

                    <div class=\"col-sm-6\">
                        <input type=\"number\" name=\"num-digits\" id=\"num-digits\" class=\"form-control\" value=\"\" title=\"\" required=\"required\">
                    </div>
                    <div class=\"col-sm-3\">
                        <button type=\"button\" id=\"show\" class=\"btn btn-primary btn-block\" disabled>Показать список</button>
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-sm-6 col-sm-offset-3 control-label\" id=\"message\"></div>
                </div>
            </form>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-sm-12\">
            <div id=\"possible-values\" class=\"panel panel-default hidden\">
                <div class=\"panel-body\"></div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "default/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 4,  36 => 3,  11 => 1,);
    }
}
