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

/* tournament/add.html.twig */
class __TwigTemplate_7883078917d16566ef6f73279e7f32d4 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "tournament/add.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Créer un tournoi";
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
        yield from         $this->loadTemplate("partial/header.html.twig", "tournament/add.html.twig", 6)->unwrap()->yield($context);
        // line 7
        yield "    ";
        yield from         $this->loadTemplate("partial/rightAside.html.twig", "tournament/add.html.twig", 7)->unwrap()->yield($context);
        // line 8
        yield "    <div class=\"w-full h-[91vh] flex items-center justify-center \">
        <section class=\"container mx-auto max-w-[340px] max-h-[380px] h-3/4 rounded-lg flex flex-col\">
            <div class=\"rounded-t\">
                <div class=\"w-full flex pb-4\">
                    <svg class=\"step-icon rounded-tl-lg active\" viewBox=\"0 0 30 2\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                        <rect width=\"30\" height=\"2\" />
                    </svg>
                    <svg class=\"step-icon\" viewBox=\"0 0 30 2\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                        <rect width=\"30\" height=\"2\" />
                    </svg>
                    <svg class=\"step-icon rounded-tr-lg\" viewBox=\"0 0 30 2\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                        <rect width=\"30\" height=\"2\"/>
                    </svg>
                </div>
                <h1 class=\"px-4 h-[30%] font-bold text-xl pb-4\">Créer un tournoi</h1>
                <p class=\"px-4 text-sm step-text\" style=\"display: flex;\">Toutes les données peuvent être modifiées ultérieurement.</p>
                <p class=\"px-4 text-sm step-text\" style=\"display: none;\">Inscrivez le nom du club, du parc sportif ou de la salle.</p>
                <p class=\"px-4 text-sm step-text\" style=\"display: none;\">Choisissez un sport de la liste.</p>
            </div>

            ";
        // line 28
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["form"] ?? null), 'form_start', ["attr" => ["class" => "h-full flex flex-col pb-4"]]);
        yield "

            <div id=\"tournamentForm\" class=\"px-4 h-full flex flex-col justify-between align-beetween\">

                <!-- Step 1 -->
                <div class=\"form-step h-full flex flex-col justify-between\" id=\"step-1\" style=\"display: flex;\">
                    <div class=\"h-full flex flex-col justify-between\">
                        <div class=\"flex flex-col gap-6 mt-4\">
                            ";
        // line 36
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "name", [], "any", false, false, false, 36), 'row');
        yield "
                            ";
        // line 37
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "date", [], "any", false, false, false, 37), 'row');
        yield "
                        </div>
                        <div class=\"w-full flex font-medium justify-end gap-2\">
                            <a href=\"";
        // line 40
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tournament_list");
        yield "\" class=\"opacity-70 flex bg-slate-300 items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \">
                                <p class=\"text-slate-500\">Annuler</p>
                            </a>
                            <button class=\"flex bg-[--bg-green-light] text-white items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"button\" id=\"next-step-1\">Suivant</button>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class=\"form-step h-full flex flex-col justify-between\" id=\"step-2\" style=\"display: none;\">
                    <div class=\"h-full flex flex-col justify-between\">
                        <div class=\"flex flex-col gap-6 mt-4\">
                            ";
        // line 54
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "location", [], "any", false, false, false, 54), 'row');
        yield "
                        </div>
                        <div class=\"w-full flex font-medium justify-end gap-2\">
                            <button class=\"opacity-70 flex bg-slate-300 items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"button\" id=\"prev-step-2\">Précédent</button>
                            <button class=\"flex bg-[--bg-green-light] text-white items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"button\" id=\"next-step-2\">Suivant</button>
                        </div>
                    </div>
                </div>

                <!-- Step 3 (Final Step) -->
                <div class=\"form-step h-full flex flex-col justify-between\" id=\"step-3\" style=\"display: none;\">
                    <div class=\"h-full flex flex-col justify-between\">
                        <div class=\"flex flex-col gap-6 mt-4\">
                            ";
        // line 69
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "sport", [], "any", false, false, false, 69), 'row');
        yield "
                        </div>
                        <div class=\"w-full flex font-medium justify-end gap-2\">
                            <button class=\"opacity-70 flex bg-slate-300 items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"button\" id=\"prev-step-3\">Précédent</button>
                            <button class=\"flex bg-[--bg-green-light] text-white items-center justify-center w-1/4
                    gap-4 rounded px-2 text-sm py-1 \" type=\"submit\">Envoyer</button>
                        </div>
                    </div>
                </div>
            </div>

            ";
        // line 81
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["form"] ?? null), 'form_end');
        yield "

        </section>
    </div>

";
        yield from [];
    }

    // line 88
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 89
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
";
        yield from [];
    }

    // line 92
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 93
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
        return "tournament/add.html.twig";
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
        return array (  204 => 93,  197 => 92,  189 => 89,  182 => 88,  171 => 81,  156 => 69,  138 => 54,  121 => 40,  115 => 37,  111 => 36,  100 => 28,  78 => 8,  75 => 7,  72 => 6,  65 => 5,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "tournament/add.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/tournament/add.html.twig");
    }
}
