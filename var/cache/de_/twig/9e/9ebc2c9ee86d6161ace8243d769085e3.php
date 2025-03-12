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

/* partial/doubleNav.html.twig */
class __TwigTemplate_57fae6459de74d9d3f9cf2243160c11c extends Template
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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partial/doubleNav.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partial/doubleNav.html.twig"));

        // line 1
        yield "<ul class=\"container mx-auto flex sm:justify-start justify-center text-[--bg-green-light] font-medium\">
    <li class=\"flex px-8 hover:bg-[--bg-green-hover] transition-all bg-white justify-center lg:justify-start cursor-pointer\">
        <a href=\"";
        // line 3
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\" class=\"flex flex-row py-2.5 pl-0 gap-2 lg:pl-2 items-center w-full\">
            <img src=\"";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/icons/home.svg"), "html", null, true);
        yield "\" alt=\"home\" width=\"12px\">
            <p>Accueil</p>
        </a>
    </li>
    <li class=\"flex px-8 hover:bg-[--bg-green-hover] transition-all bg-white justify-center lg:justify-start cursor-pointer\">
        <a href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tournament_list");
        yield "\" class=\"flex flex-row py-2.5 pl-0 gap-2 lg:pl-2 items-center w-full\">
            <img src=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/icons/cupGreen.svg"), "html", null, true);
        yield "\" alt=\"cup\" width=\"12px\">
            <p>Tournois</p>
        </a>
    </li>
</ul>

";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partial/doubleNav.html.twig";
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
        return array (  68 => 10,  64 => 9,  56 => 4,  52 => 3,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<ul class=\"container mx-auto flex sm:justify-start justify-center text-[--bg-green-light] font-medium\">
    <li class=\"flex px-8 hover:bg-[--bg-green-hover] transition-all bg-white justify-center lg:justify-start cursor-pointer\">
        <a href=\"{{ path('app_home') }}\" class=\"flex flex-row py-2.5 pl-0 gap-2 lg:pl-2 items-center w-full\">
            <img src=\"{{ asset('build/images/icons/home.svg') }}\" alt=\"home\" width=\"12px\">
            <p>Accueil</p>
        </a>
    </li>
    <li class=\"flex px-8 hover:bg-[--bg-green-hover] transition-all bg-white justify-center lg:justify-start cursor-pointer\">
        <a href=\"{{ path('app_tournament_list') }}\" class=\"flex flex-row py-2.5 pl-0 gap-2 lg:pl-2 items-center w-full\">
            <img src=\"{{ asset('build/images/icons/cupGreen.svg') }}\" alt=\"cup\" width=\"12px\">
            <p>Tournois</p>
        </a>
    </li>
</ul>

", "partial/doubleNav.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/partial/doubleNav.html.twig");
    }
}
