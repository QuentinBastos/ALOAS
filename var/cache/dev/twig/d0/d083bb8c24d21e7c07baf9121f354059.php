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

/* tournament/show.html.twig */
class __TwigTemplate_52423d6405602421945580d2836a7e7f extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tournament/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tournament/show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "tournament/show.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Tournoi - ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tournament"]) || array_key_exists("tournament", $context) ? $context["tournament"] : (function () { throw new RuntimeError('Variable "tournament" does not exist.', 3, $this->source); })()), "name", [], "any", false, false, false, 3), "html", null, true);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "    ";
        yield from         $this->loadTemplate("partial/header.html.twig", "tournament/show.html.twig", 6)->unwrap()->yield($context);
        // line 7
        yield "    ";
        yield from         $this->loadTemplate("partial/rightAside.html.twig", "tournament/show.html.twig", 7)->unwrap()->yield($context);
        // line 8
        yield "    <div class=\"shadow\">
        ";
        // line 9
        yield from         $this->loadTemplate("partial/doubleNav.html.twig", "tournament/show.html.twig", 9)->unwrap()->yield($context);
        // line 10
        yield "    </div>
    <div class=\"flex w-full h-screen container mx-auto flex flex-col md:flex-row gap-4 md:gap-8 pt-6 text-xl font-medium main-content\">
        <div class=\"w-full md:w-[80%] flex flex-col items-center px-4\">
            <h1 class=\"text-2xl font-bold text-[--bg-green-light] text-center\">Tournoi : ";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tournament"]) || array_key_exists("tournament", $context) ? $context["tournament"] : (function () { throw new RuntimeError('Variable "tournament" does not exist.', 13, $this->source); })()), "name", [], "any", false, false, false, 13), "html", null, true);
        yield "</h1>
            <ul class=\"flex flex-col md:flex-row w-full justify-between items-center mt-2 text-center md:text-left\">
                <li class=\"flex text-gray-700\">
                    ";
        // line 16
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["tournament"]) || array_key_exists("tournament", $context) ? $context["tournament"] : (function () { throw new RuntimeError('Variable "tournament" does not exist.', 16, $this->source); })()), "sport", [], "any", false, false, false, 16), "name", [], "any", false, false, false, 16) == "football")) {
            // line 17
            yield "                        ⚽
                    ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 18
(isset($context["tournament"]) || array_key_exists("tournament", $context) ? $context["tournament"] : (function () { throw new RuntimeError('Variable "tournament" does not exist.', 18, $this->source); })()), "sport", [], "any", false, false, false, 18), "name", [], "any", false, false, false, 18) == "tennis")) {
            // line 19
            yield "                        🎾
                    ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 20
(isset($context["tournament"]) || array_key_exists("tournament", $context) ? $context["tournament"] : (function () { throw new RuntimeError('Variable "tournament" does not exist.', 20, $this->source); })()), "sport", [], "any", false, false, false, 20), "name", [], "any", false, false, false, 20) == "basketball")) {
            // line 21
            yield "                        🏀
                    ";
        }
        // line 23
        yield "                    Sport : ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["tournament"]) || array_key_exists("tournament", $context) ? $context["tournament"] : (function () { throw new RuntimeError('Variable "tournament" does not exist.', 23, $this->source); })()), "sport", [], "any", false, false, false, 23), "name", [], "any", false, false, false, 23), "html", null, true);
        yield "
                </li>
                <li class=\"flex text-gray-700\">Lieu : ";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tournament"]) || array_key_exists("tournament", $context) ? $context["tournament"] : (function () { throw new RuntimeError('Variable "tournament" does not exist.', 25, $this->source); })()), "location", [], "any", false, false, false, 25), "html", null, true);
        yield "</li>
                <li class=\"flex text-gray-700\">Date : ";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tournament"]) || array_key_exists("tournament", $context) ? $context["tournament"] : (function () { throw new RuntimeError('Variable "tournament" does not exist.', 26, $this->source); })()), "date", [], "any", false, false, false, 26), "d/m/Y"), "html", null, true);
        yield "</li>
            </ul>

            <h2 class=\"text-xl font-bold mt-6\">Matchs</h2>

            ";
        // line 31
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["matches"]) || array_key_exists("matches", $context) ? $context["matches"] : (function () { throw new RuntimeError('Variable "matches" does not exist.', 31, $this->source); })()))) {
            // line 32
            yield "                <p class=\"text-gray-500\">Aucun match généré pour l'instant.</p>
            ";
        } else {
            // line 34
            yield "                <form class=\"w-full\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tournament_update_scores", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["tournament"]) || array_key_exists("tournament", $context) ? $context["tournament"] : (function () { throw new RuntimeError('Variable "tournament" does not exist.', 34, $this->source); })()), "id", [], "any", false, false, false, 34)]), "html", null, true);
            yield "\" method=\"POST\">
                    <div class=\"tournament-tree w-full overflow-x-auto\">
                        ";
            // line 36
            $context["maxPhases"] = Twig\Extension\CoreExtension::reduce($this->env, Twig\Extension\CoreExtension::map($this->env, (isset($context["matches"]) || array_key_exists("matches", $context) ? $context["matches"] : (function () { throw new RuntimeError('Variable "matches" does not exist.', 36, $this->source); })()), function ($__m__) use ($context, $macros) { $context["m"] = $__m__; return CoreExtension::getAttribute($this->env, $this->source, (isset($context["m"]) || array_key_exists("m", $context) ? $context["m"] : (function () { throw new RuntimeError('Variable "m" does not exist.', 36, $this->source); })()), "phase", [], "any", false, false, false, 36); }), function ($__carry__, $__item__) use ($context, $macros) { $context["carry"] = $__carry__; $context["item"] = $__item__; return ((((isset($context["item"]) || array_key_exists("item", $context) ? $context["item"] : (function () { throw new RuntimeError('Variable "item" does not exist.', 36, $this->source); })()) > (isset($context["carry"]) || array_key_exists("carry", $context) ? $context["carry"] : (function () { throw new RuntimeError('Variable "carry" does not exist.', 36, $this->source); })()))) ? ((isset($context["item"]) || array_key_exists("item", $context) ? $context["item"] : (function () { throw new RuntimeError('Variable "item" does not exist.', 36, $this->source); })())) : ((isset($context["carry"]) || array_key_exists("carry", $context) ? $context["carry"] : (function () { throw new RuntimeError('Variable "carry" does not exist.', 36, $this->source); })()))); }, 1);
            // line 37
            yield "
                        ";
            // line 38
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range((isset($context["maxPhases"]) || array_key_exists("maxPhases", $context) ? $context["maxPhases"] : (function () { throw new RuntimeError('Variable "maxPhases" does not exist.', 38, $this->source); })()), 1));
            foreach ($context['_seq'] as $context["_key"] => $context["phase"]) {
                // line 39
                yield "                            <div class=\"phase phase-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["phase"], "html", null, true);
                yield "\">
                                <h2 class=\"text-center text-xl font-bold my-4\">Phase ";
                // line 40
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["phase"], "html", null, true);
                yield "</h2>
                                <div class=\"matches flex flex-wrap justify-center gap-x-4 gap-y-4 w-full overflow-x-auto\">
                                    ";
                // line 42
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable((isset($context["matches"]) || array_key_exists("matches", $context) ? $context["matches"] : (function () { throw new RuntimeError('Variable "matches" does not exist.', 42, $this->source); })()));
                foreach ($context['_seq'] as $context["_key"] => $context["match"]) {
                    // line 43
                    yield "                                        ";
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["match"], "phase", [], "any", false, false, false, 43) == $context["phase"])) {
                        // line 44
                        yield "                                            <div class=\"flex items-center justify-around border-2 rounded shadow py-2 px-2 gap-2 bg-white min-w-[280px]\">
                                                <img src=\"";
                        // line 45
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl((("build/images/team/" . Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["match"], "home", [], "any", false, false, false, 45), "name", [], "any", false, false, false, 45))) . ".svg")), "html", null, true);
                        yield "\"
                                                     alt=\"";
                        // line 46
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["match"], "home", [], "any", false, false, false, 46), "name", [], "any", false, false, false, 46), "html", null, true);
                        yield "\" class=\"h-12 w-12 object-contain\">

                                                <input type=\"number\" name=\"home_score_";
                        // line 48
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["match"], "id", [], "any", false, false, false, 48), "html", null, true);
                        yield "\" value=\"";
                        (((CoreExtension::getAttribute($this->env, $this->source, $context["match"], "homeScore", [], "any", true, true, false, 48) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["match"], "homeScore", [], "any", false, false, false, 48)))) ? (yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["match"], "homeScore", [], "any", false, false, false, 48), "html", null, true)) : (yield ""));
                        yield "\"
                                                       class=\"w-12 text-center border border-gray-300 rounded\">

                                                <p class=\"font-bold text-lg\">/</p>

                                                <input type=\"number\" name=\"visitor_score_";
                        // line 53
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["match"], "id", [], "any", false, false, false, 53), "html", null, true);
                        yield "\" value=\"";
                        (((CoreExtension::getAttribute($this->env, $this->source, $context["match"], "visitorScore", [], "any", true, true, false, 53) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["match"], "visitorScore", [], "any", false, false, false, 53)))) ? (yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["match"], "visitorScore", [], "any", false, false, false, 53), "html", null, true)) : (yield ""));
                        yield "\"
                                                       class=\"w-12 text-center border border-gray-300 rounded\">

                                                <img src=\"";
                        // line 56
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl((("build/images/team/" . Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["match"], "visitor", [], "any", false, false, false, 56), "name", [], "any", false, false, false, 56))) . ".svg")), "html", null, true);
                        yield "\"
                                                     alt=\"";
                        // line 57
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["match"], "visitor", [], "any", false, false, false, 57), "name", [], "any", false, false, false, 57), "html", null, true);
                        yield "\" class=\"h-12 w-12 object-contain\">
                                            </div>
                                        ";
                    }
                    // line 60
                    yield "                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['match'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 61
                yield "                                </div>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['phase'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 64
            yield "                    </div>

                    <div class=\"text-center my-6\">
                        <button type=\"submit\" class=\"px-6 py-2 bg-[--bg-green-dark] text-white rounded shadow w-full md:w-auto\">Valider les scores</button>
                    </div>
                </form>
            ";
        }
        // line 71
        yield "        </div>

        <div class=\"flex flex-col w-full md:w-[20%] gap-8 px-4\">
            <div class=\"flex flex-col items-center justify-between rounded shadow-md w-full\">
                <h2 class=\"flex items-center justify-center text-sm font-bold bg-[--bg-green-dark] text-white w-full px-2 py-2 rounded-t\">Équipes participantes</h2>
                <ul class=\"w-full mt-2 px-2\">
                    ";
        // line 77
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["teams"]) || array_key_exists("teams", $context) ? $context["teams"] : (function () { throw new RuntimeError('Variable "teams" does not exist.', 77, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["key"] => $context["team"]) {
            // line 78
            yield "                        <li class=\"flex items-center w-full justify-between text-sm\">
                            <p>";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["key"] + 1), "html", null, true);
            yield ": Equipe</p>
                            <img class=\"w-[24px]\" src=\"";
            // line 80
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl((("build/images/team/" . CoreExtension::getAttribute($this->env, $this->source, $context["team"], "name", [], "any", false, false, false, 80)) . ".svg")), "html", null, true);
            yield "\" alt=";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["team"], "name", [], "any", false, false, false, 80), "html", null, true);
            yield " >
                        </li>
                    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 83
            yield "                        <li class=\"text-gray-500\">Aucune équipe inscrite.</li>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['team'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 85
        yield "                </ul>

                <a href=\"";
        // line 87
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_team_add", ["tournamentId" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["tournament"]) || array_key_exists("tournament", $context) ? $context["tournament"] : (function () { throw new RuntimeError('Variable "tournament" does not exist.', 87, $this->source); })()), "id", [], "any", false, false, false, 87)]), "html", null, true);
        yield "\" class=\"mt-4 text-white bg-[--bg-green-light] px-2 mb-2 py-2 rounded text-sm text-center w-full\">
                    + Modifier l'équipe
                </a>
            </div>
            <div class=\"flex flex-col items-center justify-between rounded shadow-md bg-white w-full\">
                <h2 class=\"flex items-center justify-center text-sm font-bold bg-[--bg-green-dark] text-white w-full px-2 py-2 rounded-t\">Chronos</h2>

                <p id=\"timerDisplay\" class=\"text-2xl font-bold my-2\">00:00</p>

                <div class=\"flex space-x-2 p-2\">
                    <button id=\"startStopBtn\" class=\"px-4 py-2 bg-[--bg-green-light] text-white rounded text-sm w-full md:w-auto\">Démarrer</button>
                    <button id=\"resetBtn\" class=\"p-2 bg-neutral-300 text-white rounded text-sm w-full md:w-auto\">Redémarrer</button>
                </div>
            </div>
        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 105
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 106
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "

    <style>
        .tournament-tree {
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-x: auto;
        }

        .phase {
            margin: 20px 0;
            text-align: center;
        }

        .matches {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 131
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 132
        yield "    <script>
        document.addEventListener(\"DOMContentLoaded\", function () {
            let timer;
            let isRunning = false;
            let seconds = 0;

            function updateDisplay() {
                let mins = Math.floor(seconds / 60).toString().padStart(2, \"0\");
                let secs = (seconds % 60).toString().padStart(2, \"0\");
                document.getElementById(\"timerDisplay\").innerText = `\${mins}:\${secs}`;
            }

            function startStopTimer() {
                const btn = document.getElementById(\"startStopBtn\");

                if (isRunning) {
                    clearInterval(timer);
                    btn.innerText = \"Démarrer\";
                    btn.classList.replace(\"bg-red-500\", \"bg-blue-500\");
                } else {
                    timer = setInterval(() => {
                        seconds++;
                        updateDisplay();
                    }, 1000);
                    btn.innerText = \"Arrêter\";
                    btn.classList.replace(\"bg-blue-500\", \"bg-red-500\");
                }
                isRunning = !isRunning;
            }

            function resetTimer() {
                clearInterval(timer);
                seconds = 0;
                isRunning = false;
                updateDisplay();
                const btn = document.getElementById(\"startStopBtn\");
                btn.innerText = \"Démarrer\";
                btn.classList.replace(\"bg-red-500\", \"bg-blue-500\");
            }

            document.getElementById(\"startStopBtn\").addEventListener(\"click\", startStopTimer);
            document.getElementById(\"resetBtn\").addEventListener(\"click\", resetTimer);
        });
    </script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "tournament/show.html.twig";
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
        return array (  390 => 132,  377 => 131,  342 => 106,  329 => 105,  301 => 87,  297 => 85,  290 => 83,  280 => 80,  276 => 79,  273 => 78,  268 => 77,  260 => 71,  251 => 64,  243 => 61,  237 => 60,  231 => 57,  227 => 56,  219 => 53,  209 => 48,  204 => 46,  200 => 45,  197 => 44,  194 => 43,  190 => 42,  185 => 40,  180 => 39,  176 => 38,  173 => 37,  171 => 36,  165 => 34,  161 => 32,  159 => 31,  151 => 26,  147 => 25,  141 => 23,  137 => 21,  135 => 20,  132 => 19,  130 => 18,  127 => 17,  125 => 16,  119 => 13,  114 => 10,  112 => 9,  109 => 8,  106 => 7,  103 => 6,  90 => 5,  66 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Tournoi - {{ tournament.name }}{% endblock %}

{% block body %}
    {% include 'partial/header.html.twig' %}
    {% include 'partial/rightAside.html.twig' %}
    <div class=\"shadow\">
        {% include 'partial/doubleNav.html.twig' %}
    </div>
    <div class=\"flex w-full h-screen container mx-auto flex flex-col md:flex-row gap-4 md:gap-8 pt-6 text-xl font-medium main-content\">
        <div class=\"w-full md:w-[80%] flex flex-col items-center px-4\">
            <h1 class=\"text-2xl font-bold text-[--bg-green-light] text-center\">Tournoi : {{ tournament.name }}</h1>
            <ul class=\"flex flex-col md:flex-row w-full justify-between items-center mt-2 text-center md:text-left\">
                <li class=\"flex text-gray-700\">
                    {% if tournament.sport.name == 'football' %}
                        ⚽
                    {% elseif tournament.sport.name == 'tennis' %}
                        🎾
                    {% elseif tournament.sport.name == 'basketball' %}
                        🏀
                    {% endif %}
                    Sport : {{ tournament.sport.name }}
                </li>
                <li class=\"flex text-gray-700\">Lieu : {{ tournament.location }}</li>
                <li class=\"flex text-gray-700\">Date : {{ tournament.date|date('d/m/Y') }}</li>
            </ul>

            <h2 class=\"text-xl font-bold mt-6\">Matchs</h2>

            {% if matches is empty %}
                <p class=\"text-gray-500\">Aucun match généré pour l'instant.</p>
            {% else %}
                <form class=\"w-full\" action=\"{{ path('app_tournament_update_scores', {'id': tournament.id}) }}\" method=\"POST\">
                    <div class=\"tournament-tree w-full overflow-x-auto\">
                        {% set maxPhases = (matches|map(m => m.phase))|reduce((carry, item) => item > carry ? item : carry, 1) %}

                        {% for phase in maxPhases..1 %}
                            <div class=\"phase phase-{{ phase }}\">
                                <h2 class=\"text-center text-xl font-bold my-4\">Phase {{ phase }}</h2>
                                <div class=\"matches flex flex-wrap justify-center gap-x-4 gap-y-4 w-full overflow-x-auto\">
                                    {% for match in matches %}
                                        {% if match.phase == phase %}
                                            <div class=\"flex items-center justify-around border-2 rounded shadow py-2 px-2 gap-2 bg-white min-w-[280px]\">
                                                <img src=\"{{ asset('build/images/team/' ~ match.home.name|lower ~ '.svg') }}\"
                                                     alt=\"{{ match.home.name }}\" class=\"h-12 w-12 object-contain\">

                                                <input type=\"number\" name=\"home_score_{{ match.id }}\" value=\"{{ match.homeScore ?? '' }}\"
                                                       class=\"w-12 text-center border border-gray-300 rounded\">

                                                <p class=\"font-bold text-lg\">/</p>

                                                <input type=\"number\" name=\"visitor_score_{{ match.id }}\" value=\"{{ match.visitorScore ?? '' }}\"
                                                       class=\"w-12 text-center border border-gray-300 rounded\">

                                                <img src=\"{{ asset('build/images/team/' ~ match.visitor.name|lower ~ '.svg') }}\"
                                                     alt=\"{{ match.visitor.name }}\" class=\"h-12 w-12 object-contain\">
                                            </div>
                                        {% endif %}
                                    {% endfor %}
                                </div>
                            </div>
                        {% endfor %}
                    </div>

                    <div class=\"text-center my-6\">
                        <button type=\"submit\" class=\"px-6 py-2 bg-[--bg-green-dark] text-white rounded shadow w-full md:w-auto\">Valider les scores</button>
                    </div>
                </form>
            {% endif %}
        </div>

        <div class=\"flex flex-col w-full md:w-[20%] gap-8 px-4\">
            <div class=\"flex flex-col items-center justify-between rounded shadow-md w-full\">
                <h2 class=\"flex items-center justify-center text-sm font-bold bg-[--bg-green-dark] text-white w-full px-2 py-2 rounded-t\">Équipes participantes</h2>
                <ul class=\"w-full mt-2 px-2\">
                    {% for key, team in teams %}
                        <li class=\"flex items-center w-full justify-between text-sm\">
                            <p>{{ key + 1 }}: Equipe</p>
                            <img class=\"w-[24px]\" src=\"{{ asset('build/images/team/' ~ team.name ~ '.svg') }}\" alt={{ team.name }} >
                        </li>
                    {% else %}
                        <li class=\"text-gray-500\">Aucune équipe inscrite.</li>
                    {% endfor %}
                </ul>

                <a href=\"{{ path('app_team_add', {'tournamentId': tournament.id}) }}\" class=\"mt-4 text-white bg-[--bg-green-light] px-2 mb-2 py-2 rounded text-sm text-center w-full\">
                    + Modifier l'équipe
                </a>
            </div>
            <div class=\"flex flex-col items-center justify-between rounded shadow-md bg-white w-full\">
                <h2 class=\"flex items-center justify-center text-sm font-bold bg-[--bg-green-dark] text-white w-full px-2 py-2 rounded-t\">Chronos</h2>

                <p id=\"timerDisplay\" class=\"text-2xl font-bold my-2\">00:00</p>

                <div class=\"flex space-x-2 p-2\">
                    <button id=\"startStopBtn\" class=\"px-4 py-2 bg-[--bg-green-light] text-white rounded text-sm w-full md:w-auto\">Démarrer</button>
                    <button id=\"resetBtn\" class=\"p-2 bg-neutral-300 text-white rounded text-sm w-full md:w-auto\">Redémarrer</button>
                </div>
            </div>
        </div>
    </div>
{% endblock %}

{% block stylesheets %}
    {{ parent() }}

    <style>
        .tournament-tree {
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-x: auto;
        }

        .phase {
            margin: 20px 0;
            text-align: center;
        }

        .matches {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
    </style>
{% endblock %}


{% block javascripts %}
    <script>
        document.addEventListener(\"DOMContentLoaded\", function () {
            let timer;
            let isRunning = false;
            let seconds = 0;

            function updateDisplay() {
                let mins = Math.floor(seconds / 60).toString().padStart(2, \"0\");
                let secs = (seconds % 60).toString().padStart(2, \"0\");
                document.getElementById(\"timerDisplay\").innerText = `\${mins}:\${secs}`;
            }

            function startStopTimer() {
                const btn = document.getElementById(\"startStopBtn\");

                if (isRunning) {
                    clearInterval(timer);
                    btn.innerText = \"Démarrer\";
                    btn.classList.replace(\"bg-red-500\", \"bg-blue-500\");
                } else {
                    timer = setInterval(() => {
                        seconds++;
                        updateDisplay();
                    }, 1000);
                    btn.innerText = \"Arrêter\";
                    btn.classList.replace(\"bg-blue-500\", \"bg-red-500\");
                }
                isRunning = !isRunning;
            }

            function resetTimer() {
                clearInterval(timer);
                seconds = 0;
                isRunning = false;
                updateDisplay();
                const btn = document.getElementById(\"startStopBtn\");
                btn.innerText = \"Démarrer\";
                btn.classList.replace(\"bg-red-500\", \"bg-blue-500\");
            }

            document.getElementById(\"startStopBtn\").addEventListener(\"click\", startStopTimer);
            document.getElementById(\"resetBtn\").addEventListener(\"click\", resetTimer);
        });
    </script>
{% endblock %}", "tournament/show.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/tournament/show.html.twig");
    }
}
