<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @Mercure/Collector/mercure.html.twig */
class __TwigTemplate_ceb88e0fc59c760cc41a157d2539773bc031838decdd5f719d200da104632ae4 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'toolbar' => [$this, 'block_toolbar'],
            'menu' => [$this, 'block_menu'],
            'panel' => [$this, 'block_panel'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Mercure/Collector/mercure.html.twig"));

        // line 3
        $macros["helper"] = $this->macros["helper"] = $this;
        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@Mercure/Collector/mercure.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 5
    public function block_toolbar($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "toolbar"));

        // line 6
        echo "    ";
        if ((1 === twig_compare(twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 6, $this->source); })()), "count", [], "any", false, false, false, 6), 0))) {
            // line 7
            echo "        ";
            ob_start();
            // line 8
            echo "            ";
            echo twig_include($this->env, $context, "@Mercure/Icon/mercure.svg");
            echo "
            <span class=\"sf-toolbar-value\">";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 9, $this->source); })()), "count", [], "any", false, false, false, 9), "html", null, true);
            echo "</span>
        ";
            $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 11
            echo "
        ";
            // line 12
            echo twig_include($this->env, $context, "@WebProfiler/Profiler/toolbar_item.html.twig", ["link" => "mercure"]);
            echo "
    ";
        }
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 16
    public function block_menu($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "menu"));

        // line 17
        echo "    <span class=\"label";
        echo (((0 === twig_compare(twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 17, $this->source); })()), "count", [], "any", false, false, false, 17), 0))) ? (" disabled") : (""));
        echo "\">
        <span class=\"icon\">";
        // line 18
        echo twig_include($this->env, $context, "@Mercure/Icon/mercure.svg");
        echo "</span>
        <strong>Mercure</strong>
    </span>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 23
    public function block_panel($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "panel"));

        // line 24
        echo "    ";
        $macros["helper"] = $this;
        // line 25
        echo "
    <h2>Messages</h2>

    ";
        // line 28
        if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 28, $this->source); })()), "count", [], "any", false, false, false, 28), 0))) {
            // line 29
            echo "        <div class=\"empty\">
            <p>No messages have been collected.</p>
        </div>
    ";
        } else {
            // line 33
            echo "        <div class=\"sf-tabs\">
            ";
            // line 34
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 34, $this->source); })()), "publishers", [], "any", false, false, false, 34));
            foreach ($context['_seq'] as $context["hub"] => $context["publisher"]) {
                // line 35
                echo "                <div class=\"tab\">
                    <h3 class=\"tab-title\">";
                // line 36
                echo twig_escape_filter($this->env, $context["hub"], "html", null, true);
                echo "<span class=\"badge\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["publisher"], "count", [], "any", false, false, false, 36), "html", null, true);
                echo "</span></h3>
                    <div class=\"tab-content\">
                        <div class=\"metrics\">
                            <div class=\"metric\">
                                <span class=\"value\">";
                // line 40
                echo twig_escape_filter($this->env, sprintf("%.0f", twig_get_attribute($this->env, $this->source, $context["publisher"], "duration", [], "any", false, false, false, 40)), "html", null, true);
                echo " <span class=\"unit\">ms</span></span>
                                <span class=\"label\">Total execution time</span>
                            </div>
                            <div class=\"metric\">
                                <span class=\"value\">";
                // line 44
                echo twig_escape_filter($this->env, sprintf("%.2f", ((twig_get_attribute($this->env, $this->source, $context["publisher"], "memory", [], "any", false, false, false, 44) / 1024) / 1024)), "html", null, true);
                echo " <span class=\"unit\">MB</span></span>
                                <span class=\"label\">Peak memory usage</span>
                            </div>
                        </div>

                        <table>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Time</th>
                                <th>Memory</th>
                                <th>Topics</th>
                                <th>Data</th>
                                <th>Private</th>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Retry</th>
                            </tr>
                            </thead>
                            ";
                // line 63
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["publisher"], "messages", [], "any", false, false, false, 63));
                foreach ($context['_seq'] as $context["i"] => $context["message"]) {
                    // line 64
                    echo "                                <tr>
                                    <td class=\"font-normal text-small text-muted nowrap\">";
                    // line 65
                    echo twig_escape_filter($this->env, ($context["i"] + 1), "html", null, true);
                    echo "</td>
                                    <td class=\"nowrap\">";
                    // line 66
                    echo twig_escape_filter($this->env, sprintf("%.0f", twig_get_attribute($this->env, $this->source, $context["message"], "duration", [], "any", false, false, false, 66)), "html", null, true);
                    echo " ms</td>
                                    <td class=\"nowrap\">";
                    // line 67
                    echo twig_escape_filter($this->env, sprintf("%.2f", ((twig_get_attribute($this->env, $this->source, $context["message"], "memory", [], "any", false, false, false, 67) / 1024) / 1024)), "html", null, true);
                    echo " MB</td>
                                    <td class=\"font-normal text-small text-bold nowrap\">";
                    // line 68
                    echo twig_escape_filter($this->env, twig_join_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["message"], "object", [], "any", false, false, false, 68), "topics", [], "any", false, false, false, 68), ","), "html", null, true);
                    echo "</td>
                                    <td>";
                    // line 69
                    echo twig_var_dump($this->env, $context, ...[0 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["message"], "object", [], "any", false, false, false, 69), "data", [], "any", false, false, false, 69)]);
                    echo "</td>
                                    <td>";
                    // line 70
                    echo twig_var_dump($this->env, $context, ...[0 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["message"], "object", [], "any", false, false, false, 70), "private", [], "any", false, false, false, 70)]);
                    echo "</td>
                                    <td class=\"nowrap\">";
                    // line 71
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["message"], "object", [], "any", false, false, false, 71), "id", [], "any", false, false, false, 71), "html", null, true);
                    echo "</td>
                                    <td class=\"nowrap\">";
                    // line 72
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["message"], "object", [], "any", false, false, false, 72), "type", [], "any", false, false, false, 72), "html", null, true);
                    echo "</td>
                                    <td class=\"nowrap\">";
                    // line 73
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["message"], "object", [], "any", false, false, false, 73), "retry", [], "any", false, false, false, 73), "html", null, true);
                    echo "</td>
                                </tr>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['i'], $context['message'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 76
                echo "                        </table>
                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['hub'], $context['publisher'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 80
            echo "        </div>
    ";
        }
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "@Mercure/Collector/mercure.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  244 => 80,  235 => 76,  226 => 73,  222 => 72,  218 => 71,  214 => 70,  210 => 69,  206 => 68,  202 => 67,  198 => 66,  194 => 65,  191 => 64,  187 => 63,  165 => 44,  158 => 40,  149 => 36,  146 => 35,  142 => 34,  139 => 33,  133 => 29,  131 => 28,  126 => 25,  123 => 24,  116 => 23,  105 => 18,  100 => 17,  93 => 16,  83 => 12,  80 => 11,  75 => 9,  70 => 8,  67 => 7,  64 => 6,  57 => 5,  49 => 1,  47 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% import _self as helper %}

{% block toolbar %}
    {% if collector.count > 0 %}
        {% set icon %}
            {{ include('@Mercure/Icon/mercure.svg') }}
            <span class=\"sf-toolbar-value\">{{ collector.count }}</span>
        {% endset %}

        {{ include('@WebProfiler/Profiler/toolbar_item.html.twig', { link: 'mercure' }) }}
    {% endif %}
{% endblock %}

{% block menu %}
    <span class=\"label{{ collector.count == 0 ? ' disabled' }}\">
        <span class=\"icon\">{{ include('@Mercure/Icon/mercure.svg') }}</span>
        <strong>Mercure</strong>
    </span>
{% endblock %}

{% block panel %}
    {% import _self as helper %}

    <h2>Messages</h2>

    {% if collector.count == 0 %}
        <div class=\"empty\">
            <p>No messages have been collected.</p>
        </div>
    {% else %}
        <div class=\"sf-tabs\">
            {% for hub, publisher in collector.publishers %}
                <div class=\"tab\">
                    <h3 class=\"tab-title\">{{ hub }}<span class=\"badge\">{{ publisher.count }}</span></h3>
                    <div class=\"tab-content\">
                        <div class=\"metrics\">
                            <div class=\"metric\">
                                <span class=\"value\">{{ '%.0f'|format(publisher.duration) }} <span class=\"unit\">ms</span></span>
                                <span class=\"label\">Total execution time</span>
                            </div>
                            <div class=\"metric\">
                                <span class=\"value\">{{ '%.2f'|format(publisher.memory / 1024 / 1024) }} <span class=\"unit\">MB</span></span>
                                <span class=\"label\">Peak memory usage</span>
                            </div>
                        </div>

                        <table>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Time</th>
                                <th>Memory</th>
                                <th>Topics</th>
                                <th>Data</th>
                                <th>Private</th>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Retry</th>
                            </tr>
                            </thead>
                            {% for i, message in publisher.messages %}
                                <tr>
                                    <td class=\"font-normal text-small text-muted nowrap\">{{ i + 1 }}</td>
                                    <td class=\"nowrap\">{{ '%.0f'|format(message.duration) }} ms</td>
                                    <td class=\"nowrap\">{{ '%.2f'|format(message.memory / 1024 / 1024) }} MB</td>
                                    <td class=\"font-normal text-small text-bold nowrap\">{{ message.object.topics|join(',') }}</td>
                                    <td>{{ dump(message.object.data) }}</td>
                                    <td>{{ dump(message.object.private) }}</td>
                                    <td class=\"nowrap\">{{ message.object.id }}</td>
                                    <td class=\"nowrap\">{{ message.object.type }}</td>
                                    <td class=\"nowrap\">{{ message.object.retry }}</td>
                                </tr>
                            {% endfor %}
                        </table>
                    </div>
                </div>
            {% endfor %}
        </div>
    {% endif %}
{% endblock %}
", "@Mercure/Collector/mercure.html.twig", "/home/ldab/Bureau/file_rouge_ldab/vendor/symfony/mercure-bundle/src/Resources/views/Collector/mercure.html.twig");
    }
}
