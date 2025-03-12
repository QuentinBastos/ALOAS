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

/* partial/header.html.twig */
class __TwigTemplate_20fb22d50af5e4c1947a4080fd3d9337 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partial/header.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partial/header.html.twig"));

        // line 1
        yield "<nav class=\"h-[9vh] flex items-center bg-[--bg-green-dark] border-[--bg-green-dark] border-b-4\">
    <div class=\" mx-4 flex w-full justify-between items-center\">
        <div class=\"flex items-center gap-4\">
            <a href=\"";
        // line 4
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\" class=\"flex items-center justify-center gap-2 cursor-pointer\">
                <img src=\"";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/aloas-logo.png"), "html", null, true);
        yield "\" alt=\"Logo\" class=\"h-[5vh]\">
                <h1 class=\"text-white text-2xl font-bold\">ALOAS</h1>
            </a>
        </div>
        <div>
            <div class=\"flex\">
                ";
        // line 11
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 11, $this->source); })()), "user", [], "any", false, false, false, 11)) {
            // line 12
            yield "                    <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
            yield "\"
                       class=\"flex items-center justify-center py-1 px-2 gap-2 cursor-pointer\">
                        <img src=\"";
            // line 14
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/icons/plus.svg"), "html", null, true);
            yield "\" alt=\"account\" width=\"24\">
                        <p class=\"sm:flex hidden text-md font-medium text-white\">Ajouter un utilisateur</p>
                    </a>
                    <a href=\"";
            // line 17
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\"
                       class=\"flex items-center justify-center py-1 px-2 gap-2 cursor-pointer\">
                        <img src=\"";
            // line 19
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/icons/login.svg"), "html", null, true);
            yield "\" alt=\"account\" width=\"16\">
                        <p class=\" sm:flex hidden text-md font-medium text-white\">Se déconnecter</p>
                    </a>
                ";
        } else {
            // line 23
            yield "                    <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\"
                       class=\"flex items-center justify-center py-1 px-2 gap-2 cursor-pointer\">
                        <img src=\"";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/icons/login.svg"), "html", null, true);
            yield "\" alt=\"account\" width=\"16\">
                        <p class=\"sm:flex hidden text-md font-medium text-white\">Se connecter</p>
                    </a>
                ";
        }
        // line 29
        yield "                <a id=\"buttonAside\" class=\"flex items-center justify-center py-1 px-2 gap-2 cursor-pointer\">
                    <img src=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/icons/help.svg"), "html", null, true);
        yield "\" alt=\"account\" width=\"24\">
                    <p class=\"sm:flex hidden text-md font-medium text-white\">Assistance</p>
                </a>
            </div>
        </div>
    </div>
</nav>
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
        return "partial/header.html.twig";
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
        return array (  108 => 30,  105 => 29,  98 => 25,  92 => 23,  85 => 19,  80 => 17,  74 => 14,  68 => 12,  66 => 11,  57 => 5,  53 => 4,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<nav class=\"h-[9vh] flex items-center bg-[--bg-green-dark] border-[--bg-green-dark] border-b-4\">
    <div class=\" mx-4 flex w-full justify-between items-center\">
        <div class=\"flex items-center gap-4\">
            <a href=\"{{ path('app_home') }}\" class=\"flex items-center justify-center gap-2 cursor-pointer\">
                <img src=\"{{ asset('build/images/aloas-logo.png') }}\" alt=\"Logo\" class=\"h-[5vh]\">
                <h1 class=\"text-white text-2xl font-bold\">ALOAS</h1>
            </a>
        </div>
        <div>
            <div class=\"flex\">
                {% if app.user %}
                    <a href=\"{{ path('app_register') }}\"
                       class=\"flex items-center justify-center py-1 px-2 gap-2 cursor-pointer\">
                        <img src=\"{{ asset('build/images/icons/plus.svg') }}\" alt=\"account\" width=\"24\">
                        <p class=\"sm:flex hidden text-md font-medium text-white\">Ajouter un utilisateur</p>
                    </a>
                    <a href=\"{{ path('app_logout') }}\"
                       class=\"flex items-center justify-center py-1 px-2 gap-2 cursor-pointer\">
                        <img src=\"{{ asset('build/images/icons/login.svg') }}\" alt=\"account\" width=\"16\">
                        <p class=\" sm:flex hidden text-md font-medium text-white\">Se déconnecter</p>
                    </a>
                {% else %}
                    <a href=\"{{ path('app_login') }}\"
                       class=\"flex items-center justify-center py-1 px-2 gap-2 cursor-pointer\">
                        <img src=\"{{ asset('build/images/icons/login.svg') }}\" alt=\"account\" width=\"16\">
                        <p class=\"sm:flex hidden text-md font-medium text-white\">Se connecter</p>
                    </a>
                {% endif %}
                <a id=\"buttonAside\" class=\"flex items-center justify-center py-1 px-2 gap-2 cursor-pointer\">
                    <img src=\"{{ asset('build/images/icons/help.svg') }}\" alt=\"account\" width=\"24\">
                    <p class=\"sm:flex hidden text-md font-medium text-white\">Assistance</p>
                </a>
            </div>
        </div>
    </div>
</nav>
", "partial/header.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/partial/header.html.twig");
    }
}
