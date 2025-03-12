<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* team/add.html.twig */
class __TwigTemplate_f065ee254629209480f01eb5ccf31ab3 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "team/add.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "team/add.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "team/add.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Ajouter des équipes";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "    ";
        yield from         $this->loadTemplate("partial/header.html.twig", "team/add.html.twig", 6)->unwrap()->yield($context);
        // line 7
        yield "    ";
        yield from         $this->loadTemplate("partial/rightAside.html.twig", "team/add.html.twig", 7)->unwrap()->yield($context);
        // line 8
        yield "
    <div class=\"w-full h-[91vh] flex items-center justify-center \">
        <section class=\"container mx-auto max-w-[340px] max-h-[380px] h-3/4 rounded-lg flex flex-col rounded border-t-4
        border-[--bg-green-light] px-4 pt-2\">
            <div class=\"h-1/4\">
                <h1>Ajouter des équipes</h1>
                <p class=\"step-text\">Ajouter une ou plusieurs équipes. Vous pouvez ajouter plusieurs équipes à la fois.</p>
            </div>

            ";
        // line 17
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 17, $this->source); })()), 'form_start', ["attr" => ["class" => "flex flex-col h-3/4 justify-between py-2"]]);
        yield "

            <div id=\"team-list\" class=\"team-list\" data-prototype=\"";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 19, $this->source); })()), "teams", [], "any", false, false, false, 19), "vars", [], "any", false, false, false, 19), "prototype", [], "any", false, false, false, 19), 'widget'), "html_attr");
        yield "\">
                ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 20, $this->source); })()), "teams", [], "any", false, false, false, 20));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["teamForm"]) {
            // line 21
            yield "                    <div class=\"team-item\" data-team-index=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 21), "html", null, true);
            yield "\">
                        <p>";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 22), "html", null, true);
            yield ". Equipe</p>
                        <div class=\"image-placeholder\" data-team-index=\"";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 23), "html", null, true);
            yield "\">
                            <img src=\"\" alt=\"\" class=\"team-preview\">
                            ";
            // line 25
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 25) != 0)) {
                // line 26
                yield "                                <button type=\"button\" class=\"remove-team btn\">
                                    &times;
                                </button>
                            ";
            }
            // line 30
            yield "                        </div>
                    </div>
                    ";
            // line 32
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, $context["teamForm"], "name", [], "any", false, false, false, 32), 'row', ["attr" => ["class" => "selected-team-name hidden", "data-team-index" => CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 32)]]);
            yield "
                ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['teamForm'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        yield "            </div>

            <div class=\"button-container\">
                <button type=\"button\" id=\"add-team\" class=\"btn add-btn\" ";
        // line 37
        if ((((isset($context["existingTeamsCount"]) || array_key_exists("existingTeamsCount", $context) ? $context["existingTeamsCount"] : (function () { throw new RuntimeError('Variable "existingTeamsCount" does not exist.', 37, $this->source); })()) + Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 37, $this->source); })()), "teams", [], "any", false, false, false, 37))) >= 8)) {
            yield "disabled";
        }
        yield ">
                    Ajouter une équipe
                </button>
                ";
        // line 40
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 40, $this->source); })()), "save", [], "any", false, false, false, 40), 'row', ["attr" => ["class" => "btn save-btn"]]);
        yield "
            </div>

            ";
        // line 43
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 43, $this->source); })()), 'form_end');
        yield "

            <div class=\"back-button\">
                <a href=\"";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tournament_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["tournament"]) || array_key_exists("tournament", $context) ? $context["tournament"] : (function () { throw new RuntimeError('Variable "tournament" does not exist.', 46, $this->source); })()), "id", [], "any", false, false, false, 46)]), "html", null, true);
        yield "\">← Retourner au tournoi</a>
            </div>
        </section>
    </div>

    <!-- Popup (Modale) -->
    <div id=\"image-popup\" class=\"popup\">
        <div class=\"popup-content\">
            <span class=\"close-popup\">&times;</span>
            <div class=\"popup-images\">
                ";
        // line 56
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["svgFiles"]) || array_key_exists("svgFiles", $context) ? $context["svgFiles"] : (function () { throw new RuntimeError('Variable "svgFiles" does not exist.', 56, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["file"]) {
            // line 57
            yield "                    ";
            $context["teamName"] = Twig\Extension\CoreExtension::replace($context["file"], [".svg" => ""]);
            // line 58
            yield "                    <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("build/images/team/" . $context["file"])), "html", null, true);
            yield "\" class=\"popup-team-logo\" data-name=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["teamName"]) || array_key_exists("teamName", $context) ? $context["teamName"] : (function () { throw new RuntimeError('Variable "teamName" does not exist.', 58, $this->source); })()), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["teamName"]) || array_key_exists("teamName", $context) ? $context["teamName"] : (function () { throw new RuntimeError('Variable "teamName" does not exist.', 58, $this->source); })()), "html", null, true);
            yield "\" />
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['file'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 60
        yield "            </div>
        </div>
    </div>

    <style>
        ";
        // line 65
        yield from $this->yieldParentBlock("body", $context, $blocks);
        yield "
    </style>

    <script>
        ";
        // line 69
        yield $this->extensions['Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension']->renderWebpackScriptTags("app");
        yield "
    </script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "team/add.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  257 => 69,  250 => 65,  243 => 60,  230 => 58,  227 => 57,  223 => 56,  210 => 46,  204 => 43,  198 => 40,  190 => 37,  185 => 34,  169 => 32,  165 => 30,  159 => 26,  157 => 25,  152 => 23,  148 => 22,  143 => 21,  126 => 20,  122 => 19,  117 => 17,  106 => 8,  103 => 7,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Ajouter des équipes{% endblock %}

{% block body %}
    {% include 'partial/header.html.twig' %}
    {% include 'partial/rightAside.html.twig' %}

    <div class=\"w-full h-[91vh] flex items-center justify-center \">
        <section class=\"container mx-auto max-w-[340px] max-h-[380px] h-3/4 rounded-lg flex flex-col rounded border-t-4
        border-[--bg-green-light] px-4 pt-2\">
            <div class=\"h-1/4\">
                <h1>Ajouter des équipes</h1>
                <p class=\"step-text\">Ajouter une ou plusieurs équipes. Vous pouvez ajouter plusieurs équipes à la fois.</p>
            </div>

            {{ form_start(form, {'attr': {'class': 'flex flex-col h-3/4 justify-between py-2'}}) }}

            <div id=\"team-list\" class=\"team-list\" data-prototype=\"{{ form_widget(form.teams.vars.prototype)|e('html_attr') }}\">
                {% for teamForm in form.teams %}
                    <div class=\"team-item\" data-team-index=\"{{ loop.index0 }}\">
                        <p>{{ loop.index0 }}. Equipe</p>
                        <div class=\"image-placeholder\" data-team-index=\"{{ loop.index0 }}\">
                            <img src=\"\" alt=\"\" class=\"team-preview\">
                            {% if loop.index0 != 0 %}
                                <button type=\"button\" class=\"remove-team btn\">
                                    &times;
                                </button>
                            {% endif %}
                        </div>
                    </div>
                    {{ form_row(teamForm.name, {'attr': {'class': 'selected-team-name hidden', 'data-team-index': loop.index0}}) }}
                {% endfor %}
            </div>

            <div class=\"button-container\">
                <button type=\"button\" id=\"add-team\" class=\"btn add-btn\" {% if existingTeamsCount + form.teams|length >= 8 %}disabled{% endif %}>
                    Ajouter une équipe
                </button>
                {{ form_row(form.save, {'attr': {'class': 'btn save-btn'}}) }}
            </div>

            {{ form_end(form) }}

            <div class=\"back-button\">
                <a href=\"{{ path('app_tournament_show', {'id': tournament.id}) }}\">← Retourner au tournoi</a>
            </div>
        </section>
    </div>

    <!-- Popup (Modale) -->
    <div id=\"image-popup\" class=\"popup\">
        <div class=\"popup-content\">
            <span class=\"close-popup\">&times;</span>
            <div class=\"popup-images\">
                {% for file in svgFiles %}
                    {% set teamName = file|replace({'.svg': ''}) %}
                    <img src=\"{{ asset('build/images/team/' ~ file) }}\" class=\"popup-team-logo\" data-name=\"{{ teamName }}\" alt=\"{{ teamName }}\" />
                {% endfor %}
            </div>
        </div>
    </div>

    <style>
        {{ parent() }}
    </style>

    <script>
        {{ encore_entry_script_tags('app') }}
    </script>
{% endblock %}
", "team/add.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/team/add.html.twig");
    }
}
