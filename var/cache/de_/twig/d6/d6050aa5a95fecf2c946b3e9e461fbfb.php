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

/* components/cardTournament.html.twig */
class __TwigTemplate_c76f289a79545cc46bd53c9bf6b8e84b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "components/cardTournament.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "components/cardTournament.html.twig"));

        // line 1
        yield "<div class=\"flex flex-col border-2 rounded shadow-md py-2 aspect-square items-center cursor-pointer border-neutral-300
    hover:scale-110 transition-transform duration-200\">
    <h2 class=\"text-lg font-bold h-[20%]\">";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 3, $this->source); })()), "html", null, true);
        yield "</h2>

    <img src=\"";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl((("build/images/tournament/" . (isset($context["sportName"]) || array_key_exists("sportName", $context) ? $context["sportName"] : (function () { throw new RuntimeError('Variable "sportName" does not exist.', 5, $this->source); })())) . ".png")), "html", null, true);
        yield "\"
         alt=\"";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["sportName"]) || array_key_exists("sportName", $context) ? $context["sportName"] : (function () { throw new RuntimeError('Variable "sportName" does not exist.', 6, $this->source); })()), "html", null, true);
        yield " image\"
         class=\"h-[50%]\">

    <div class=\"flex flex-col items-center h-[30%] justify-end\">
        <p class=\"text-gray-600\">";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["location"]) || array_key_exists("location", $context) ? $context["location"] : (function () { throw new RuntimeError('Variable "location" does not exist.', 10, $this->source); })()), "html", null, true);
        yield "</p>
        <p class=\"text-sm italic\">";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["sportName"]) || array_key_exists("sportName", $context) ? $context["sportName"] : (function () { throw new RuntimeError('Variable "sportName" does not exist.', 11, $this->source); })()), "html", null, true);
        yield "</p>
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
        return "components/cardTournament.html.twig";
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
        return array (  72 => 11,  68 => 10,  61 => 6,  57 => 5,  52 => 3,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"flex flex-col border-2 rounded shadow-md py-2 aspect-square items-center cursor-pointer border-neutral-300
    hover:scale-110 transition-transform duration-200\">
    <h2 class=\"text-lg font-bold h-[20%]\">{{ name }}</h2>

    <img src=\"{{ asset('build/images/tournament/' ~ sportName ~ '.png') }}\"
         alt=\"{{ sportName }} image\"
         class=\"h-[50%]\">

    <div class=\"flex flex-col items-center h-[30%] justify-end\">
        <p class=\"text-gray-600\">{{ location }}</p>
        <p class=\"text-sm italic\">{{ sportName }}</p>
    </div>
</div>
", "components/cardTournament.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/components/cardTournament.html.twig");
    }
}
