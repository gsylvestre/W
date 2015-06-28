<?php

/* layout.html.twig */
class __TwigTemplate_823030466b8d43d1d094f6117227ac5d93ba1661d72891232d149f76b58c6af5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'main_content' => array($this, 'block_main_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
\t<meta charset=\"UTF-8\">
\t<title>Document</title>
</head>
<body>
\t";
        // line 8
        $this->displayBlock('main_content', $context, $blocks);
        // line 9
        echo "</body>
</html>";
    }

    // line 8
    public function block_main_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  36 => 8,  31 => 9,  29 => 8,  20 => 1,);
    }
}
