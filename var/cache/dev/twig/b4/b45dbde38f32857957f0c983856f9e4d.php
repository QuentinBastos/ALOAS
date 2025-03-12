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

/* components/cardMatch.html.twig */
class __TwigTemplate_131610a4eac970991f58ce405f0eaddf extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "components/cardMatch.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "components/cardMatch.html.twig"));

        // line 1
        yield "<div class=\"h-full w-auto flex flex-col border-2 rounded shadow py-2\">
    <div class=\"h-[5%] w-full flex items-center justify-center\">
        <p class=\"font-base text-sm\">Pétanque</p>
    </div>
    <div class=\"flex items-center justify-around h-[95%]\">
        <img src=\"";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/team/bird.svg"), "html", null, true);
        yield "\" alt=\"bird\" class=\"h-full\" />
        <p>3</p>
        <p>VS</p>
        <p>0</p>
        <img src=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/team/bird.svg"), "html", null, true);
        yield "\" alt=\"bird\" class=\"h-full\" />
    </div>
</div>
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
        return "components/cardMatch.html.twig";
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
        return array (  62 => 10,  55 => 6,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"h-full w-auto flex flex-col border-2 rounded shadow py-2\">
    <div class=\"h-[5%] w-full flex items-center justify-center\">
        <p class=\"font-base text-sm\">Pétanque</p>
    </div>
    <div class=\"flex items-center justify-around h-[95%]\">
        <img src=\"{{ asset('build/images/team/bird.svg') }}\" alt=\"bird\" class=\"h-full\" />
        <p>3</p>
        <p>VS</p>
        <p>0</p>
        <img src=\"{{ asset('build/images/team/bird.svg') }}\" alt=\"bird\" class=\"h-full\" />
    </div>
</div>
", "components/cardMatch.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/components/cardMatch.html.twig");
    }
}
