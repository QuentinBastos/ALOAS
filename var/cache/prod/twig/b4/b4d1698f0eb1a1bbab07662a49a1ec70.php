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

/* home/home.html.twig */
class __TwigTemplate_86f6cd24cced6f3e2368c448bd28a94d extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "home/home.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "    ";
        yield from         $this->loadTemplate("partial/header.html.twig", "home/home.html.twig", 4)->unwrap()->yield($context);
        // line 5
        yield "    ";
        yield from         $this->loadTemplate("partial/rightAside.html.twig", "home/home.html.twig", 5)->unwrap()->yield($context);
        // line 6
        yield "    <div class=\"shadow\">
        ";
        // line 7
        yield from         $this->loadTemplate("partial/doubleNav.html.twig", "home/home.html.twig", 7)->unwrap()->yield($context);
        // line 8
        yield "    </div>
    <div class=\"flex w-full h-screen container mx-auto flex flex-col items-center pt-6 text-xl font-medium main-content\">
        <div class=\"flex w-full justify-between px-8 pb-14 flex-col sm:flex-row gap-6 sm:gap-0\">
            ";
        // line 11
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, false, false, 11)) {
            // line 12
            yield "                <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tournament_add");
            yield "\"
                   class=\"flex bg-[--bg-green-light] items-center justify-center gap-4 rounded px-4 py-2 text-white text-base w-full sm:w-auto\">
                    <img src=\"";
            // line 14
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/icons/cupWhite.svg"), "html", null, true);
            yield "\" alt=\"ajout tournois\" width=\"14px\">
                    <p>Créer un tournoi</p>
                </a>
            ";
        }
        // line 18
        yield "            <h1 class=\"hidden sm:flex items-center text-[#19864e] sm:ml-8\">Derniers Match</h1>
            <form action=\"";
        // line 19
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\" method=\"GET\"
                  class=\"flex flex-col sm:flex-row items-center gap-4 sm:gap-6 w-full sm:w-auto\">
                <div class=\"sm:flex sm:justify-center items-center gap-2 w-full\">
                    <input type=\"date\" id=\"dateFilter\" name=\"dateFilter\"
                           class=\"mb-4 sm:mb-0 px-2 py-1 pt-2 pb-2 rounded border text-sm w-full sm:w-auto\"
                           value=\"";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 24), "query", [], "any", false, false, false, 24), "get", ["dateFilter"], "method", false, false, false, 24), "html", null, true);
        yield "\">
                    <button type=\"submit\"
                            class=\"bg-[--bg-green-dark] text-sm text-white rounded px-4 py-2 w-full sm:w-auto\">Filtrer
                    </button>
                </div>
            </form>
            <h1 class=\"sm:hidden flex justify-center text-[#19864e] sm:ml-8\">Derniers Match</h1>
        </div>

        ";
        // line 33
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["teamMatchResults"] ?? null))) {
            // line 34
            yield "            <ul class=\"flex flex-col gap-4 w-full items-center grid lg:grid-cols-2 grid-cols-1 justify-center gap-8 px-12 pb-6\">
                ";
            // line 35
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["teamMatchResults"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["result"]) {
                // line 36
                yield "                    <li class=\"h-[12.5vh] w-full\">
                        <div class=\"h-full w-auto flex flex-col border-2 rounded shadow py-2\">
                            <div class=\"h-[5%] w-full flex items-center justify-center\">
                                <p class=\"font-base text-sm\">";
                // line 39
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["result"], "tournament", [], "any", false, false, false, 39), "sport", [], "any", false, false, false, 39), "name", [], "any", false, false, false, 39), "html", null, true);
                yield "</p>
                            </div>
                            <div class=\"flex items-center justify-around h-[95%]\">
                                <img src=\"";
                // line 42
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl((("build/images/team/" . Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["result"], "home", [], "any", false, false, false, 42), "name", [], "any", false, false, false, 42))) . ".svg")), "html", null, true);
                yield "\"
                                     alt=\"";
                // line 43
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["result"], "home", [], "any", false, false, false, 43), "name", [], "any", false, false, false, 43), "html", null, true);
                yield "\" class=\"h-full\"/>
                                <p class=\"";
                // line 44
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["result"], "winner", [], "any", false, false, false, 44) == CoreExtension::getAttribute($this->env, $this->source, $context["result"], "home", [], "any", false, false, false, 44))) ? ("text-gold") : (""));
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["result"], "homeScore", [], "any", false, false, false, 44), "html", null, true);
                yield "</p>
                                <p>VS</p>
                                <img src=\"";
                // line 46
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl((("build/images/team/" . Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["result"], "visitor", [], "any", false, false, false, 46), "name", [], "any", false, false, false, 46))) . ".svg")), "html", null, true);
                yield "\"
                                     alt=\"";
                // line 47
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["result"], "visitor", [], "any", false, false, false, 47), "name", [], "any", false, false, false, 47), "html", null, true);
                yield "\" class=\"h-full\"/>
                                <p class=\"";
                // line 48
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["result"], "winner", [], "any", false, false, false, 48) == CoreExtension::getAttribute($this->env, $this->source, $context["result"], "visitor", [], "any", false, false, false, 48))) ? ("text-gold") : (""));
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["result"], "visitorScore", [], "any", false, false, false, 48), "html", null, true);
                yield "</p>
                            </div>
                        </div>
                    </li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['result'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 53
            yield "            </ul>

        ";
        } else {
            // line 56
            yield "            <p>Aucun match trouvé.</p>
        ";
        }
        // line 58
        yield "    </div>
";
        yield from [];
    }

    // line 61
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 62
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
";
        yield from [];
    }

    // line 65
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 66
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
        return "home/home.html.twig";
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
        return array (  207 => 66,  200 => 65,  192 => 62,  185 => 61,  179 => 58,  175 => 56,  170 => 53,  157 => 48,  153 => 47,  149 => 46,  142 => 44,  138 => 43,  134 => 42,  128 => 39,  123 => 36,  119 => 35,  116 => 34,  114 => 33,  102 => 24,  94 => 19,  91 => 18,  84 => 14,  78 => 12,  76 => 11,  71 => 8,  69 => 7,  66 => 6,  63 => 5,  60 => 4,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "home/home.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/home/home.html.twig");
    }
}
