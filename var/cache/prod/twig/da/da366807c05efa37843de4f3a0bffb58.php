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

/* tournament/list.html.twig */
class __TwigTemplate_5d17df9872f34cf68f2c8207bb83ea56 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "tournament/list.html.twig", 1);
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
        yield from         $this->loadTemplate("partial/header.html.twig", "tournament/list.html.twig", 4)->unwrap()->yield($context);
        // line 5
        yield "    ";
        yield from         $this->loadTemplate("partial/rightAside.html.twig", "tournament/list.html.twig", 5)->unwrap()->yield($context);
        // line 6
        yield "    <div class=\"shadow\">
        ";
        // line 7
        yield from         $this->loadTemplate("partial/doubleNav.html.twig", "tournament/list.html.twig", 7)->unwrap()->yield($context);
        // line 8
        yield "    </div>
    <div class=\"flex w-full h-screen container mx-auto flex flex-col items-center pt-6 text-xl font-medium main-content\">
        <div class=\"flex w-full justify-between px-8 pb-14 flex-col sm:flex-row gap-4\">
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
        yield "            <h1 class=\"flex items-center text-[#19864e] text-2xl text-center sm:text-left\">Liste des Tournois</h1>
            <div class=\"flex justify-center sm:justify-start w-full sm:w-auto\">
                ";
        // line 20
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["filterForm"] ?? null), 'form_start', ["attr" => ["class" => "flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto"]]);
        yield "
                ";
        // line 21
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["filterForm"] ?? null), "sports", [], "any", false, false, false, 21), 'row', ["attr" => ["class" => "w-full sm:w-auto"]]);
        yield "
                ";
        // line 22
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["filterForm"] ?? null), 'form_end');
        yield "
            </div>
        </div>

        <ul class=\"gap-8 w-full items-center content-center grid lg:grid-cols-5 md:grid-cols-3 grid-cols-2 justify-center px-12 pb-6 gap-8\">
            ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["tournaments"] ?? null));
        $context['_iterated'] = false;
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["tournament"]) {
            // line 28
            yield "                <li>
                    <a href=\"";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tournament_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["tournament"], "id", [], "any", false, false, false, 29)]), "html", null, true);
            yield "\" class=\"block\">
                        ";
            // line 30
            yield from             $this->loadTemplate("components/cardTournament.html.twig", "tournament/list.html.twig", 30)->unwrap()->yield(CoreExtension::merge($context, ["name" => CoreExtension::getAttribute($this->env, $this->source,             // line 31
$context["tournament"], "name", [], "any", false, false, false, 31), "location" => CoreExtension::getAttribute($this->env, $this->source,             // line 32
$context["tournament"], "location", [], "any", false, false, false, 32), "sportName" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 33
$context["tournament"], "sport", [], "any", false, false, false, 33), "name", [], "any", false, false, false, 33)]));
            // line 35
            yield "                    </a>
                </li>
            ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        if (!$context['_iterated']) {
            // line 38
            yield "                <li class=\"grid-cols-subgrid col-span-5 h-full items-center\">
                    <p class=\"text-center text-gray-500 col-start-2\">Aucun tournoi trouvé.</p>
                </li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['tournament'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        yield "        </ul>
    </div>
";
        yield from [];
    }

    // line 46
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 47
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        select {
            border-color: var(--bg-green-light);
            border-width: 3px;
            border-radius: 7px;
            padding: 2px 18px 2px 4px;

            &:hover {
                opacity: 100%;
            }
        }
    </style>
";
        yield from [];
    }

    // line 62
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 63
        yield "    ";
        yield $this->extensions['Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension']->renderWebpackScriptTags("app");
        yield "
    <script>
        document.addEventListener(\"DOMContentLoaded\", function () {
            const sportSelect = document.querySelector(\"select[name='tournament_filter[sports]']\");

            if (sportSelect) {
                sportSelect.addEventListener(\"change\", function () {
                    this.form.submit();
                });
            }
        });
    </script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "tournament/list.html.twig";
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
        return array (  206 => 63,  199 => 62,  179 => 47,  172 => 46,  165 => 42,  156 => 38,  141 => 35,  139 => 33,  138 => 32,  137 => 31,  136 => 30,  132 => 29,  129 => 28,  111 => 27,  103 => 22,  99 => 21,  95 => 20,  91 => 18,  84 => 14,  78 => 12,  76 => 11,  71 => 8,  69 => 7,  66 => 6,  63 => 5,  60 => 4,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "tournament/list.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/tournament/list.html.twig");
    }
}
