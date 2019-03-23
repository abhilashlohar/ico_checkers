<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* C:\xampp\htdocs\ico_checkers\vendor\cakephp\bake\src\Template\Bake\\Controller\controller.twig */
class __TwigTemplate_e21a87bc7caa67974be33190365111b528dea509619384db48ad88d07a87dc91 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa = $this->env->getExtension("WyriHaximus\\TwigView\\Lib\\Twig\\Extension\\Profiler");
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa->enter($__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "C:\\xampp\\htdocs\\ico_checkers\\vendor\\cakephp\\bake\\src\\Template\\Bake\\\\Controller\\controller.twig"));

        // line 20
        echo "<?php
namespace ";
        // line 21
        echo twig_escape_filter($this->env, ($context["namespace"] ?? null), "html", null, true);
        echo "\\Controller";
        echo twig_escape_filter($this->env, ($context["prefix"] ?? null), "html", null, true);
        echo ";

use ";
        // line 23
        echo twig_escape_filter($this->env, ($context["namespace"] ?? null), "html", null, true);
        echo "\\Controller\\AppController;

/**
 * ";
        // line 26
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo " Controller
 *
";
        // line 28
        if (($context["defaultModel"] ?? null)) {
            // line 29
            echo " * @property \\";
            echo twig_escape_filter($this->env, ($context["defaultModel"] ?? null), "html", null, true);
            echo " \$";
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "
";
        }
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["components"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["component"]) {
            // line 33
            $context["classInfo"] = $this->getAttribute(($context["Bake"] ?? null), "classInfo", [0 => $context["component"], 1 => "Controller/Component", 2 => "Component"], "method");
            // line 34
            echo " * @property ";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["classInfo"] ?? null), "fqn", []), "html", null, true);
            echo " \$";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["classInfo"] ?? null), "name", []), "html", null, true);
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['component'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        if (twig_in_filter("index", ($context["actions"] ?? null))) {
            // line 38
            echo " *
 * @method \\";
            // line 39
            echo twig_escape_filter($this->env, ($context["namespace"] ?? null), "html", null, true);
            echo "\\Model\\Entity\\";
            echo twig_escape_filter($this->env, ($context["entityClassName"] ?? null), "html", null, true);
            echo "[]|\\Cake\\Datasource\\ResultSetInterface paginate(\$object = null, array \$settings = [])
";
        }
        // line 41
        echo " */
class ";
        // line 42
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "Controller extends AppController
{
";
        // line 44
        $context["helpers"] = $this->getAttribute(($context["Bake"] ?? null), "arrayProperty", [0 => "helpers", 1 => ($context["helpers"] ?? null), 2 => ["indent" => false]], "method");
        // line 45
        if (twig_trim_filter(($context["helpers"] ?? null))) {
            // line 46
            echo ($context["helpers"] ?? null);
            echo "
";
        }
        // line 49
        $context["components"] = $this->getAttribute(($context["Bake"] ?? null), "arrayProperty", [0 => "components", 1 => ($context["components"] ?? null), 2 => ["indent" => false]], "method");
        // line 50
        if (twig_trim_filter(($context["components"] ?? null))) {
            // line 51
            echo ($context["components"] ?? null);
            echo "
";
        }
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["actions"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["action"]) {
            // line 55
echo $context['_view']->element(("Controller/" . $context["action"]),[],[]);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['action'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
        echo "}
";
        
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa->leave($__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa_prof);

    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\ico_checkers\\vendor\\cakephp\\bake\\src\\Template\\Bake\\\\Controller\\controller.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 57,  123 => 55,  119 => 54,  114 => 51,  112 => 50,  110 => 49,  105 => 46,  103 => 45,  101 => 44,  96 => 42,  93 => 41,  86 => 39,  83 => 38,  81 => 37,  70 => 34,  68 => 33,  64 => 32,  56 => 29,  54 => 28,  49 => 26,  43 => 23,  36 => 21,  33 => 20,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * Controller bake template file
 *
 * Allows templating of Controllers generated from bake.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
#}
<?php
namespace {{ namespace }}\\Controller{{ prefix }};

use {{ namespace }}\\Controller\\AppController;

/**
 * {{ name }} Controller
 *
{% if defaultModel %}
 * @property \\{{ defaultModel }} \${{ name }}
{% endif %}

{%- for component in components %}
{% set classInfo = Bake.classInfo(component, 'Controller/Component', 'Component') %}
 * @property {{ classInfo.fqn }} \${{ classInfo.name }}
{% endfor %}

{%- if 'index' in actions %}
 *
 * @method \\{{ namespace }}\\Model\\Entity\\{{ entityClassName }}[]|\\Cake\\Datasource\\ResultSetInterface paginate(\$object = null, array \$settings = [])
{% endif %}
 */
class {{ name }}Controller extends AppController
{
{% set helpers = Bake.arrayProperty('helpers', helpers, {'indent': false})|raw %}
{% if helpers|trim %}
    {{- helpers|raw }}
{% endif %}

{%- set components = Bake.arrayProperty('components', components, {'indent': false})|raw %}
{% if components|trim %}
    {{- components|raw }}
{% endif %}

{%- for action in actions %}
    {%- element 'Controller/' ~ action %}
{% endfor %}
}
", "C:\\xampp\\htdocs\\ico_checkers\\vendor\\cakephp\\bake\\src\\Template\\Bake\\\\Controller\\controller.twig", "C:\\xampp\\htdocs\\ico_checkers\\vendor\\cakephp\\bake\\src\\Template\\Bake\\\\Controller\\controller.twig");
    }
}
