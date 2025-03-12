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

/* base.html.twig */
class __TwigTemplate_d77987c72db7fd2c609e18170741c78e extends Template
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
            'title' => [$this, 'block_title'],
            'meta_description' => [$this, 'block_meta_description'],
            'meta_keywords' => [$this, 'block_meta_keywords'],
            'meta_author' => [$this, 'block_meta_author'],
            'meta_robots' => [$this, 'block_meta_robots'],
            'canonical' => [$this, 'block_canonical'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascripts' => [$this, 'block_javascripts'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta charset=\"UTF-8\">

    <title>";
        // line 7
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
    <meta name=\"description\" content=\"";
        // line 8
        yield from $this->unwrap()->yieldBlock('meta_description', $context, $blocks);
        yield "\">
    <meta name=\"keywords\" content=\"";
        // line 9
        yield from $this->unwrap()->yieldBlock('meta_keywords', $context, $blocks);
        yield "\">
    <meta name=\"author\" content=\"";
        // line 10
        yield from $this->unwrap()->yieldBlock('meta_author', $context, $blocks);
        yield "\">
    <meta name=\"robots\" content=\"";
        // line 11
        yield from $this->unwrap()->yieldBlock('meta_robots', $context, $blocks);
        yield "\">
    <meta name=\"generator\" content=\"ALOAS\">
    <link rel=\"canonical\" href=\"";
        // line 13
        yield from $this->unwrap()->yieldBlock('canonical', $context, $blocks);
        yield "\">
    <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/aloas-logo.png"), "html", null, true);
        yield "\">
    <link rel=\"icon\"
          href=\"data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text><text y=%221.3em%22 x=%220.2em%22 font-size=%2276%22 fill=%22%23fff%22>sf</text></svg>\">
    ";
        // line 17
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 20
        yield "
    ";
        // line 21
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 24
        yield "    <script src=\"https://kit.fontawesome.com/85b48dec81.js\" crossorigin=\"anonymous\"></script>
</head>
<body class=\"w-full\">
";
        // line 27
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 28
        yield "</body>
</html>
";
        yield from [];
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "ALOAS";
        yield from [];
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_description(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "ALOAS Gestion de tournoi";
        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_keywords(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "ALOAS SAE TOURNOI LYON1 VALETTE IUT ";
        yield from [];
    }

    // line 10
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_author(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "ALOAS";
        yield from [];
    }

    // line 11
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_robots(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "index, follow";
        yield from [];
    }

    // line 13
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_canonical(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 13), "uri", [], "any", false, false, false, 13), "html", null, true);
        yield from [];
    }

    // line 17
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 18
        yield "        ";
        yield $this->extensions['Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension']->renderWebpackLinkTags("app_css");
        yield "
    ";
        yield from [];
    }

    // line 21
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 22
        yield "        ";
        yield $this->extensions['Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension']->renderWebpackScriptTags("app");
        yield "
    ";
        yield from [];
    }

    // line 27
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
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
        return array (  207 => 27,  199 => 22,  192 => 21,  184 => 18,  177 => 17,  166 => 13,  155 => 11,  144 => 10,  133 => 9,  122 => 8,  111 => 7,  104 => 28,  102 => 27,  97 => 24,  95 => 21,  92 => 20,  90 => 17,  84 => 14,  80 => 13,  75 => 11,  71 => 10,  67 => 9,  63 => 8,  59 => 7,  51 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "base.html.twig", "/home/ubuntu/Projects/gestion-tournoi-aloas/templates/base.html.twig");
    }
}
