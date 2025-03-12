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
class __TwigTemplate_a33134220c5626abf459c2f3515b12a5 extends Template
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
        return array (  95 => 40,  83 => 31,  76 => 27,  69 => 23,  57 => 14,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "partial/rightAside.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/partial/rightAside.html.twig");
    }
}
