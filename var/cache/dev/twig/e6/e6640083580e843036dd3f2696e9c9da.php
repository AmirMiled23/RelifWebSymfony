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

/* AjoutEvent.html.twig */
class __TwigTemplate_d0cd2c29a0df7657bda17f2396fd86f5 extends Template
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
        // line 2
        return "backoff.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "AjoutEvent.html.twig"));

        $this->parent = $this->loadTemplate("backoff.html.twig", "AjoutEvent.html.twig", 2);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Ajouter une Catégorie";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 7
        yield "<div style=\"margin-top: 70px;\">
    <div class=\"container mt-5\">
        <h1>Ajouter une Catégorie</h1>

        <form method=\"post\" enctype=\"multipart/form-data\">
            <div class=\"mb-3\">
                <label for=\"nom\" class=\"form-label\">Nom</label>
                <input type=\"text\" id=\"nom\" name=\"nom\" class=\"form-control\" placeholder=\"Entrez le nom\">
            </div>

            <div class=\"mb-3\">
                <label for=\"description\" class=\"form-label\">Description</label>
                <textarea id=\"description\" name=\"description\" class=\"form-control\" placeholder=\"Entrez la description\"></textarea>
            </div>

            <div class=\"mb-3\">
                <label for=\"image\" class=\"form-label\">Image</label>
                <input type=\"file\" id=\"image\" name=\"image\" class=\"form-control\">
            </div>

            <button type=\"submit\" class=\"btn btn-primary\">Ajouter Catégorie</button>
        </form>
    </div>
</div/    
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "AjoutEvent.html.twig";
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
        return array (  85 => 7,  75 => 6,  58 => 4,  41 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/AjoutEvent.html.twig #}
{% extends 'backoff.html.twig' %}

{% block title %}Ajouter une Catégorie{% endblock %}

{% block body %}
<div style=\"margin-top: 70px;\">
    <div class=\"container mt-5\">
        <h1>Ajouter une Catégorie</h1>

        <form method=\"post\" enctype=\"multipart/form-data\">
            <div class=\"mb-3\">
                <label for=\"nom\" class=\"form-label\">Nom</label>
                <input type=\"text\" id=\"nom\" name=\"nom\" class=\"form-control\" placeholder=\"Entrez le nom\">
            </div>

            <div class=\"mb-3\">
                <label for=\"description\" class=\"form-label\">Description</label>
                <textarea id=\"description\" name=\"description\" class=\"form-control\" placeholder=\"Entrez la description\"></textarea>
            </div>

            <div class=\"mb-3\">
                <label for=\"image\" class=\"form-label\">Image</label>
                <input type=\"file\" id=\"image\" name=\"image\" class=\"form-control\">
            </div>

            <button type=\"submit\" class=\"btn btn-primary\">Ajouter Catégorie</button>
        </form>
    </div>
</div/    
{% endblock %}
", "AjoutEvent.html.twig", "C:\\Users\\amirm\\Desktop\\PI WORKSHOPS\\piNFnlCOP\\Pi\\Pi\\templates\\AjoutEvent.html.twig");
    }
}
