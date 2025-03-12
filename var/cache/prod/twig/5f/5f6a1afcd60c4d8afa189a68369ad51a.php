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

/* team/add.html.twig */
class __TwigTemplate_f0aaf349c370d26d4fd24e4c1ced7d60 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "team/add.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Ajouter des équipes";
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
        yield "    ";
        yield from         $this->loadTemplate("partial/header.html.twig", "team/add.html.twig", 6)->unwrap()->yield($context);
        // line 7
        yield "    ";
        yield from         $this->loadTemplate("partial/rightAside.html.twig", "team/add.html.twig", 7)->unwrap()->yield($context);
        // line 8
        yield "
    <div class=\"w-full h-[91vh] flex items-center justify-center \">
        <section class=\"container mx-auto max-w-[340px] max-h-[380px] h-3/4 rounded-lg flex flex-col rounded border-t-4
        border-[--bg-green-light] px-4 pt-2\">
            <div class=\"h-1/4\">
                <h1>Ajouter des équipes</h1>
                <p class=\"step-text\">Ajouter une ou plusieurs équipes. Vous pouvez ajouter plusieurs équipes à la fois.</p>
            </div>

            ";
        // line 17
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["form"] ?? null), 'form_start', ["attr" => ["class" => "flex flex-col h-3/4 justify-between py-2"]]);
        yield "

            <div id=\"team-list\" class=\"team-list\" data-prototype=\"";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "teams", [], "any", false, false, false, 19), "vars", [], "any", false, false, false, 19), "prototype", [], "any", false, false, false, 19), 'widget'), "html_attr");
        yield "\">
                ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "teams", [], "any", false, false, false, 20));
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
        foreach ($context['_seq'] as $context["_key"] => $context["teamForm"]) {
            // line 21
            yield "                    <div class=\"team-item\" data-team-index=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 21), "html", null, true);
            yield "\">
                        <p>";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 22), "html", null, true);
            yield ". Equipe</p>
                        <div class=\"image-placeholder\" data-team-index=\"";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 23), "html", null, true);
            yield "\">
                            <img src=\"\" alt=\"\" class=\"team-preview\">
                            ";
            // line 25
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 25) != 0)) {
                // line 26
                yield "                                <button type=\"button\" class=\"remove-team btn\">
                                    &times;
                                </button>
                            ";
            }
            // line 30
            yield "                        </div>
                    </div>
                    ";
            // line 32
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, $context["teamForm"], "name", [], "any", false, false, false, 32), 'row', ["attr" => ["class" => "selected-team-name hidden", "data-team-index" => CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 32)]]);
            yield "
                ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['teamForm'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        yield "            </div>

            <div class=\"button-container\">
                <button type=\"button\" id=\"add-team\" class=\"btn add-btn\" ";
        // line 37
        if (((($context["existingTeamsCount"] ?? null) + Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "teams", [], "any", false, false, false, 37))) >= 8)) {
            yield "disabled";
        }
        yield ">
                    Ajouter une équipe
                </button>
                ";
        // line 40
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "save", [], "any", false, false, false, 40), 'row', ["attr" => ["class" => "btn save-btn"]]);
        yield "
            </div>

            ";
        // line 43
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["form"] ?? null), 'form_end');
        yield "

            <div class=\"back-button\">
                <a href=\"";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tournament_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["tournament"] ?? null), "id", [], "any", false, false, false, 46)]), "html", null, true);
        yield "\">← Retourner au tournoi</a>
            </div>
        </section>
    </div>

    <!-- Popup (Modale) -->
    <div id=\"image-popup\" class=\"popup\">
        <div class=\"popup-content\">
            <span class=\"close-popup\">&times;</span>
            <div class=\"popup-images\">
                ";
        // line 56
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["svgFiles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["file"]) {
            // line 57
            yield "                    ";
            $context["teamName"] = Twig\Extension\CoreExtension::replace($context["file"], [".svg" => ""]);
            // line 58
            yield "                    <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("build/images/team/" . $context["file"])), "html", null, true);
            yield "\" class=\"popup-team-logo\" data-name=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["teamName"] ?? null), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["teamName"] ?? null), "html", null, true);
            yield "\" />
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['file'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 60
        yield "            </div>
        </div>
    </div>

    <style>
        ";
        // line 65
        yield from $this->yieldParentBlock("body", $context, $blocks);
        yield "
    </style>

    <script>
        ";
        // line 69
        yield $this->extensions['Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension']->renderWebpackScriptTags("app");
        yield "
    </script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "team/add.html.twig";
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
        return array (  227 => 69,  220 => 65,  213 => 60,  200 => 58,  197 => 57,  193 => 56,  180 => 46,  174 => 43,  168 => 40,  160 => 37,  155 => 34,  139 => 32,  135 => 30,  129 => 26,  127 => 25,  122 => 23,  118 => 22,  113 => 21,  96 => 20,  92 => 19,  87 => 17,  76 => 8,  73 => 7,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "team/add.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/team/add.html.twig");
    }
}
