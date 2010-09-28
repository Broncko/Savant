<?php

/* test.twig.html */
class __TwigTemplate_ad3d1170e4f355784a608d49b70ef4fc extends Twig_Template
{
    public function display(array $context)
    {
        // line 1
        echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
  <head>
    <title></title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
  </head>
  <body>
    Hello ";
        // line 8
        echo (isset($context['testvar']) ? $context['testvar'] : null);
        echo "
    <p>
        Name: ";
        // line 10
        echo $this->getAttribute((isset($context['hendrik']) ? $context['hendrik'] : null), "name", array(), "any");
        echo "
    </p>
  </body>
</html>
";
    }

}
