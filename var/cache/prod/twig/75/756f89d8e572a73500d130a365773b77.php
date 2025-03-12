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

/* security/login.html.twig */
class __TwigTemplate_2480513c29e11ee5eada4a255edb8e0b extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "security/login.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Connexion";
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
                <h1 class=\"h-[30%] font-bold text-xl mb-2\">Connexion</h1>
                <p class=\"text-sm\">Veuillez entrer vos identifiants pour vous connecter.</p>
            </div>

            <form method=\"post\" class=\"h-full flex flex-col pb-4 px-4 justify-between\">
                ";
        // line 15
        if (($context["error"] ?? null)) {
            // line 16
            yield "                    <div class=\"bg-red-100 text-red-700 p-4 rounded mb-4\">
                        ";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, ($context["error"] ?? null), "messageKey", [], "any", false, false, false, 17), CoreExtension::getAttribute($this->env, $this->source, ($context["error"] ?? null), "messageData", [], "any", false, false, false, 17), "security"), "html", null, true);
            yield "
                    </div>
                ";
        }
        // line 20
        yield "
                ";
        // line 21
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, false, false, 21)) {
            // line 22
            yield "                    <div class=\"bg-blue-100 text-blue-700 p-4 rounded mb-4\">
                        Vous êtes connecté en tant que ";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, false, false, 23), "userIdentifier", [], "any", false, false, false, 23), "html", null, true);
            yield ".
                        <a href=\"";
            // line 24
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\" class=\"text-green-700 underline\">Se déconnecter</a>
                    </div>
                ";
        }
        // line 27
        yield "
                <div class=\"flex flex-col gap-6 mt-4\">
                    <div>
                        <label for=\"username\" class=\"block text-sm font-medium text-gray-700\">Nom d'utilisateur</label>
                        <input type=\"text\" value=\"";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["last_username"] ?? null), "html", null, true);
        yield "\" name=\"_username\" id=\"username\"
                               class=\"w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500\"
                               autocomplete=\"username\" required autofocus>
                    </div>
                    <div>
                        <label for=\"password\" class=\"block text-sm font-medium text-gray-700\">Mot de passe</label>
                        <input type=\"password\" name=\"_password\" id=\"password\"
                               class=\"w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500\"
                               autocomplete=\"current-password\" required>
                    </div>
                </div>



                <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        yield "\">

                <div class=\"w-full flex font-medium justify-between gap-4 mt-4\">
                    <a href=\"";
        // line 48
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\" class=\" flex bg-slate-300 items-center justify-center w-1/2
                    gap-4 rounded px-2 text-sm py-1 \">
                        <p class=\"text-slate-500\">Retour</p>
                    </a>
                    <button class=\"flex bg-[--bg-green-light] text-white items-center justify-center w-1/2
                    gap-4 rounded px-2 text-sm py-1 \" type=\"submit\">Se connecter</button>
                </div>
            </form>
        </section>
    </div>
";
        yield from [];
    }

    // line 60
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 61
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
";
        yield from [];
    }

    // line 64
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 65
        yield "    ";
        yield $this->extensions['Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension']->renderWebpackScriptTags("app");
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "security/login.html.twig";
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
        return array (  179 => 65,  172 => 64,  164 => 61,  157 => 60,  141 => 48,  135 => 45,  118 => 31,  112 => 27,  106 => 24,  102 => 23,  99 => 22,  97 => 21,  94 => 20,  88 => 17,  85 => 16,  83 => 15,  72 => 6,  65 => 5,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "security/login.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/security/login.html.twig");
    }
}
