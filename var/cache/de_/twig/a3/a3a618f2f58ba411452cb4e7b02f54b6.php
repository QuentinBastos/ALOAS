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

/* tournament/add.html.twig */
class __TwigTemplate_6912a6d21d290b74eec8b9f2a60667c6 extends Template
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
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascripts' => [$this, 'block_javascripts'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tournament/add.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tournament/add.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "tournament/add.html.twig", 1);
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

        yield "Créer un tournoi";
        
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
        yield from         $this->loadTemplate("partial/header.html.twig", "tournament/add.html.twig", 6)->unwrap()->yield($context);
        // line 7
        yield "    ";
        yield from         $this->loadTemplate("partial/rightAside.html.twig", "tournament/add.html.twig", 7)->unwrap()->yield($context);
        // line 8
        yield "    <div class=\"w-full h-[91vh] flex items-center justify-center \">
        <section class=\"container mx-auto max-w-[340px] max-h-[380px] h-3/4 rounded-lg flex flex-col\">
            <div class=\"rounded-t\">
                <div class=\"w-full flex pb-4\">
                    <svg class=\"step-icon rounded-tl-lg active\" viewBox=\"0 0 30 2\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                        <rect width=\"30\" height=\"2\" />
                    </svg>
                    <svg class=\"step-icon\" viewBox=\"0 0 30 2\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                        <rect width=\"30\" height=\"2\" />
                    </svg>
                    <svg class=\"step-icon rounded-tr-lg\" viewBox=\"0 0 30 2\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                        <rect width=\"30\" height=\"2\"/>
                    </svg>
                </div>
                <h1 class=\"px-4 h-[30%] font-bold text-xl pb-4\">Créer un tournoi</h1>
                <p class=\"px-4 text-sm step-text\" style=\"display: flex;\">Toutes les données peuvent être modifiées ultérieurement.</p>
                <p class=\"px-4 text-sm step-text\" style=\"display: none;\">Inscrivez le nom du club, du parc sportif ou de la salle.</p>
                <p class=\"px-4 text-sm step-text\" style=\"display: none;\">Choisissez un sport de la liste.</p>
            </div>

            ";
        // line 28
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 28, $this->source); })()), 'form_start', ["attr" => ["class" => "h-full flex flex-col pb-4"]]);
        yield "

            <div id=\"tournamentForm\" class=\"px-4 h-full flex flex-col justify-between align-beetween\">

                <!-- Step 1 -->
                <div class=\"form-step h-full flex flex-col justify-between\" id=\"step-1\" style=\"display: flex;\">
                    <div class=\"h-full flex flex-col justify-between\">
                        <div class=\"flex flex-col gap-6 mt-4\">
                            ";
        // line 36
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 36, $this->source); })()), "name", [], "any", false, false, false, 36), 'row');
        yield "
                            ";
        // line 37
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 37, $this->source); })()), "date", [], "any", false, false, false, 37), 'row');
        yield "
                        </div>
                        <div class=\"w-full flex font-medium justify-end gap-2\">
                            <a href=\"";
        // line 40
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tournament_list");
        yield "\" class=\"opacity-70 flex bg-slate-300 items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \">
                                <p class=\"text-slate-500\">Annuler</p>
                            </a>
                            <button class=\"flex bg-[--bg-green-light] text-white items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"button\" id=\"next-step-1\">Suivant</button>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class=\"form-step h-full flex flex-col justify-between\" id=\"step-2\" style=\"display: none;\">
                    <div class=\"h-full flex flex-col justify-between\">
                        <div class=\"flex flex-col gap-6 mt-4\">
                            ";
        // line 54
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 54, $this->source); })()), "location", [], "any", false, false, false, 54), 'row');
        yield "
                        </div>
                        <div class=\"w-full flex font-medium justify-end gap-2\">
                            <button class=\"opacity-70 flex bg-slate-300 items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"button\" id=\"prev-step-2\">Précédent</button>
                            <button class=\"flex bg-[--bg-green-light] text-white items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"button\" id=\"next-step-2\">Suivant</button>
                        </div>
                    </div>
                </div>

                <!-- Step 3 (Final Step) -->
                <div class=\"form-step h-full flex flex-col justify-between\" id=\"step-3\" style=\"display: none;\">
                    <div class=\"h-full flex flex-col justify-between\">
                        <div class=\"flex flex-col gap-6 mt-4\">
                            ";
        // line 69
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 69, $this->source); })()), "sport", [], "any", false, false, false, 69), 'row');
        yield "
                        </div>
                        <div class=\"w-full flex font-medium justify-end gap-2\">
                            <button class=\"opacity-70 flex bg-slate-300 items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"button\" id=\"prev-step-3\">Précédent</button>
                            <button class=\"flex bg-[--bg-green-light] text-white items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"submit\">Envoyer</button>
                        </div>
                    </div>
                </div>
            </div>

            ";
        // line 81
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 81, $this->source); })()), 'form_end');
        yield "

        </section>
    </div>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 88
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 89
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 92
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 93
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
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
        return "tournament/add.html.twig";
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
        return array (  258 => 93,  245 => 92,  231 => 89,  218 => 88,  201 => 81,  186 => 69,  168 => 54,  151 => 40,  145 => 37,  141 => 36,  130 => 28,  108 => 8,  105 => 7,  102 => 6,  89 => 5,  66 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Créer un tournoi{% endblock %}

{% block body %}
    {% include 'partial/header.html.twig' %}
    {% include 'partial/rightAside.html.twig' %}
    <div class=\"w-full h-[91vh] flex items-center justify-center \">
        <section class=\"container mx-auto max-w-[340px] max-h-[380px] h-3/4 rounded-lg flex flex-col\">
            <div class=\"rounded-t\">
                <div class=\"w-full flex pb-4\">
                    <svg class=\"step-icon rounded-tl-lg active\" viewBox=\"0 0 30 2\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                        <rect width=\"30\" height=\"2\" />
                    </svg>
                    <svg class=\"step-icon\" viewBox=\"0 0 30 2\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                        <rect width=\"30\" height=\"2\" />
                    </svg>
                    <svg class=\"step-icon rounded-tr-lg\" viewBox=\"0 0 30 2\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                        <rect width=\"30\" height=\"2\"/>
                    </svg>
                </div>
                <h1 class=\"px-4 h-[30%] font-bold text-xl pb-4\">Créer un tournoi</h1>
                <p class=\"px-4 text-sm step-text\" style=\"display: flex;\">Toutes les données peuvent être modifiées ultérieurement.</p>
                <p class=\"px-4 text-sm step-text\" style=\"display: none;\">Inscrivez le nom du club, du parc sportif ou de la salle.</p>
                <p class=\"px-4 text-sm step-text\" style=\"display: none;\">Choisissez un sport de la liste.</p>
            </div>

            {{ form_start(form, {'attr': {'class': 'h-full flex flex-col pb-4'}}) }}

            <div id=\"tournamentForm\" class=\"px-4 h-full flex flex-col justify-between align-beetween\">

                <!-- Step 1 -->
                <div class=\"form-step h-full flex flex-col justify-between\" id=\"step-1\" style=\"display: flex;\">
                    <div class=\"h-full flex flex-col justify-between\">
                        <div class=\"flex flex-col gap-6 mt-4\">
                            {{ form_row(form.name) }}
                            {{ form_row(form.date) }}
                        </div>
                        <div class=\"w-full flex font-medium justify-end gap-2\">
                            <a href=\"{{ path('app_tournament_list') }}\" class=\"opacity-70 flex bg-slate-300 items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \">
                                <p class=\"text-slate-500\">Annuler</p>
                            </a>
                            <button class=\"flex bg-[--bg-green-light] text-white items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"button\" id=\"next-step-1\">Suivant</button>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class=\"form-step h-full flex flex-col justify-between\" id=\"step-2\" style=\"display: none;\">
                    <div class=\"h-full flex flex-col justify-between\">
                        <div class=\"flex flex-col gap-6 mt-4\">
                            {{ form_row(form.location) }}
                        </div>
                        <div class=\"w-full flex font-medium justify-end gap-2\">
                            <button class=\"opacity-70 flex bg-slate-300 items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"button\" id=\"prev-step-2\">Précédent</button>
                            <button class=\"flex bg-[--bg-green-light] text-white items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"button\" id=\"next-step-2\">Suivant</button>
                        </div>
                    </div>
                </div>

                <!-- Step 3 (Final Step) -->
                <div class=\"form-step h-full flex flex-col justify-between\" id=\"step-3\" style=\"display: none;\">
                    <div class=\"h-full flex flex-col justify-between\">
                        <div class=\"flex flex-col gap-6 mt-4\">
                            {{ form_row(form.sport) }}
                        </div>
                        <div class=\"w-full flex font-medium justify-end gap-2\">
                            <button class=\"opacity-70 flex bg-slate-300 items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"button\" id=\"prev-step-3\">Précédent</button>
                            <button class=\"flex bg-[--bg-green-light] text-white items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"submit\">Envoyer</button>
                        </div>
                    </div>
                </div>
            </div>

            {{ form_end(form) }}

        </section>
    </div>

{% endblock %}

{% block stylesheets %}
    {{ parent() }}
{% endblock %}

{% block javascripts %}
    {{ parent() }}
{% endblock %}
", "tournament/add.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/tournament/add.html.twig");
    }
}
