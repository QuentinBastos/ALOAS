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
class __TwigTemplate_0fea29ae4b6fa3f4fe55d2190cd6adc8 extends Template
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
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, false, false, 11)) {
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
        return array (  102 => 30,  99 => 29,  92 => 25,  86 => 23,  79 => 19,  74 => 17,  68 => 14,  62 => 12,  60 => 11,  51 => 5,  47 => 4,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "partial/header.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/partial/header.html.twig");
    }
}
