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

/* registration/register.html.twig */
class __TwigTemplate_c5ded630ffb59f459cdb6cc972b49e9b extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "registration/register.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Inscription";
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 6
        yield "    <div class=\"w-full h-[91vh] flex flex-col items-center justify-center\">
        <section class=\"container mx-auto max-w-[340px] max-h-[380px] h-3/4 rounded-lg flex flex-col mt-2\">
            <div class=\"w-340 h-2 bg-[--bg-green-light] rounded-t-lg\"></div>
            <div class=\"rounded-t px-4 pt-4\">
                <h1 class=\"h-[30%] font-bold text-xl mb-2\">Inscription</h1>
                <p class=\"text-sm\">Créez votre compte en remplissant les champs ci-dessous.</p>
            </div>

            <form method=\"post\" class=\"h-full flex flex-col pb-4 px-4 justify-between\">
                ";
        // line 15
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["registrationForm"] ?? null), 'form_start');
        yield "
                <div class=\"flex flex-col gap-6 mt-4\">
                    <div>
                        ";
        // line 18
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["registrationForm"] ?? null), "username", [], "any", false, false, false, 18), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"], "label" => "Nom d'utilisateur"]);
        yield "
                        ";
        // line 19
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["registrationForm"] ?? null), "username", [], "any", false, false, false, 19), 'widget', ["attr" => ["class" => "w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"]]);
        yield "
                    </div>
                    <div>
                        ";
        // line 22
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["registrationForm"] ?? null), "plainPassword", [], "any", false, false, false, 22), 'label', ["label_attr" => ["class" => "block text-sm font-medium text-gray-700"], "label" => "Mot de passe"]);
        yield "
                        ";
        // line 23
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["registrationForm"] ?? null), "plainPassword", [], "any", false, false, false, 23), 'widget', ["attr" => ["class" => "w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"]]);
        yield "
                    </div>
                </div>

                <div class=\"w-full flex font-medium justify-between gap-4 mt-4\">
                    <a href=\"";
        // line 28
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\"
                       class=\"flex bg-slate-300 items-center justify-center w-1/2 gap-4 rounded px-2 text-sm py-1 \">
                        <p class=\"text-slate-500\">Retour</p>
                    </a>
                    <button class=\"flex bg-[--bg-green-light] text-white items-center justify-center w-1/2 gap-4 rounded px-2 text-sm py-1 \"
                            type=\"submit\">S'inscrire
                    </button>
                </div>
                ";
        // line 36
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["registrationForm"] ?? null), 'form_end');
        yield "
            </form>
        </section>
    </div>
";
        yield from [];
    }

    // line 42
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 43
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
";
        yield from [];
    }

    // line 46
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 47
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "registration/register.html.twig";
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
        return array (  154 => 47,  147 => 46,  139 => 43,  132 => 42,  122 => 36,  111 => 28,  103 => 23,  99 => 22,  93 => 19,  89 => 18,  83 => 15,  72 => 6,  65 => 5,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "registration/register.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/registration/register.html.twig");
    }
}
