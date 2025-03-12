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

/* partial/rightAside.html.twig */
class __TwigTemplate_6e0ec623292869d86307a4a62b764b5b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partial/rightAside.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partial/rightAside.html.twig"));

        // line 1
        yield "<div id=\"rightAside\" class=\"aside hidden\">
    <div class=\"insideAside\">
        <div class=\"h-[9vh] shadow\">
            <div id=\"buttonClose\" class=\"flex items-center h-full w-full p-5 font-bold text-xl cursor-pointer\">
                <i class=\"fa-solid fa-chevron-right pr-3\"></i>
                Assistance
            </div>
        </div>
        <div class=\"h-[91vh]\">
            <div class=\"shadow pl-5 pr-5 pt-2 pb-2 flex flex-col\">
                <span class=\"titleVideo\">
                    Vidéos
                </span>
                <a href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_video_all");
        yield "\" class=\"textVideo\">
                    <i class=\"fa-solid fa-video\"></i>
                    <span>Voir les vidéos d'explication</span>
                </a>
            </div>
            <div class=\"shadow pl-5 pr-5 pt-2 pb-2 flex flex-col\">
                <span class=\"titleVideo\">
                    Créer un calendrier de tournois
                </span>
                <a href=\"";
        // line 23
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_video_team");
        yield "\" class=\"textVideo\">
                    <i class=\"fa-solid fa-people-group\"></i>
                    <span>Ajouter des équipes</span>
                </a>
                <a href=\"";
        // line 27
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_video_team");
        yield "\" class=\"textVideo\">
                    <i class=\"fa-solid fa-trophy\"></i>
                    <span>Créer un classement</span>
                </a>
                <a href=\"";
        // line 31
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_video_team");
        yield "\" class=\"textVideo\">
                    <i class=\"fa-solid fa-arrow-trend-up\"></i>
                    <span>Traiter des scores</span>
                </a>
            </div>
            <div class=\"shadow pl-5 pr-5 pt-2 pb-2 flex flex-col\">
                <span class=\"titleVideo\">
                    Plus d'aide
                </span>
                <a href=\"";
        // line 40
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_video_help");
        yield "\" class=\"textVideo\">
                    <i class=\"fa-solid fa-phone\"></i>
                    <span>Centre d'aide</span>
                </a>
            </div>
        </div>
    </div>
</div>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partial/rightAside.html.twig";
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
        return array (  101 => 40,  89 => 31,  82 => 27,  75 => 23,  63 => 14,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div id=\"rightAside\" class=\"aside hidden\">
    <div class=\"insideAside\">
        <div class=\"h-[9vh] shadow\">
            <div id=\"buttonClose\" class=\"flex items-center h-full w-full p-5 font-bold text-xl cursor-pointer\">
                <i class=\"fa-solid fa-chevron-right pr-3\"></i>
                Assistance
            </div>
        </div>
        <div class=\"h-[91vh]\">
            <div class=\"shadow pl-5 pr-5 pt-2 pb-2 flex flex-col\">
                <span class=\"titleVideo\">
                    Vidéos
                </span>
                <a href=\"{{ path('app_video_all') }}\" class=\"textVideo\">
                    <i class=\"fa-solid fa-video\"></i>
                    <span>Voir les vidéos d'explication</span>
                </a>
            </div>
            <div class=\"shadow pl-5 pr-5 pt-2 pb-2 flex flex-col\">
                <span class=\"titleVideo\">
                    Créer un calendrier de tournois
                </span>
                <a href=\"{{ path('app_video_team') }}\" class=\"textVideo\">
                    <i class=\"fa-solid fa-people-group\"></i>
                    <span>Ajouter des équipes</span>
                </a>
                <a href=\"{{ path('app_video_team') }}\" class=\"textVideo\">
                    <i class=\"fa-solid fa-trophy\"></i>
                    <span>Créer un classement</span>
                </a>
                <a href=\"{{ path('app_video_team') }}\" class=\"textVideo\">
                    <i class=\"fa-solid fa-arrow-trend-up\"></i>
                    <span>Traiter des scores</span>
                </a>
            </div>
            <div class=\"shadow pl-5 pr-5 pt-2 pb-2 flex flex-col\">
                <span class=\"titleVideo\">
                    Plus d'aide
                </span>
                <a href=\"{{ path('app_video_help') }}\" class=\"textVideo\">
                    <i class=\"fa-solid fa-phone\"></i>
                    <span>Centre d'aide</span>
                </a>
            </div>
        </div>
    </div>
</div>", "partial/rightAside.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/partial/rightAside.html.twig");
    }
}
